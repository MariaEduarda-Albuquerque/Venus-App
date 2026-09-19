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
        Schema::create('tbsintomaciclo', function (Blueprint $table) {
            $table->unsignedInteger('codCiclo');
            $table->date('dataRegistro');
            $table->enum('sintoma', ['colica', 'fluxo_leve', 'fluxo_moderado', 'fluxo_intenso', 'humor', 'enxaqueca', 'dor_de_cabeca', 'inchaco', 'irritabilidade', 'cansaco', 'nausea', 'secrecao', 'outro']);

            $table->primary(['codCiclo', 'dataRegistro', 'sintoma']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbsintomaciclo');
    }
};
