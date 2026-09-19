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
        Schema::create('tbprofissionalsaude', function (Blueprint $table) {
            $table->increments('codProfissionalSaude');
            $table->string('nomeProfissionalSaude', 120);
            $table->string('emailProfissionalSaude', 150)->unique('uq_profissional_email');
            $table->string('telProfissionalSaude', 14)->nullable();
            $table->string('senhaProfissionalSaude');
            $table->boolean('duasEtapasAtiva')->default(false);
            $table->enum('provedorLoginProfissional', ['local', 'google'])->default('local');
            $table->string('googleIdProfissional')->nullable();
            $table->enum('categoriaProfissional', ['medico', 'enfermeiro', 'psicologo', 'assistente_social', 'outro']);
            $table->string('especialidadeProfissionalSaude', 25)->nullable();
            $table->string('apresentacaoProfissional', 400)->nullable();
            $table->string('paisProfissional', 60)->nullable();
            $table->string('cidadeProfissional', 100)->nullable();
            $table->char('ufProfissional', 2)->nullable();
            $table->string('cepProfissional', 10)->nullable();
            $table->string('nrFiscalProfissional', 20)->nullable();
            $table->string('fotoPerfilProfissional')->nullable();
            $table->enum('statusVerificacao', ['em_analise', 'aprovado', 'pendencia'])->default('em_analise');
            $table->enum('statusConta', ['ativa', 'suspensa', 'excluida'])->default('ativa');
            $table->dateTime('dataCadastro')->useCurrent();
            $table->dateTime('dataAtualizacao')->useCurrentOnUpdate()->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbprofissionalsaude');
    }
};
