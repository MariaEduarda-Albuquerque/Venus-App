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
        Schema::table('tbinscricaoevento', function (Blueprint $table) {
            $table->foreign(['codEvento'], 'tbinscricaoevento_ibfk_1')->references(['codEvento'])->on('tbevento')->onUpdate('restrict')->onDelete('cascade');
            $table->foreign(['codUsuario'], 'tbinscricaoevento_ibfk_2')->references(['codUsuario'])->on('tbusuario')->onUpdate('restrict')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tbinscricaoevento', function (Blueprint $table) {
            $table->dropForeign('tbinscricaoevento_ibfk_1');
            $table->dropForeign('tbinscricaoevento_ibfk_2');
        });
    }
};
