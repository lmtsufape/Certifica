<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAcaoStatusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('acao_status', function (Blueprint $table) {
            $table->integer('id_acao_status')->primary()->unique();
            $table->integer('acao_id_acao');
            $table->integer('status_id_status');
            
            $table->foreign('acao_id_acao', 'fk_acao_status_acao1')->references('id_acao')->on('acao');
            $table->foreign('status_id_status', 'fk_acao_status_status1')->references('id_status')->on('status');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('acao_status');
    }
}
