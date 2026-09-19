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
        Schema::table('tbunidadeservico', function (Blueprint $table) {
            $table->foreign(['codUnidade'], 'tbunidadeservico_ibfk_1')->references(['codUnidade'])->on('tbunidadesaude')->onUpdate('restrict')->onDelete('cascade');
            $table->foreign(['codServico'], 'tbunidadeservico_ibfk_2')->references(['codServico'])->on('tbservicounidade')->onUpdate('restrict')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tbunidadeservico', function (Blueprint $table) {
            $table->dropForeign('tbunidadeservico_ibfk_1');
            $table->dropForeign('tbunidadeservico_ibfk_2');
        });
    }
};
