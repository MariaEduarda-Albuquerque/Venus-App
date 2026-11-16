<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('tbconteudo', function (Blueprint $table) {
            $table->string('objetivoConteudo', 250)->nullable()->after('tituloConteudo');
            $table->string('publicoAlvoConteudo', 255)->nullable();
            $table->date('periodoInicioConteudo')->nullable();
            $table->date('periodoFimConteudo')->nullable();
            $table->string('tagsConteudo', 255)->nullable();
            $table->string('mensagemPrincipalConteudo', 80)->nullable();
            $table->string('chamadaAcaoConteudo', 60)->nullable();
            $table->string('fontesConteudo', 300)->nullable();
            $table->string('fundoConteudo', 20)->default('vinho');
        });
    }

    public function down(): void
    {
        Schema::table('tbconteudo', function (Blueprint $table) {
            $table->dropColumn([
                'objetivoConteudo', 'publicoAlvoConteudo', 'periodoInicioConteudo',
                'periodoFimConteudo', 'tagsConteudo', 'mensagemPrincipalConteudo',
                'chamadaAcaoConteudo', 'fontesConteudo', 'fundoConteudo',
            ]);
        });
    }
};