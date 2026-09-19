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
        Schema::table('tbdenunciaacao', function (Blueprint $table) {
            $table->foreign(['codDenuncia'], 'tbdenunciaacao_ibfk_1')->references(['codDenuncia'])->on('tbdenuncia')->onUpdate('restrict')->onDelete('cascade');
            $table->foreign(['codAdmin'], 'tbdenunciaacao_ibfk_2')->references(['codAdmin'])->on('tbadmin')->onUpdate('restrict')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tbdenunciaacao', function (Blueprint $table) {
            $table->dropForeign('tbdenunciaacao_ibfk_1');
            $table->dropForeign('tbdenunciaacao_ibfk_2');
        });
    }
};
