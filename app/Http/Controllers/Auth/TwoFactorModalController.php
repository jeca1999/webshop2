<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Support\Facades\Log;
use Laravel\Fortify\Http\Controllers\TwoFactorAuthenticatedSessionController as FortifyTwoFactorController;
use Laravel\Fortify\Http\Requests\TwoFactorLoginRequest;

class TwoFactorModalController extends FortifyTwoFactorController
{
    public function store(TwoFactorLoginRequest $request)
    {
        file_put_contents(storage_path('logs/2fa_debug.txt'), 'Controller hit: '.now().PHP_EOL, FILE_APPEND);
        $response = parent::store($request);
        $consoleScript = '';
        if (method_exists($response, 'getTargetUrl') && !str_contains($response->getTargetUrl(), url('/two-factor-challenge'))) {
            $request->session()->forget('2fa_required');
            $request->session()->save(); // Use request session instance
            \Log::info('2FA cleared', [
                'user_id' => auth()->id(),
                'session' => $request->session()->all(),
                'redirect' => $response->getTargetUrl(),
            ]);
            $consoleScript = "<script>console.log('2FA cleared', 'user_id: ".addslashes(auth()->id())."', 'session: ".addslashes(json_encode($request->session()->all()))."', 'redirect: ".addslashes($response->getTargetUrl())."');</script>";
        } else {
            \Log::info('2FA NOT cleared', [
                'user_id' => auth()->id(),
                'session' => $request->session()->all(),
                'redirect' => method_exists($response, 'getTargetUrl') ? $response->getTargetUrl() : null,
            ]);
            $consoleScript = "<script>console.log('2FA NOT cleared', 'user_id: ".addslashes(auth()->id())."', 'session: ".addslashes(json_encode($request->session()->all()))."', 'redirect: ".addslashes(method_exists($response, 'getTargetUrl') ? $response->getTargetUrl() : '')."');</script>";
        }
        if (method_exists($response, 'getTargetUrl')) {
            $request->session()->flash('console_script', $consoleScript);
        }
        return $response;
    }
}
