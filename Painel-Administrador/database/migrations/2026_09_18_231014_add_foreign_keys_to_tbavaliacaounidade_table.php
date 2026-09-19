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
        Schema::table('tbavaliacaounidade', function (Blueprint $table) {
            $table->foreign(['codUnidade'], 'tbavaliacaounidade_ibfk_1')->references(['codUnidade'])->on('tbunidadesaude')->onUpdate('restrict')->onDelete('cascade');
            $table->foreign(['codUsuario'], 'tbavaliacaounidade_ibfk_2')->references(['codUsuario'])->on('tbusuario')->onUpdate('restrict')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tbavaliacaounidade', function (Blueprint $table) {
            $table->dropForeign('tbavaliacaounidade_ibfk_1');
            $table->dropForeign('tbavaliacaounidade_ibfk_2');
        });
    }
};
