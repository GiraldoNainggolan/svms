<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next, string $role): Response
    {
        // CEK AUTH DULU (PENTING)
        if (!auth()->check()) {
            return redirect('/login');
        }

        // CEK ROLE
        if (auth()->user()->role !== $role) {
            abort(403, 'Akses ditolak.');
        }

        return $next($request);
    }
}