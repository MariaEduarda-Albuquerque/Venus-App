<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tbforumresposta', function (Blueprint $table) {
            $table->increments('codForumResposta');
            $table->unsignedInteger('codForumPublicacao')->index('codforumpublicacao');
            $table->enum('autorTipo', ['usuaria', 'profissional']);
            $table->unsignedInteger('codUsuario')->nullable()->index('codusuario');
            $table->unsignedInteger('codProfissionalSaude')->nullable()->index('codprofissionalsaude');
            $table->text('textoResposta');
            $table->dateTime('dataResposta')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbforumresposta');
    }
};
