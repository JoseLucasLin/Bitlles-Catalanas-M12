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
        Schema::dropIfExists('Tournament_Round');
        Schema::create('Tournament_Round', function (Blueprint $table) {
            $table->id() -> primary();
            $table->integer('id_tournament') -> nullable(false)->references('id')->on('Tournament');
            $table->integer('id_round') -> nullable(false)->references('id')->on('Round');
            $table->time('finish_hour') -> nullable(false);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('Tournament_Round');
    }
};
