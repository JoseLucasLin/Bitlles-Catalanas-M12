<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Referee_Tournament extends Model
{
    use HasFactory;

    protected $table = 'referee_tournaments';

    protected $fillable = [
        'id_tournament',
        'id_user_referee',
        'id_field'
    ];

    public function tournament()
    {
        return $this->belongsTo(Tournament::class, 'id_tournament');
    }

    public function referee()
    {
        return $this->belongsTo(User::class, 'id_user_referee');
    }

    public function field()
    {
        return $this->belongsTo(Fields::class, 'id_field');
    }
}
