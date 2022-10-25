<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsuarioDadosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('usuario_dados', function (Blueprint $table) {
            $table->integer('id_usuario')->primary();
            $table->string('instituicao', 100)->nullable();
            $table->string('vinculo', 45)->nullable();
            $table->string('departamento', 50)->nullable();
            $table->string('email_institucional', 45)->nullable();
            $table->string('celular', 24)->nullable();
            $table->string('whatsapp', 24)->nullable();
            $table->string('telefone', 24)->nullable();
            
            $table->foreign('id_usuario', 'fk_usuario_dados_usuario1')->references('id_usuario')->on('usuario');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('usuario_dados');
    }
}
