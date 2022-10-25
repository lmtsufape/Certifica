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
        Schema::create('participante_info_complementars', function (Blueprint $table) 
        {
            $table->id();
            $table->string('curso', 45);
            $table->string('orientador', 150);
            $table->string('local', 100);
            $table->integer('carga_horaria');
            $table->date('dia_inicio');
            $table->date('dia_fim')->nullable();
            $table->unsignedInteger('participante_id')->index();
            $table->foreign('participante_id')->references('id')->on('participantes');
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
        Schema::dropIfExists('participante_info_complementars');
    }
};
