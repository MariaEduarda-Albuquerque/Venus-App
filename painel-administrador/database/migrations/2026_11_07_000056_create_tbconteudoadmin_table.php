<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tbconteudoadmin', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_unicode_ci';
            $table->integer('codConteudoAdmin')->unsigned()->autoIncrement();
            $table->integer('codConteudo')->unsigned();
            $table->integer('codAdmin')->unsigned();
            $table->enum('decisao', ['aprovado', 'recusado', 'ajuste_solicitado']);
            $table->string('motivoDecisao', 255)->nullable()->default(null);
            $table->dateTime('dataDecisao')->useCurrent();

            $table->primary(['codConteudoAdmin']);

            $table->index(['codConteudo'], 'codconteudo');

            $table->index(['codAdmin'], 'codadmin');

            $table->foreign(['codConteudo'], 'tbconteudoadmin_ibfk_1')->references(['codConteudo'])->on('tbconteudo')->onDelete('cascade');

            $table->foreign(['codAdmin'], 'tbconteudoadmin_ibfk_2')->references(['codAdmin'])->on('tbadmin');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tbconteudoadmin');
    }
};
