<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tbdiario', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_unicode_ci';
            $table->integer('codDiario')->unsigned()->autoIncrement();
            $table->string('tituloDiario', 120);
            $table->text('descricaoDiario')->nullable()->default(null);
            $table->string('arquivoDiario', 255)->nullable()->default(null);
            $table->date('dataDiario');
            $table->integer('codUsuario')->unsigned();
            $table->integer('codTipoDiario')->unsigned();

            $table->primary(['codDiario']);

            $table->index(['codUsuario', 'dataDiario'], 'idx_diario_usuario_data');

            $table->index(['codTipoDiario'], 'codtipodiario');

            $table->foreign(['codUsuario'], 'tbdiario_ibfk_1')->references(['codUsuario'])->on('tbusuario')->onDelete('cascade');

            $table->foreign(['codTipoDiario'], 'tbdiario_ibfk_2')->references(['codTipoDiario'])->on('tbtipodiario');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tbdiario');
    }
};
