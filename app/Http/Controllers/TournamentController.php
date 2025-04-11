<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tournament;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;
use App\Models\Type_Tournament;
use App\Models\User;
use App\Models\Fields;
use App\Models\Round;
use App\Models\Referee_Tournament;

class TournamentController extends Controller
{
    //Abre el formulario de creacion de torneos
    public function create()
    {
        $types = Type_Tournament::all();
        $referees = User::where('role', 1)->get();
        return view('admin.create-tournament', compact('types', 'referees'));
    }

    //Guarda el torneo
    public function store(Request $request)
    {
        $messages = [
            'name.required' => 'El nombre del torneo es obligatorio',
            'type.required' => 'Seleccione un tipo de torneo',
            'normal_price.required' => 'El precio normal es requerido',
            'normal_price.numeric' => 'El precio debe ser un número',
            'partner_price.required' => 'El precio partner es requerido',
            'partner_price.numeric' => 'El precio partner debe ser un número',
            'expected_date.required' => 'La fecha estimada es obligatoria',
            'expected_date.date' => 'Ingrese una fecha válida',
            'expected_date.after' => 'La fecha debe ser futura',
            'image.required' => 'La imagen es requerida',
            'image.image' => 'El archivo debe ser una imagen',
            'image.mimes' => 'Formatos aceptados: JPG, PNG',
            'image.max' => 'La imagen no debe superar 2MB',
            'rounds.required' => 'Debe indicar cuántas rondas tendrá el torneo',
            'rounds.integer' => 'El número de rondas debe ser un número entero',
            'rounds.min' => 'Debe haber al menos una ronda',
            'fields.required' => 'Debe añadir al menos una pista',
            'fields.*.name.required' => 'El nombre de la pista es obligatorio',
            'fields.*.referee.required' => 'Debe asignar un árbitro a cada pista',
        ];

        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|integer|exists:Type_Tournament,id',
            'normal_price' => 'required|numeric|min:0',
            'partner_price' => 'required|numeric|min:0',
            'expected_date' => 'required|date|after:today',
            'image' => 'required|image|mimes:jpg,png|max:2048',
            'rounds' => 'required|integer|min:1',
            'fields' => 'required|array|min:1',
            'fields.*.name' => 'required|string|max:120',
            'fields.*.referee' => 'required|integer|exists:users,id',
        ], $messages);
        
        try {
            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('tournament-images'), $imageName);

            $tournament = Tournament::create([
                'name' => $validatedData['name'],
                'type' => $validatedData['type'],
                'normal_price' => $validatedData['normal_price'],
                'partner_price' => $validatedData['partner_price'],
                'expected_date' => $validatedData['expected_date'],
                'image' => $imageName
            ]);

            $fields = $validatedData['fields'];
            foreach ($fields as $field) {
                $newField = \App\Models\Fields::create([
                    'field_name' => $field['name']
                ]);

                \App\Models\Referee_Tournament::create([
                    'id_tournament' => $tournament->id,
                    'id_user_referee' => $field['referee'],
                    'id_field' => $newField->id
                ]);
            }

            for ($i = 1; $i <= $validatedData['rounds']; $i++) {
                \App\Models\Round::create([
                    'id_tournament' => $tournament->id,
                    'id_status' => 1, // o el status por defecto (pendiente, por ejemplo)
                    'round_number' => $i
                ]);
            }

            return redirect()->route('createTournament')->with('success', 'Torneo creado con éxito!');
        
        } catch (\Exception $e) {
            return back()->withInput()->with('error', 'Error: ' . $e->getMessage());
        }
    }

    //Abre el formulario de edicion de torneos
    public function edit($id){
        return view('admin.tournament-manager');
    }

    //Actualiza el torneo
    public function update($id){

    }

    //Elimina un torneo
    public function destroy($id){

    }
}
