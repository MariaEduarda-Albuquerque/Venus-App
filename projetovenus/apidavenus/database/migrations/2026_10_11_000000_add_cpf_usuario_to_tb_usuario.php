<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // A tabela tbUsuario já existe no banco do projeto. Só acrescentamos
        // a coluna caso ela ainda não esteja presente.
        if (Schema::hasTable('tbUsuario') && !Schema::hasColumn('tbUsuario', 'cpfUsuario')) {
            Schema::table('tbUsuario', function (Blueprint $table) {
                $table->string('cpfUsuario', 11)->nullable()->unique();
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasTable('tbUsuario') && Schema::hasColumn('tbUsuario', 'cpfUsuario')) {
            Schema::table('tbUsuario', function (Blueprint $table) {
                $table->dropUnique(['cpfUsuario']);
                $table->dropColumn('cpfUsuario');
            });
        }
    }
};
