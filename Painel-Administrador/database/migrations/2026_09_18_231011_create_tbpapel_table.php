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
        Schema::create('tbpapel', function (Blueprint $table) {
            $table->tinyIncrements('codPapel');
            $table->string('nomePapel', 30)->unique('uq_papel_nome');
            $table->string('descricaoPapel', 200)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbpapel');
    }
};
