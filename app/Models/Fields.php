<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fields extends Model
{
    use HasFactory;

    protected $fillable = ['field_name'];

    public function refereeTournaments()
    {
        return $this->hasMany(Referee_Tournament::class, 'id_field');
    }
}
