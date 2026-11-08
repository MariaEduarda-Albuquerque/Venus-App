<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tbchamadomensagem', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_unicode_ci';
            $table->integer('codMensagem')->unsigned()->autoIncrement();
            $table->integer('codChamado')->unsigned();
            $table->enum('tipoRemetente', ['profissional', 'admin']);
            $table->integer('codRemetente')->unsigned();
            $table->text('textoMensagem');
            $table->string('anexoMensagem', 255)->nullable()->default(null);
            $table->dateTime('dataMensagem')->useCurrent();

            $table->primary(['codMensagem']);

            $table->index(['codChamado'], 'tbchamadomensagem_codchamado_foreign');

            $table->index(['codRemetente'], 'tbchamadomensagem_codremetente_index');

            $table->foreign(['codChamado'], 'tbchamadomensagem_codchamado_foreign')->references(['codChamado'])->on('tbchamadosuporte')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tbchamadomensagem');
    }
};
