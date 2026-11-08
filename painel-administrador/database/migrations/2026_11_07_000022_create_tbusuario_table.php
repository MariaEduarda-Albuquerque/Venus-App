<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tbusuario', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_unicode_ci';
            $table->integer('codUsuario')->unsigned()->autoIncrement();
            $table->string('nomeUsuario', 120);
            $table->string('apelidoUsuario', 60)->nullable()->default(null);
            $table->string('biografiaUsuario', 255)->nullable()->default(null);
            $table->string('pronomesUsuario', 30)->nullable()->default(null);
            $table->string('linkUsuario', 255)->nullable()->default(null);
            $table->string('emailUsuario', 150)->nullable()->default(null);
            $table->string('telUsuario', 14)->nullable()->default(null);
            $table->string('senhaUsuario', 255);
            $table->enum('provedorLoginUsuario', ['local', 'google'])->default('local');
            $table->string('googleIdUsuario', 255)->nullable()->default(null);
            $table->date('dataNascimentoUsuario');
            $table->string('cidadeUsuario', 100)->nullable()->default(null);
            $table->string('bairroUsuario', 100)->nullable()->default(null);
            $table->char('ufUsuario', 2)->nullable()->default(null);
            $table->string('fotoPerfilUsuario', 255)->nullable()->default(null);
            $table->enum('temaUsuario', ['claro', 'escuro'])->default('claro');
            $table->string('idiomaUsuario', 10)->default('pt-BR');
            $table->tinyInteger('anonimaPadraoUsuario')->default(0);
            $table->enum('statusUsuario', ['ativa', 'suspensa', 'excluida'])->default('ativa');
            $table->dateTime('dataCadastro')->useCurrent();
            $table->dateTime('dataAtualizacao')->useCurrent()->useCurrentOnUpdate();

            $table->primary(['codUsuario']);

            $table->unique(['emailUsuario'], 'uq_usuario_email');

            $table->index(['cidadeUsuario', 'ufUsuario'], 'idx_usuario_cidade_uf');

            $table->index(['bairroUsuario'], 'idx_usuario_bairro');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tbusuario');
    }
};
