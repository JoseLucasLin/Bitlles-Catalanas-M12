<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        /*CREATE TABLE Stats_Player_Tournament (
            id INTEGER PRIMARY KEY AUTO_INCREMENT,
            id_player INTEGER NOT NULL,
            id_tournament INTEGER NOT NULL,
            total_points INTEGER NOT NULL,
            accuracy FLOAT NOT NULL
        ); */
        Schema::dropIfExists('Stats_Player_Tournaments');
        Schema::create('Stats_Player_Tournaments', function (Blueprint $table) {
            $table->id()->primary();
            $table->integer('id_player')->nullable(false);
            $table->integer('id_tournament')->nullable(false);
            $table->integer('total_points')->nullable(false)->default(0);
            $table->integer('total_points')->nullable(true);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('Stats_Player_Tournaments');
        //
    }
};
