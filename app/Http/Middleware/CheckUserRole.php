<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

class CheckUserRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        if (!Auth::check()) {
            return redirect('login');
        }


        return $next($request);
        $user = Auth::user();

        // Verificar si el usuario tiene alguno de los roles especificados
        foreach ($roles as $role) {
            if ($user->role == $role) {
                return $next($request);
            }
        }

        try {
            $user = JWTAuth::parseToken()->authenticate();
        } catch (JWTException $e) {
            return response()->json(['error' => 'Token not valid'], 401);
        }
        // Si no tiene ningún rol permitido, redirigir o mostrar error
        return redirect('/')->with('error', 'No tienes permisos para acceder a esta sección.');
    }
}
