<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUinidadeAdminstrativaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('uinidade_adminstrativa', function (Blueprint $table) {
            $table->integer('id')->primary()->unique();
            $table->string('descricao', 300);
            $table->integer('setor_id');
            
            $table->foreign('setor_id', 'fk_coordenacao_setor')->references('id')->on('setor');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('uinidade_adminstrativa');
    }
}
