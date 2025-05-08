<?php

namespace App\Http\Controllers;

use App\Models\Tournament;
use App\Models\Players;
use App\Models\User;
use App\Models\Fields;
use App\Models\Stats_Player_Tournament;
use Illuminate\Http\Request;

class AddPlayersController extends Controller
{
    public function index()
    {
        // Obtener todos los torneos activos
        $tournaments = Tournament::where(function($query) {
                $query->whereNull('end_date')
                    ->orWhere('end_date', '>', now());
            })
            ->get();

        $players = Players::all(); // Todos los jugadores
        $referees = User::where('role', 1)->get(); // Árbitros (rol 1)
        $fields = Fields::all(); // Todas las pistas

        // Obtenemos jugadores ya asignados a torneos
        $assignedPlayers = Stats_Player_Tournament::with(['player', 'tournament'])
            ->get();

        return view('admin.add-players', compact('tournaments', 'players', 'referees', 'fields', 'assignedPlayers'));
    }

    // Asignar jugador a un torneo
    public function assignPlayer(Request $request)
    {
        try {
            $validated = $request->validate([
                'tournament_id' => 'required|exists:tournaments,id',
                'player_id' => 'required|integer', // Cambiado para evitar validación exists
            ]);

            // Verificar si el jugador existe manualmente
            $player = Players::find($request->player_id);
            if (!$player) {
                return response()->json([
                    'success' => false,
                    'message' => 'El jugador no existe'
                ], 404);
            }

            // Verificar si ya está asignado
            $alreadyAssigned = Stats_Player_Tournament::where('id_tournament', $request->tournament_id)
                ->where('id_player', $request->player_id)
                ->exists();

            if ($alreadyAssigned) {
                return response()->json([
                    'success' => false,
                    'message' => 'Este jugador ya está asignado a este torneo'
                ]);
            }

            // Asignar el jugador al torneo
            $assignment = Stats_Player_Tournament::create([
                'id_player' => $request->player_id,
                'id_tournament' => $request->tournament_id,
                'total_points' => 0,
                'accuracy' => 0
            ]);

            $tournament = Tournament::find($request->tournament_id);

            return response()->json([
                'success' => true,
                'message' => 'Jugador asignado correctamente',
                'data' => [
                    'id' => $assignment->id,
                    'player_name' => $player->name . ' ' . $player->lastname,
                    'tournament_name' => $tournament->name
                ]
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al asignar jugador: ' . $e->getMessage()
            ], 500);
        }
    }

    public function removePlayer($id)
    {
        $assignment = Stats_Player_Tournament::findOrFail($id);
        $assignment->delete();

        return response()->json([
            'success' => true,
            'message' => 'Jugador eliminado del torneo'
        ]);
    }

    // Asignar árbitro a un campo en un torneo
    public function assignReferee(Request $request)
    {
        $validated = $request->validate([
            'tournament_id' => 'required|exists:tournaments,id',
            'referee_id' => 'required|exists:users,id',
            'field_id' => 'required|exists:fields,id'
        ]);

        \App\Models\Referee_Tournament::updateOrCreate(
            [
                'id_tournament' => $request->tournament_id,
                'id_field' => $request->field_id
            ],
            [
                'id_user_referee' => $request->referee_id
            ]
        );

        // Obtener datos para la respuesta
        $referee = User::find($request->referee_id);
        $tournament = Tournament::find($request->tournament_id);
        $field = Fields::find($request->field_id);

        return response()->json([
            'success' => true,
            'message' => 'Árbitro asignado correctamente',
            'data' => [
                'referee_name' => $referee->name,
                'tournament_name' => $tournament->name,
                'field_name' => $field->field_name
            ]
        ]);
    }
}
