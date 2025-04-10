<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Players extends Model
{
    use HasFactory;

    protected $table = 'player';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $fillable = [
        'name',
        'lastname',
        'mail',
        'code',
        'partner',
        'image',
        'last_login',
        'attemp_logins',
    ];

    public function stats()
    {
        return $this->hasMany(Stats_Player_Tournament::class, 'id_player');
    }

    public function rounds()
    {
        return $this->hasMany(Round::class, 'id_player');
    }
}
