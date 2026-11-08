<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tbvacina', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_unicode_ci';
            $table->integer('codVacina')->unsigned()->autoIncrement();
            $table->integer('codUsuario')->unsigned();
            $table->string('nomeVacina', 100);
            $table->date('dataAplicacao')->nullable()->default(null);
            $table->string('doseVacina', 30)->nullable()->default(null);
            $table->string('comprovanteVacina', 255)->nullable()->default(null);
            $table->dateTime('dataRegistro')->useCurrent();

            $table->primary(['codVacina']);

            $table->index(['codUsuario'], 'idx_vacina_usuario');

            $table->foreign(['codUsuario'], 'tbvacina_ibfk_1')->references(['codUsuario'])->on('tbusuario')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tbvacina');
    }
};
