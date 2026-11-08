<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tbfeedback', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_unicode_ci';
            $table->integer('codFeedback')->unsigned()->autoIncrement();
            $table->enum('autorTipo', ['usuaria', 'profissional']);
            $table->integer('codUsuario')->unsigned()->nullable()->default(null);
            $table->integer('codProfissionalSaude')->unsigned()->nullable()->default(null);
            $table->tinyInteger('nota')->unsigned();
            $table->enum('categoriaFeedback', ['sugestao', 'problema_tecnico', 'elogio', 'outro']);
            $table->string('assuntoFeedback', 150)->nullable()->default(null);
            $table->text('comentario')->nullable()->default(null);
            $table->enum('statusFeedback', ['enviado', 'em_analise', 'respondido'])->default('enviado');
            $table->dateTime('dataFeedback')->useCurrent();

            $table->primary(['codFeedback']);

            $table->index(['codUsuario'], 'codusuario');

            $table->index(['codProfissionalSaude'], 'codprofissionalsaude');

            $table->foreign(['codUsuario'], 'tbfeedback_ibfk_1')->references(['codUsuario'])->on('tbusuario')->onDelete('cascade');

            $table->foreign(['codProfissionalSaude'], 'tbfeedback_ibfk_2')->references(['codProfissionalSaude'])->on('tbprofissionalsaude')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tbfeedback');
    }
};
