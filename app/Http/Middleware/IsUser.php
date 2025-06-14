<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class IsUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check()) {
            \Illuminate\Support\Facades\Log::info('User is authenticated. User role: ' . Auth::user()->role);
            if (Auth::user()->role === 'user') {
            return $next($request);
        }

        } else {
            \Illuminate\Support\Facades\Log::warning('User is authenticated but does not have the \'user\' role.');
        }

        abort(403, 'Unauthorized action.');
    }
}