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
        Schema::table('tbtrilhaaprendizado', function (Blueprint $table) {
            $table->foreign(['codTipoCategoria'], 'tbtrilhaaprendizado_ibfk_1')->references(['codTipoCategoria'])->on('codtipocategoria')->onUpdate('restrict')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tbtrilhaaprendizado', function (Blueprint $table) {
            $table->dropForeign('tbtrilhaaprendizado_ibfk_1');
        });
    }
};
