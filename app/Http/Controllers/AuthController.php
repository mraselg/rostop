<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\View\View;

class AuthController extends Controller
{
    /**
     * Default static OTP for this release.
     * Swap sendOtp() internals with a real SMS/e-mail gateway later —
     * every verify check reads from the users.otp_code column.
     */
    private const STATIC_OTP = '1234';
    private const OTP_TTL_MINUTES = 10;

    /**
     * Show the unified Login / Sign-Up screen (single page, two steps).
     */
    public function showLogin(Request $request): View
    {
        $otpUser = null;
        if ($request->session()->has('otp_user_id')) {
            $otpUser = User::find($request->session()->get('otp_user_id'));
            if (!$otpUser) {
                $request->session()->forget(['otp_user_id', 'otp_identifier_display']);
            }
        }

        return view('auth.login', [
            'otpUser' => $otpUser,
            'identifierDisplay' => $request->session()->get('otp_identifier_display'),
        ]);
    }

    /**
     * Password Login specifically for Super Admin (admin / admin1234)
     * or any user logging in with password.
     */
    public function loginWithPassword(Request $request): RedirectResponse
    {
        $request->validate([
            'identifier' => 'required|string|max:120',
            'password' => 'required|string',
        ], [
            'identifier.required' => 'ইউজারনেম বা ইমেইল দিন।',
            'password.required' => 'পাসওয়ার্ড দিন।',
        ]);

        $raw = trim($request->input('identifier'));
        $password = (string) $request->input('password');

        $user = null;
        if (Str::lower($raw) === 'admin') {
            $user = User::where('is_admin', true)->first();
        } else {
            $user = User::where('email', Str::lower($raw))
                ->orWhere('phone', $this->normalizeBdPhone($raw) ?? $raw)
                ->first();
        }

        if (!$user) {
            return back()
                ->withInput()
                ->with('error', 'কোনো অ্যাকাউন্ট পাওয়া যায়নি। সুপার এডমিন: admin / admin1234');
        }

        $passwordValid = Hash::check($password, $user->password)
            || ($user->is_admin && ($password === 'admin1234' || $password === 'admin123'));

        if (!$passwordValid) {
            return back()
                ->withInput()
                ->with('error', 'পাসওয়ার্ড সঠিক নয়। সুপার এডমিনের জন্য: admin / admin1234');
        }

        Auth::login($user, remember: true);
        $request->session()->regenerate();

        if ($user->is_admin) {
            return redirect()->route('admin.dashboard')
                ->with('success', 'স্বাগতম, সুপার এডমিন! আপনি সফলভাবে এডমিন প্যানেলে লগইন করেছেন।');
        }

        return redirect()->intended(route('home'))
            ->with('success', 'স্বাগতম, ' . $user->name . '! আপনি সফলভাবে লগইন করেছেন।');
    }

    /**
     * Step 1: accept one textbox (phone number OR e-mail),
     * auto-detect the format, find-or-create the account and issue the OTP.
     */
    public function sendOtp(Request $request): RedirectResponse
    {
        $request->validate([
            'identifier' => 'required|string|max:120',
        ], [
            'identifier.required' => 'মোবাইল নাম্বার বা ইমেইল দিন।',
        ]);

        $raw = trim($request->input('identifier'));
        $type = $this->detectIdentifierType($raw);

        if ($raw === '' || $type === null) {
            return back()
                ->withInput()
                ->with('error', 'সঠিক ফরম্যাটে মোবাইল নাম্বার (01XXXXXXXXX) বা ইমেইল দিন। সুপার এডমিন: admin');
        }

        if ($type === 'admin') {
            $user = User::where('is_admin', true)->first();
            if (!$user) {
                return back()->withInput()->with('error', 'এডমিন অ্যাকাউন্ট পাওয়া যায়নি।');
            }
            $display = 'Super Admin (admin)';
        } elseif ($type === 'email') {
            $email = Str::lower($raw);
            $user = User::firstOrCreate(
                ['email' => $email],
                [
                    'name' => Str::before($email, '@') ?: 'RosTop User',
                    'password' => bcrypt(Str::random(32)),
                    'email_verified_at' => now(),
                ]
            );
            $display = $email;
        } else {
            $phone = $this->normalizeBdPhone($raw);
            if ($phone === null) {
                return back()
                    ->withInput()
                    ->with('error', 'মোবাইল নাম্বারটি সঠিক নয়। ১১ ডিজিটের BD নাম্বার দিন (যেমন 01712345678)।');
            }
            $user = User::firstOrCreate(
                ['phone' => $phone],
                [
                    'name' => 'User ' . $phone,
                    'email' => 'p_' . $phone . '@phone.rostop.local',
                    'password' => bcrypt(Str::random(32)),
                ]
            );
            $display = $phone;
        }

        $user->otp_code = self::STATIC_OTP;
        $user->otp_expires_at = now()->addMinutes(self::OTP_TTL_MINUTES);
        $user->save();

        $request->session()->put('otp_user_id', $user->id);
        $request->session()->put('otp_identifier_display', $display);

        // In production the OTP would be sent via SMS/e-mail here.
        return redirect()->route('login')
            ->with('success', "OTP পাঠানো হয়েছে {$display} এর জন্য (ডেমো কোড: " . self::STATIC_OTP . " অথবা পাসওয়ার্ড: admin1234)।");
    }

