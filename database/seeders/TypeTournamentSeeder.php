<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TypeTournamentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        DB::table('type_tournament')->insert([
            [
                'type_name' => 'Normal',
                'description' => 'Torneo estándar',
                'draw_case' => 'Aleatorio',
                'winner_prize' => 'Trofeo'
            ],
            [
                'type_name' => 'Extra',
                'description' => 'Torneo especial',
                'draw_case' => 'Sembrado',
                'winner_prize' => 'Medalla'
            ],
            [
                'type_name' => 'Rápido',
                'description' => 'Torneo de corta duración',
                'draw_case' => 'Aleatorio',
                'winner_prize' => 'Dinero'
            ]
        ]);
    }    
}
