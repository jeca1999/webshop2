<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Laravel\Fortify\Actions\ConfirmTwoFactorAuthentication;
use Laravel\Fortify\Http\Controllers\TwoFactorAuthenticatedSessionController as FortifyTwoFactorController;
use Illuminate\Http\RedirectResponse;

class TwoFactorModalController extends FortifyTwoFactorController
{
    public function store(Request $request): RedirectResponse
    {
        // Use Fortify's logic to validate the code
        $response = parent::store($request);
        // On success, clear the modal session flag
        Session::forget('2fa_required');
        return $response;
    }
}
