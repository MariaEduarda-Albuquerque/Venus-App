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
        Schema::create('tbhumordiario', function (Blueprint $table) {
            $table->unsignedInteger('codUsuario');
            $table->date('dataRegistro');
            $table->enum('humor', ['otimo', 'bom', 'neutro', 'ruim', 'pessimo']);

            $table->primary(['codUsuario', 'dataRegistro']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbhumordiario');
    }
};
