<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tbtrilhaaprendizado', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_unicode_ci';
            $table->integer('codTrilha')->unsigned()->autoIncrement();
            $table->string('nomeTrilha', 100);
            $table->string('descricaoTrilha', 255)->nullable()->default(null);
            $table->integer('codTipoCategoria')->unsigned()->nullable()->default(null);

            $table->primary(['codTrilha']);

            $table->index(['codTipoCategoria'], 'codtipocategoria');

            $table->foreign(['codTipoCategoria'], 'tbtrilhaaprendizado_ibfk_1')->references(['codTipoCategoria'])->on('codtipocategoria')->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tbtrilhaaprendizado');
    }
};
