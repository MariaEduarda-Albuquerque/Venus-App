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
        Schema::create('tbciclomenstrual', function (Blueprint $table) {
            $table->increments('codCiclo');
            $table->unsignedInteger('codUsuario');
            $table->date('dataInicio');
            $table->unsignedTinyInteger('duracaoDias')->nullable();

            $table->index(['codUsuario', 'dataInicio'], 'idx_ciclo_usuario');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbciclomenstrual');
    }
};
