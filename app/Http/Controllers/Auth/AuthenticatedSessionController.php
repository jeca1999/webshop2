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

        $credentials = $request->only('email', 'password');
        $remember = $request->boolean('remember');

        // Check if email exists in sellers table
        $isSeller = \App\Models\Seller::where('email', $credentials['email'])->exists();

        if ($isSeller) {
            if (Auth::guard('seller')->attempt($credentials, $remember)) {
                Auth::guard('web')->logout();
                $request->session()->regenerate();
                // Sellers do NOT get 2FA, redirect immediately
                return redirect()->intended('/seller/dashboard');
            }
        } else {
            if (Auth::guard('web')->attempt($credentials, $remember)) {
                Auth::guard('seller')->logout();
                $request->session()->regenerate();
                $user = Auth::guard('web')->user();
                if ($user && $user->two_factor_secret) {
                    session(['2fa_required' => true, 'login.id' => $user->getAuthIdentifier()]);
                    // Ensure intended URL is set for post-2FA redirect
                    session()->put('url.intended', route('dashboard'));
                    return redirect()->intended('/dashboard');
                }
                return redirect()->intended('/dashboard');
            }
        }

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
            Auth::guard('seller')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
