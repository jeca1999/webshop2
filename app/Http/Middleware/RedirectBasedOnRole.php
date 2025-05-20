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
        if (Auth::guard('web')->check()) {
            return redirect()->route('dashboard');
        }

        // If logged in as seller
        if (Auth::guard('seller')->check()) {
            return redirect()->route('sellerdashboard');
        }

        // If not authenticated, continue (or redirect to login)
        return $next($request);
    }
}
