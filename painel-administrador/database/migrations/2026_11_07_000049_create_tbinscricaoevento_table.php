<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tbinscricaoevento', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_unicode_ci';
            $table->integer('codEvento')->unsigned();
            $table->integer('codUsuario')->unsigned();
            $table->dateTime('dataInscricao')->useCurrent();

            $table->primary(['codEvento', 'codUsuario']);

            $table->index(['codUsuario'], 'codusuario');

            $table->foreign(['codEvento'], 'tbinscricaoevento_ibfk_1')->references(['codEvento'])->on('tbevento')->onDelete('cascade');

            $table->foreign(['codUsuario'], 'tbinscricaoevento_ibfk_2')->references(['codUsuario'])->on('tbusuario')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tbinscricaoevento');
    }
};
