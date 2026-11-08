<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tbdatasaude', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_unicode_ci';
            $table->bigInteger('codDataSaude')->unsigned()->autoIncrement();
            $table->string('nomeDataSaude', 120);
            $table->tinyInteger('mesDataSaude')->unsigned();
            $table->tinyInteger('diaDataSaude')->unsigned()->nullable()->default(null);
            $table->string('corDataSaude', 7)->default('#9E182B');
            $table->text('pautaDataSaude');
            $table->bigInteger('codTipoCategoria')->unsigned();

            $table->primary(['codDataSaude']);

            $table->index(['mesDataSaude'], 'tbdatasaude_mesdatasaude_index');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tbdatasaude');
    }
};
