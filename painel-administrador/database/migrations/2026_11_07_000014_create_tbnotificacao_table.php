<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tbnotificacao', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_unicode_ci';
            $table->bigInteger('codNotificacao')->unsigned()->autoIncrement();
            $table->enum('destinatarioTipo', ['usuaria', 'profissional', 'admin']);
            $table->integer('codDestinatario')->unsigned();
            $table->string('tipoNotificacao', 50);
            $table->string('tituloNotificacao', 150);
            $table->string('corpoNotificacao', 255)->nullable()->default(null);
            $table->tinyInteger('lida')->default(0);
            $table->dateTime('dataEnvio')->useCurrent();

            $table->primary(['codNotificacao']);

            $table->index(['destinatarioTipo', 'codDestinatario', 'lida'], 'idx_notificacao_destinatario');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tbnotificacao');
    }
};
