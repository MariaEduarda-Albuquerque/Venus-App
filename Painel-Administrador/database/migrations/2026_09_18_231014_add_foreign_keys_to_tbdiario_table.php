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
        Schema::table('tbdiario', function (Blueprint $table) {
            $table->foreign(['codUsuario'], 'tbdiario_ibfk_1')->references(['codUsuario'])->on('tbusuario')->onUpdate('restrict')->onDelete('cascade');
            $table->foreign(['codTipoDiario'], 'tbdiario_ibfk_2')->references(['codTipoDiario'])->on('tbtipodiario')->onUpdate('restrict')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tbdiario', function (Blueprint $table) {
            $table->dropForeign('tbdiario_ibfk_1');
            $table->dropForeign('tbdiario_ibfk_2');
        });
    }
};
