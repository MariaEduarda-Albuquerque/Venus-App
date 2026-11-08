<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tbinteresseusuario', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_unicode_ci';
            $table->integer('codUsuario')->unsigned();
            $table->integer('codTipoCategoria')->unsigned();
            $table->dateTime('dataSelecionado')->useCurrent();

            $table->primary(['codUsuario', 'codTipoCategoria']);

            $table->index(['codTipoCategoria'], 'codtipocategoria');

            $table->foreign(['codUsuario'], 'tbinteresseusuario_ibfk_1')->references(['codUsuario'])->on('tbusuario')->onDelete('cascade');

            $table->foreign(['codTipoCategoria'], 'tbinteresseusuario_ibfk_2')->references(['codTipoCategoria'])->on('codtipocategoria')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tbinteresseusuario');
    }
};
