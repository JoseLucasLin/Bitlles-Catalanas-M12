<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class UserSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Limpiar tabla para evitar duplicados en ejecuciones múltiples (opcional)
        // DB::table('Users')->truncate();

        // Crear usuarios aleatorios con rol básico (suponiendo que rol 3 es usuario básico)
        for ($i=1; $i < 3; $i++) {
            DB::table('Users')->insert([
                'username' => 'username'.Str::random(10),
                'password' => bcrypt('1234ASDF'),
                'mail' => Str::random(10).'@example.com',
                'image' => Str::random(4).'-example.png',
                'role' => 1, // Asumiendo que 3 es el rol para usuarios básicos
                'attemp_logins' => $i,
                'last_login' => now(),
            ]);
        }

        // Crear usuario admin
        DB::table('Users')->insert([
            'username' => 'admin',
            'password' => bcrypt('admin'),
            'mail' => 'admin@gmail.com',
            'image' => 'admin-example.png',
            'role' => 2, // Asumiendo que 2 es el rol de admin
            'attemp_logins' => 0,
            'last_login' => now(),
        ]);

        // Crear usuario árbitro
        DB::table('Users')->insert([
            'username' => 'arbitro',
            'password' => bcrypt('arbitro'),
            'mail' => 'arbitro@gmail.com',
            'image' => 'referee-example.png',
            'role' => 1, // Asumiendo que 1 es el rol de árbitro
            'attemp_logins' => 0,
            'last_login' => now(),
        ]);
    }
}
