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
            $table->string('descricao');

            $table->unsignedInteger('tipo_natureza_id')->index();
            $table->foreign('tipo_natureza_id')->references('id')->on('tipo_naturezas');
            $table->unsignedInteger('unidade_administrativa_id')->index();
            $table->foreign('unidade_administrativa_id')->references('id')->on('unidade_administrativas');
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
