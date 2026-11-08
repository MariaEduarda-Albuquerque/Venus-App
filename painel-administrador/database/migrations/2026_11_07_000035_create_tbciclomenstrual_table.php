<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tbciclomenstrual', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_unicode_ci';
            $table->integer('codCiclo')->unsigned()->autoIncrement();
            $table->integer('codUsuario')->unsigned();
            $table->date('dataInicio');
            $table->tinyInteger('duracaoDias')->unsigned()->nullable()->default(null);

            $table->primary(['codCiclo']);

            $table->index(['codUsuario', 'dataInicio'], 'idx_ciclo_usuario');

            $table->foreign(['codUsuario'], 'tbciclomenstrual_ibfk_1')->references(['codUsuario'])->on('tbusuario')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tbciclomenstrual');
    }
};
