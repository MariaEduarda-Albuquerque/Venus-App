<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tbtrilhaconteudo', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_unicode_ci';
            $table->integer('codTrilha')->unsigned();
            $table->integer('codConteudo')->unsigned();
            $table->smallInteger('ordem')->unsigned();

            $table->primary(['codTrilha', 'codConteudo']);

            $table->index(['codConteudo'], 'codconteudo');

            $table->foreign(['codTrilha'], 'tbtrilhaconteudo_ibfk_1')->references(['codTrilha'])->on('tbtrilhaaprendizado')->onDelete('cascade');

            $table->foreign(['codConteudo'], 'tbtrilhaconteudo_ibfk_2')->references(['codConteudo'])->on('tbconteudo')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tbtrilhaconteudo');
    }
};
