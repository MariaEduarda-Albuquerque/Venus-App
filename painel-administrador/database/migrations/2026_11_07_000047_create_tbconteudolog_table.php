<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tbconteudolog', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_unicode_ci';
            $table->integer('codLog')->unsigned()->autoIncrement();
            $table->integer('codConteudo')->unsigned();
            $table->integer('codAdmin')->unsigned()->nullable()->default(null);
            $table->string('acao', 20);
            $table->dateTime('dataLog')->useCurrent();

            $table->primary(['codLog']);

            $table->index(['codAdmin'], 'tbconteudolog_codadmin_foreign');

            $table->index(['codConteudo', 'dataLog'], 'tbconteudolog_codconteudo_datalog_index');

            $table->foreign(['codAdmin'], 'tbconteudolog_codadmin_foreign')->references(['codAdmin'])->on('tbadmin')->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tbconteudolog');
    }
};
