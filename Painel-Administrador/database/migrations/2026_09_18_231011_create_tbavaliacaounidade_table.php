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
        Schema::create('tbavaliacaounidade', function (Blueprint $table) {
            $table->increments('codAvaliacao');
            $table->unsignedInteger('codUnidade')->index('codunidade');
            $table->unsignedInteger('codUsuario')->index('codusuario');
            $table->unsignedTinyInteger('nota');
            $table->enum('lotacaoPercebida', ['livre', 'moderado', 'cheio']);
            $table->string('comentario')->nullable();
            $table->dateTime('dataAvaliacao')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbavaliacaounidade');
    }
};
