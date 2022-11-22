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
            $table->unsignedInteger('unidade_administrativa_id')->index();
            $table->unsignedInteger('tipo_natureza_id')->index();
            $table->string('descricao');
            $table->foreign('unidade_administrativa_id')->references('id')->on('unidade_administrativas');
            $table->foreign('tipo_natureza_id')->references('id')->on('tipo_naturezas');
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
        Schema::dropIfExists('naturezas');
    }
};
