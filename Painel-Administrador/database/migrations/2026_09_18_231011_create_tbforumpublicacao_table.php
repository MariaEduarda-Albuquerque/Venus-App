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
        Schema::create('tbforumpublicacao', function (Blueprint $table) {
            $table->increments('codForumPublicacao');
            $table->unsignedInteger('codUsuario')->index('codusuario');
            $table->unsignedInteger('codTipoCategoria')->nullable()->index('codtipocategoria');
            $table->string('tituloPublicacao', 150);
            $table->text('textoPublicacao');
            $table->string('anexoPublicacao')->nullable();
            $table->boolean('publicadoAnonimo')->default(false);
            $table->dateTime('dataPublicacao')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbforumpublicacao');
    }
};
