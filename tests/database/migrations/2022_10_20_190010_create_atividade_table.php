<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAtividadeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('atividade', function (Blueprint $table) {
            $table->integer('id_atividade')->primary()->unique();
            $table->integer('id_acao');
            $table->tinyInteger('status');
            $table->string('descricao');
            $table->string('info')->nullable();
            $table->date('data_inicio');
            $table->date('data_fim')->nullable();
            $table->integer('carga_horaria');
            
            $table->foreign('id_acao', 'fk_atividade_acao1')->references('id_acao')->on('acao');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('atividade');
    }
}
