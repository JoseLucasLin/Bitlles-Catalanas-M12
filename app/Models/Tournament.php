<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tournament extends Model
{
    use HasFactory;

    protected $table = 'tournaments';

    protected $fillable = [
        'name',
        'type',
        'normal_price',
        'partner_price',
        'image',
        'expected_date',
        'start_date',
        'end_date'
    ];

    protected $casts = [
        'start_date' => 'datetime',
        'end_date' => 'datetime'
    ];

    public function type()
    {
        return $this->belongsTo(Type_Tournament::class, 'type');
    }

    public function rounds()
    {
        return $this->hasMany(Round::class, 'id_tournament');
    }

    public function tournamentRounds()
    {
        return $this->hasMany(Tournament_Round::class, 'id_tournament');
    }

    public function refereeTournaments()
    {
        return $this->hasMany(Referee_Tournament::class, 'id_tournament');
    }

    public function players()
    {
        return $this->belongsToMany(Players::class, 'stats_player_tournament', 'id_tournament', 'id_player')
            ->withPivot('total_points', 'accuracy');
    }

    public function stats()
    {
        return $this->hasMany(Stats_Player_Tournament::class, 'id_tournament');
    }
}
