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
        Schema::create('certificado_modelos', function (Blueprint $table) {
            $table->id();
            $table->string('texto_posicao');
            $table->string('data_posicao');
            $table->string('assinatura_direita');
            $table->string('assinatura_esquerda');

            $table->unsignedInteger('unidade_administrativa_id')->index();
            $table->foreign('unidade_administrativa_id')->references('id')->on('unidade_administrativas');
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
        Schema::dropIfExists('certificado_modelos');
    }
};
