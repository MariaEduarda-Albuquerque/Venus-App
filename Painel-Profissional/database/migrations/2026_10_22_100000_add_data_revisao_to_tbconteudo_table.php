<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

// Feedback da moderação: o Admin grava aqui o motivo da recusa e a data da revisão.
//  - motivoRecusaConteudo: justificativa digitada pelo Admin ao recusar
//  - dataRevisaoConteudo:  quando o Admin aprovou ou recusou
return new class extends Migration
{
    public function up(): void
    {
        Schema::table('tbconteudo', function (Blueprint $table) {
            if (!Schema::hasColumn('tbconteudo', 'motivoRecusaConteudo')) {
                $table->text('motivoRecusaConteudo')->nullable();
            }
            if (!Schema::hasColumn('tbconteudo', 'dataRevisaoConteudo')) {
                $table->timestamp('dataRevisaoConteudo')->nullable();
            }
        });
    }

    public function down(): void
    {
        Schema::table('tbconteudo', function (Blueprint $table) {
            if (Schema::hasColumn('tbconteudo', 'dataRevisaoConteudo')) {
                $table->dropColumn('dataRevisaoConteudo');
            }
        });
    }
};
