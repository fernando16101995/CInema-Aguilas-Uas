<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class EnsureProfileIsSelected
{
    /**
     * Maneja una solicitud entrante.
     *
     * Revisa si el 'active_profile_id' existe en la sesión.
     * Si no existe, redirige a la selección de perfil.
     */
    public function handle(Request $request, Closure $next)
    {
        // 1. Revisa si la sesión NO tiene el ID del perfil
        if (! session()->has('active_profile_id')) {
            // 2. Si no lo tiene, lo redirige a la pantalla de selección
            return redirect()->route('profiles.index');
        }

        // 3. Si sí lo tiene, deja que continúe al dashboard
        return $next($request);
    }
}
