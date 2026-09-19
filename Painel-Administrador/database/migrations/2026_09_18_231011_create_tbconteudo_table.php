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
        Schema::create('tbconteudo', function (Blueprint $table) {
            $table->increments('codConteudo');
            $table->string('tituloConteudo', 150);
            $table->mediumText('corpoConteudo');
            $table->string('capaConteudo')->nullable();
            $table->unsignedSmallInteger('tempoLeituraMinutos')->nullable();
            $table->unsignedInteger('codTipoCategoria')->index('codtipocategoria');
            $table->unsignedInteger('codTipoConteudo')->index('codtipoconteudo');
            $table->unsignedInteger('codProfissionalSaude')->nullable()->index('codprofissionalsaude');
            $table->enum('statusConteudo', ['rascunho', 'em_revisao', 'publicado', 'recusado'])->default('rascunho')->index('idx_conteudo_status');
            $table->dateTime('dataCriacao')->useCurrent();
            $table->dateTime('dataAtualizacao')->useCurrentOnUpdate()->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbconteudo');
    }
};
