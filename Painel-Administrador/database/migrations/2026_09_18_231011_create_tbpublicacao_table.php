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
        Schema::create('tbpublicacao', function (Blueprint $table) {
            $table->increments('codPublicacao');
            $table->string('tituloPublicacao', 150);
            $table->string('descricaoPublicacao')->nullable();
            $table->unsignedInteger('codConteudo')->unique('uq_publicacao_conteudo');
            $table->dateTime('dataPublicacao')->useCurrent();
            $table->unsignedInteger('visualizacoes')->default(0);
            $table->unsignedInteger('tempoMedioLeituraSeg')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbpublicacao');
    }
};
