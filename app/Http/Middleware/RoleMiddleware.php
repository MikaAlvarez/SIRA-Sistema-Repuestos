<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, string $role): Response
    {
        logger('🧩 RoleMiddleware ejecutado', [
            'ruta' => $request->path(),
            'required_role' => $role,
            'user_id' => Auth::id(),
            'user_role' => Auth::user()?->role,
            'metodo' => $request->method(),
        ]);

        if (!Auth::check()) {
            logger('🚫 RoleMiddleware bloqueó: usuario no autenticado');
            abort(403, 'Usuario no autenticado');
        }

        if (Auth::user()->role !== $role) {
            logger('🚫 RoleMiddleware bloqueó: rol no coincide', [
                'expected' => $role,
                'actual' => Auth::user()->role,
            ]);
            abort(403, 'Rol no autorizado');
        }

        logger('✅ RoleMiddleware permitió continuar');
        return $next($request);
    }
}
