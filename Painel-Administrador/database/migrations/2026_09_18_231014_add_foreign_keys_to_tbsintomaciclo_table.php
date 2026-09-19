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
        Schema::table('tbsintomaciclo', function (Blueprint $table) {
            $table->foreign(['codCiclo'], 'tbsintomaciclo_ibfk_1')->references(['codCiclo'])->on('tbciclomenstrual')->onUpdate('restrict')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tbsintomaciclo', function (Blueprint $table) {
            $table->dropForeign('tbsintomaciclo_ibfk_1');
        });
    }
};
