<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        if ($request->user()?->perfil?->nome !== 'ADMINISTRADOR') {
            return redirect()->route('usuario.inicio');
        }

        return $next($request);
    }
}
