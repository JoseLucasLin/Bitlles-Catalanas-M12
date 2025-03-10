<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Migration for the PlayerHistoryStats table.
* Player_History_Stats
*id (pk) : INTEGER
*id_player : INTEGER
*number_game_makes : INTEGER
*total_points_all_game : INTEGER
*last_game_points : INTEGER
*best_game_points : INTEGER
*accuracy : FLOAT

 */

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::dropIfExists('Player_History_Stats');
        Schema::create('Player_History_Stats', function (Blueprint $table) {
            $table->id() ->primary();
            $table->integer('id_player') ->nullable(false)->references('id')->on('Players');
            $table->integer('number_game_makes') ->nullable(false);
            $table->integer('total_points_all_game') ->nullable(false);
            $table->integer('last_game_points') ->nullable(false);
            $table->integer('best_game_points') ->nullable(false);
            $table->float('accuracy') ->nullable(false);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('Player_History_Stats');
    }
};
