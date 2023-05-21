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
            $table->string('status')->nullable();
            $table->string('titulo');
            $table->date('data_inicio');
            $table->date('data_fim');
            $table->string('anexo')->nullable();

            $table->foreignId('tipo_natureza_id')->constrained('tipo_naturezas');
            $table->foreignId('usuario_id')->constrained('users');
            $table->foreignId('unidade_administrativa_id')->constrained('unidade_administrativas');

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
