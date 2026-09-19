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
        Schema::table('tbconteudoadmin', function (Blueprint $table) {
            $table->foreign(['codConteudo'], 'tbconteudoadmin_ibfk_1')->references(['codConteudo'])->on('tbconteudo')->onUpdate('restrict')->onDelete('cascade');
            $table->foreign(['codAdmin'], 'tbconteudoadmin_ibfk_2')->references(['codAdmin'])->on('tbadmin')->onUpdate('restrict')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tbconteudoadmin', function (Blueprint $table) {
            $table->dropForeign('tbconteudoadmin_ibfk_1');
            $table->dropForeign('tbconteudoadmin_ibfk_2');
        });
    }
};
