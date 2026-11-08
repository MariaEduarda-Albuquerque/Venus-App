<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tbprogressotrilha', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_unicode_ci';
            $table->integer('codUsuario')->unsigned();
            $table->integer('codTrilha')->unsigned();
            $table->integer('codConteudo')->unsigned();
            $table->dateTime('concluidoEm')->useCurrent();

            $table->primary(['codUsuario', 'codTrilha', 'codConteudo']);

            $table->index(['codTrilha'], 'codtrilha');

            $table->index(['codConteudo'], 'codconteudo');

            $table->foreign(['codUsuario'], 'tbprogressotrilha_ibfk_1')->references(['codUsuario'])->on('tbusuario')->onDelete('cascade');

            $table->foreign(['codTrilha'], 'tbprogressotrilha_ibfk_2')->references(['codTrilha'])->on('tbtrilhaaprendizado')->onDelete('cascade');

            $table->foreign(['codConteudo'], 'tbprogressotrilha_ibfk_3')->references(['codConteudo'])->on('tbconteudo')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tbprogressotrilha');
    }
};
