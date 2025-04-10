<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Player_Throws extends Model
{
    use HasFactory;

    protected $table = 'player_throws';

    protected $fillable = [
        'id_player_round',
        'throw_number',
        'score',
        'created_at'
    ];

    protected $casts = [
        'created_at' => 'datetime'
    ];

    public function playerRound()
    {
        return $this->belongsTo(Player_Round::class, 'id_player_round');
    }
}
