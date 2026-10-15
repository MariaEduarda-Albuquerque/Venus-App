<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('tbprofissionalsaude', function (Blueprint $table) {
            $table->string('comprovanteConselhoClasseProfissional')->nullable()->after('fotoPerfilProfissional');
            $table->string('documentoComplementarProfissional')->nullable()->after('comprovanteConselhoClasseProfissional');
        });
    }

    public function down(): void
    {
        Schema::table('tbprofissionalsaude', function (Blueprint $table) {
            $table->dropColumn(['comprovanteConselhoClasseProfissional', 'documentoComplementarProfissional']);
        });
    }
};