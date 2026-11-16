<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        $formatos = ['Artigo', 'Vídeo', 'Infográfico', 'Campanha'];
        $categorias = ['Contraceptivos', 'Gravidez', 'Pré-natal', 'Pós-parto', 'ISTs', 'Direitos', 'Corpo', 'Saúde sexual', 'Saúde mental', 'Rede de Apoio', 'Ciclo menstrual', 'Menopausa', 'Prevenção de câncer', 'Endometriose', 'Ovário Policístico'];

        foreach ($formatos as $nome) {
            if (!DB::table('tbtipoconteudo')->where('descricaoTipoConteudo', $nome)->exists()) {
                DB::table('tbtipoconteudo')->insert(['descricaoTipoConteudo' => $nome]);
            }
        }

        foreach ($categorias as $nome) {
            if (!DB::table('tbtipocategoria')->where('nomeTipoCategoria', $nome)->exists()) {
                DB::table('tbtipocategoria')->insert(['nomeTipoCategoria' => $nome]);
            }
        }
    }

    public function down(): void
    {
        // Não apaga nada: esses dados podem já estar ligados a conteúdos.
    }
};