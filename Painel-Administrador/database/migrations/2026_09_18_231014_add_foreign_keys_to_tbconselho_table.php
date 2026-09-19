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
        Schema::table('tbconselho', function (Blueprint $table) {
            $table->foreign(['codProfissionalSaude'], 'tbconselho_ibfk_1')->references(['codProfissionalSaude'])->on('tbprofissionalsaude')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tbconselho', function (Blueprint $table) {
            $table->dropForeign('tbconselho_ibfk_1');
        });
    }
};
