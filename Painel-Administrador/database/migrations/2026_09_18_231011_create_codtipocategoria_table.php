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
        Schema::create('codtipocategoria', function (Blueprint $table) {
            $table->increments('codTipoCategoria');
            $table->string('nomeTipoCategoria', 60);
            $table->string('descricaoTipoCategoria')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('codtipocategoria');
    }
};
