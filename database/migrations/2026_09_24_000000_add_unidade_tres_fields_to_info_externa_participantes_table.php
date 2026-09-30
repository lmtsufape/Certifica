<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('info_externa_participantes', function (Blueprint $table) {
            $table->string('titulo_plano')->nullable();
            $table->string('orientador_cpf')->nullable();
            $table->string('orientador_email')->nullable();
            $table->date('data_inicio')->nullable();
            $table->date('data_fim')->nullable();
            $table->string('tipo_natureza_participante')->nullable();
        });
    }

    public function down()
    {
        Schema::table('info_externa_participantes', function (Blueprint $table) {
            $table->dropColumn([
                'titulo_plano',
                'orientador_cpf',
                'orientador_email',
                'data_inicio',
                'data_fim',
                'tipo_natureza_participante',
            ]);
        });
    }
};
