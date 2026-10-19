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
        Schema::create('tbatendimento', function (Blueprint $table) {
            $table->increments('codAtendimento');

            $table->unsignedInteger('codProfissionalSaude');
            $table->unsignedInteger('codUsuaria'); // AJUSTE: tipo real da PK de usuárias

            $table->enum('tipoAtendimento', ['agendada', 'duvida_rapida']);
            $table->unsignedInteger('tempoRespostaMinutos')->nullable();
            $table->unsignedTinyInteger('avaliacao')->nullable(); // 0 a 10

            $table->dateTime('dataCadastro')->useCurrent();
            $table->dateTime('dataAtualizacao')->useCurrent()->useCurrentOnUpdate();

            $table->foreign('codProfissionalSaude')
                ->references('codProfissionalSaude')
                ->on('tbprofissionalsaude');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
