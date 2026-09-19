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
        Schema::table('tbinteresseusuario', function (Blueprint $table) {
            $table->foreign(['codUsuario'], 'tbinteresseusuario_ibfk_1')->references(['codUsuario'])->on('tbusuario')->onUpdate('restrict')->onDelete('cascade');
            $table->foreign(['codTipoCategoria'], 'tbinteresseusuario_ibfk_2')->references(['codTipoCategoria'])->on('codtipocategoria')->onUpdate('restrict')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tbinteresseusuario', function (Blueprint $table) {
            $table->dropForeign('tbinteresseusuario_ibfk_1');
            $table->dropForeign('tbinteresseusuario_ibfk_2');
        });
    }
};
