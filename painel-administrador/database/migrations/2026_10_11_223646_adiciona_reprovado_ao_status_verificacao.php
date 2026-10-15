<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::statement("ALTER TABLE tbprofissionalsaude
            MODIFY statusVerificacao ENUM('em_analise','aprovado','pendencia','reprovado')
            NOT NULL DEFAULT 'em_analise'");
    }

    public function down(): void
    {
        DB::table('tbprofissionalsaude')
            ->where('statusVerificacao', 'reprovado')
            ->update(['statusVerificacao' => 'pendencia']);

        DB::statement("ALTER TABLE tbprofissionalsaude
            MODIFY statusVerificacao ENUM('em_analise','aprovado','pendencia')
            NOT NULL DEFAULT 'em_analise'");
    }
};
