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
        Schema::table('tblembreteremedio', function (Blueprint $table) {
            $table->foreign(['codUsuario'], 'tblembreteremedio_ibfk_1')->references(['codUsuario'])->on('tbusuario')->onUpdate('restrict')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tblembreteremedio', function (Blueprint $table) {
            $table->dropForeign('tblembreteremedio_ibfk_1');
        });
    }
};
