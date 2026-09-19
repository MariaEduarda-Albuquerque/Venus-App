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
        Schema::table('tbconteudosalvo', function (Blueprint $table) {
            $table->foreign(['codUsuario'], 'tbconteudosalvo_ibfk_1')->references(['codUsuario'])->on('tbusuario')->onUpdate('restrict')->onDelete('cascade');
            $table->foreign(['codConteudo'], 'tbconteudosalvo_ibfk_2')->references(['codConteudo'])->on('tbconteudo')->onUpdate('restrict')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tbconteudosalvo', function (Blueprint $table) {
            $table->dropForeign('tbconteudosalvo_ibfk_1');
            $table->dropForeign('tbconteudosalvo_ibfk_2');
        });
    }
};
