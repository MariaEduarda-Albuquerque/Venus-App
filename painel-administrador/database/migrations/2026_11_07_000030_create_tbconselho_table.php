<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tbconselho', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_unicode_ci';
            $table->integer('codConselho')->autoIncrement();
            $table->integer('codProfissionalSaude')->unsigned();
            $table->char('ufConselho', 2)->nullable()->default(null);
            $table->char('numConselho', 6)->nullable()->default(null);
            $table->binary('registroConselho')->nullable()->default(null);
            $table->string('documentoComplementarConselho', 255)->nullable()->default(null);

            $table->primary(['codConselho']);

            $table->unique(['codProfissionalSaude'], 'uq_conselho_profissional');

            $table->unique(['ufConselho', 'numConselho'], 'uq_conselho_uf_numero');

            $table->foreign(['codProfissionalSaude'], 'tbconselho_ibfk_1')->references(['codProfissionalSaude'])->on('tbprofissionalsaude')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tbconselho');
    }
};
