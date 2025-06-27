<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\UpdatesUserPasswords;
use PragmaRX\Google2FA\Google2FA;

class UpdateUserPasswordWith2FA implements UpdatesUserPasswords
{
    use PasswordValidationRules;

    /**
     * Validate and update the user's password, requiring 2FA code if enabled.
     *
     * @param  array<string, string>  $input
     */
    public function update(User $user, array $input): void
    {
        Validator::make($input, [
            'current_password' => ['required', 'string', 'current_password:web'],
            'password' => $this->passwordRules(),
            'two_factor_code' => $user->two_factor_secret ? ['required', 'digits:6'] : ['nullable'],
        ], [
            'current_password.current_password' => __('The provided password does not match your current password.'),
            'two_factor_code.required' => __('The two-factor authentication code is required.'),
            'two_factor_code.digits' => __('The two-factor authentication code must be 6 digits.'),
        ])->validateWithBag('updatePassword');

        if ($user->two_factor_secret) {
            $google2fa = new Google2FA();
            $valid = $google2fa->verifyKey(
                decrypt($user->two_factor_secret),
                $input['two_factor_code']
            );
            if (!$valid) {
                throw \Illuminate\Validation\ValidationException::withMessages([
                    'two_factor_code' => [__('The provided two-factor authentication code is invalid.')],
                ])->errorBag('updatePassword');
            }
        }

        $user->forceFill([
            'password' => Hash::make($input['password']),
        ])->save();
    }
}
