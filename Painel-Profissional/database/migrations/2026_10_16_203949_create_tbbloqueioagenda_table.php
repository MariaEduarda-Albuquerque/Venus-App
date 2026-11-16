<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tbbloqueioagenda', function (Blueprint $table) {
            $table->id('codBloqueio');
            $table->unsignedBigInteger('codProfissionalSaude');
            $table->date('dataBloqueio');
            $table->time('horaInicio');
            $table->time('horaFim');
            $table->string('motivoBloqueio', 30);
            $table->timestamp('dataCriacao')->useCurrent();

            $table->index(['codProfissionalSaude', 'dataBloqueio']);
            $table->foreign('codProfissionalSaude')->references('codProfissionalSaude')->on('tbprofissionalsaude')->cascadeOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tbbloqueioagenda');
    }
};
