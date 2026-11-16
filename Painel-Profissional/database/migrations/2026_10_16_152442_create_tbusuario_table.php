<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tbusuario', function (Blueprint $table) {
            $table->id('codUsuario');
            $table->string('nomeUsuario', 120);
            $table->string('apelidoUsuario', 60)->nullable();
            $table->string('emailUsuario', 150)->nullable()->unique();
            $table->string('senhaUsuario', 255);
            $table->date('dataNascimentoUsuario');
            $table->string('cidadeUsuario', 100)->nullable();
            $table->char('ufUsuario', 2)->nullable();
            $table->string('fotoPerfilUsuario', 255)->nullable();
            $table->enum('temaUsuario', ['claro', 'escuro'])->default('claro');
            $table->string('idiomaUsuario', 10)->default('pt-BR');
            $table->boolean('anonimaPadraoUsuario')->default(false);
            $table->enum('statusUsuario', ['ativa', 'suspensa', 'excluida'])->default('ativa');
            $table->timestamp('dataCadastro')->useCurrent();
            $table->timestamp('dataAtualizacao')->useCurrent()->useCurrentOnUpdate();

            $table->index(['cidadeUsuario', 'ufUsuario'], 'idx_usuario_cidade_uf');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tbusuario');
    }
};
