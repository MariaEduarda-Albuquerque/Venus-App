<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tbdatasaude', function (Blueprint $table) {
            $table->id('codDataSaude');
            $table->string('nomeDataSaude', 120);
            $table->unsignedTinyInteger('mesDataSaude');             // 1 a 12
            $table->unsignedTinyInteger('diaDataSaude')->nullable(); // vazio = campanha do mês inteiro
            $table->string('corDataSaude', 7)->default('#9E182B');
            $table->text('pautaDataSaude');
            $table->unsignedBigInteger('codTipoCategoria');

            $table->index('mesDataSaude');
            $table->foreign('codTipoCategoria')->references('codTipoCategoria')->on('tbtipocategoria');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tbdatasaude');
    }
};
