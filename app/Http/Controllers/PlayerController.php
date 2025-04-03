<?php

namespace App\Http\Controllers;

use App\Models\Players;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

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
}
