<?php

namespace Database\Seeders;
use App\Models\Fields;
//use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;


class FieldSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
       for ($i=0; $i < 50; $i++) { 
        # code...
        DB::table('fields')->insert([
            'field_name' => 'Pista guay -'.Str::random(5),
            //'email' => Str::random(10).'@example.com',
            //'password' => Hash::make('password'),
        ]);
       }

    }
}
