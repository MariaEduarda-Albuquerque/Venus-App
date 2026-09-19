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
        Schema::create('tbinteresseusuario', function (Blueprint $table) {
            $table->unsignedInteger('codUsuario');
            $table->unsignedInteger('codTipoCategoria')->index('codtipocategoria');
            $table->dateTime('dataSelecionado')->useCurrent();

            $table->primary(['codUsuario', 'codTipoCategoria']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbinteresseusuario');
    }
};
