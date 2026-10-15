<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tbverificacaoprofissional', function (Blueprint $t) {
            $t->id();
            $t->unsignedBigInteger('codProfissionalSaude')->index();
            $t->unsignedBigInteger('admin_id')->nullable();
            $t->string('decisao', 20);          // aprovado | pendencia | reprovado
            $t->text('motivo')->nullable();
            $t->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbverificacaoprofissional');
    }
};
