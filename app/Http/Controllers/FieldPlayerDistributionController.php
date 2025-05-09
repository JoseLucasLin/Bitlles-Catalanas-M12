<?php

namespace App\Http\Controllers;

use App\Models\Tournament;
use App\Models\Players;
use App\Models\Fields;
use App\Models\Round;
use App\Models\Stats_Player_Tournament;
use App\Models\Referee_Tournament;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class FieldPlayerDistributionController extends Controller
{
    public function index()
    {
        // Obtener torneos activos
        $tournaments = Tournament::where(function($query) {
                $query->whereNull('end_date')
                    ->orWhere('end_date', '>', now());
            })
            ->get();

        // Obtener jugadores
        $players = Players::all();

        return view('admin.players-fields', compact('tournaments', 'players'));
    }

    public function getCourts($tournamentId)
    {
        // Obtener las pistas (fields) relacionadas con el torneo
        $courts = Referee_Tournament::where('id_tournament', $tournamentId)
            ->join('fields', 'referee_tournaments.id_field', '=', 'fields.id')
            ->select('fields.id', 'fields.field_name as name')
            ->get();

        return response()->json([
            'success' => true,
            'courts' => $courts
        ]);
    }

    public function getPlayers($tournamentId)
    {
        try {
            // Obtener jugadores registrados en el torneo
            $players = Stats_Player_Tournament::where('id_tournament', $tournamentId)
                ->join('player', 'stats_player_tournaments.id_player', '=', 'player.id')
                ->select('player.id', 'player.name', 'player.lastname')
                ->get();

            // Ajusta la respuesta al formato que espera el frontend
            return response()->json([
                'success' => true,
                'players' => $players
            ]);
        } catch (\Exception $e) {
            // Log del error para depuración
            Log::error('Error al cargar jugadores: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Error al cargar jugadores: ' . $e->getMessage()
            ], 500);
        }
    }

    public function distribute(Request $request)
    {
        try {
            $validated = $request->validate([
                'tournament_id' => 'required|exists:tournaments,id',
                'distributions' => 'required|array',
                'distributions.*.court_id' => 'required|exists:fields,id',
                'distributions.*.player_ids' => 'required|array',
                'distributions.*.player_ids.*' => 'required|exists:player,id',
            ]);

            DB::beginTransaction();

            $tournamentId = $request->tournament_id;
            $tournament = Tournament::findOrFail($tournamentId);
            $currentRound = $tournament->current_round ?? 1;

            // Eliminar asignaciones previas si existen
            Round::where('id_tournament', $tournamentId)
                ->where('round_number', $currentRound)
                ->delete();

            // Crear nuevas asignaciones
            foreach ($request->distributions as $dist) {
                $courtId = $dist['court_id'];

                foreach ($dist['player_ids'] as $playerId) {
                    Round::create([
                        'id_tournament' => $tournamentId,
                        'id_field' => $courtId,
                        'id_player' => $playerId,
                        'round_number' => $currentRound,
                        'id_status' => 1, // Pendiente
                        't1' => 0,
                        't2' => 0,
                        't3' => 0,
                    ]);
                }
            }

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Jugadores distribuidos correctamente'
            ]);
        } catch (\Exception $e) {
            DB::rollback();

            return response()->json([
                'success' => false,
                'message' => 'Error al distribuir jugadores: ' . $e->getMessage()
            ], 500);
        }
    }

    public function getCurrentDistributions($tournamentId)
    {
        try {
            $tournament = Tournament::findOrFail($tournamentId);
            $currentRound = $tournament->current_round ?? 1;

            // Obtener distribuciones actuales
            $distributions = Round::where('id_tournament', $tournamentId)
                ->where('round_number', $currentRound)
                ->join('player', 'rounds.id_player', '=', 'player.id')
                ->select('rounds.id_field as court_id', 'player.id as player_id', 'player.name', 'player.lastname')
                ->get();

            // Agrupar por pista
            $groupedDistributions = [];
            foreach ($distributions as $dist) {
                if (!isset($groupedDistributions[$dist->court_id])) {
                    $groupedDistributions[$dist->court_id] = [
                        'court_id' => $dist->court_id,
                        'players' => []
                    ];
                }

                $groupedDistributions[$dist->court_id]['players'][] = [
                    'id' => $dist->player_id, // Cambiado de $dist->id a $dist->player_id
                    'name' => $dist->name,
                    'lastname' => $dist->lastname
                ];
            }

            return response()->json([
                'success' => true,
                'hasDistributions' => count($groupedDistributions) > 0,
                'distributions' => array_values($groupedDistributions)
            ]);
        } catch (\Exception $e) {
            Log::error('Error al verificar distribuciones: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Error al verificar distribuciones: ' . $e->getMessage()
            ], 500);
        }
    }
}
