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
        Schema::table('tbforumpublicacao', function (Blueprint $table) {
            $table->foreign(['codUsuario'], 'tbforumpublicacao_ibfk_1')->references(['codUsuario'])->on('tbusuario')->onUpdate('restrict')->onDelete('cascade');
            $table->foreign(['codTipoCategoria'], 'tbforumpublicacao_ibfk_2')->references(['codTipoCategoria'])->on('codtipocategoria')->onUpdate('restrict')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tbforumpublicacao', function (Blueprint $table) {
            $table->dropForeign('tbforumpublicacao_ibfk_1');
            $table->dropForeign('tbforumpublicacao_ibfk_2');
        });
    }
};
