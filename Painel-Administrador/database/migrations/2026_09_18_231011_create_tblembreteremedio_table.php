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
        Schema::create('tblembreteremedio', function (Blueprint $table) {
            $table->increments('codLembreteRemedio');
            $table->string('nomeLembreteRemedio', 100);
            $table->string('dosagemLembreteRemedio', 60);
            $table->time('horarioLembreteRemedio');
            $table->unsignedInteger('codUsuario')->index('codusuario');
            $table->boolean('ativo')->default(true);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tblembreteremedio');
    }
};
