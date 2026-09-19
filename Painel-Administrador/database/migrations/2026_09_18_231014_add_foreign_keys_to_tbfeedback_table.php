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
        Schema::table('tbfeedback', function (Blueprint $table) {
            $table->foreign(['codUsuario'], 'tbfeedback_ibfk_1')->references(['codUsuario'])->on('tbusuario')->onUpdate('restrict')->onDelete('cascade');
            $table->foreign(['codProfissionalSaude'], 'tbfeedback_ibfk_2')->references(['codProfissionalSaude'])->on('tbprofissionalsaude')->onUpdate('restrict')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tbfeedback', function (Blueprint $table) {
            $table->dropForeign('tbfeedback_ibfk_1');
            $table->dropForeign('tbfeedback_ibfk_2');
        });
    }
};
