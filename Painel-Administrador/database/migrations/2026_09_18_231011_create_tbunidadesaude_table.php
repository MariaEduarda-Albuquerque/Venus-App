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
        Schema::create('tbunidadesaude', function (Blueprint $table) {
            $table->increments('codUnidade');
            $table->string('nomeUnidade', 150);
            $table->enum('tipoUnidade', ['UBS', 'UPA', 'CAPS', 'CRAS', 'Farmacia_Popular']);
            $table->string('endereco');
            $table->decimal('latitude', 10, 7);
            $table->decimal('longitude', 10, 7);
            $table->string('telefone', 20)->nullable();
            $table->string('horarioFuncionamento')->nullable();

            $table->index(['latitude', 'longitude'], 'idx_unidade_geo');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbunidadesaude');
    }
};
