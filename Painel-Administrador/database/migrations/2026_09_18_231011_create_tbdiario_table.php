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
        Schema::create('tbdiario', function (Blueprint $table) {
            $table->increments('codDiario');
            $table->string('tituloDiario', 120);
            $table->text('descricaoDiario')->nullable();
            $table->string('arquivoDiario')->nullable();
            $table->date('dataDiario');
            $table->unsignedInteger('codUsuario');
            $table->unsignedInteger('codTipoDiario')->index('codtipodiario');

            $table->index(['codUsuario', 'dataDiario'], 'idx_diario_usuario_data');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbdiario');
    }
};
