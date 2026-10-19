<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TbvacinaTableSeeder extends Seeder
{
    /**
     * Popula a tabela `tbvacina` de forma linear e direta:
     * para cada usuária existente, registra duas vacinas do calendário
     * básico (uma "base" e outra deslocada na lista), uma por vez.
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
        $total = 0;

        foreach ($usuarios as $codUsuario) {
            // Primeira vacina da usuária (round-robin)
            DB::table('tbvacina')->insert([
                'codUsuario'        => $codUsuario,
                'nomeVacina'        => $vacinas[$indice % $totalVacinas],
                'dataAplicacao'     => now()->subDays(30 + $indice * 3)->format('Y-m-d'),
                'doseVacina'        => '1ª dose',
                'comprovanteVacina' => null,
                'dataRegistro'      => now(),
            ]);

            // Segunda vacina, deslocada em 3 posições (sempre diferente da primeira)
            DB::table('tbvacina')->insert([
                'codUsuario'        => $codUsuario,
                'nomeVacina'        => $vacinas[($indice + 3) % $totalVacinas],
                'dataAplicacao'     => now()->subDays(120 + $indice * 5)->format('Y-m-d'),
                'doseVacina'        => $indice % 2 === 0 ? '2ª dose' : 'Dose única',
                'comprovanteVacina' => null,
                'dataRegistro'      => now(),
            ]);

            $indice++;
            $total += 2;
        }

        $this->command?->info($total . ' registros inseridos em tbvacina.');
    }
}
