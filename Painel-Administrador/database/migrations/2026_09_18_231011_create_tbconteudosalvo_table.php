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
        Schema::create('tbconteudosalvo', function (Blueprint $table) {
            $table->unsignedInteger('codUsuario');
            $table->unsignedInteger('codConteudo')->index('codconteudo');
            $table->dateTime('dataSalvo')->useCurrent();

            $table->primary(['codUsuario', 'codConteudo']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbconteudosalvo');
    }
};
