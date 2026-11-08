<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tbdisponibilidadeprofissional', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_unicode_ci';
            $table->integer('codDisponibilidade')->unsigned()->autoIncrement();
            $table->integer('codProfissionalSaude')->unsigned();
            $table->tinyInteger('diaSemana')->unsigned();
            $table->time('horaInicio');
            $table->time('horaFim');
            $table->enum('tipoAtendimento', ['chat', 'duvida_rapida', 'presencial']);
            $table->integer('idTipoAtendimento')->nullable()->default(null);

            $table->primary(['codDisponibilidade']);

            $table->index(['codProfissionalSaude'], 'codprofissionalsaude');

            $table->index(['idTipoAtendimento'], 'idx_disponibilidade_tipoatendimento');

            $table->foreign(['codProfissionalSaude'], 'tbdisponibilidadeprofissional_ibfk_1')->references(['codProfissionalSaude'])->on('tbprofissionalsaude')->onDelete('cascade');

            $table->foreign(['idTipoAtendimento'], 'tbdisponibilidadeprofissional_ibfk_2')->references(['idTipoAtendimento'])->on('tbtipoatendimento')->onDelete('set null')->onUpdate('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tbdisponibilidadeprofissional');
    }
};
