<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tbtipoatendimento', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_unicode_ci';
            $table->integer('idTipoAtendimento')->autoIncrement();
            $table->string('descricaoTipoAtendimento', 255);

            $table->primary(['idTipoAtendimento']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tbtipoatendimento');
    }
};
