<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAcaoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('acao', function (Blueprint $table) {
            $table->integer('id_acao')->primary()->unique();
            $table->integer('natureza_id_natureza');
            $table->integer('usuario_id_usuario');
            $table->integer('id_status');
            $table->tinyInteger('status');
            $table->string('titulo');
            $table->date('data_inicio');
            $table->date('data_fim')->nullable();
            
            $table->foreign('id_status', 'fk_acao_status1')->references('id_status')->on('status');
            $table->foreign('natureza_id_natureza', 'fk_natureza_has_usuario_natureza1')->references('id_natureza')->on('natureza');
            $table->foreign('usuario_id_usuario', 'fk_natureza_has_usuario_usuario1')->references('id_usuario')->on('usuario');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('acao');
    }
}
