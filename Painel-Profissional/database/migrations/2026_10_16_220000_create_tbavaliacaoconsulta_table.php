<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tbavaliacaoconsulta', function (Blueprint $table) {
            $table->unsignedBigInteger('codConsulta')->primary();
            $table->unsignedTinyInteger('nota'); 
            $table->string('comentario', 255)->nullable();
            $table->timestamp('dataAvaliacao')->useCurrent();

            $table->foreign('codConsulta')->references('codConsulta')->on('tbconsulta')->cascadeOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tbavaliacaoconsulta');
    }
};
