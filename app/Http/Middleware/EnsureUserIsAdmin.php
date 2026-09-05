<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserIsAdmin
{
    /**
     * Allow only authenticated admin users into the admin portal.
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!Auth::check()) {
            return redirect()->route('login')
                ->with('error', 'অ্যাডমিন প্যানেলে ঢুকতে আগে লগইন করুন।');
        }

        if (!Auth::user()->is_admin) {
            abort(403, 'এই এরিয়ায় শুধুমাত্র অ্যাডমিনদের প্রবেশাধিকার আছে।');
        }

        return $next($request);
    }
}
