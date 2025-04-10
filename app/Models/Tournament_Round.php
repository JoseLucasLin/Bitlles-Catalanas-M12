<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tournament_Round extends Model
{
    use HasFactory;

    protected $table = 'tournament_round';

    public $timestamps = false;

    protected $fillable = ['id_tournament', 'id_round', 'finish_hour'];

    public function tournament()
    {
        return $this->belongsTo(Tournament::class, 'id_tournament');
    }
    public function round()
    {
        return $this->belongsTo(Round::class, 'id_round');
    }
}
