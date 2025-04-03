<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Players;
use Illuminate\Http\Request;

class PlayerSearchController extends Controller
{
    /**
     * Mostrar la lista de jugadores con opción de búsqueda
     */
    public function index(Request $request)
    {
        $search = $request->input('search');

        $query = Players::query();

        // Aplicar filtro de búsqueda si existe
        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%')
                  ->orWhere('lastname', 'like', '%' . $search . '%')
                  ->orWhere('mail', 'like', '%' . $search . '%');
            });
        }

        // Obtener resultados paginados
        $players = $query->paginate(10);

        return view('admin.player-search', compact('players'));
    }

    /**
     * Obtener detalles de un jugador específico para el modal (formato JSON)
     */
    public function getPlayerDetails($id)
    {
        try {
            $player = Players::findOrFail($id);
            return response()->json($player);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Jugador no encontrado'], 404);
        }
    }
}
