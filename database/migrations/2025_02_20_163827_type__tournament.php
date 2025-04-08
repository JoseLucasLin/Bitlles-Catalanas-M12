<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/*
CREATE TABLE Type_Tournament (
    id INTEGER PRIMARY KEY AUTO_INCREMENT,
    type_name VARCHAR(255) NOT NULL,
    description VARCHAR(255),
    draw_case VARCHAR(255),
    winner_prize VARCHAR(255) DEFAULT NULL
);
*/

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::dropIfExists('type_tournament');
        Schema::create('type_tournament', function (Blueprint $table) {
            $table->id() -> primary();
            $table->string('type_name') -> nullable(false);
            $table->string('description');
            $table->string('draw_case');
            $table->string('winner_prize') -> nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('type_tournament');
    }
};
