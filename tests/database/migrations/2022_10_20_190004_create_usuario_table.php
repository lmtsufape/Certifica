<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsuarioTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('usuario', function (Blueprint $table) {
            $table->integer('id_usuario')->primary()->unique();
            $table->integer('id_tipo_perfil');
            $table->string('nome', 150);
            $table->string('email');
            $table->string('senha', 32);
            $table->string('CPF', 14);
            
            $table->foreign('id_tipo_perfil', 'fk_usuario_tipo_perfil1')->references('id_tipo_perfil')->on('perfil');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('usuario');
    }
}
