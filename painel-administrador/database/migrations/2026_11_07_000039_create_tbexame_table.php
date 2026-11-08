<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tbexame', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_unicode_ci';
            $table->integer('codExame')->unsigned()->autoIncrement();
            $table->integer('codUsuario')->unsigned();
            $table->string('nomeExame', 150);
            $table->string('arquivoExame', 255);
            $table->date('dataExame');
            $table->enum('statusExame', ['salvo', 'analisado'])->default('salvo');
            $table->string('observacaoExame', 255)->nullable()->default(null);
            $table->dateTime('dataUpload')->useCurrent();

            $table->primary(['codExame']);

            $table->index(['codUsuario', 'dataExame'], 'idx_exame_usuario');

            $table->foreign(['codUsuario'], 'tbexame_ibfk_1')->references(['codUsuario'])->on('tbusuario')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tbexame');
    }
};
