<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

// Colunas usadas pelo histórico de publicações (motivo da recusa, data de publicação,
// desempenho e arquivamento). Quem muda status/motivo/data é a moderação (Admin).
return new class extends Migration
{
    public function up(): void
    {
        Schema::table('tbconteudo', function (Blueprint $table) {
            $table->text('motivoRecusaConteudo')->nullable();
            $table->timestamp('dataPublicacao')->nullable();
            $table->unsignedInteger('visualizacoesConteudo')->default(0);
            $table->unsignedInteger('curtidasConteudo')->default(0);
            $table->unsignedInteger('inscritasConteudo')->default(0); // só para campanhas
            $table->timestamp('arquivadoEm')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('tbconteudo', function (Blueprint $table) {
            $table->dropColumn(['motivoRecusaConteudo', 'dataPublicacao', 'visualizacoesConteudo', 'curtidasConteudo', 'inscritasConteudo', 'arquivadoEm']);
        });
    }
};
