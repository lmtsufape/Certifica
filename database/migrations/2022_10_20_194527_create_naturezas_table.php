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
        Schema::create('naturezas', function (Blueprint $table) 
        {
            $table->id();
            $table->integer('unidade_administrativa_id');
            $table->integer('tipo_natureza_id');
            $table->string('descricao', 250);
            $table->foreign('unidade_administrativa_id')->references('id')->on('unidade_administrativas');
            $table->foreign('tipo_natureza_id')->references('id')->on('tipo_naturezas');
        
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('naturezas');
    }
};
