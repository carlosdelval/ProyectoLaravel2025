<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    /**
     * Maneja una solicitud entrante.
     */
    public function handle(Request $request, Closure $next, $role)
    {
        // Verifica si el usuario está autenticado y tiene el rol necesario
        if (!Auth::check() || Auth::user()->role !== $role) {
            abort(403, 'No tienes permiso para acceder a esta página. Debes ser administrador.');
        }

        return $next($request);
    }
}
