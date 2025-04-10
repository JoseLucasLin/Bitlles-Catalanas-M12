<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stats_Player_Tournament extends Model
{
    use HasFactory;

    protected $table = 'stats_player_tournament';

    protected $fillable = [
        'id_player',
        'id_tournament',
        'total_points',
        'accuracy'
    ];

    public function player()
    {
        return $this->belongsTo(Players::class, 'id_player');
    }

    public function tournament()
    {
        return $this->belongsTo(Tournament::class, 'id_tournament');
    }
}
