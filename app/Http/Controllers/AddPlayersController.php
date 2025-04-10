<?php

namespace App\Http\Controllers;

use App\Models\Tournament;
use App\Models\Tournament_Round;
use App\Models\Fields;
use App\Models\Players;
use App\Models\Referee_Tournament;
use App\Models\Round;
use Illuminate\Http\Request;

class AddPlayersController extends Controller
{
    public function index()
    {
        $tournaments = Tournament::all();
        $players = Players::all();
        $assignedPlayers = Round::with('player', 'field')->get();

        return view('admin.add-players', compact('tournaments', 'players', 'assignedPlayers'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'tournament' => 'required|exists:tournaments,id',
            'player_id' => 'required|exists:player,id',
            'field_id' => 'required|exists:fields,id',
        ]);

        $existingAssignment = Round::where('id_player', $request->player_id)
                                ->where('id_field', $request->field_id)
                                ->first();

        if ($existingAssignment) {
            return redirect()->back()->with('error', 'Este jugador ya está asignado a una pista.');
        }

        $round = new Round();
        $round->id_player = $request->player_id;
        $round->id_field = $request->field_id;
        $round->id_status = 1;
        $round->save();

        $tournamentRound = new Tournament_Round();
        $tournamentRound->id_tournament = $request->tournament;
        $tournamentRound->id_round = $round->id;
        $tournamentRound->save();

        return redirect()->back()->with('success', 'Jugador asignado a pista exitosamente.');
    }

    public function getFieldsByTournament($tournamentId)
    {
        $fields = Fields::whereIn('id', Referee_Tournament::where('id_tournament', $tournamentId)->pluck('id_field'))->get();

        return response()->json($fields);
    }

    public function removePlayer($id)
    {
        $round = Round::findOrFail($id);
        $round->delete();

        return redirect()->back()->with('success', 'Jugador eliminado de la pista exitosamente.');
    }
}
