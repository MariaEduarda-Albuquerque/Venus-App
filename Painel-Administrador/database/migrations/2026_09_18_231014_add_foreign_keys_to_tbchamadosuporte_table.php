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
        Schema::table('tbchamadosuporte', function (Blueprint $table) {
            $table->foreign(['codProfissionalSaude'], 'tbchamadosuporte_ibfk_1')->references(['codProfissionalSaude'])->on('tbprofissionalsaude')->onUpdate('restrict')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tbchamadosuporte', function (Blueprint $table) {
            $table->dropForeign('tbchamadosuporte_ibfk_1');
        });
    }
};
