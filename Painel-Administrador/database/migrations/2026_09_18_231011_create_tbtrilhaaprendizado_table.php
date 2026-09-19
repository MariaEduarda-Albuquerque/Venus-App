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
        Schema::create('tbtrilhaaprendizado', function (Blueprint $table) {
            $table->increments('codTrilha');
            $table->string('nomeTrilha', 100);
            $table->string('descricaoTrilha')->nullable();
            $table->unsignedInteger('codTipoCategoria')->nullable()->index('codtipocategoria');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbtrilhaaprendizado');
    }
};
