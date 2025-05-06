<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use App\Models\User;
use App\Models\Role;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Illuminate\Support\Facades\Cookie;

class AuthenticatedSessionController extends Controller 
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
{
    // Autenticar usuario
    if (!Auth::attempt($request->only('mail', 'password'))) {
        return back()->withErrors(['mail' => 'Las credenciales son incorrectas']);
    }

    // Regenerar sesión (por seguridad)
    $request->session()->regenerate();

    $user = \App\Models\User::find(Auth::id());

    if ($user) {
        $user->last_login = now();
        $user->save();
    }
    // Generar el token JWT
    $token = JWTAuth::fromUser($user);

    // Crear la respuesta de redirección
    $response = redirect(match ($user->role) {
        1 => '/',
        2 => '/admin',
        default => '/',
    });

    // Establecer la cookie en la respuesta
    return $response->withCookie(
        cookie(
            'jwt_token', // Nombre de la cookie
            $token, // Valor (el token)
            60 * 24 * 7, // Expiración en minutos (7 días)
            '/', // Ruta
            null, // Dominio
            true, // Solo HTTPS
            true // HttpOnly (previene accesos desde JavaScript)
        )
    );
}


    /**
     * Destroy an authenticated session.
     */

    public function destroy(Request $request): RedirectResponse
    {
        // Cerrar sesión con Laravel (para autenticación de sesión)
        Auth::guard('web')->logout();
    
        // Invalidar la sesión
        $request->session()->invalidate();
        $request->session()->regenerateToken();
    
        // Intentar invalidar el token JWT si existe
        try {
            if ($token = Cookie::get('jwt_token')) {
                JWTAuth::invalidate($token);
                Cookie::destroy('jwt_token');
            }
        } catch (JWTException $e) {
            // Manejo del error si el token no es válido
            return redirect('/')->with('error', 'Token inválido o sesión ya cerrada.');
        }
    
        return redirect('/')->with('message', 'Sesión cerrada exitosamente.');
    }
    


}
