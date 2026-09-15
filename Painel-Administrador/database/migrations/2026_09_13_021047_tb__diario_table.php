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
        //
            Schema::create('tbDiario', function (Blueprint $table) {
        $table->id(); 
        $table->string('tituloDiario');
        $table->text('descDiario')->unique(); 
        $table->date('dataDiario');
        $table->foreignId('tbUsuario_id')->constrained('tbUsuario');
        $table->foreignId('tbtipodiario_id')->constrained('tbTipoDiario');
        $table->timestamps(); 
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
