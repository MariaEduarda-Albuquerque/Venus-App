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
        Schema::create('tbadmin', function (Blueprint $table) {
            $table->increments('codAdmin');
            $table->string('nomeAdmin', 120);
            $table->string('emailAdmin', 150)->unique('uq_admin_email');
            $table->string('telAdmin', 14)->nullable();
            $table->string('paisAdmin', 60)->nullable();
            $table->string('cidadeAdmin', 100)->nullable();
            $table->char('ufAdmin', 2)->nullable();
            $table->string('cepAdmin', 10)->nullable();
            $table->string('nrFiscalAdmin', 20)->nullable();
            $table->enum('temaAdmin', ['claro', 'escuro', 'sistema'])->default('sistema');
            $table->string('senhaAdmin');
            $table->unsignedTinyInteger('codPapel')->index('codpapel');
            $table->boolean('duasEtapasAtiva')->default(false);
            $table->enum('statusConta', ['ativa', 'suspensa'])->default('ativa');
            $table->dateTime('dataCadastro')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbadmin');
    }
};
