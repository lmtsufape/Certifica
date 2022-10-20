<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCertificadoModelosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('certificado_modelos', function (Blueprint $table) {
            $table->integer('id')->primary();
            $table->integer('uinidade_adminstrativa_id');
            $table->string('texto_posicao', 45)->nullable();
            $table->string('data_posicao', 45)->nullable();
            $table->string('ass_direita', 45)->nullable();
            $table->string('ass_esquerda', 45)->nullable();
            
            $table->foreign('uinidade_adminstrativa_id', 'fk_certificado_setor_uinidade_adminstrativa1')->references('id')->on('uinidade_adminstrativa');
            $table->foreign('id', 'fk_certioficado_setor_setor1')->references('id')->on('setor');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('certificado_modelos');
    }
}
