<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fields extends Model
{
    use HasFactory;

    protected $table = 'fields';

    protected $fillable = [
        'field_name'
    ];

    public function rounds()
    {
        return $this->hasMany(Round::class, 'id_field');
    }

    public function refereeTournaments()
    {
        return $this->hasMany(Referee_Tournament::class, 'id_field');
    }
}
