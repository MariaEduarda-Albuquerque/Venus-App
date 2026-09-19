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
        Schema::create('tbconteudoadmin', function (Blueprint $table) {
            $table->increments('codConteudoAdmin');
            $table->unsignedInteger('codConteudo')->index('codconteudo');
            $table->unsignedInteger('codAdmin')->index('codadmin');
            $table->enum('decisao', ['aprovado', 'recusado', 'ajuste_solicitado']);
            $table->string('motivoDecisao')->nullable();
            $table->dateTime('dataDecisao')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbconteudoadmin');
    }
};
