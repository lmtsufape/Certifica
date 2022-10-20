<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePerfilStatusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('perfil_status', function (Blueprint $table) {
            $table->integer('id_perfil_status')->primary()->unique();
            $table->integer('id_perfil_sistema');
            $table->integer('id_status');
            $table->timestamp('data', 5);
            $table->string('observacao', 250)->nullable();
            
            $table->foreign('id_perfil_sistema', 'fk_perfil_sistema_has_status_perfil_sistema1')->references('id_perfil_sistema')->on('perfil_sistema');
            $table->foreign('id_status', 'fk_perfil_sistema_has_status_status1')->references('id_status')->on('status');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('perfil_status');
    }
}
