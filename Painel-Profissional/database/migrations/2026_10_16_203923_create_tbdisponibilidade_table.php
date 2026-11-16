<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tbdisponibilidade', function (Blueprint $table) {
            $table->id('codDisponibilidade');
            $table->unsignedBigInteger('codProfissionalSaude');
            $table->unsignedTinyInteger('diaSemana');
            $table->time('horaInicio');
            $table->time('horaFim');
            $table->enum('tipoAtendimento', ['chat', 'duvida_rapida', 'presencial']);

            $table->index(['codProfissionalSaude', 'diaSemana']);
            $table->foreign('codProfissionalSaude')->references('codProfissionalSaude')->on('tbprofissionalsaude')->cascadeOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tbdisponibilidade');
    }
};
