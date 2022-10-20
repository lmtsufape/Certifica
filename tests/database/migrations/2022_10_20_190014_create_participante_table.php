<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateParticipanteTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('participante', function (Blueprint $table) {
            $table->integer('id_participante')->primary()->unique();
            $table->integer('id_atividade');
            $table->string('nome', 150);
            $table->string('email', 150)->nullable();
            $table->string('cpf', 14)->nullable();
            $table->tinyInteger('ativo');
            $table->string('chave_validacao', 300)->nullable();
            
            $table->foreign('id_atividade', 'fk_participante_atividade1')->references('id_atividade')->on('atividade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('participante');
    }
}
