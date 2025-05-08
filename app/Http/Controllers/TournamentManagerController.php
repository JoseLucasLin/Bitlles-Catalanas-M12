<?php

namespace App\Http\Controllers;

use App\Models\Tournament;
use App\Models\Fields;
use App\Models\Stats_Player_Tournament;
use App\Models\Referee_Tournament;
use App\Models\Players;
use Illuminate\Http\Request;

class TournamentManagerController extends Controller
{
    public function index()
    {
        // Obtener todos los torneos
        $tournaments = Tournament::all();

        // Seleccionar el primer torneo como predeterminado (si existe)
        $selectedTournament = $tournaments->first();
        $tournamentInfo = $selectedTournament ? $this->getTournamentInfo($selectedTournament->id) : null;

        return view('admin.tournament-manager', compact('tournaments', 'selectedTournament', 'tournamentInfo'));
    }

    /**
     * Obtener información detallada del torneo
     */
    public function getTournamentInfo($tournamentId)
    {
        // Obtener el torneo
        $tournament = Tournament::findOrFail($tournamentId);

        // Contar campos disponibles
        $availableCourts = Referee_Tournament::where('id_tournament', $tournamentId)->count();

        // Contar jugadores registrados
        $registeredPlayers = Stats_Player_Tournament::where('id_tournament', $tournamentId)->count();

        // Obtener ronda actual
        $currentRound = $tournament->current_round ?? 1;

        // Verificar si el torneo ha sido iniciado
        $isStarted = $tournament->started ?? false;

        // Verificar si el torneo ha finalizado
        $isFinished = $tournament->end_date ? true : false;

        return [
            'tournament' => $tournament,
            'availableCourts' => $availableCourts,
            'registeredPlayers' => $registeredPlayers,
            'currentRound' => $currentRound,
            'isStarted' => $isStarted,
            'isFinished' => $isFinished,
        ];
    }

    /**
     * Mostrar información de un torneo específico (AJAX)
     */
    public function showTournament($id)
    {
        $tournamentInfo = $this->getTournamentInfo($id);

        return response()->json([
            'success' => true,
            'data' => $tournamentInfo
        ]);
    }

    /**
     * Iniciar un torneo
     */
    public function startTournament(Request $request)
    {
        $tournamentId = $request->tournament_id;
        $tournament = Tournament::findOrFail($tournamentId);

        // Verificar si hay suficientes jugadores
        $playersCount = Stats_Player_Tournament::where('id_tournament', $tournamentId)->count();

        if ($playersCount < 2) {
            return response()->json([
                'success' => false,
                'message' => 'El torneo necesita al menos 2 jugadores para comenzar'
            ]);
        }

        // Verificar si hay campos asignados
        $courtsCount = Referee_Tournament::where('id_tournament', $tournamentId)->count();

        if ($courtsCount < 1) {
            return response()->json([
                'success' => false,
                'message' => 'El torneo necesita al menos un campo con árbitro asignado'
            ]);
        }

        // Marcar el torneo como iniciado
        $tournament->started = true;
        $tournament->current_round = 1;
        $tournament->start_date = now();
        $tournament->save();

        // Aquí se podría generar los cruces iniciales del torneo
        // ...

        return response()->json([
            'success' => true,
            'message' => 'Torneo iniciado correctamente',
            'data' => $this->getTournamentInfo($tournamentId)
        ]);
    }

    /**
     * Avanzar a la siguiente ronda
     */
    public function nextRound(Request $request)
    {
        $tournamentId = $request->tournament_id;
        $tournament = Tournament::findOrFail($tournamentId);

        // Verificar que el torneo esté iniciado
        if (!$tournament->started) {
            return response()->json([
                'success' => false,
                'message' => 'El torneo no ha sido iniciado'
            ]);
        }

        // Verificar que todas las partidas de la ronda actual estén completadas
        // (Aquí iría la lógica para verificar que todas las partidas están completadas)

        // Incrementar la ronda actual
        $tournament->current_round = $tournament->current_round + 1;
        $tournament->save();

        // Generar los cruces para la siguiente ronda
        // ...

        return response()->json([
            'success' => true,
            'message' => 'Avanzado a la siguiente ronda',
            'data' => $this->getTournamentInfo($tournamentId)
        ]);
    }

    /**
     * Resolver empates
     */
    public function resolveTie(Request $request)
    {
        $tournamentId = $request->tournament_id;

        // Aquí iría la lógica para resolver empates
        // ...

        return response()->json([
            'success' => true,
            'message' => 'Empates resueltos correctamente',
            'data' => $this->getTournamentInfo($tournamentId)
        ]);
    }

    /**
     * Modificar datos del torneo
     */
    public function modifyTournament(Request $request)
    {
        $tournamentId = $request->tournament_id;
        $tournament = Tournament::findOrFail($tournamentId);

        // Aquí iría la lógica para modificar el torneo
        // ...

        return response()->json([
            'success' => true,
            'message' => 'Torneo modificado correctamente',
            'data' => $this->getTournamentInfo($tournamentId)
        ]);
    }

    /**
     * Obtener jugadores de un torneo específico (AJAX)
     */
    public function getTournamentPlayers($id)
    {
        try {
            $statsPlayersTournament = Stats_Player_Tournament::where('id_tournament', $id)
                ->with('player')
                ->get();

            $players = [];

            foreach($statsPlayersTournament as $stat) {
                $players[] = [
                    'id' => $stat->player->id,
                    'name' => $stat->player->name,
                    'lastname' => $stat->player->lastname,
                    'stats' => [
                        'total_points' => $stat->total_points,
                        'accuracy' => $stat->accuracy
                    ]
                ];
            }

            return response()->json([
                'success' => true,
                'players' => $players
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ]);
        }
    }
}
