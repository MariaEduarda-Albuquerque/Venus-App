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
        Schema::table('tbpublicacao', function (Blueprint $table) {
            $table->foreign(['codConteudo'], 'tbpublicacao_ibfk_1')->references(['codConteudo'])->on('tbconteudo')->onUpdate('restrict')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tbpublicacao', function (Blueprint $table) {
            $table->dropForeign('tbpublicacao_ibfk_1');
        });
    }
};
