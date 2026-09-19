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
        Schema::table('tbtrilhaconteudo', function (Blueprint $table) {
            $table->foreign(['codTrilha'], 'tbtrilhaconteudo_ibfk_1')->references(['codTrilha'])->on('tbtrilhaaprendizado')->onUpdate('restrict')->onDelete('cascade');
            $table->foreign(['codConteudo'], 'tbtrilhaconteudo_ibfk_2')->references(['codConteudo'])->on('tbconteudo')->onUpdate('restrict')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tbtrilhaconteudo', function (Blueprint $table) {
            $table->dropForeign('tbtrilhaconteudo_ibfk_1');
            $table->dropForeign('tbtrilhaconteudo_ibfk_2');
        });
    }
};
