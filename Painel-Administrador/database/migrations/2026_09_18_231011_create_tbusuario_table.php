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
        Schema::create('tbusuario', function (Blueprint $table) {
            $table->increments('codUsuario');
            $table->string('nomeUsuario', 120);
            $table->string('apelidoUsuario', 60)->nullable();
            $table->string('biografiaUsuario')->nullable();
            $table->string('pronomesUsuario', 30)->nullable();
            $table->string('linkUsuario')->nullable();
            $table->string('emailUsuario', 150)->nullable()->unique('uq_usuario_email');
            $table->string('telUsuario', 14)->nullable();
            $table->string('senhaUsuario');
            $table->enum('provedorLoginUsuario', ['local', 'google'])->default('local');
            $table->string('googleIdUsuario')->nullable();
            $table->date('dataNascimentoUsuario');
            $table->string('cidadeUsuario', 100)->nullable();
            $table->string('bairroUsuario', 100)->nullable()->index('idx_usuario_bairro');
            $table->char('ufUsuario', 2)->nullable();
            $table->string('fotoPerfilUsuario')->nullable();
            $table->enum('temaUsuario', ['claro', 'escuro'])->default('claro');
            $table->string('idiomaUsuario', 10)->default('pt-BR');
            $table->boolean('anonimaPadraoUsuario')->default(false);
            $table->enum('statusUsuario', ['ativa', 'suspensa', 'excluida'])->default('ativa');
            $table->dateTime('dataCadastro')->useCurrent();
            $table->dateTime('dataAtualizacao')->useCurrentOnUpdate()->useCurrent();

            $table->index(['cidadeUsuario', 'ufUsuario'], 'idx_usuario_cidade_uf');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbusuario');
    }
};
