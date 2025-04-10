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
        /*
        CREATE TABLE Rounds (
        id INTEGER PRIMARY KEY AUTO_INCREMENT,
        id_player INTEGER NOT NULL,
        id_field INTEGER NOT NULL,
        id_status INTEGER NOT NULL
        ); */
        Schema::dropIfExists('rounds');
        Schema::create('rounds', function (Blueprint $table) {
            $table->id()->primary();
            $table->integer('id_tournament')->nullable(false)->references('id')->on('tournaments');
            $table->integer('id_round')->nullable(false)->references('id')->on('rounds');
            $table->integer('id_field')->nullable(false)->references('id')->on('fields');
            $table->integer('id_status')->nullable(false)->references('id')->on('status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rounds');
        //
    }
};
