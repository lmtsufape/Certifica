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
        Schema::create('colaboradores', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('gestor_id');
            $table->unsignedBigInteger('acao_id');
            $table->unsignedBigInteger('user_id');
            $table->timestamps();

        });
    }

    public function down()
    {
        Schema::dropIfExists('colaboradores_acao');
    }
};
