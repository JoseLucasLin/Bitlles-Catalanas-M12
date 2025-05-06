<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Cookie;
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
    { // Intentar autenticar al usuario con JWT
        try {
            // Obtener el token desde la cookie manualmente
            $token = Cookie::get('jwt_token');
            
            if (!$token) {
                return response()->json(['error' => 'Token no encontrado en cookies'], 401);
            }
    
            // Pasar el token al sistema de JWTAuth
            JWTAuth::setToken($token);
            $user = JWTAuth::authenticate();
    
        } catch (JWTException $e) {
            return response()->json(['error' => 'Token no válido o expirado'], 401);
        }

        // Verificar si el usuario está autenticado
        if (!$user) {
            return response()->json(['error' => 'No autenticado'], 401);
        }

        // Verificar si el usuario tiene uno de los roles requeridos
        if (!in_array($user->role, $roles)) {
            return response()->json(['error' => 'No tienes permisos para acceder a esta sección'], 403);
        }

        // Permitir acceso si el usuario cumple con las condiciones
        return $next($request);
    }
}
