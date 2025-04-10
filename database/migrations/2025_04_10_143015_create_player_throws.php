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
        Schema::create('player_throws', function (Blueprint $table) {
            $table->id();
            $table->integer('id_player_round')->nullable(false)->references('id')->on('player_rounds');
            $table->integer('throw_number')->nullable(false)->default(0);
            $table->integer('score')->nullable(false)->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('player_throws');
    }
};
