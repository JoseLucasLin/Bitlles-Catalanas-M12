<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    // En el archivo de migración generado
    public function up()
    {
        Schema::table('tournaments', function (Blueprint $table) {
            $table->timestamps(); // Añade created_at y updated_at
        });
    }

    public function down()
    {
        Schema::table('tournaments', function (Blueprint $table) {
            $table->dropTimestamps();
        });

    }
};
