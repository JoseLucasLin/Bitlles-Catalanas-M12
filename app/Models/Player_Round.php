<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class Player_Round extends Pivot
{
    protected $table = 'player_round';

    public $incrementing = true;

    protected $fillable = [
        'id_player',
        'id_round',
        'total_score'
    ];

    public function player()
    {
        return $this->belongsTo(Players::class, 'id_player');
    }

    public function round()
    {
        return $this->belongsTo(Round::class, 'id_round');
    }

    public function throws()
    {
        return $this->hasMany(Player_Throws::class, 'id_player_round');
    }
}
