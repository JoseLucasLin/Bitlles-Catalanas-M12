<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Players;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use Illuminate\Support\Facades\Storage;
use Tymon\JWTAuth\Facades\JWTAuth;

class RegisteredPlayerController extends Controller
{
    /**
     * Display the registration view.
     */
    public function index(): View
    {

        return view('admin.create-player');
    }
    /**
     * Display the registration view.
     */
    public function create()
    {
        $token = JWTAuth::fromUser();

        return response()->json(['token' => $token]);
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        // Validación
        $request->validate([
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:Player,mail'],
            'partner' => ['required', 'integer'],
        ]);

        $originalName = "default_image.png";
        // Guardar archivo
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $originalName = $request->first_name.$request->last_name.".".$request->file('image')->getClientOriginalExtension();
            $image->move(public_path('player-img'), $originalName);
        }

        $player = Players::create([
            'name' => $request->first_name,
            'lastname' => $request->last_name,
            'mail' => $request->email,
            'image' => $originalName,
            'code' => uniqid(),
            'partner' => $request->partner,
            'attemp_logins' => 0,
            'last_login' => now(),
        ]);

        /// Redireccionar con mensaje de éxito - usa el nombre completo de la ruta
        return redirect('/admin/create-player')->with('success', 'Jugador registrado correctamente');
    }
}
