<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tbpapel', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_unicode_ci';
            $table->tinyInteger('codPapel')->unsigned()->autoIncrement();
            $table->string('nomePapel', 30);
            $table->string('descricaoPapel', 200)->nullable()->default(null);

            $table->primary(['codPapel']);

            $table->unique(['nomePapel'], 'uq_papel_nome');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tbpapel');
    }
};
