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
        'id_field',
        't1',
        't2',
        't3',
        'id_player',
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

    public function player()
    {
        return $this->belongsTo(Players::class, 'id_player');
    }


    public function tournamentRounds()
    {
        return $this->hasMany(Round::class, 'id_round');
    }


    public function field()
    {
        return $this->belongsTo(Fields::class, 'id_field');
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
