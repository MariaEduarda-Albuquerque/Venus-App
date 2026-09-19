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
        Schema::table('tbprogressotrilha', function (Blueprint $table) {
            $table->foreign(['codUsuario'], 'tbprogressotrilha_ibfk_1')->references(['codUsuario'])->on('tbusuario')->onUpdate('restrict')->onDelete('cascade');
            $table->foreign(['codTrilha'], 'tbprogressotrilha_ibfk_2')->references(['codTrilha'])->on('tbtrilhaaprendizado')->onUpdate('restrict')->onDelete('cascade');
            $table->foreign(['codConteudo'], 'tbprogressotrilha_ibfk_3')->references(['codConteudo'])->on('tbconteudo')->onUpdate('restrict')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tbprogressotrilha', function (Blueprint $table) {
            $table->dropForeign('tbprogressotrilha_ibfk_1');
            $table->dropForeign('tbprogressotrilha_ibfk_2');
            $table->dropForeign('tbprogressotrilha_ibfk_3');
        });
    }
};
