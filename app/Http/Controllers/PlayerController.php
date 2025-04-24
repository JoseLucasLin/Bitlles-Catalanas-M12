<?php

namespace App\Http\Controllers;

use App\Models\Players;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Mail;
use App\Mail\MailableLogin;

class PlayerController extends Controller
{
    //Crea un nuevo jugador
    public function create(){
        return view('admin.create-player');
    }

    //Guarda el jugador
    public function store(){
        // Ya implementado en RegisteredPlayerController
    }

    //Muestra formulario para editar jugador
    public function edit($id){
        $player = Players::findOrFail($id);
        return view('admin.edit-player', compact('player'));
    }

    //Actualiza el jugador
    public function update(Request $request, $id){
        $player = Players::findOrFail($id);

        // Validación
        $request->validate([
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'string',
                'lowercase',
                'email',
                'max:255',
                Rule::unique('Player', 'mail')->ignore($player->id)
            ],
            'partner' => ['required', 'integer', 'in:0,1'],
            'image' => ['nullable', 'image', 'max:2048'], // Máximo 2MB
        ]);

        // Procesar imagen si se ha subido una nueva
        if ($request->hasFile('image')) {
            // Eliminar imagen anterior si no es la default
            if ($player->image != "default_image.png") {
                // Verificar si el archivo existe antes de intentar eliminarlo
                $oldImagePath = public_path('player-img/' . $player->image);
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                }
            }

            // Guardar nueva imagen
            $image = $request->file('image');
            $originalName = $request->first_name.$request->last_name.".".$image->getClientOriginalExtension();
            $image->move(public_path('player-img'), $originalName);

            // Actualizar nombre de imagen en la BD
            $player->image = $originalName;
        }

        // Actualizar datos
        $player->name = $request->first_name;
        $player->lastname = $request->last_name;
        $player->mail = $request->email;
        $player->partner = $request->partner;
        $player->save();

        return redirect()->route('admin.player-search')
            ->with('success', 'Jugador actualizado correctamente');
    }

    //Elimina un jugador
    public function destroy($id){
        // Implementación futura si necesitas eliminar jugadores
    }

    /**
     * Enviar código del jugador por correo electrónico
     */
    public function sendCode(Request $request, $id)
    {
        $player = Players::findOrFail($id);

        // Verificar que el jugador tenga un correo electrónico
        if (empty($player->mail)) {
            return response()->json([
                'success' => false,
                'message' => 'El jugador no tiene un correo electrónico registrado'
            ], 400);
        }

        try {
            // Enviar correo con el código
            Mail::to($player->mail)->send(new MailableLogin($player->name, $player->code));

            return response()->json([
                'success' => true,
                'message' => 'Código enviado correctamente a ' . $player->mail
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al enviar el código: ' . $e->getMessage()
            ], 500);
        }
    }
}
