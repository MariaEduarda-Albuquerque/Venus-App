
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tbchamadomensagem', function (Blueprint $table) {
            $table->increments('codMensagem');

            // Chamado relacionado à mensagem
            $table->unsignedInteger('codChamado');

            // Identificação de quem enviou a mensagem
            $table->enum('tipoRemetente', ['profissional', 'admin']);
            $table->unsignedInteger('codRemetente');

            // Conteúdo da mensagem
            $table->text('textoMensagem');

            // Anexo opcional
            $table->string('anexoMensagem', 255)->nullable();

            // Data e hora do envio
            $table->dateTime('dataMensagem')->useCurrent();

            // Relacionamento com tbchamado
            $table->foreign('codChamado')
                ->references('codChamado')
                ->on('tbchamadosuporte')
                ->onDelete('cascade');

            $table->index('codRemetente');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tbchamadomensagem');
    }
};
