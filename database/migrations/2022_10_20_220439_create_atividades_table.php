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
        Schema::create('atividades', function (Blueprint $table)
        {
            $table->id();
            $table->boolean('status');
            $table->string('descricao');
            $table->string('info')->nullable();
            $table->date('data_inicio');
            $table->date('data_fim')->nullable();
            $table->integer('carga_horaria');
            $table->unsignedInteger('acao_id')->index();
            $table->foreign('acao_id')->references('id')->on('acaos');
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
        Schema::dropIfExists('atividades');
    }
};
