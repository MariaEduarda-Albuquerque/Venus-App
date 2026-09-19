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
        Schema::create('tbexame', function (Blueprint $table) {
            $table->increments('codExame');
            $table->unsignedInteger('codUsuario');
            $table->string('nomeExame', 150);
            $table->string('arquivoExame');
            $table->date('dataExame');
            $table->enum('statusExame', ['salvo', 'analisado'])->default('salvo');
            $table->string('observacaoExame')->nullable();
            $table->dateTime('dataUpload')->useCurrent();

            $table->index(['codUsuario', 'dataExame'], 'idx_exame_usuario');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbexame');
    }
};
