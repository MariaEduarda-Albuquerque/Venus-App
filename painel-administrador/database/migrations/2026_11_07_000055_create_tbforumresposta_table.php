<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tbforumresposta', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_unicode_ci';
            $table->integer('codForumResposta')->unsigned()->autoIncrement();
            $table->integer('codForumPublicacao')->unsigned();
            $table->enum('autorTipo', ['usuaria', 'profissional']);
            $table->integer('codUsuario')->unsigned()->nullable()->default(null);
            $table->integer('codProfissionalSaude')->unsigned()->nullable()->default(null);
            $table->text('textoResposta');
            $table->dateTime('dataResposta')->useCurrent();

            $table->primary(['codForumResposta']);

            $table->index(['codForumPublicacao'], 'codforumpublicacao');

            $table->index(['codUsuario'], 'codusuario');

            $table->index(['codProfissionalSaude'], 'codprofissionalsaude');

            $table->foreign(['codForumPublicacao'], 'tbforumresposta_ibfk_1')->references(['codForumPublicacao'])->on('tbforumpublicacao')->onDelete('cascade');

            $table->foreign(['codUsuario'], 'tbforumresposta_ibfk_2')->references(['codUsuario'])->on('tbusuario')->onDelete('cascade');

            $table->foreign(['codProfissionalSaude'], 'tbforumresposta_ibfk_3')->references(['codProfissionalSaude'])->on('tbprofissionalsaude')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tbforumresposta');
    }
};
