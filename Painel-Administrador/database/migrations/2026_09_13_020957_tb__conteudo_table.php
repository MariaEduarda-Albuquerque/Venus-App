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
            Schema::create('tbConteudo', function (Blueprint $table) {
        $table->id(); 
        $table->string('tituloConteudo');
        $table->string('corpoConteudo')->unique(); 
        $table->foreignId('tbtipocategoria_id')->constrained('tbTipoCategoria');
        $table->foreignId('tbtipoconteudo_id')->constrained('tbtipoConteudo');
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
