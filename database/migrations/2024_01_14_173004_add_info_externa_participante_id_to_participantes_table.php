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
        Schema::table('participantes', function (Blueprint $table) {
            //
            $table->foreignId('info_externa_participante_id')->nullable()->constrained('info_externa_participantes');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('participantes', function (Blueprint $table) {
            //
            $table->dropForeign(['info_externa_participante_id']);
            $table->dropColumn('info_externa_participante_id');
        });
    }
};
