<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
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
    $request->validate([
        'email' => ['required', 'string', 'email'],
        'password' => ['required', 'string'],
    ]);

    // Try to login as a regular user first
    if (Auth::guard('web')->attempt($request->only('email', 'password'), $request->boolean('remember'))) {
        Auth::guard('seller')->logout(); // Ensure seller guard is logged out
        $request->session()->regenerate();
        return redirect()->intended('/dashboard');
    }

    // Only try seller if user login failed
    if (Auth::guard('seller')->attempt($request->only('email', 'password'), $request->boolean('remember'))) {
        Auth::guard('web')->logout(); // Ensure user guard is logged out
        $request->session()->regenerate();
        return redirect()->intended('/sellerdashboard');
    }

    // If neither, return error
    return back()->withErrors([
        'email' => __('auth.failed'),
    ]);
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
