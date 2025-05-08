<?php

namespace Database\Seeders;

use App\Models\Fields;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Ejecutar todos los seeders en orden lógico

        // 1. Seeders de tablas maestras/catálogos
        $this->call([
            RoleSeed::class,         // Roles de usuario
            StatusSeed::class,        // Estados posibles
            TypeTournamentSeeder::class, // Tipos de torneos
        ]);

        // 2. Seeders de entidades principales
        $this->call([
            UserSeed::class,          // Usuarios (admin, árbitros)
            PlayerSeed::class,        // Jugadores
            FieldSeed::class,         // Pistas/campos
        ]);

        // 3. Seeders de torneos y competiciones
        $this->call([
            TournamentSeed::class,    // Torneos
            RoundSeed::class,         // Rondas
        ]);

        // 4. Seeders de relaciones y datos complementarios
        $this->call([
               // Relación torneos-rondas
            Referee_TournamentSeed::class,   // Árbitros asignados a torneos
            Player_History_StatsSeed::class, // Historial y estadísticas de jugadores
            Stats_Player_TournamentSeed::class, // Estadísticas de jugadores en torneos
        ]);


    }
}
