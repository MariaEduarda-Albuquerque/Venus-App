<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tbsintomaciclo', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_unicode_ci';
            $table->integer('codCiclo')->unsigned();
            $table->date('dataRegistro');
            $table->enum('sintoma', ['colica', 'fluxo_leve', 'fluxo_moderado', 'fluxo_intenso', 'humor', 'enxaqueca', 'dor_de_cabeca', 'inchaco', 'irritabilidade', 'cansaco', 'nausea', 'secrecao', 'outro']);

            $table->primary(['codCiclo', 'dataRegistro', 'sintoma']);

            $table->foreign(['codCiclo'], 'tbsintomaciclo_ibfk_1')->references(['codCiclo'])->on('tbciclomenstrual')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tbsintomaciclo');
    }
};
