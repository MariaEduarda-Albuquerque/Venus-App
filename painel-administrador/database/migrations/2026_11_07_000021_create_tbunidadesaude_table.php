<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tbunidadesaude', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_unicode_ci';
            $table->integer('codUnidade')->unsigned()->autoIncrement();
            $table->string('nomeUnidade', 150);
            $table->enum('tipoUnidade', ['UBS', 'UPA', 'CAPS', 'CRAS', 'Farmacia_Popular']);
            $table->string('endereco', 255);
            $table->decimal('latitude', 10, 7);
            $table->decimal('longitude', 10, 7);
            $table->string('telefone', 20)->nullable()->default(null);
            $table->string('horarioFuncionamento', 255)->nullable()->default(null);

            $table->primary(['codUnidade']);

            $table->index(['latitude', 'longitude'], 'idx_unidade_geo');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tbunidadesaude');
    }
};
