<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tbforumpublicacao', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_unicode_ci';
            $table->integer('codForumPublicacao')->unsigned()->autoIncrement();
            $table->integer('codUsuario')->unsigned();
            $table->integer('codTipoCategoria')->unsigned()->nullable()->default(null);
            $table->string('tituloPublicacao', 150);
            $table->text('textoPublicacao');
            $table->string('anexoPublicacao', 255)->nullable()->default(null);
            $table->tinyInteger('publicadoAnonimo')->default(0);
            $table->dateTime('dataPublicacao')->useCurrent();

            $table->primary(['codForumPublicacao']);

            $table->index(['codUsuario'], 'codusuario');

            $table->index(['codTipoCategoria'], 'codtipocategoria');

            $table->foreign(['codUsuario'], 'tbforumpublicacao_ibfk_1')->references(['codUsuario'])->on('tbusuario')->onDelete('cascade');

            $table->foreign(['codTipoCategoria'], 'tbforumpublicacao_ibfk_2')->references(['codTipoCategoria'])->on('codtipocategoria')->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tbforumpublicacao');
    }
};
