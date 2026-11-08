<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tbhumordiario', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_unicode_ci';
            $table->integer('codUsuario')->unsigned();
            $table->date('dataRegistro');
            $table->enum('humor', ['otimo', 'bom', 'neutro', 'ruim', 'pessimo']);

            $table->primary(['codUsuario', 'dataRegistro']);

            $table->foreign(['codUsuario'], 'tbhumordiario_ibfk_1')->references(['codUsuario'])->on('tbusuario')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tbhumordiario');
    }
};
