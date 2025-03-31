<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Players extends Model
{
    protected $table = 'Player'; // Nombre de la tabla
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
}
