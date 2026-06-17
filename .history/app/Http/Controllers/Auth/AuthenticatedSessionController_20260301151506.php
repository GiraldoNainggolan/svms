<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\ActivityLog;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        // AUTO REDIRECT BY ROLE
        $user = auth()->user();

        ActivityLog::log('login', "{$user->name} ({$user->role}) berhasil login", $user);

        if ($user->role === 'super_admin') {
            return redirect('/admin');
        }

        if ($user->role === 'security') {
            return redirect('/security');
        }

        if ($user->role === 'staff') {
            return redirect('/staff');
        }

        return redirect('/');
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $user = auth()->user();
        if ($user) {
            ActivityLog::log('logout', "{$user->name} logout", $user);
        }

        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
