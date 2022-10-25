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
        Schema::create('participantes', function (Blueprint $table) 
        {
            $table->id();
            $table->string('nome', 150);
            $table->string('email', 150)->nullable();
            $table->string('cpf', 14)->nullable();
            $table->tinyInteger('ativo');
            $table->string('chave_validacao', 300)->nullable();
            $table->unsignedInteger('atividade_id')->index();
            $table->foreign('atividade_id')->references('id')->on('atividades');
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
        Schema::dropIfExists('participantes');
    }
};
