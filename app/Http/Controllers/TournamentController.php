<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tournament;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

class TournamentController extends Controller
{
    //Abre el formulario de creacion de torneos
    public function create()
    {
        return view('admin.create-tournament');
    }

    //Guarda el torneo
    public function store(Request $request){
        // Validación con mensajes personalizados
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
            'image.max' => 'La imagen no debe superar 2MB'
        ];

        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|integer|in:1,2,3',
            'normal_price' => 'required|numeric|min:0',
            'partner_price' => 'required|numeric|min:0',
            'expected_date' => 'required|date|after:today',
            'image' => 'required|image|mimes:jpg,png|max:2048'
        ], $messages);

        // Depuración: Ver datos validados
        Log::info('Datos validados:', $validatedData);

        try {
            // Procesamiento de la imagen
            $imagePath = $request->file('image')->store('public/tournaments');
            $imageUrl = Storage::url($imagePath);

            Log::info('Imagen guardada en:', [
                'path' => $imagePath,
                'url' => $imageUrl
            ]);

            // Preparación de datos para la BD
            $tournamentData = [
                'name' => $validatedData['name'],
                'type' => $validatedData['type'],
                'normal_price' => $validatedData['normal_price'],
                'partner_price' => $validatedData['partner_price'],
                'expected_date' => Carbon::parse($validatedData['expected_date']),
                'image' => $imageUrl
            ];

            Log::info('Datos preparados para insertar:', $tournamentData);

            // Creación del torneo con depuración
            $tournament = Tournament::create($tournamentData);

            if ($tournament->exists) {
                Log::info('Torneo creado exitosamente:', $tournament->toArray());
                return redirect()->route('createTournament')
                    ->with('success', 'Torneo creado exitosamente!');
            } else {
                Log::error('El torneo no se creó correctamente');
                throw new \Exception('No se pudo crear el torneo en la base de datos');
            }

        } catch (\Exception $e) {
            Log::error('Error al crear torneo:', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
                'input' => $request->all()
            ]);

            return back()->withInput()
                ->with('error', 'Error al crear torneo: '.$e->getMessage());
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
