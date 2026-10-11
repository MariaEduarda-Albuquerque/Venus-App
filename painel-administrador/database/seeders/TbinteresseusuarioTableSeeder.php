<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TbinteresseusuarioTableSeeder extends Seeder
{
    /**
     * Popula a tabela `tbinteresseusuario` de forma linear e direta:
     * para cada usuária, registra um único interesse, associando-a
     * a uma categoria, sem sorteio nem inserção em lote.
     *
     * FKs:
     *   codUsuario       -> tbusuario.codUsuario
     *   codTipoCategoria -> codtipocategoria.codTipoCategoria
     *
     * Portanto TbusuarioTableSeeder e CodtipocategoriaTableSeeder
     * precisam rodar ANTES deste seeder.
     */
    public function run(): void
    {
        $usuarios = DB::table('tbusuario')->pluck('codUsuario');
        $categorias = DB::table('codtipocategoria')->pluck('codTipoCategoria')->values();

        if ($usuarios->isEmpty() || $categorias->isEmpty()) {
            $this->command?->warn(
                'tbusuario ou codtipocategoria vazias. Rode TbusuarioTableSeeder e CodtipocategoriaTableSeeder antes do TbinteresseusuarioTableSeeder.'
            );
            return;
        }

        $totalCategorias = $categorias->count();
        $indice = 0;

        foreach ($usuarios as $codUsuario) {
            // Associa cada usuária a uma categoria, alternando entre
            // as categorias disponíveis (round-robin), um insert por vez.
            $codTipoCategoria = $categorias[$indice % $totalCategorias];

            DB::table('tbinteresseusuario')->insert([
                'codUsuario'       => $codUsuario,
                'codTipoCategoria' => $codTipoCategoria,
                'dataSelecionado'  => now(),
            ]);

            $indice++;
        }

        $this->command?->info($indice . ' registros inseridos em tbinteresseusuario.');
    }
}