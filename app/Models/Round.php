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
        'id_player',
        'id_field',
        'id_status',
    ];

    public function tournamentRounds()
    {
        return $this->hasMany(TournamentRound::class, 'id_round');
    }
    public function player()
    {
        return $this->belongsTo(Players::class, 'id_player');
    }

    public function field()
    {
        return $this->belongsTo(Fields::class, 'id_field');
    }

    public function status()
    {
        return $this->belongsTo(Status::class, 'id_status');
    }
}
