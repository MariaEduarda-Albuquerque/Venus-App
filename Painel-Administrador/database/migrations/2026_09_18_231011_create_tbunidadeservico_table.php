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
        Schema::create('tbunidadeservico', function (Blueprint $table) {
            $table->unsignedInteger('codUnidade');
            $table->unsignedInteger('codServico')->index('codservico');

            $table->primary(['codUnidade', 'codServico']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbunidadeservico');
    }
};
