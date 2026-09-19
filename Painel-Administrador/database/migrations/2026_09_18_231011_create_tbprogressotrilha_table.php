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
        Schema::create('tbprogressotrilha', function (Blueprint $table) {
            $table->unsignedInteger('codUsuario');
            $table->unsignedInteger('codTrilha')->index('codtrilha');
            $table->unsignedInteger('codConteudo')->index('codconteudo');
            $table->dateTime('concluidoEm')->useCurrent();

            $table->primary(['codUsuario', 'codTrilha', 'codConteudo']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbprogressotrilha');
    }
};
