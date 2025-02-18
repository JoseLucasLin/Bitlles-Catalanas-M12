<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRolesTable extends Migration
{
    public function up()
    {
        Schema::dropIfExists('Roles');
        Schema::create('Roles', function (Blueprint $table) {
            $table->id()-> primary() ->autoIncrement();
            $table->string('role_name', 40);
        });
    }

    public function down()
    {
        Schema::dropIfExists('Roles');
    }
}
