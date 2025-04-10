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
        'expected_date' => 'datetime',
        'start_date' => 'datetime',
        'end_date' => 'datetime'
    ];

    public function fields()
    {
        return $this->belongsToMany(Fields::class, 'referee_tournaments', 'id_tournament', 'id_field');
    }
    public function tournamentRounds()
    {
        return $this->hasMany(Tournament_Round::class, 'id_tournament');
    }
    public function stats()
    {
        return $this->hasMany(Stats_Player_Tournament::class, 'id_tournament');
    }
    public function rounds()
    {
        return $this->hasManyThrough(Round::class, Stats_Player_Tournament::class, 'id_tournament', 'id_player');
    }
}
