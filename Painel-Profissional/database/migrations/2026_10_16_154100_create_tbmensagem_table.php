<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tbmensagem', function (Blueprint $table) {
            $table->id('codMensagem');
            $table->unsignedBigInteger('codUsuario');
            $table->unsignedBigInteger('codProfissionalSaude');
            $table->enum('remetenteMensagem', ['usuario', 'profissional']);
            $table->text('textoMensagem');
            $table->boolean('lidaMensagem')->default(false);
            $table->timestamp('dataEnvio')->useCurrent();

            $table->index(['codProfissionalSaude', 'codUsuario']);
            $table->foreign('codUsuario')->references('codUsuario')->on('tbusuario')->cascadeOnDelete();
            $table->foreign('codProfissionalSaude')->references('codProfissionalSaude')->on('tbprofissionalsaude')->cascadeOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tbmensagem');
    }
};
