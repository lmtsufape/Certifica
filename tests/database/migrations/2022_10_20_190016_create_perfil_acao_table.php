<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePerfilAcaoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('perfil_acao', function (Blueprint $table) {
            $table->integer('id_perfil_acao')->primary()->unique();
            $table->integer('id_acao');
            $table->integer('id_usuario');
            
            $table->foreign('id_usuario', 'fk_perfil_acao_usuario1')->references('id_usuario')->on('usuario');
            $table->foreign('id_acao', 'fk_tipo_perfil_has_acao_acao1')->references('id_acao')->on('acao');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('perfil_acao');
    }
}
