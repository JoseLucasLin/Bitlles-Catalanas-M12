<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function index(): View
    {

        return view('admin.create-referee');
    }
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
      //todo poner mensaje de que se creo correctamente.
 //Textos completos id 	username 	password 	mail 	role 	image 	last_login 	attemp_logins 	created_at 	updated_at
        $request->validate([
            'username' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:Users,mail'], // Cambiar
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $originalName="default_image.png";
      //guardar archivo
        if ($request->hasFile('image')) {

            $image = $request->file('image');
            $originalName = Str::random(15) . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('user-img'), $originalName);

       }
        $user = User::create([
            'username' => $request->username, //
            'mail' => $request->email, //
            'password' => Hash::make($request->password),
            'role' => 1, // referee
            'image' => $originalName,
            'attemp_logins' => 0,
            'last_login' => now(),
            'created_at' => now(),
        ]);

        event(new Registered($user));

        //Auth::login($user);

        return redirect()->back();
    }
}
