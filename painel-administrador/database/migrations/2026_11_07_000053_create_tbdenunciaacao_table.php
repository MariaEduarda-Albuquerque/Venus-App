<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tbdenunciaacao', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_unicode_ci';
            $table->integer('codDenunciaAcao')->unsigned()->autoIncrement();
            $table->integer('codDenuncia')->unsigned();
            $table->integer('codAdmin')->unsigned();
            $table->enum('acaoTomada', ['remover_conteudo', 'advertir', 'suspender_conta', 'arquivar_sem_acao', 'resolvida', 'reaberta']);
            $table->string('justificativa', 1000);
            $table->dateTime('dataAcao')->useCurrent();

            $table->primary(['codDenunciaAcao']);

            $table->index(['codDenuncia'], 'coddenuncia');

            $table->index(['codAdmin'], 'codadmin');

            $table->foreign(['codDenuncia'], 'tbdenunciaacao_ibfk_1')->references(['codDenuncia'])->on('tbdenuncia')->onDelete('cascade');

            $table->foreign(['codAdmin'], 'tbdenunciaacao_ibfk_2')->references(['codAdmin'])->on('tbadmin');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tbdenunciaacao');
    }
};
