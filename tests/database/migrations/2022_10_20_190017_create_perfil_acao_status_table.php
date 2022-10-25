<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePerfilAcaoStatusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('perfil_acao_status', function (Blueprint $table) {
            $table->string('id_perfil_acao_status', 45)->primary();
            $table->integer('id_perfil_acao');
            $table->integer('id_status');
            $table->timestamp('data', 5);
            $table->string('observacao', 250)->nullable();
            
            $table->foreign('id_perfil_acao', 'fk_perfil_acao_has_status_perfil_acao1')->references('id_perfil_acao')->on('perfil_acao');
            $table->foreign('id_status', 'fk_perfil_acao_has_status_status1')->references('id_status')->on('status');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('perfil_acao_status');
    }
}
