<?php

// ONDE SALVAR: database/migrations/2026_09_13_000000_create_tb_redefinicao_senha_table.php
// (o nome do arquivo pode mudar a data pra hoje, o Laravel só usa isso pra
// ordenar as migrations — não precisa ser exatamente essa)
//
// COMO RODAR: depois de salvar, no terminal, dentro da pasta do projeto Laravel:
//   php artisan migrate

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Segue o mesmo padrão de nomenclatura do resto do banco (tbUsuario,
        // codUsuario, etc.): tabela "tbRedefinicaoSenha", chave primária
        // "codRedefinicaoSenha".
        Schema::create('tbRedefinicaoSenha', function (Blueprint $table) {
            $table->id('codRedefinicaoSenha');

            $table->string('emailUsuario', 150);
            $table->string('codigoRedefinicao', 255); // guarda o hash do código, não o código puro

            // até quando esse código vale (ex.: gerado + 15 minutos)
            $table->timestamp('expiraEmRedefinicao');

            // marca true quando o código já foi usado pra trocar a senha,
            // assim ele não pode ser reaproveitado
            $table->boolean('usadoRedefinicao')->default(false);

            $table->timestamps();

            // acelera a busca "me dá o código válido mais recente desse e-mail"
            $table->index('emailUsuario');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tbRedefinicaoSenha');
    }
};
