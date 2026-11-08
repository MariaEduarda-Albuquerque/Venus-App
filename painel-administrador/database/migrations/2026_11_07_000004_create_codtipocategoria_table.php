<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('codtipocategoria', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_unicode_ci';
            $table->integer('codTipoCategoria')->unsigned()->autoIncrement();
            $table->string('nomeTipoCategoria', 60);
            $table->string('descricaoTipoCategoria', 255)->nullable()->default(null);

            $table->primary(['codTipoCategoria']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('codtipocategoria');
    }
};
