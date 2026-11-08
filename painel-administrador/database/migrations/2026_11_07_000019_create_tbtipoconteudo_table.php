<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tbtipoconteudo', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_unicode_ci';
            $table->integer('codTipoConteudo')->unsigned()->autoIncrement();
            $table->string('descricaoTipoConteudo', 60);

            $table->primary(['codTipoConteudo']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tbtipoconteudo');
    }
};
