<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tbavaliacaoconsulta', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_unicode_ci';
            $table->integer('codConsulta')->unsigned();
            $table->tinyInteger('nota')->unsigned();
            $table->string('comentario', 255)->nullable()->default(null);
            $table->dateTime('dataAvaliacao')->useCurrent();

            $table->primary(['codConsulta']);

            $table->foreign(['codConsulta'], 'tbavaliacaoconsulta_ibfk_1')->references(['codConsulta'])->on('tbconsulta')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tbavaliacaoconsulta');
    }
};
