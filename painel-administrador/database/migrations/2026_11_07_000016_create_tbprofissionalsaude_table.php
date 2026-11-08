<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tbprofissionalsaude', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_unicode_ci';
            $table->integer('codProfissionalSaude')->unsigned()->autoIncrement();
            $table->string('nomeProfissionalSaude', 120);
            $table->string('emailProfissionalSaude', 150);
            $table->string('telProfissionalSaude', 14)->nullable()->default(null);
            $table->string('senhaProfissionalSaude', 255);
            $table->tinyInteger('duasEtapasAtiva')->default(0);
            $table->enum('provedorLoginProfissional', ['local', 'google'])->default('local');
            $table->string('googleIdProfissional', 255)->nullable()->default(null);
            $table->enum('categoriaProfissional', ['medico', 'enfermeiro', 'psicologo', 'assistente_social', 'outro']);
            $table->string('especialidadeProfissionalSaude', 25)->nullable()->default(null);
            $table->string('apresentacaoProfissional', 400)->nullable()->default(null);
            $table->string('paisProfissional', 60)->nullable()->default(null);
            $table->string('cidadeProfissional', 100)->nullable()->default(null);
            $table->char('ufProfissional', 2)->nullable()->default(null);
            $table->string('cepProfissional', 10)->nullable()->default(null);
            $table->string('ruaProfissional', 150)->nullable()->default(null);
            $table->string('numeroProfissional', 10)->nullable()->default(null);
            $table->string('complementoProfissional', 100)->nullable()->default(null);
            $table->string('nrFiscalProfissional', 20)->nullable()->default(null);
            $table->string('fotoPerfilProfissional', 255)->nullable()->default(null);
            $table->string('comprovanteConselhoClasseProfissional', 255)->nullable()->default(null);
            $table->string('documentoComplementarProfissional', 255)->nullable()->default(null);
            $table->enum('statusVerificacao', ['em_analise', 'aprovado', 'pendencia', 'reprovado'])->default('em_analise');
            $table->enum('statusConta', ['ativa', 'suspensa', 'excluida'])->default('ativa');
            $table->dateTime('dataCadastro')->useCurrent();
            $table->dateTime('dataAtualizacao')->useCurrent()->useCurrentOnUpdate();

            $table->primary(['codProfissionalSaude']);

            $table->unique(['emailProfissionalSaude'], 'uq_profissional_email');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tbprofissionalsaude');
    }
};
