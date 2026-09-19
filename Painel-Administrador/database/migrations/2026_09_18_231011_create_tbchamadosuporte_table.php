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
        Schema::create('tbchamadosuporte', function (Blueprint $table) {
            $table->increments('codChamado');
            $table->unsignedInteger('codProfissionalSaude')->index('codprofissionalsaude');
            $table->string('assuntoChamado', 150);
            $table->text('descricaoChamado');
            $table->string('anexoChamado')->nullable();
            $table->enum('statusChamado', ['aberto', 'em_atendimento', 'resolvido'])->default('aberto');
            $table->dateTime('dataAbertura')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbchamadosuporte');
    }
};
