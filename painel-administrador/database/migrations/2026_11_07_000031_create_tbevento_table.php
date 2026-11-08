<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tbevento', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_unicode_ci';
            $table->integer('codEvento')->unsigned()->autoIncrement();
            $table->string('tituloEvento', 150);
            $table->text('descricaoEvento')->nullable()->default(null);
            $table->string('bannerEvento', 255)->nullable()->default(null);
            $table->enum('formatoEvento', ['online', 'presencial']);
            $table->string('linkOuEndereco', 255)->nullable()->default(null);
            $table->dateTime('dataHoraEvento');
            $table->smallInteger('duracaoMinutos')->unsigned()->nullable()->default(null);
            $table->integer('vagasTotais')->unsigned()->nullable()->default(null);
            $table->integer('codProfissionalSaude')->unsigned()->nullable()->default(null);

            $table->primary(['codEvento']);

            $table->index(['codProfissionalSaude'], 'codprofissionalsaude');

            $table->foreign(['codProfissionalSaude'], 'tbevento_ibfk_1')->references(['codProfissionalSaude'])->on('tbprofissionalsaude')->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tbevento');
    }
};
