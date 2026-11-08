<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tblembreteremedio', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_unicode_ci';
            $table->integer('codLembreteRemedio')->unsigned()->autoIncrement();
            $table->string('nomeLembreteRemedio', 100);
            $table->string('dosagemLembreteRemedio', 60);
            $table->time('horarioLembreteRemedio');
            $table->integer('codUsuario')->unsigned();
            $table->tinyInteger('ativo')->default(1);

            $table->primary(['codLembreteRemedio']);

            $table->index(['codUsuario'], 'codusuario');

            $table->foreign(['codUsuario'], 'tblembreteremedio_ibfk_1')->references(['codUsuario'])->on('tbusuario')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tblembreteremedio');
    }
};
