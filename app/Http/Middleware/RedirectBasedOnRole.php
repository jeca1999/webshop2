<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RedirectBasedOnRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // If logged in as user (client)
        if (Auth::guard('web')->check() && Auth::user()->role === 'client') {
            return redirect()->route('client.dashboard');
        }

        // If logged in as seller
        if (Auth::guard('seller')->check() && Auth::guard('seller')->user()->role === 'seller') {
            return redirect()->route('seller.dashboard');
        }

        // If not authenticated, continue (or redirect to login)
        return $next($request);
    }
}
