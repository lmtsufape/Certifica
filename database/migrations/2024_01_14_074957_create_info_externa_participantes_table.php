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
        Schema::create('info_externa_participantes', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('tipo')->nullable();
            $table->string('disciplina')->nullable();
            $table->string('orientador')->nullable();
            $table->string('periodo_letivo')->nullable();
            $table->string('area')->nullable();
            $table->string('local_realizado')->nullable();
            $table->string('titulo_projeto')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('info_externa_participantes');
    }
};
