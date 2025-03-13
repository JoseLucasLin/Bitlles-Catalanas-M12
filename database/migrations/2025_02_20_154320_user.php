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
    /*  id INTEGER PRIMARY KEY AUTO_INCREMENT,
        username VARCHAR(255) NOT NULL,
        password VARCHAR(255) NOT NULL,
        mail VARCHAR(120) NOT NULL,
        role INTEGER NOT NULL,
        image VARCHAR(100) DEFAULT 'default_image.png',
        last_login TIMESTAMP,
        attemp_logins INTEGER */
        Schema::dropIfExists('Users');
        Schema::create('Users', function (Blueprint $table) {
            $table->id(); // Eliminar ->primary() - id() ya es clave primaria
            $table->string('username',255)->nullable(false);
            $table->string('password')->nullable(false);
            $table->string('mail',140)->nullable(false);
            $table->Integer('role')->nullable(false)->default(0)->references('id')->on('Roles');
            $table->string('image',250)->default('default_image.png');
            $table->timestamp('last_login')->nullable(); // Hacer nullable
            $table->integer('attemp_logins')->nullable(); // Hacer nullable, opcional
            $table->timestamps(); // Agregar timestamps estándar de Laravel
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('Users');
    }
};
