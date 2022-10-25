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
            $table->integer('natureza_id');
            $table->integer('usuario_id');
            $table->tinyInteger('status');
            $table->string('titulo');
            $table->date('data_inicio');
            $table->date('data_fim')->nullable();
            $table->foreign('natureza_id')->references('id')->on('naturezas');
            $table->foreign('usuario_id')->references('id')->on('usuarios');
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
