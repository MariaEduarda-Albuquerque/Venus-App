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
        //
Schema::create('tbdestaque', function (Blueprint $t) {
    $t->id('codDestaque');
    $t->unsignedBigInteger('admin_id')->nullable();
    $t->string('tituloDestaque', 80);
    $t->text('objetivoDestaque');
    $t->enum('publicoalvoDestaque', [
        'adolescentes_e_jovens',
        'mulheres_adultas',
        'gestantes',
        'todas_as_usuarias',
    ])->default('todas_as_usuarias');
    $t->enum('faixaetariaDestaque', [
        '14_25',
        '26_40',
        '41_60',
        'todas_as_idades',
    ])->default('todas_as_idades');
    $t->enum('categoriaDestaque', [
        'ists',
        'saude_mental',
        'saude_reprodutiva',
        'prevencao_e_exames',
    ])->default('ists');
    $t->enum('duracaoDestaque', ['7', '15', '30', '90'])->default('7');
    $t->text('tagsDestaque')->nullable();
    $t->string('mensagemprincipalDestaque', 80);
    $t->text('apresentacaoDestaque');
    $t->string('ctaDestaque', 30);
    $t->text('fontesreferenciaDestaque');
    $t->string('fotoprincipalDestaque');
    $t->text('materiaiscomplementaresDestaque')->nullable();
    $t->enum('statusDestaque', ['ativa', 'terminada'])->default('ativa');
    $t->date('datainicioDestaque');
    $t->date('dataterminoDestaque');
    $t->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
