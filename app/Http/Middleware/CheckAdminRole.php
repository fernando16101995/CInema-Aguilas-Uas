<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckAdminRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // 1. Revisa si el usuario está logueado
    // 2. Revisa si el rol de ese usuario es "admin"
    if (auth()->check() && auth()->user()->role == 'admin') {
        // Si es admin, déjalo pasar
        return $next($request);
    }

    // Si no es admin, regrésalo al dashboard normal
    return redirect('/dashboard');
    }
}
