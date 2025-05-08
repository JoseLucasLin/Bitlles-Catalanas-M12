<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PlayerSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        for ($i=0; $i < 2; $i++) {
            # code...

            DB::table('Player')->insert([
                'name' => 'Pepe-'.Str::random(10),
                'lastname' => 'NOSOYSANCHEZ-'.Str::random(10),

                'mail' => Str::random(10).'@example.com',
                'code' => Str::random(15),
                'partner' => $i%2,
                'last_login' => now(),
                'attemp_logins' => $i,
            ]);
           }
    }
}
