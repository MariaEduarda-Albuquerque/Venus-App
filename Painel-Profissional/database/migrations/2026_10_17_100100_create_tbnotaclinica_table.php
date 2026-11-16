<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

// Nota clínica do prontuário. É PRIVADA: só o profissional que escreveu enxerga.
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tbnotaclinica', function (Blueprint $table) {
            $table->id('codNota');
            $table->unsignedBigInteger('codConsulta')->nullable();
            $table->unsignedBigInteger('codUsuario');
            $table->unsignedBigInteger('codProfissionalSaude');
            $table->text('textoNota');
            $table->timestamp('dataCriacao')->useCurrent();

            $table->index(['codProfissionalSaude', 'codUsuario'], 'idx_nota_profissional_usuaria');
            $table->foreign('codConsulta')->references('codConsulta')->on('tbconsulta')->nullOnDelete();
            $table->foreign('codUsuario')->references('codUsuario')->on('tbusuario')->cascadeOnDelete();
            $table->foreign('codProfissionalSaude')->references('codProfissionalSaude')->on('tbprofissionalsaude')->cascadeOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tbnotaclinica');
    }
};
