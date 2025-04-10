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
        Schema::dropIfExists('tournament_round');
        Schema::create('tournament_round', function (Blueprint $table) {
            $table->id() -> primary();
            $table->integer('id_tournament') -> nullable(false)->references('id')->on('tournament');
            $table->integer('id_round') -> nullable(false)->references('id')->on('round');
            $table->timestamp('finish_hour')->nullable()->default(null);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tournament_Round');
    }
};
