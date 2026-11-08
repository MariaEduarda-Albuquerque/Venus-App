<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tbconteudo', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_unicode_ci';
            $table->integer('codConteudo')->unsigned()->autoIncrement();
            $table->string('tituloConteudo', 150);
            $table->string('objetivoConteudo', 250)->nullable()->default(null);
            $table->mediumText('corpoConteudo')->nullable()->default(null);
            $table->text('fontesConteudo')->nullable()->default(null);
            $table->string('capaConteudo', 255)->nullable()->default(null);
            $table->smallInteger('tempoLeituraMinutos')->unsigned()->nullable()->default(null);
            $table->integer('codTipoCategoria')->unsigned()->nullable()->default(null);
            $table->integer('codTipoConteudo')->unsigned();
            $table->integer('codProfissionalSaude')->unsigned()->nullable()->default(null);
            $table->integer('codAdminCriador')->unsigned()->nullable()->default(null);
            $table->enum('statusConteudo', ['rascunho', 'em_revisao', 'publicado', 'recusado'])->default('rascunho');
            $table->dateTime('dataEnvio')->nullable()->default(null);
            $table->dateTime('dataCriacao')->useCurrent();
            $table->dateTime('dataAtualizacao')->useCurrent()->useCurrentOnUpdate();
            $table->text('motivoRecusaConteudo')->nullable()->default(null);
            $table->timestamp('dataPublicacao')->nullable()->default(null);
            $table->integer('visualizacoesConteudo')->unsigned()->default(0);
            $table->integer('curtidasConteudo')->unsigned()->default(0);
            $table->integer('inscritasConteudo')->unsigned()->default(0);
            $table->timestamp('arquivadoEm')->nullable()->default(null);
            $table->date('dataPlanejadaConteudo')->nullable()->default(null);
            $table->timestamp('dataRevisaoConteudo')->nullable()->default(null);
            $table->string('publicoAlvoConteudo', 255)->nullable()->default(null);
            $table->date('periodoInicioConteudo')->nullable()->default(null);
            $table->date('periodoFimConteudo')->nullable()->default(null);
            $table->string('tagsConteudo', 255)->nullable()->default(null);
            $table->string('mensagemPrincipalConteudo', 80)->nullable()->default(null);
            $table->string('chamadaAcaoConteudo', 60)->nullable()->default(null);
            $table->enum('fundoConteudo', ['vinho', 'rosa', 'lilas', 'pessego', 'azul', 'grafite'])->default('vinho');

            $table->primary(['codConteudo']);

            $table->index(['codTipoCategoria'], 'codtipocategoria');

            $table->index(['codTipoConteudo'], 'codtipoconteudo');

            $table->index(['codProfissionalSaude'], 'codprofissionalsaude');

            $table->index(['statusConteudo'], 'idx_conteudo_status');

            $table->index(['codAdminCriador'], 'tbconteudo_codadmincriador_foreign');

            $table->index(['statusConteudo'], 'tbconteudo_statusconteudo_index');

            $table->index(['dataEnvio'], 'tbconteudo_dataenvio_index');

            $table->foreign(['codAdminCriador'], 'tbconteudo_codadmincriador_foreign')->references(['codAdmin'])->on('tbadmin')->onDelete('set null');

            $table->foreign(['codTipoCategoria'], 'tbconteudo_ibfk_1')->references(['codTipoCategoria'])->on('codtipocategoria');

            $table->foreign(['codTipoConteudo'], 'tbconteudo_ibfk_2')->references(['codTipoConteudo'])->on('tbtipoconteudo');

            $table->foreign(['codProfissionalSaude'], 'tbconteudo_ibfk_3')->references(['codProfissionalSaude'])->on('tbprofissionalsaude')->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tbconteudo');
    }
};
