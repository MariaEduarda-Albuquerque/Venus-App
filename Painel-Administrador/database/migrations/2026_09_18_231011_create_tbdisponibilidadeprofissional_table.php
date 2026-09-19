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
        Schema::create('tbdisponibilidadeprofissional', function (Blueprint $table) {
            $table->increments('codDisponibilidade');
            $table->unsignedInteger('codProfissionalSaude')->index('codprofissionalsaude');
            $table->unsignedTinyInteger('diaSemana');
            $table->time('horaInicio');
            $table->time('horaFim');
            $table->enum('tipoAtendimento', ['chat', 'duvida_rapida', 'presencial']);
            $table->integer('idTipoAtendimento')->nullable()->index('idx_disponibilidade_tipoatendimento');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbdisponibilidadeprofissional');
    }
};
