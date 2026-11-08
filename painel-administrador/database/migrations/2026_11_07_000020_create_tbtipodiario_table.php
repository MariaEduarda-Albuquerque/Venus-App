<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tbtipodiario', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_unicode_ci';
            $table->integer('codTipoDiario')->unsigned()->autoIncrement();
            $table->string('descricaoTipoDiario', 60);

            $table->primary(['codTipoDiario']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tbtipodiario');
    }
};
