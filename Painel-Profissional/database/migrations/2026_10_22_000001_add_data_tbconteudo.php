<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    // ATENÇÃO: confira se o nome da tabela de conteúdos é mesmo "tbconteudo".
    public function up(): void
    {
        Schema::table('tbconteudo', function (Blueprint $table) {
            $table->date('dataPlanejadaConteudo')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('tbconteudo', function (Blueprint $table) {
            $table->dropColumn('dataPlanejadaConteudo');
        });
    }
};
