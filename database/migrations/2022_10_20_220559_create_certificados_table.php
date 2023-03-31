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
            $table->string('texto');
            $table->string('img_fundo');
            $table->date('data_inicio');
            $table->date('data_fim')->nullable();
            $table->string('cpf_participante');
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
        Schema::dropIfExists('certificados');
    }
};
