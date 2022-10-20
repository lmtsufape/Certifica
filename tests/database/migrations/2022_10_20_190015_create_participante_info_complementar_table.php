<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateParticipanteInfoComplementarTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('participante_info_complementar', function (Blueprint $table) {
            $table->integer('id_participante')->primary();
            $table->string('curso', 45);
            $table->string('orientador', 150);
            $table->string('local', 100);
            $table->integer('carga_horaria');
            $table->date('dia_inicio');
            $table->date('dia_fim')->nullable();
            
            $table->foreign('id_participante', 'fk_participante_info_complementar_participante1')->references('id_participante')->on('participante');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('participante_info_complementar');
    }
}
