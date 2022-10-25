<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAssinaturaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assinatura', function (Blueprint $table) {
            $table->integer('id_assinatura')->primary()->unique();
            $table->integer('id_usuario');
            $table->string('img_assinatura', 300);
            
            $table->foreign('id_usuario', 'fk_assinatura_usuario1')->references('id_usuario')->on('usuario');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('assinatura');
    }
}
