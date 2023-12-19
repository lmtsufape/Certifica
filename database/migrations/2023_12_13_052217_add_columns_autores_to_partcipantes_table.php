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
            $table->foreignId('autor_trabalhos_id')->nullable()->constrained('trabalhos');
            $table->foreignId('coautor_trabalhos_id')->nullable()->constrained('trabalhos');
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
            $table->dropForeign(['autor_trabalhos_id']);
            $table->dropForeign(['coautor_trabalhos_id']);

        });
    }
};
