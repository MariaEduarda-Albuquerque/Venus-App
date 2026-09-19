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
        Schema::create('tbvacina', function (Blueprint $table) {
            $table->increments('codVacina');
            $table->unsignedInteger('codUsuario')->index('idx_vacina_usuario');
            $table->string('nomeVacina', 100);
            $table->date('dataAplicacao')->nullable();
            $table->string('doseVacina', 30)->nullable();
            $table->string('comprovanteVacina')->nullable();
            $table->dateTime('dataRegistro')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbvacina');
    }
};
