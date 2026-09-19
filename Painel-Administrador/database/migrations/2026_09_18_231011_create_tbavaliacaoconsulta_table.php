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
        Schema::create('tbavaliacaoconsulta', function (Blueprint $table) {
            $table->unsignedInteger('codConsulta')->primary();
            $table->unsignedTinyInteger('nota');
            $table->string('comentario')->nullable();
            $table->dateTime('dataAvaliacao')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbavaliacaoconsulta');
    }
};