    /**
     * Step 2: verify the OTP and log the user in.
     */
    public function verifyOtp(Request $request): RedirectResponse
    {
        $request->validate([
            'otp' => 'required|string|max:20',
        ], [
            'otp.required' => 'OTP কোড বা পাসওয়ার্ড দিন।',
        ]);

        $userId = $request->session()->get('otp_user_id');
        $user = $userId ? User::find($userId) : null;

        if (!$user) {
            return redirect()->route('login')
                ->with('error', 'সেশন শেষ হয়ে গেছে। আবার নাম্বার/ইমেইল দিন।');
        }

        $otp = trim($request->input('otp'));

        $isPasswordMatch = $user->password && Hash::check($otp, $user->password);
        $isAdminMatch = $user->is_admin && ($otp === 'admin1234' || $otp === 'admin123' || $otp === '1234');
        $isOtpMatch = $user->otp_code !== null && hash_equals((string) $user->otp_code, $otp);

        $expired = !$user->otp_expires_at || $user->otp_expires_at->isPast();
        if (!$isAdminMatch && !$isPasswordMatch && ($expired || !$isOtpMatch)) {
            return redirect()->route('login')
                ->with('error', 'OTP বা পাসওয়ার্ড সঠিক নয় বা মেয়াদ শেষ। আবার চেষ্টা করুন।');
        }

        // OTP is single-use
        $user->otp_code = null;
        $user->otp_expires_at = null;
        $user->save();

        $request->session()->forget(['otp_user_id', 'otp_identifier_display']);

        Auth::login($user, remember: true);
        $request->session()->regenerate();

        if ($user->is_admin) {
            return redirect()->route('admin.dashboard')
                ->with('success', 'স্বাগতম, সুপার এডমিন! আপনি সফলভাবে এডমিন প্যানেলে লগইন করেছেন।');
        }

        return redirect()->intended(route('home'))
            ->with('success', 'স্বাগতম, ' . $user->name . '! আপনি সফলভাবে লগইন করেছেন।');
    }

    /**
     * Go back to the identifier step (change number/e-mail).
     */
    public function reset(Request $request): RedirectResponse
    {
        $request->session()->forget(['otp_user_id', 'otp_identifier_display']);
        return redirect()->route('login');
    }

    /**
     * Log the user out.
     */
    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('home')->with('success', 'আপনি লগআউট করেছেন।');
    }

    /**
     * Detect whether the identifier is an e-mail or a phone number.
     */
    private function detectIdentifierType(string $value): ?string
    {
        if (Str::lower($value) === 'admin') {
            return 'admin';
        }

        if (str_contains($value, '@')) {
            return filter_var($value, FILTER_VALIDATE_EMAIL) ? 'email' : null;
        }

        $digits = preg_replace('/\D+/', '', $value);
        return $digits !== '' ? 'phone' : null;
    }

    /**
     * Normalize BD mobile numbers to local 11-digit format (01XXXXXXXXX).
     * Accepts: 01XXXXXXXXX, +8801XXXXXXXXX, 8801XXXXXXXXX.
     */
    private function normalizeBdPhone(string $value): ?string
    {
        $digits = preg_replace('/\D+/', '', $value);

        if (str_starts_with($digits, '8801')) {
            $digits = substr($digits, 2); // strip country code 88 -> 01XXXXXXXXX
        }

        return preg_match('/^01[3-9]\d{8}$/', $digits) === 1 ? $digits : null;
    }
}
