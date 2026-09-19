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
        Schema::table('tbforumreacao', function (Blueprint $table) {
            $table->foreign(['codForumPublicacao'], 'tbforumreacao_ibfk_1')->references(['codForumPublicacao'])->on('tbforumpublicacao')->onUpdate('restrict')->onDelete('cascade');
            $table->foreign(['codUsuario'], 'tbforumreacao_ibfk_2')->references(['codUsuario'])->on('tbusuario')->onUpdate('restrict')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tbforumreacao', function (Blueprint $table) {
            $table->dropForeign('tbforumreacao_ibfk_1');
            $table->dropForeign('tbforumreacao_ibfk_2');
        });
    }
};
