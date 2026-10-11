<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TbvacinaTableSeeder extends Seeder
{
    /**
     * Popula a tabela `tbvacina` de forma linear e direta:
     * para cada usuária existente, registra uma vacina do calendário
     * básico, uma por vez.
     *
     * FK: codUsuario -> tbusuario.codUsuario (ON DELETE CASCADE)
     * Portanto TbusuarioTableSeeder precisa rodar ANTES deste seeder.
     */
    public function run(): void
    {
        $usuarios = DB::table('tbusuario')->pluck('codUsuario');

        if ($usuarios->isEmpty()) {
            $this->command?->warn('tbusuario vazia. Rode o TbusuarioTableSeeder antes do TbvacinaTableSeeder.');
            return;
        }

        $vacinas = [
            'HPV',
            'Hepatite B',
            'Tríplice viral (SCR)',
            'dT (dupla adulto)',
            'Influenza',
            'COVID-19',
        ];

        $totalVacinas = count($vacinas);
        $indice = 0;

        foreach ($usuarios as $codUsuario) {
            $nomeVacina = $vacinas[$indice % $totalVacinas];

            DB::table('tbvacina')->insert([
                'codUsuario'        => $codUsuario,
                'nomeVacina'        => $nomeVacina,
                'dataAplicacao'     => now()->subDays(30)->format('Y-m-d'),
                'doseVacina'        => '1ª dose',
                'comprovanteVacina' => null,
                'dataRegistro'      => now(),
            ]);

            $indice++;
        }

        $this->command?->info($indice . ' registros inseridos em tbvacina.');
    }
}