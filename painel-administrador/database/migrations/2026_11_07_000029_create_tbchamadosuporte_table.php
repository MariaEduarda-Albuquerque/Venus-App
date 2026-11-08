<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tbchamadosuporte', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_unicode_ci';
            $table->integer('codChamado')->unsigned()->autoIncrement();
            $table->integer('codProfissionalSaude')->unsigned();
            $table->string('assuntoChamado', 150);
            $table->text('descricaoChamado');
            $table->string('anexoChamado', 255)->nullable()->default(null);
            $table->enum('statusChamado', ['aberto', 'em_atendimento', 'resolvido'])->default('aberto');
            $table->dateTime('dataAbertura')->useCurrent();
            $table->enum('canalChamado', ['chat', 'email', 'formulario', 'telefone'])->default('chat');
            $table->enum('motivoChamado', ['duvida', 'acesso_a_senha', 'erro_tecnico', 'conta_e_dados', 'sugestoes'])->default('duvida');
            $table->integer('avaliacaoChamado');

            $table->primary(['codChamado']);

            $table->index(['codProfissionalSaude'], 'codprofissionalsaude');

            $table->foreign(['codProfissionalSaude'], 'tbchamadosuporte_ibfk_1')->references(['codProfissionalSaude'])->on('tbprofissionalsaude')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tbchamadosuporte');
    }
};
