<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tbunidadeservico', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_unicode_ci';
            $table->integer('codUnidade')->unsigned();
            $table->integer('codServico')->unsigned();

            $table->primary(['codUnidade', 'codServico']);

            $table->index(['codServico'], 'codservico');

            $table->foreign(['codUnidade'], 'tbunidadeservico_ibfk_1')->references(['codUnidade'])->on('tbunidadesaude')->onDelete('cascade');

            $table->foreign(['codServico'], 'tbunidadeservico_ibfk_2')->references(['codServico'])->on('tbservicounidade')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tbunidadeservico');
    }
};
