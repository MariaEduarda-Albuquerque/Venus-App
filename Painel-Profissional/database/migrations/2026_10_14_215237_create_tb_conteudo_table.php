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
            $table->id('codConteudo');
            $table->string('tituloConteudo', 150);
            $table->mediumText('corpoConteudo');
            $table->string('capaConteudo', 255)->nullable();
            $table->unsignedSmallInteger('tempoLeituraMinutos')->nullable();

            $table->foreignId('codTipoCategoria')
                ->constrained('tbtipocategoria', 'codTipoCategoria')
                ->restrictOnDelete();

            $table->foreignId('codTipoConteudo')
                ->constrained('tbtipoconteudo', 'codTipoConteudo')
                ->restrictOnDelete();

            $table->foreignId('codProfissionalSaude')
                ->nullable()
                ->constrained('tbprofissionalsaude', 'codProfissionalSaude')
                ->nullOnDelete();

            $table->enum('statusConteudo', ['rascunho', 'em_revisao', 'publicado', 'recusado'])->default('rascunho');
            $table->timestamp('dataCriacao')->useCurrent();
            $table->timestamp('dataAtualizacao')->useCurrent()->useCurrentOnUpdate();

            $table->index('statusConteudo', 'idx_conteudo_status');
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