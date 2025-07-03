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

        try {
            $request->authenticate();
        } catch (\Illuminate\Validation\ValidationException $e) {
            // If rate limited, show lockout UI
            $errorBag = $e->errors();
            if (isset($errorBag['email']) && str_contains($errorBag['email'][0], 'Too many login attempts')) {
                preg_match('/in (\d+) seconds?/', $errorBag['email'][0], $matches);
                $seconds = isset($matches[1]) ? (int)$matches[1] : 60;
                return back()->withErrors([
                    'email' => __('auth.throttle', ['seconds' => $seconds]),
                ])->withInput()->with('lockout', true);
            }
            // Otherwise, show normal error
            return back()->withErrors($e->errors())->withInput();
        }

        // After successful authentication, handle seller/user logic
        $credentials = $request->only('email', 'password');
        $isSeller = \App\Models\Seller::where('email', $credentials['email'])->exists();
        $remember = $request->boolean('remember');

        if ($isSeller) {
            Auth::guard('web')->logout();
            Auth::guard('seller')->attempt($credentials, $remember);
            $request->session()->regenerate();
            return redirect(route('seller.dashboard'));
        } else {
            Auth::guard('seller')->logout();
            Auth::guard('web')->attempt($credentials, $remember);
            $request->session()->regenerate();
            $user = Auth::guard('web')->user();
            if ($user && $user->two_factor_secret) {
                session()->put('login', ['id' => $user->getAuthIdentifier()]);
                session(['2fa_required' => true]);
                session()->put('url.intended', route('dashboard'));
                return redirect()->intended('/dashboard');
            }
            return redirect()->intended('/dashboard');
        }
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
