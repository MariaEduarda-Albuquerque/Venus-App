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
        Schema::table('tbforumresposta', function (Blueprint $table) {
            $table->foreign(['codForumPublicacao'], 'tbforumresposta_ibfk_1')->references(['codForumPublicacao'])->on('tbforumpublicacao')->onUpdate('restrict')->onDelete('cascade');
            $table->foreign(['codUsuario'], 'tbforumresposta_ibfk_2')->references(['codUsuario'])->on('tbusuario')->onUpdate('restrict')->onDelete('cascade');
            $table->foreign(['codProfissionalSaude'], 'tbforumresposta_ibfk_3')->references(['codProfissionalSaude'])->on('tbprofissionalsaude')->onUpdate('restrict')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tbforumresposta', function (Blueprint $table) {
            $table->dropForeign('tbforumresposta_ibfk_1');
            $table->dropForeign('tbforumresposta_ibfk_2');
            $table->dropForeign('tbforumresposta_ibfk_3');
        });
    }
};
