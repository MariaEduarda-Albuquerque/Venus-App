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
        Schema::create('tbfeedback', function (Blueprint $table) {
            $table->increments('codFeedback');
            $table->enum('autorTipo', ['usuaria', 'profissional']);
            $table->unsignedInteger('codUsuario')->nullable()->index('codusuario');
            $table->unsignedInteger('codProfissionalSaude')->nullable()->index('codprofissionalsaude');
            $table->unsignedTinyInteger('nota');
            $table->enum('categoriaFeedback', ['sugestao', 'problema_tecnico', 'elogio', 'outro']);
            $table->string('assuntoFeedback', 150)->nullable();
            $table->text('comentario')->nullable();
            $table->enum('statusFeedback', ['enviado', 'em_analise', 'respondido'])->default('enviado');
            $table->dateTime('dataFeedback')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbfeedback');
    }
};
