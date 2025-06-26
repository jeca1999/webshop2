<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Support\Facades\Session;
use Laravel\Fortify\Http\Controllers\TwoFactorAuthenticatedSessionController as FortifyTwoFactorController;
use Laravel\Fortify\Http\Requests\TwoFactorLoginRequest;
use Illuminate\Http\RedirectResponse;

class TwoFactorModalController extends FortifyTwoFactorController
{
    public function store(TwoFactorLoginRequest $request): RedirectResponse
    {
        $response = parent::store($request);
        // Only clear the session flag if the code was correct (redirect is NOT back)
        if (method_exists($response, 'getTargetUrl') && !str_contains($response->getTargetUrl(), url('/two-factor-challenge'))) {
            Session::forget('2fa_required');
        }
        return $response;
    }
}
