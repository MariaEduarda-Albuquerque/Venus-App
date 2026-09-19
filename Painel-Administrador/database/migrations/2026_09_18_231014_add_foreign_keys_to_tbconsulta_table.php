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
        Schema::table('tbconsulta', function (Blueprint $table) {
            $table->foreign(['codUsuario'], 'tbconsulta_ibfk_1')->references(['codUsuario'])->on('tbusuario')->onUpdate('restrict')->onDelete('cascade');
            $table->foreign(['codProfissionalSaude'], 'tbconsulta_ibfk_2')->references(['codProfissionalSaude'])->on('tbprofissionalsaude')->onUpdate('restrict')->onDelete('cascade');
            $table->foreign(['idTipoAtendimento'], 'tbconsulta_ibfk_3')->references(['idTipoAtendimento'])->on('tbtipoatendimento')->onUpdate('cascade')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tbconsulta', function (Blueprint $table) {
            $table->dropForeign('tbconsulta_ibfk_1');
            $table->dropForeign('tbconsulta_ibfk_2');
            $table->dropForeign('tbconsulta_ibfk_3');
        });
    }
};
