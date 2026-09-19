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
        Schema::create('tbdenunciaacao', function (Blueprint $table) {
            $table->increments('codDenunciaAcao');
            $table->unsignedInteger('codDenuncia')->index('coddenuncia');
            $table->unsignedInteger('codAdmin')->index('codadmin');
            $table->enum('acaoTomada', ['remover_conteudo', 'advertir', 'suspender_conta', 'arquivar_sem_acao']);
            $table->string('justificativa');
            $table->dateTime('dataAcao')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbdenunciaacao');
    }
};
