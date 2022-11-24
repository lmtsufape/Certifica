<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('certificados', function (Blueprint $table) 
        {
            $table->id();
            $table->string('logo');
            $table->string('texto');
            $table->string('img_fundo');
            $table->string('assinatura_esquerda');

            $table->unsignedInteger('atividade_id')->index();
            $table->foreign('atividade_id')->references('id')->on('atividades');
            $table->unsignedInteger('certificado_modelo_id')->index();
            $table->foreign('certificado_modelo_id')->references('id')->on('certificado_modelos');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('certificados');
    }
};
