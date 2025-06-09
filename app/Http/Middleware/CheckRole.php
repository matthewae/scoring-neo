<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        if (!auth()->check()) {
            Log::warning('User not authenticated when accessing role-protected route.');
            abort(403, 'Unauthorized action: User not authenticated.');
        }

        $userRole = auth()->user()->role;
        Log::info('User role: ' . $userRole . ', Required roles: ' . implode(', ', $roles));

        if (!in_array($userRole, $roles)) {
            abort(403, 'Unauthorized action: Insufficient role.');
        }

        return $next($request);
    }
}
