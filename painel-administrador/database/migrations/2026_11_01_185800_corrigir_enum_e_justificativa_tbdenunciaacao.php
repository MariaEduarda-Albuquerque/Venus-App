
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::statement("
            ALTER TABLE tbdenunciaacao
            MODIFY COLUMN acaoTomada ENUM(
                'remover_conteudo',
                'advertir',
                'suspender_conta',
                'arquivar_sem_acao',
                'resolvida',
                'reaberta'
            ) NOT NULL
        ");

        DB::statement("
            ALTER TABLE tbdenunciaacao
            MODIFY COLUMN justificativa VARCHAR(1000) NOT NULL
        ");
    }

    public function down(): void
    {

        DB::table('tbdenunciaacao')
            ->whereIn('acaoTomada', ['resolvida', 'reaberta'])
            ->update(['acaoTomada' => 'arquivar_sem_acao']);

        DB::statement("
            ALTER TABLE tbdenunciaacao
            MODIFY COLUMN acaoTomada ENUM(
                'remover_conteudo',
                'advertir',
                'suspender_conta',
                'arquivar_sem_acao'
            ) NOT NULL
        ");

        DB::statement("
            ALTER TABLE tbdenunciaacao
            MODIFY COLUMN justificativa VARCHAR(255) NOT NULL
        ");
    }
};
