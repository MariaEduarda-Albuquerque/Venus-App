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
        Schema::table('tbhumordiario', function (Blueprint $table) {
            $table->foreign(['codUsuario'], 'tbhumordiario_ibfk_1')->references(['codUsuario'])->on('tbusuario')->onUpdate('restrict')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tbhumordiario', function (Blueprint $table) {
            $table->dropForeign('tbhumordiario_ibfk_1');
        });
    }
};
