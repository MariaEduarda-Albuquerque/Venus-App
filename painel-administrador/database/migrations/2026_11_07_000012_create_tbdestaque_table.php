<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tbdestaque', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_unicode_ci';
            $table->bigInteger('codDestaque')->unsigned()->autoIncrement();
            $table->bigInteger('admin_id')->unsigned()->nullable()->default(null);
            $table->string('tituloDestaque', 80);
            $table->text('objetivoDestaque');
            $table->enum('publicoalvoDestaque', ['adolescentes_e_jovens', 'mulheres_adultas', 'gestantes', 'todas_as_usuarias'])->default('todas_as_usuarias');
            $table->enum('faixaetariaDestaque', ['14_25', '26_40', '41_60', 'todas_as_idades'])->default('todas_as_idades');
            $table->enum('categoriaDestaque', ['ists', 'saude_mental', 'saude_reprodutiva', 'prevencao_e_exames'])->default('ists');
            $table->enum('duracaoDestaque', ['7', '15', '30', '90'])->default('7');
            $table->text('tagsDestaque')->nullable()->default(null);
            $table->string('mensagemprincipalDestaque', 80);
            $table->text('apresentacaoDestaque');
            $table->string('ctaDestaque', 30);
            $table->text('fontesreferenciaDestaque');
            $table->string('fotoprincipalDestaque', 255);
            $table->text('materiaiscomplementaresDestaque')->nullable()->default(null);
            $table->enum('statusDestaque', ['ativa', 'terminada'])->default('ativa');
            $table->date('datainicioDestaque');
            $table->date('dataterminoDestaque');
            $table->timestamp('created_at')->nullable()->default(null);
            $table->timestamp('updated_at')->nullable()->default(null);

            $table->primary(['codDestaque']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tbdestaque');
    }
};
