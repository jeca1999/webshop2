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

        try {
            if ($isSeller) {
                if (Auth::guard('seller')->attempt($credentials, $remember)) {
                    Auth::guard('web')->logout();
                    $request->session()->regenerate();
                    // Sellers do NOT get 2FA, always redirect to dashboard
                    return redirect(route('seller.dashboard'));
                }
            } else {
                if (Auth::guard('web')->attempt($credentials, $remember)) {
                    Auth::guard('seller')->logout();
                    $request->session()->regenerate();
                    $user = Auth::guard('web')->user();
                    if ($user && $user->two_factor_secret) {
                        // Set the session key as an array for Fortify compatibility
                        session()->put('login', ['id' => $user->getAuthIdentifier()]);
                        session(['2fa_required' => true]);
                        session()->put('url.intended', route('dashboard'));
                        return redirect()->intended('/dashboard');
                    }
                    return redirect()->intended('/dashboard');
                }
            }
        } catch (\Illuminate\Http\Exceptions\ThrottleRequestsException $e) {
            // Always show a user-friendly message and timer, never a raw 429
            $seconds = 60;
            if (method_exists($e, 'getHeaders')) {
                $headers = $e->getHeaders();
                if (isset($headers['Retry-After'])) {
                    $seconds = (int) $headers['Retry-After'];
                }
            }
            if ($seconds === 60 && preg_match('/(\d+)/', $e->getMessage(), $matches)) {
                $seconds = (int) $matches[1];
            }
            // Set a custom status code to avoid Laravel's default 429 response
            return back()->withErrors([
                'email' => __('auth.throttle', ['seconds' => $seconds]),
            ])->withInput()->with('lockout', true);
        }

        // If login failed but not throttled
        return back()->withErrors([
            'email' => __('auth.failed'),
        ])->withInput();
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
