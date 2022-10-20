<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCertificadoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('certificado', function (Blueprint $table) {
            $table->integer('id')->primary()->unique();
            $table->integer('atividade_id');
            $table->integer('certificado_modelo_id');
            $table->mediumText('logo')->nullable();
            $table->mediumText('texto')->nullable();
            $table->mediumText('img_fundo')->nullable();
            
            $table->foreign('atividade_id', 'fk_certificado_atividade1')->references('id_atividade')->on('atividade');
            $table->foreign('certificado_modelo_id', 'fk_certificado_certificado_modelos1')->references('id')->on('certificado_modelos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('certificado');
    }
}
