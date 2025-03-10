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
    end_date TIMESTAMP */
        Schema::dropIfExists('Tournaments');
        Schema::create('Tournaments', function (Blueprint $table) {
            $table->id()->primary();
            $table->string('name',255)->nullable(false);
            $table->integer('type')->nullable(false);
            $table->float('normal_price')->nullable(true);
            $table->float('partner_price')->nullable(true);
            $table->string('image',250)->default('image.png');
            $table->timestamp('expected_date');
            $table->timestamp('start_date');
            $table->timestamp('end_date')->nullable(true);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Schema::dropIfExists('Tournaments');
    }
};
