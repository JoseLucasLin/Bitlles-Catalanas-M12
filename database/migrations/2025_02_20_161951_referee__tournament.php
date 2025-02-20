<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/*
CREATE TABLE Referee_Tournament (
    id INTEGER PRIMARY KEY AUTO_INCREMENT,
    id_tournament INTEGER NOT NULL,
    id_user_referee INTEGER NOT NULL,
    id_field INTEGER NOT NULL
);
*/

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::dropIfExists('Referee_Tournament');
        Schema::create('Referee_Tournament', function (Blueprint $table) {
            $table->id() -> primary();
            $table->integer('id_tournament') -> nullable(false);
            $table->integer('id_user_referee') -> nullable(false);
            $table->integer('id_field') -> nullable(false);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('Referee_Tournament');
    }
};
