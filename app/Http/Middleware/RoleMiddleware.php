<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, ...$roles)
    {
        // Verificar si el usuario está autenticado
        if (!Auth::check()) {
            abort(403, 'No tienes acceso a esta sección');
        }

        // Verificar si el usuario tiene alguno de los roles permitidos
        if (!in_array(Auth::user()->role, $roles)) {
            abort(403, 'No tienes acceso a esta sección');
        }

        return $next($request);
    }
}

