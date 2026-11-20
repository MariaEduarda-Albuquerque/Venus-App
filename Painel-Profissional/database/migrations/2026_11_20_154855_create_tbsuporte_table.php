<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tbsuporte', function (Blueprint $table) {
            $table->id('idSuporte');
            $table->unsignedBigInteger('codProfissionalSaude')->nullable();
            $table->text('descricaoSuporte');
            $table->string('statusSuporte', 20)->default('aberto'); // aberto | resolvido
            $table->timestamps();

            $table->foreign('codProfissionalSaude')
                ->references('codProfissionalSaude')
                ->on('tbprofissionalsaude')
                ->nullOnDelete(); // se o profissional excluir a conta, o chamado fica
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tbsuporte');
    }
};