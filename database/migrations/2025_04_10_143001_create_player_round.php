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
        Schema::create('player_round', function (Blueprint $table) {
            $table->id();
            $table->integer('id_player')->nullable(false)->references('id')->on('players');
            $table->integer('id_round')->nullable(false)->references('id')->on('rounds');
            $table->integer('total_score')->nullable(false)->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('player_round');
    }
};
