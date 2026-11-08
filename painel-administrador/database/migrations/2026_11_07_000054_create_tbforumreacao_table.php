<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tbforumreacao', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_unicode_ci';
            $table->integer('codForumPublicacao')->unsigned();
            $table->integer('codUsuario')->unsigned();
            $table->enum('tipoReacao', ['apoio'])->default('apoio');

            $table->primary(['codForumPublicacao', 'codUsuario']);

            $table->index(['codUsuario'], 'codusuario');

            $table->foreign(['codForumPublicacao'], 'tbforumreacao_ibfk_1')->references(['codForumPublicacao'])->on('tbforumpublicacao')->onDelete('cascade');

            $table->foreign(['codUsuario'], 'tbforumreacao_ibfk_2')->references(['codUsuario'])->on('tbusuario')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tbforumreacao');
    }
};
