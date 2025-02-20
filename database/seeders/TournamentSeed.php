<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
class TournamentSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        /*
            id INTEGER PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(255) NOT NULL,
    type INTEGER NOT NULL,
    normal_price FLOAT NOT NULL,
    partner_price FLOAT NOT NULL,
    image VARCHAR(100) DEFAULT 'default_image.png',
    expected_date VARCHAR(50),
    start_date TIMESTAMP,
    end_date TIMESTAMP
     */
    DB::table('Tournament')->insert([
        'name' => 'Torneo de prueba',
        'type' => 1,
        'normal_price' => (1.1),
        'partner_price' => (1.2) ,
        
        'expected_date' => now(),
        'start_date' => now(),
        'end_date' => (date("Y-m-d", strtotime("+ 1 day"))),
    ]);
    }
}
