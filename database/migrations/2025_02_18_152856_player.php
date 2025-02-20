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
        //
        Schema::dropIfExists('Player');
        Schema::create('Player', function (Blueprint $table) {
            $table->id()->primary();
            $table->string('name',255);
            $table->string('lastname',255);
            $table->string('mail',120);
            $table->string('code',15)->nullable();
            $table->boolean('partner')->nullable();
            $table->string('image',255)->default('default_image.png');
            $table->timestamp('last_login');
            $table->integer('attemp_logins');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('Player');
        //
    }
};
