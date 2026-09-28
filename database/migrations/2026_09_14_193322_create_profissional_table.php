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
            $table->id('codProfissionalSaude');
            $table->string('nomeProfissionalSaude', 120);
            $table->string('emailProfissionalSaude', 150);
            $table->string('telProfissionalSaude', 14)->nullable();
            $table->string('senhaProfissionalSaude', 255);
            $table->boolean('duasEtapasAtiva')->default(false);
            $table->enum('provedorLoginProfissional', ['Local', 'Google'])->default('Local');
            $table->string('googleIdProfissional', 255)->nullable();
            $table->enum('categoriaProfissional', ['Médico', 'Enfermeiro','Psicologo', 'Assistente Social', 'Outro']);
            $table->string('especialidadeProfissionalSaude', 25)->nullable();
            $table->string('apresentacaoProfissional', 400)->nullable();
            $table->string('paisProfissional', 60)->nullable();
            $table->string('cidadeProfissional', 100)->nullable();
            $table->string('ufProfissional', 2)->nullable();
            $table->string('cepProfissional', 10)->nullable();
            $table->string('nrFiscalProfissional', 20)->nullable();
            $table->string('fotoPerfilProfissional', 255)->nullable();
            $table->enum('statusVerificacao', ['Em análise', 'Aprovado', 'Pendência'])->default('Em análise');
            $table->enum('statusConta', ['Ativa', 'Suspensa', 'Excluída'])->default('Ativa');
            $table->timestamp('dataCadastro')->useCurrent();
            $table->timestamp('dataAtualizacao')->useCurrent()->useCurrentOnUpdate();            
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
