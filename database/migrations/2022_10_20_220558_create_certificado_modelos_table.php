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
        Schema::create('certificado_modelos', function (Blueprint $table) {
            $table->id();
            $table->string('tipo_certificado')->nullable();
            $table->string('descricao');
            $table->string('imagem');
            $table->text('texto');
            $table->unsignedInteger('unidade_administrativa_id')->nullable()->index();
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
        Schema::dropIfExists('certificado_modelos');
    }
};
