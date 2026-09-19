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
        Schema::table('tbavaliacaoconsulta', function (Blueprint $table) {
            $table->foreign(['codConsulta'], 'tbavaliacaoconsulta_ibfk_1')->references(['codConsulta'])->on('tbconsulta')->onUpdate('restrict')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tbavaliacaoconsulta', function (Blueprint $table) {
            $table->dropForeign('tbavaliacaoconsulta_ibfk_1');
        });
    }
};
