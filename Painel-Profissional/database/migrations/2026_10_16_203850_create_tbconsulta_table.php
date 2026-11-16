<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tbconsulta', function (Blueprint $table) {
            $table->id('codConsulta');
            $table->string('nomeConsulta', 120);
            $table->enum('tipoConsulta', ['agendada', 'duvida_rapida'])->default('agendada');
            $table->enum('statusConsulta', ['aguardando', 'em_andamento', 'encerrada', 'cancelada'])->default('aguardando');
            $table->dateTime('dataHoraAgendada')->nullable();
            $table->text('historicoConsulta')->nullable();
            $table->unsignedBigInteger('codUsuario');
            $table->unsignedBigInteger('codProfissionalSaude');
            $table->timestamp('dataCriacao')->useCurrent();

            $table->index(['codProfissionalSaude', 'statusConsulta'], 'idx_consulta_profissional_status');
            $table->index(['codProfissionalSaude', 'dataHoraAgendada'], 'idx_consulta_profissional_data');
            $table->foreign('codUsuario')->references('codUsuario')->on('tbusuario')->cascadeOnDelete();
            $table->foreign('codProfissionalSaude')->references('codProfissionalSaude')->on('tbprofissionalsaude')->cascadeOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tbconsulta');
    }
};
