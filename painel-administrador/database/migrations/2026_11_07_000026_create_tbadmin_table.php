<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tbadmin', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_unicode_ci';
            $table->integer('codAdmin')->unsigned()->autoIncrement();
            $table->string('nomeAdmin', 120);
            $table->string('emailAdmin', 150);
            $table->string('telAdmin', 14)->nullable()->default(null);
            $table->string('paisAdmin', 60)->nullable()->default(null);
            $table->string('cidadeAdmin', 100)->nullable()->default(null);
            $table->char('ufAdmin', 2)->nullable()->default(null);
            $table->string('cepAdmin', 10)->nullable()->default(null);
            $table->string('nrFiscalAdmin', 20)->nullable()->default(null);
            $table->enum('temaAdmin', ['claro', 'escuro', 'sistema'])->default('sistema');
            $table->string('senhaAdmin', 255);
            $table->tinyInteger('codPapel')->unsigned();
            $table->tinyInteger('duasEtapasAtiva')->default(0);
            $table->enum('statusConta', ['ativa', 'suspensa'])->default('ativa');
            $table->dateTime('dataCadastro')->useCurrent();
            $table->string('codpostalAdmin', 8);

            $table->primary(['codAdmin']);

            $table->unique(['emailAdmin'], 'uq_admin_email');

            $table->index(['codPapel'], 'codpapel');

            $table->foreign(['codPapel'], 'tbadmin_ibfk_1')->references(['codPapel'])->on('tbpapel');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tbadmin');
    }
};
