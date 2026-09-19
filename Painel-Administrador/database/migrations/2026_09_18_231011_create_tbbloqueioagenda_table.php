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
        Schema::create('tbbloqueioagenda', function (Blueprint $table) {
            $table->increments('codBloqueio');
            $table->unsignedInteger('codProfissionalSaude');
            $table->date('dataBloqueio');
            $table->time('horaInicio')->nullable();
            $table->time('horaFim')->nullable();
            $table->string('motivoBloqueio', 150)->nullable();
            $table->dateTime('dataCriacao')->useCurrent();

            $table->index(['codProfissionalSaude', 'dataBloqueio'], 'idx_bloqueio_profissional_data');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbbloqueioagenda');
    }
};
