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
        Schema::create('naturezas', function (Blueprint $table) {
            $table->id()->primary()->unique();
            $table->integer('id_coordenacao');
            $table->integer('id_tipo_natureza');
            $table->string('descricao', 250);
            
            $table->foreign('id_coordenacao', 'fk_coordenacao_has_tipo_natureza_coordenacao1')->references('id')->on('uinidade_adminstrativa');
            $table->foreign('id_tipo_natureza', 'fk_coordenacao_has_tipo_natureza_tipo_natureza1')->references('id_tipo_natureza')->on('tipo_natureza');
        
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
