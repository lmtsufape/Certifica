<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAtividadeStatusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('atividade_status', function (Blueprint $table) {
            $table->integer('id_atividade_status')->primary()->unique();
            $table->integer('atividade_id_atividade');
            $table->integer('status_id_status');
            $table->timestamp('data', 5);
            $table->string('obsercao', 250)->nullable();
            
            $table->foreign('atividade_id_atividade', 'fk_atividade_has_status_atividade1')->references('id_atividade')->on('atividade');
            $table->foreign('status_id_status', 'fk_atividade_has_status_status1')->references('id_status')->on('status');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('atividade_status');
    }
}
