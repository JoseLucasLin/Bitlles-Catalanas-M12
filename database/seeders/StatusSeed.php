<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StatusSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('Status')->insert([
            ['name' => 'Esperando'],
            ['name' => 'Tirando'],
            ['name' => 'Recogiendo']
        ]);
    }
}
