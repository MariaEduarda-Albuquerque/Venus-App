<?php

use Illuminate\Database\Migrations\Migration;

// Popula a Agenda com as datas, campanhas e vacinas de saúde da mulher.
// Roda junto com "php artisan migrate", sem precisar de "db:seed".
return new class extends Migration
{
    public function up(): void
    {
        (new \Database\Seeders\DataSaudeSeeder())->setContainer(app())->run();
    }

    public function down(): void
    {
        // Mantém os dados (a tabela é removida na migration de criação)
    }
};
