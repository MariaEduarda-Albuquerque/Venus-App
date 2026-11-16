<?php

namespace Database\Seeders;

use App\Models\TipoCategoria;
use App\Models\TipoConteudo;
use Illuminate\Database\Seeder;

class ConteudoSeeder extends Seeder
{
    public function run(): void
    {
        foreach (['Contraceptivos', 'Gravidez', 'Pré-natal', 'Pós-parto', 'ISTs', 'Direitos',  'Corpo', 'Saúde sexual', 'Saúde mental', 'Rede de Apoio', 'Ciclo menstrual', 'Menopausa', 'Prevenção de câncer', 'Endometriose', 'Ovário Policístico'] as $nome) {
            TipoCategoria::firstOrCreate(['nomeTipoCategoria' => $nome]);
        }

        foreach (['Artigo', 'Vídeo', 'Infográfico'] as $descricao) {
            TipoConteudo::firstOrCreate(['descricaoTipoConteudo' => $descricao]);
        }
    }
}
 
