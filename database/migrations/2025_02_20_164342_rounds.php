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
        Schema::dropIfExists('Rounds');
        Schema::create('Rounds', function (Blueprint $table) {
            $table->id()->primary();
            $table->integer('id_player')->nullable(false)->references('id')->on('Players');
            $table->integer('id_field')->nullable(false)->references('id')->on('Fields');
            $table->integer('id_status')->nullable(false)->references('id')->on('Status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('Rounds');
        //
    }
};
