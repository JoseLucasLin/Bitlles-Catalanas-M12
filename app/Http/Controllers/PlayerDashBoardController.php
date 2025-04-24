<?php

namespace App\Http\Controllers;

use App\Models\Players;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\QueryException;

class PlayerDashBoardController extends Controller
{
    /**
     * Verificar el código del jugador y redirigir al dashboard
     */
    public function verify(Request $request)
    {
        $request->validate([
            'code' => 'required|string'
        ]);

        // Buscar jugador por código
        $player = Players::where('code', $request->code)->first();

        if (!$player) {
            return back()->with('error', 'Código de jugador no válido.');
        }

        // Redirigir al dashboard del jugador
        return redirect()->route('player.dashboard', $player->id);
    }

    /**
     * Mostrar los datos básicos del jugador
     */
    public function show($id)
    {
        // Solo cargar el jugador sin relaciones que podrían causar errores
        $player = Players::findOrFail($id);

        // Inicializar variables con valores predeterminados
        $stats = null;
        $tournaments = collect(); // Colección vacía

        // Intentar cargar historyStats si existe la relación
        try {
            if (method_exists($player, 'historyStats')) {
                $stats = $player->historyStats;
            }
        } catch (\Exception $e) {
            // Si hay error, dejamos stats como null
        }

        return view('players.dashboard', compact('player', 'stats', 'tournaments'));
    }
}
