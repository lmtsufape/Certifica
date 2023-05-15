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
        Schema::create('acaos', function (Blueprint $table)
        {
            $table->id();
            $table->string('status')->nullable();
            $table->string('titulo');
            $table->date('data_inicio');
            $table->date('data_fim')->nullable();
            $table->string('anexo')->nullable();
            $table->unsignedInteger('natureza_id')->index();
            $table->foreign('natureza_id')->references('id')->on('naturezas');
            $table->unsignedInteger('tipo_natureza_id')->index();
            $table->foreign('tipo_natureza_id')->references('id')->on('tipo_naturezas');
            $table->unsignedInteger('usuario_id')->index();
            $table->foreign('usuario_id')->references('id')->on('users');
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
        Schema::dropIfExists('acaos');
    }
};
