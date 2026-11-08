<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tbavaliacaounidade', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_unicode_ci';
            $table->integer('codAvaliacao')->unsigned()->autoIncrement();
            $table->integer('codUnidade')->unsigned();
            $table->integer('codUsuario')->unsigned();
            $table->tinyInteger('nota')->unsigned();
            $table->enum('lotacaoPercebida', ['livre', 'moderado', 'cheio']);
            $table->string('comentario', 255)->nullable()->default(null);
            $table->dateTime('dataAvaliacao')->useCurrent();

            $table->primary(['codAvaliacao']);

            $table->index(['codUnidade'], 'codunidade');

            $table->index(['codUsuario'], 'codusuario');

            $table->foreign(['codUnidade'], 'tbavaliacaounidade_ibfk_1')->references(['codUnidade'])->on('tbunidadesaude')->onDelete('cascade');

            $table->foreign(['codUsuario'], 'tbavaliacaounidade_ibfk_2')->references(['codUsuario'])->on('tbusuario')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tbavaliacaounidade');
    }
};
