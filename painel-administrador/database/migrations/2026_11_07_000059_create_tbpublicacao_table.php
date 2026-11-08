<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tbpublicacao', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_unicode_ci';
            $table->integer('codPublicacao')->unsigned()->autoIncrement();
            $table->string('tituloPublicacao', 150);
            $table->string('descricaoPublicacao', 255)->nullable()->default(null);
            $table->integer('codConteudo')->unsigned();
            $table->dateTime('dataPublicacao')->useCurrent();
            $table->integer('visualizacoes')->unsigned()->default(0);
            $table->integer('tempoMedioLeituraSeg')->unsigned()->default(0);

            $table->primary(['codPublicacao']);

            $table->unique(['codConteudo'], 'uq_publicacao_conteudo');

            $table->foreign(['codConteudo'], 'tbpublicacao_ibfk_1')->references(['codConteudo'])->on('tbconteudo')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tbpublicacao');
    }
};
