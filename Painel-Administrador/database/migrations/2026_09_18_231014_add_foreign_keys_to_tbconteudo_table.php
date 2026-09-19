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
        Schema::table('tbconteudo', function (Blueprint $table) {
            $table->foreign(['codTipoCategoria'], 'tbconteudo_ibfk_1')->references(['codTipoCategoria'])->on('codtipocategoria')->onUpdate('restrict')->onDelete('restrict');
            $table->foreign(['codTipoConteudo'], 'tbconteudo_ibfk_2')->references(['codTipoConteudo'])->on('tbtipoconteudo')->onUpdate('restrict')->onDelete('restrict');
            $table->foreign(['codProfissionalSaude'], 'tbconteudo_ibfk_3')->references(['codProfissionalSaude'])->on('tbprofissionalsaude')->onUpdate('restrict')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tbconteudo', function (Blueprint $table) {
            $table->dropForeign('tbconteudo_ibfk_1');
            $table->dropForeign('tbconteudo_ibfk_2');
            $table->dropForeign('tbconteudo_ibfk_3');
        });
    }
};
