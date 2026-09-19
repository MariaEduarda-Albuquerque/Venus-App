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
        Schema::create('tbconselho', function (Blueprint $table) {
            $table->integer('codConselho', true);
            $table->unsignedInteger('codProfissionalSaude')->unique('uq_conselho_profissional');
            $table->char('ufConselho', 2)->nullable();
            $table->char('numConselho', 6)->nullable();
            $table->binary('registroConselho')->nullable();
            $table->string('documentoComplementarConselho')->nullable();

            $table->unique(['ufConselho', 'numConselho'], 'uq_conselho_uf_numero');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbconselho');
    }
};
