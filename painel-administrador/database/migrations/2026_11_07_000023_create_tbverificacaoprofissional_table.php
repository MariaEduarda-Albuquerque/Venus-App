<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tbverificacaoprofissional', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_unicode_ci';
            $table->bigInteger('id')->unsigned()->autoIncrement();
            $table->bigInteger('codProfissionalSaude')->unsigned();
            $table->bigInteger('admin_id')->unsigned()->nullable()->default(null);
            $table->string('decisao', 20);
            $table->text('motivo')->nullable()->default(null);
            $table->timestamp('created_at')->nullable()->default(null);
            $table->timestamp('updated_at')->nullable()->default(null);

            $table->primary(['id']);

            $table->index(['codProfissionalSaude'], 'tbverificacaoprofissional_codprofissionalsaude_index');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tbverificacaoprofissional');
    }
};
