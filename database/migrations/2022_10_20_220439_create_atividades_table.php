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
            $table->string('descricao');
            $table->date('data_inicio');
            $table->date('data_fim')->nullable();
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
