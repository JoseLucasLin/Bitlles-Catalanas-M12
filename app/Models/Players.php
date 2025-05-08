<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Players extends Model
{
    protected $table = 'player'; // Nombre de la tabla
    protected $primaryKey = 'id'; // Clave primaria
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
    public function historyStats()
    {
        return $this->hasOne(PlayerHistoryStats::class, 'id_player');
    }
    public function rounds()
    {
        return $this->hasMany(Round::class, 'id_player');
    }
    public function tournaments()
    {
        return $this->belongsToMany(Tournament::class, 'stats_player_tournament', 'id_player', 'id_tournament')
            ->withPivot('total_points', 'accuracy');
    }

}
