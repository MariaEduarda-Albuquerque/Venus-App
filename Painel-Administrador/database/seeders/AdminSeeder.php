<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\AdmModel;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */

public function run(): void
{
    AdmModel::create([
        'nomeAdmin' => 'Otavio',
        'emailAdmin' => 'admin2@sistema.com',
        'senhaAdmin' => Hash::make('senha123'),
        'tbConteudoAdmin_id' => 3,
    ]);
}
}
