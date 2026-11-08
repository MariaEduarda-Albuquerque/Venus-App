<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tbconsulta', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_unicode_ci';
            $table->integer('codConsulta')->unsigned()->autoIncrement();
            $table->string('nomeConsulta', 120);
            $table->enum('tipoConsulta', ['agendada', 'duvida_rapida'])->default('agendada');
            $table->integer('idTipoAtendimento')->nullable()->default(null);
            $table->string('statusConsulta', 20)->default('aguardando');
            $table->dateTime('dataHoraAgendada')->nullable()->default(null);
            $table->text('historicoConsulta')->nullable()->default(null);
            $table->integer('codUsuario')->unsigned();
            $table->integer('codProfissionalSaude')->unsigned();
            $table->dateTime('dataCriacao')->useCurrent();

            $table->primary(['codConsulta']);

            $table->index(['codProfissionalSaude', 'statusConsulta'], 'idx_consulta_profissional_status');

            $table->index(['idTipoAtendimento'], 'idx_consulta_tipoatendimento');

            $table->index(['codUsuario'], 'codusuario');

            $table->foreign(['codUsuario'], 'tbconsulta_ibfk_1')->references(['codUsuario'])->on('tbusuario')->onDelete('cascade');

            $table->foreign(['codProfissionalSaude'], 'tbconsulta_ibfk_2')->references(['codProfissionalSaude'])->on('tbprofissionalsaude')->onDelete('cascade');

            $table->foreign(['idTipoAtendimento'], 'tbconsulta_ibfk_3')->references(['idTipoAtendimento'])->on('tbtipoatendimento')->onDelete('set null')->onUpdate('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tbconsulta');
    }
};
