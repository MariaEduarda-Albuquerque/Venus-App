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
        Schema::create('tbnotificacao', function (Blueprint $table) {
            $table->bigIncrements('codNotificacao');
            $table->enum('destinatarioTipo', ['usuaria', 'profissional', 'admin']);
            $table->unsignedInteger('codDestinatario');
            $table->string('tipoNotificacao', 50);
            $table->string('tituloNotificacao', 150);
            $table->string('corpoNotificacao')->nullable();
            $table->boolean('lida')->default(false);
            $table->dateTime('dataEnvio')->useCurrent();

            $table->index(['destinatarioTipo', 'codDestinatario', 'lida'], 'idx_notificacao_destinatario');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbnotificacao');
    }
};
