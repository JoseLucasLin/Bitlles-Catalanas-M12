<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Player_History_Stats extends Model
{
    use HasFactory;

    protected $table = 'player_history_stats';

    public $timestamps = false;

    protected $fillable = [
        'id_player',
        'number_game_makes',
        'total_points_all_game',
        'last_game_points',
        'best_game_points',
        'accuracy',
    ];
}
