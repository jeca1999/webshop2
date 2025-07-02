<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Exceptions\ThrottleRequestsException;
use Illuminate\Http\Request;

class Handler extends ExceptionHandler
{
    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {
        $this->renderable(function (ThrottleRequestsException $e, Request $request) {
            // Only handle login POST requests
            if ($request->is('login') && $request->isMethod('post')) {
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
                return redirect()->back()
                    ->withErrors(['email' => __('auth.throttle', ['seconds' => $seconds])])
                    ->withInput()
                    ->with('lockout', true);
            }
        });
    }
}
