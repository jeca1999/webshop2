<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EnsureEmailIsVerified
{
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check() && (is_null(Auth::user()->email_verified_at) || !empty(Auth::user()->email_verification_code))) {
            return redirect()->route('verification.code.notice');
        }
        return $next($request);
    }
}
