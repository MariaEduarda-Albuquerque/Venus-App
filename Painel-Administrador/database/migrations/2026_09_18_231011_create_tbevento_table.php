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
        Schema::create('tbevento', function (Blueprint $table) {
            $table->increments('codEvento');
            $table->string('tituloEvento', 150);
            $table->text('descricaoEvento')->nullable();
            $table->string('bannerEvento')->nullable();
            $table->enum('formatoEvento', ['online', 'presencial']);
            $table->string('linkOuEndereco')->nullable();
            $table->dateTime('dataHoraEvento');
            $table->unsignedSmallInteger('duracaoMinutos')->nullable();
            $table->unsignedInteger('vagasTotais')->nullable();
            $table->unsignedInteger('codProfissionalSaude')->nullable()->index('codprofissionalsaude');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbevento');
    }
};
