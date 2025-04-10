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
        
        $request->authenticate();

        $request->session()->regenerate();

        // Actualizar last_login utilizando el método update en lugar de save
        $userId = Auth::id();
        User::where('id', $userId)->update(['last_login' => now()]);

        // Obtener el usuario actualizado
        $user = Auth::user();

        // Obtener información del rol
        $role = Role::find($user->role);

        // Verificar que el rol exista y corresponda al esperado
        if ($role) {
            if ($role->id == 1 && $role->name == 'arbitro') {
                // Rol de árbitro verificado
                return redirect('/');
            } elseif ($role->id == 2 && $role->name == 'admin') {
                // Rol de administrador verificado
                return redirect('/admin');
            }
        }

        $token = JWTAuth::fromUser($user);

        cookie()->json(compact('user','token'), 201);
        // Si no coincide con los roles esperados o hay un problema
        return redirect('/');
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        JWTAuth::invalidate(JWTAuth::getToken());

        //return response()->json(['message' => 'Successfully logged out']);
        return redirect('/');
    }


}
