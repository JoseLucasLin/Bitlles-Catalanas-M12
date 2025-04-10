<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Type_Tournament extends Model
{
    use HasFactory;

    protected $table = 'type_tournament';

    protected $fillable = [
        'type_name',
        'description',
        'draw_case',
        'winner_prize'
    ];

    public function tournaments()
    {
        return $this->hasMany(Tournament::class, 'type');
    }
}
