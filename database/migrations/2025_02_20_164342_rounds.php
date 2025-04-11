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
            $table->integer('round_number');
            $table->timestamp('start_time')->nullable();
            $table->timestamp('end_time')->nullable();

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
