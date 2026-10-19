<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('tbchamadosuporte', function (Blueprint $table) {
            $table->enum('canalChamado', [
                'chat',
                'email',
                'formulario',
                'telefone'
            ])->default('chat');

            $table->enum('motivoChamado', [
                'duvida',
                'acesso_a_senha',
                'erro_tecnico',
                'conta_e_dados',
                'sugestoes'
            ])->default('duvida');

            $table->integer('avaliacaoChamado');
        });
    }

    public function down(): void
    {
        Schema::table('tbchamadosuporte', function (Blueprint $table) {
            $table->dropColumn([
                'canalChamado',
                'motivoChamado',
                'avaliacaoChamado'
            ]);
        });
    }
};
