<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            \Database\Seeders\TbprofissionalsaudeTableSeeder::class,
            \Database\Seeders\PacientesDemoSeeder::class,
            \Database\Seeders\AgendaDemoSeeder::class,
            \Database\Seeders\ConteudoSeeder::class,
            \Database\Seeders\DataSaudeSeeder::class,
            \Database\Seeders\ProntuarioDemoSeeder::class,
            \Database\Seeders\PublicacoesDemoSeeder::class,
        ]);
    }
}