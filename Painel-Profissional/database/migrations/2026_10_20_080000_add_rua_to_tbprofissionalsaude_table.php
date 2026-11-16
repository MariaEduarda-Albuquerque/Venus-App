<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('tbprofissionalsaude', function (Blueprint $table) {
            $table->string('ruaProfissional', 150)->nullable()->after('cepProfissional');
        });
    }

    public function down(): void
    {
        Schema::table('tbprofissionalsaude', function (Blueprint $table) {
            $table->dropColumn('ruaProfissional');
        });
    }
};
