<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Log;
use Laravel\Fortify\Http\Controllers\TwoFactorAuthenticatedSessionController as FortifyTwoFactorController;
use Laravel\Fortify\Http\Requests\TwoFactorLoginRequest;

class TwoFactorModalController extends FortifyTwoFactorController
{
    public function store(TwoFactorLoginRequest $request)
    {
        $response = parent::store($request);
        // Only clear the session flag if the code was correct (redirect is NOT back)
        $consoleScript = '';
        if (method_exists($response, 'getTargetUrl') && !str_contains($response->getTargetUrl(), url('/two-factor-challenge'))) {
            Session::forget('2fa_required');
            Log::info('2FA cleared', [
                'user_id' => auth()->id(),
                'session' => session()->all(),
                'redirect' => $response->getTargetUrl(),
            ]);
            $consoleScript = "<script>console.log('2FA cleared', 'user_id: ".addslashes(auth()->id())."', 'session: ".addslashes(json_encode(session()->all()))."', 'redirect: ".addslashes($response->getTargetUrl())."');</script>";
        } else {
            Log::info('2FA NOT cleared', [
                'user_id' => auth()->id(),
                'session' => session()->all(),
                'redirect' => method_exists($response, 'getTargetUrl') ? $response->getTargetUrl() : null,
            ]);
            $consoleScript = "<script>console.log('2FA NOT cleared', 'user_id: ".addslashes(auth()->id())."', 'session: ".addslashes(json_encode(session()->all()))."', 'redirect: ".addslashes(method_exists($response, 'getTargetUrl') ? $response->getTargetUrl() : '')."');</script>";
        }
        // If response is a redirect, flash the script to session for next request
        if (method_exists($response, 'getTargetUrl')) {
            session()->flash('console_script', $consoleScript);
        }
        return $response;
    }
}
