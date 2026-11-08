<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tbbloqueioagenda', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_unicode_ci';
            $table->integer('codBloqueio')->unsigned()->autoIncrement();
            $table->integer('codProfissionalSaude')->unsigned();
            $table->date('dataBloqueio');
            $table->time('horaInicio')->nullable()->default(null);
            $table->time('horaFim')->nullable()->default(null);
            $table->string('motivoBloqueio', 150)->nullable()->default(null);
            $table->dateTime('dataCriacao')->useCurrent();

            $table->primary(['codBloqueio']);

            $table->index(['codProfissionalSaude', 'dataBloqueio'], 'idx_bloqueio_profissional_data');

            $table->foreign(['codProfissionalSaude'], 'tbbloqueioagenda_ibfk_1')->references(['codProfissionalSaude'])->on('tbprofissionalsaude')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tbbloqueioagenda');
    }
};
