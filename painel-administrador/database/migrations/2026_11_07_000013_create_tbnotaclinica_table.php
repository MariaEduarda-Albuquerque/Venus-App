<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tbnotaclinica', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_unicode_ci';
            $table->bigInteger('codNota')->unsigned()->autoIncrement();
            $table->bigInteger('codConsulta')->unsigned()->nullable()->default(null);
            $table->bigInteger('codUsuario')->unsigned();
            $table->bigInteger('codProfissionalSaude')->unsigned();
            $table->text('textoNota');
            $table->timestamp('dataCriacao')->useCurrent();

            $table->primary(['codNota']);

            $table->index(['codProfissionalSaude', 'codUsuario'], 'idx_nota_profissional_usuaria');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tbnotaclinica');
    }
};
