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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('cpf')->unique()->nullable();
            $table->string('celular')->nullable();
            $table->string('instituicao')->nullable();
            $table->string('siape')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('profile_photo_path', 2048)->nullable();

            $table->foreignId('perfil_id')->constrained('perfils');
            $table->foreignId('unidade_administrativa_id')->nullable()->constrained('unidade_administrativas');
            $table->foreignId('curso_id')->nullable()->constrained('cursos');
            $table->foreignId('instituicao_id')->constrained('instituicaos');

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
        Schema::dropIfExists('users');
    }
};
