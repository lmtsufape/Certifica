<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAssinaturaCoordenacaoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assinatura_coordenacao', function (Blueprint $table) {
            $table->integer('id_coordenacao')->primary();
            $table->string('assinatura_esquerda', 150)->nullable();
            $table->string('assinatura_direita', 150)->nullable();
            $table->string('nome_direita', 150)->nullable();
            $table->string('descricao_esquerda', 150)->nullable();
            $table->string('descricao_direita', 150)->nullable();
            
            $table->foreign('id_coordenacao', 'fk_assinatura_coordenacao_coordenacao1')->references('id')->on('uinidade_adminstrativa');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('assinatura_coordenacao');
    }
}
