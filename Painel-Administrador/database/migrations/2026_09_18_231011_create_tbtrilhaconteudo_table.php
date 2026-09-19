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
        Schema::create('tbtrilhaconteudo', function (Blueprint $table) {
            $table->unsignedInteger('codTrilha');
            $table->unsignedInteger('codConteudo')->index('codconteudo');
            $table->unsignedSmallInteger('ordem');

            $table->primary(['codTrilha', 'codConteudo']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbtrilhaconteudo');
    }
};
