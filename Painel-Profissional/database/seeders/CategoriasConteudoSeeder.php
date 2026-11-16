<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriasConteudoSeeder extends Seeder
{
    public function run(): void
    {
        $categorias = [
            'Câncer de mama',
            'Câncer do colo do útero',
            'ISTs e prevenção',
            'Vacinação e HPV',
            'Saúde sexual e reprodutiva',
            'Planejamento familiar e contracepção',
            'Gravidez e pré-natal',
            'Pós-parto e amamentação',
            'Menopausa',
            'Endometriose e SOP',
            'Saúde íntima e ginecológica',
            'Saúde mental',
            'Nutrição e bem-estar',
            'Violência contra a mulher',
        ];

        foreach ($categorias as $nome) {
            DB::table('tbtipocategoria')->updateOrInsert(
                ['nomeTipoCategoria' => $nome],
                ['nomeTipoCategoria' => $nome]
            );
        }
    }
}