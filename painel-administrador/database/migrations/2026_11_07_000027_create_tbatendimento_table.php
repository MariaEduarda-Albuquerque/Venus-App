<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tbatendimento', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_unicode_ci';
            $table->integer('codAtendimento')->unsigned()->autoIncrement();
            $table->integer('codProfissionalSaude')->unsigned();
            $table->integer('codUsuaria')->unsigned();
            $table->enum('tipoAtendimento', ['agendada', 'duvida_rapida']);
            $table->integer('tempoRespostaMinutos')->unsigned()->nullable()->default(null);
            $table->tinyInteger('avaliacao')->unsigned()->nullable()->default(null);
            $table->dateTime('dataCadastro')->useCurrent();
            $table->dateTime('dataAtualizacao')->useCurrent()->useCurrentOnUpdate();

            $table->primary(['codAtendimento']);

            $table->index(['codProfissionalSaude'], 'tbatendimento_codprofissionalsaude_foreign');

            $table->foreign(['codProfissionalSaude'], 'tbatendimento_codprofissionalsaude_foreign')->references(['codProfissionalSaude'])->on('tbprofissionalsaude');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tbatendimento');
    }
};
