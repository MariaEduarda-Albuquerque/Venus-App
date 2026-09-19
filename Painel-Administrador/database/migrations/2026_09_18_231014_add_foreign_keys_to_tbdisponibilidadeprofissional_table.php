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
        Schema::table('tbdisponibilidadeprofissional', function (Blueprint $table) {
            $table->foreign(['codProfissionalSaude'], 'tbdisponibilidadeprofissional_ibfk_1')->references(['codProfissionalSaude'])->on('tbprofissionalsaude')->onUpdate('restrict')->onDelete('cascade');
            $table->foreign(['idTipoAtendimento'], 'tbdisponibilidadeprofissional_ibfk_2')->references(['idTipoAtendimento'])->on('tbtipoatendimento')->onUpdate('cascade')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tbdisponibilidadeprofissional', function (Blueprint $table) {
            $table->dropForeign('tbdisponibilidadeprofissional_ibfk_1');
            $table->dropForeign('tbdisponibilidadeprofissional_ibfk_2');
        });
    }
};
