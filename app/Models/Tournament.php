<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tournament extends Model
{
    use HasFactory;

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
}
