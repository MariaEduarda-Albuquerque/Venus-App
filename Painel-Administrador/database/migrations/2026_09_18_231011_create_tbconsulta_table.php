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
        Schema::create('tbconsulta', function (Blueprint $table) {
            $table->increments('codConsulta');
            $table->string('nomeConsulta', 120);
            $table->enum('tipoConsulta', ['agendada', 'duvida_rapida'])->default('agendada');
            $table->integer('idTipoAtendimento')->nullable()->index('idx_consulta_tipoatendimento');
            $table->enum('statusConsulta', ['aguardando', 'em_andamento', 'encerrada', 'cancelada'])->default('aguardando');
            $table->dateTime('dataHoraAgendada')->nullable();
            $table->text('historicoConsulta')->nullable();
            $table->unsignedInteger('codUsuario')->index('codusuario');
            $table->unsignedInteger('codProfissionalSaude');
            $table->dateTime('dataCriacao')->useCurrent();

            $table->index(['codProfissionalSaude', 'statusConsulta'], 'idx_consulta_profissional_status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbconsulta');
    }
};
