<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePerfilSistemaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('perfil_sistema', function (Blueprint $table) {
            $table->integer('id_perfil_sistema')->primary()->unique();
            $table->integer('id_coordenacao');
            $table->integer('id_usuario');
            $table->tinyInteger('status');
            
            $table->foreign('id_usuario', 'fk_perfil_sistema_usuario1')->references('id_usuario')->on('usuario');
            $table->foreign('id_coordenacao', 'fk_table1_coordenacao1')->references('id')->on('uinidade_adminstrativa');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('perfil_sistema');
    }
}
