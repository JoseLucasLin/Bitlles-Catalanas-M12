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
            id INTEGER PRIMARY KEY AUTO_INCREMENT,
            name VARCHAR(255) NOT NULL,
            type INTEGER NOT NULL,
            normal_price FLOAT NOT NULL,
            partner_price FLOAT NOT NULL,
            image VARCHAR(100) DEFAULT 'default_image.png',
            expected_date VARCHAR(50),
            start_date TIMESTAMP,
            end_date TIMESTAMP
        */
        Schema::dropIfExists('tournaments');
        Schema::create('tournaments', function (Blueprint $table) {
            $table->id(); // Quita el ->primary(), id() ya es primary key
            $table->string('name',255)->nullable(false);
            $table->integer('type')->nullable(false);
            $table->float('normal_price')->nullable(false);
            $table->float('partner_price')->nullable(false);
            $table->integer('total_rounds')->default(1)->nullable(false); // Añadido para el número de rondas
            $table->string('image',250)->default('image.png')->nullable(false);
            $table->integer('current_round')->default(0)->nullable(false); // Añadido para la ronda actual
            // Cambiamos expected_date a string como en el comentario
            $table->string('expected_date', 50)->nullable();

            // Hacemos los timestamps nullable
            $table->timestamp('start_date')->nullable();
            $table->timestamp('end_date')->nullable();

            // Añadimos los timestamps estándar de Laravel
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tournaments');
    }
};
