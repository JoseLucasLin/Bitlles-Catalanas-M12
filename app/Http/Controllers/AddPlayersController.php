<?php

namespace App\Http\Controllers;

use App\Models\Tournament;
use App\Models\Players;
use App\Models\Fields;
use App\Models\Round;
use App\Models\Player_Round;
use App\Models\Referee_Tournament;
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

        $players = Players::all();
        $fields = Fields::all();
        
        // Obtenemos jugadores asignados con sus pistas
        $assignedPlayers = Player_Round::with([
                'player', 
                'round.tournament', 
                'round.refereeTournament.field'
            ])
            ->get()
            ->groupBy('round.id_tournament');
            
        return view('admin.add-players', compact('tournaments', 'players', 'fields', 'assignedPlayers'));
    }

    public function assignPlayer(Request $request)
    {
        $validated = $request->validate([
            'tournament_id' => 'required|exists:tournaments,id',
            'player_id' => 'required|exists:player,id',
            'field_id' => 'required|exists:fields,id'
        ]);

        // Verificar si el jugador ya está asignado a este torneo
        $alreadyAssigned = Player_Round::whereHas('round', function($q) use ($request) {
                $q->where('id_tournament', $request->tournament_id);
            })
            ->where('id_player', $request->player_id)
            ->exists();

        if ($alreadyAssigned) {
            return back()->with('error', 'Este jugador ya está asignado a este torneo');
        }

        // Crear o obtener la ronda para este torneo Y pista específica
        $round = Round::firstOrCreate([
            'id_tournament' => $request->tournament_id,
            'round_number' => 1 // Podemos diferenciar por pista si es necesario
        ], [
            'id_status' => 1,
            'start_time' => now(),
            'end_time' => now()->addHours(2)
        ]);

        // Asignar jugador a la ronda
        Player_Round::create([
            'id_player' => $request->player_id,
            'id_round' => $round->id,
            'total_score' => 0
        ]);

        // Asignar la pista específica al torneo
        Referee_Tournament::updateOrCreate([
            'id_tournament' => $request->tournament_id,
            'id_field' => $request->field_id
        ], [
            'id_user_referee' => null
        ]);

        return back()->with('success', 'Jugador asignado correctamente a la pista seleccionada');
    }
    public function removePlayer($id)
    {
        $assignment = Player_Round::findOrFail($id);
        $assignment->delete();
        
        return back()->with('success', 'Jugador eliminado del torneo');
    }
}