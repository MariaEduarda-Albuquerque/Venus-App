<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tbmensagem', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_unicode_ci';
            $table->bigInteger('codMensagem')->unsigned()->autoIncrement();
            $table->integer('codConsulta')->unsigned();
            $table->enum('remetenteTipo', ['usuaria', 'profissional']);
            $table->text('textoMensagem')->nullable()->default(null);
            $table->string('anexoMensagem', 255)->nullable()->default(null);
            $table->dateTime('lidaEm')->nullable()->default(null);
            $table->dateTime('dataEnvio')->useCurrent();

            $table->primary(['codMensagem']);

            $table->index(['codConsulta', 'dataEnvio'], 'idx_mensagem_consulta');

            $table->foreign(['codConsulta'], 'tbmensagem_ibfk_1')->references(['codConsulta'])->on('tbconsulta')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tbmensagem');
    }
};
