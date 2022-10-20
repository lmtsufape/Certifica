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
        Schema::create('acao_informacao_complementars', function (Blueprint $table) {
            $table->id()->primary();
            $table->string('observacoes', 254)->nullable();
            $table->string('num_proc_telat_fim', 45)->nullable();
            $table->string('num_proc_abertura', 45)->nullable();
            $table->string('num_edital', 45)->nullable();
            
            $table->foreign('id_acao', 'fk_acao_informacao_complementar_acao1')->references('id_acao')->on('acao');
        
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
        Schema::dropIfExists('acao_informacao_complementars');
    }
};
