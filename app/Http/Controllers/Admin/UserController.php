<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class UserController extends Controller
{
    /**
     * All registered users with search.
     */
    public function index(Request $request): View
    {
        $query = User::orderBy('id', 'desc');

        if ($request->filled('q')) {
            $q = trim($request->query('q'));
            $query->where(function ($sub) use ($q) {
                $sub->where('name', 'like', "%{$q}%")
                    ->orWhere('email', 'like', "%{$q}%")
                    ->orWhere('phone', 'like', "%{$q}%");
            });
        }

        $users = $query->paginate(20)->withQueryString();

        return view('admin.users.index', compact('users'));
    }

    /**
     * Grant / revoke admin access.
     */
    public function toggleAdmin(int $id): RedirectResponse
    {
        $user = User::findOrFail($id);

        if ($user->id === Auth::id()) {
            return back()->with('error', 'নিজের অ্যাডমিন অ্যাক্সেস পরিবর্তন করা যাবে না।');
        }

        $user->is_admin = !$user->is_admin;
        $user->save();

        return back()->with('success', $user->is_admin
            ? "{$user->name} এখন অ্যাডমিন।"
            : "{$user->name}-এর অ্যাডমিন অ্যাক্সেস বন্ধ করা হয়েছে।");
    }

    /**
     * Delete a user account.
     */
    public function destroy(int $id): RedirectResponse
    {
        $user = User::findOrFail($id);

        if ($user->id === Auth::id()) {
            return back()->with('error', 'নিজের অ্যাকাউন্ট ডিলিট করা যাবে না।');
        }

        $name = $user->name;
        $user->delete();

        return redirect()->route('admin.users.index')
            ->with('success', "ইউজার '{$name}' ডিলিট করা হয়েছে।");
    }
}
