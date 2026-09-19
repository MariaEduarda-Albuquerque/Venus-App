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
        Schema::create('tbforumreacao', function (Blueprint $table) {
            $table->unsignedInteger('codForumPublicacao');
            $table->unsignedInteger('codUsuario')->index('codusuario');
            $table->enum('tipoReacao', ['apoio'])->default('apoio');

            $table->primary(['codForumPublicacao', 'codUsuario']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbforumreacao');
    }
};
