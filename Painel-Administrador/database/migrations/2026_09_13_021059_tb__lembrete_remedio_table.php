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
            Schema::create('tbLembreteRemedio', function (Blueprint $table) {
        $table->id(); 
        $table->string('nomeLembreteRemedio');
        $table->string('dosagemLembreteRemedio')->unique(); 
        $table->dateTime('horarioLembreteRemedio');
        $table->foreignId('tbUsuario_id')->constrained('tbUsuario');
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
