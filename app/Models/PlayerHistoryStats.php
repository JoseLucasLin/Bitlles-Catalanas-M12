<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlayerHistoryStats extends Model
{
    use HasFactory;

    protected $table = 'player_history_stats';

    protected $fillable = [
        'id_player',
        'number_game_makes',
        'total_points_all_game',
        'last_game_points',
        'best_game_points',
        'accuracy'
    ];

    public function player()
    {
        return $this->belongsTo(Players::class, 'id_player');
    }
}
