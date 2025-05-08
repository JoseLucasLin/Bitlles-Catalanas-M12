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
            $table->id();
            $table->unsignedBigInteger('id_tournament');
            $table->unsignedBigInteger('id_status');
            $table->unsignedBigInteger('id_field')->nullable(); // Hacer estos campos opcionales
            $table->integer('round_number');
            $table->integer('t1')->default(0); // Añadir valor por defecto
            $table->integer('t2')->default(0); // Añadir valor por defecto
            $table->integer('t3')->default(0); // Añadir valor por defecto
            $table->unsignedBigInteger('id_player')->nullable(); // Hacer este campo opcional

            $table->foreign('id_field')->references('id')->on('fields')->onDelete('cascade');
            $table->foreign('id_player')->references('id')->on('player')->onDelete('cascade');
            $table->foreign('id_tournament')->references('id')->on('tournaments')->onDelete('cascade');
            $table->foreign('id_status')->references('id')->on('status')->onDelete('restrict');
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
