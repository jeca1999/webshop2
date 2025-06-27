<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class PasswordController extends Controller
{
    /**
     * Update the user's password.
     */
    public function update(Request $request): RedirectResponse
    {
        $validated = $request->validateWithBag('updatePassword', [
            'current_password' => ['required', 'current_password'],
            'password' => ['required', Password::defaults(), 'confirmed'],
        ]);

        $user = $request->user();
        // If 2FA is enabled, require and validate the code
        if ($user->two_factor_secret) {
            $request->validateWithBag('updatePassword', [
                'two_factor_code' => ['required', 'digits:6'],
            ]);
            if (!app('pragmarx.google2fa')->verifyKey(decrypt($user->two_factor_secret), $request->input('two_factor_code'))) {
                return back()->withErrors(['two_factor_code' => 'The provided two-factor code is invalid.'])->withInput();
            }
        }

        $request->user()->update([
            'password' => Hash::make($validated['password']),
        ]);

        return back()->with('status', 'password-updated');
    }
}
