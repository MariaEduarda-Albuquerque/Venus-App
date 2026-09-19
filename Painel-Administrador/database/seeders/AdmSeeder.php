<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdmSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('tbadmin')->insert([
            'codAdmin' => 2,
            'nomeAdmin' => 'Admin',
            'emailAdmin' => 'admin@sistema.com',
            'senhaAdmin' => Hash::make('adm123'),
            'codPapel' => 1,
            'duasEtapasAtiva' => 1,
            'statusConta' => 'ativa',
            'dataCadastro' => now(),
        ]);
    }
}