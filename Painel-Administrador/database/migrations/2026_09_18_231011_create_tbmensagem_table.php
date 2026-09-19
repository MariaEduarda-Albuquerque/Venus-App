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
        Schema::create('tbmensagem', function (Blueprint $table) {
            $table->bigIncrements('codMensagem');
            $table->unsignedInteger('codConsulta');
            $table->enum('remetenteTipo', ['usuaria', 'profissional']);
            $table->text('textoMensagem')->nullable();
            $table->string('anexoMensagem')->nullable();
            $table->dateTime('lidaEm')->nullable();
            $table->dateTime('dataEnvio')->useCurrent();

            $table->index(['codConsulta', 'dataEnvio'], 'idx_mensagem_consulta');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbmensagem');
    }
};
