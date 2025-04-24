<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Round extends Model
{
    use HasFactory;

    protected $table = 'rounds';

    public $timestamps = false;

    protected $fillable = [
        'id_tournament',
        'id_status',
        'round_number',
        'start_time',
        'end_time'
    ];

    protected $casts = [
        'start_time' => 'datetime',
        'end_time' => 'datetime'
    ];

    public function tournament()
    {
        return $this->belongsTo(Tournament::class, 'id_tournament');
    }

    public function status()
    {
        return $this->belongsTo(Status::class, 'id_status');
    }

    public function players()
    {
        return $this->belongsToMany(Players::class, 'player_round', 'id_round', 'id_player')
            ->withPivot('total_score')
            ->using(Player_Round::class);
    }

    public function playerRounds()
    {
        return $this->hasMany(Player_Round::class, 'id_round');
    }

    public function tournamentRounds()
    {
        return $this->hasMany(Tournament_Round::class, 'id_round');
    }

    public function throws()
    {
        return $this->hasManyThrough(
            Player_Throws::class,
            Player_Round::class,
            'id_round', // Foreign key on PlayerRound table
            'id_player_round', // Foreign key on PlayerThrows table
            'id', // Local key on Round table
            'id' // Local key on PlayerRound table
        );
    }

    public function field()
    {
        return $this->hasOneThrough(
            Fields::class,
            Referee_Tournament::class,
            'id_tournament', // FK en referee_tournaments
            'id', // FK en fields
            'id_tournament', // Local key en rounds (usamos id_tournament en lugar de id)
            'id_field' // Local key en referee_tournaments
        );
    }

    public function refereeTournament()
    {
        return $this->hasOneThrough(
            Referee_Tournament::class,
            Tournament::class,
            'id', // FK en tournaments
            'id_tournament', // FK en referee_tournaments
            'id_tournament', // Local key en rounds
            'id' // Local key en tournaments
        );
    }
}
