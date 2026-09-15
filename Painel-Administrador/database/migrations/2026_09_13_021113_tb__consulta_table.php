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
            Schema::create('tbConsulta', function (Blueprint $table) {
        $table->id(); 
        $table->string('nomeConsulta');
        $table->string('statusConsulta')->unique(); 
        $table->text('historicoConsulta');
        $table->foreignId('tbUsuario_id')->constrained('tbUsuario');
        $table->foreignId('tbprofissionaldasaude_id')->constrained('tbProfissionalDaSaude');
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
