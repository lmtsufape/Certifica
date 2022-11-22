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
        Schema::create('assinatura_coordenacaos', function (Blueprint $table)
        {
            $table->id();
            $table->string('cargo');
            $table->string('nome');
            $table->string('img_assinatura');
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
        Schema::dropIfExists('assinatura_coordenacaos');
    }
};
