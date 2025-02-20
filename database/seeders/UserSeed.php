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
        //
        for ($i=1; $i < 50; $i++) { 
            # code...
            DB::table('Users')->insert([
                'username' => 'username'.Str::random(20),
                'password' => bcrypt('1234ASDF'),
                'mail' => Str::random(20).'@example.com',
                'image' => Str::random(4).'-example.png' ,
                
                'attemp_logins' => $i,
                'last_login' => now(),
                'refresh_token' => Str::random(20).".".Str::random(20).".".Str::random(20),
            ]);
           }
    }
}
