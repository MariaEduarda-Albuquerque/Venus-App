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
            Schema::create('tbPublicacao', function (Blueprint $table) {
        $table->id(); 
        $table->string('tituloPublicacao');
        $table->text('descPublicacao')->unique(); 
        $table->foreignId('tbConteudo_id')->constrained('tbConteudo');
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
