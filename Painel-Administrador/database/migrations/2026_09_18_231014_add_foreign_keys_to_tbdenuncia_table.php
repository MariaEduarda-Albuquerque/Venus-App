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
        Schema::table('tbdenuncia', function (Blueprint $table) {
            $table->foreign(['codUsuarioDenunciante'], 'tbdenuncia_ibfk_1')->references(['codUsuario'])->on('tbusuario')->onUpdate('restrict')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tbdenuncia', function (Blueprint $table) {
            $table->dropForeign('tbdenuncia_ibfk_1');
        });
    }
};
