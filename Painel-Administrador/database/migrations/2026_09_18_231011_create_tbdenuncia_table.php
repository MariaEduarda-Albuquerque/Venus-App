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
        Schema::create('tbdenuncia', function (Blueprint $table) {
            $table->increments('codDenuncia');
            $table->enum('tipoAlvo', ['forum_publicacao', 'forum_resposta', 'mensagem_chat', 'perfil_profissional']);
            $table->unsignedInteger('codAlvo');
            $table->unsignedInteger('codUsuarioDenunciante')->nullable()->index('codusuariodenunciante');
            $table->string('motivoDenuncia');
            $table->string('comentarioDenuncia')->nullable();
            $table->enum('gravidade', ['baixa', 'media', 'alta'])->default('media');
            $table->enum('statusDenuncia', ['pendente', 'em_analise', 'resolvida', 'arquivada'])->default('pendente');
            $table->dateTime('dataDenuncia')->useCurrent();

            $table->index(['statusDenuncia', 'gravidade'], 'idx_denuncia_status_gravidade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbdenuncia');
    }
};
