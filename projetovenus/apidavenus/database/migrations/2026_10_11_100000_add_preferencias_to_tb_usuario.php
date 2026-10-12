<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('tbUsuario')) return;

        $columns = [
            'preferenciasNotificacaoUsuario' => fn (Blueprint $table) => $table->json('preferenciasNotificacaoUsuario')->nullable(),
            'filtrosInteresseUsuario' => fn (Blueprint $table) => $table->json('filtrosInteresseUsuario')->nullable(),
            'visibilidadePerfilUsuario' => fn (Blueprint $table) => $table->string('visibilidadePerfilUsuario', 20)->default('anonima'),
            'mostrarBioUsuario' => fn (Blueprint $table) => $table->boolean('mostrarBioUsuario')->default(false),
            'permitirApoioUsuario' => fn (Blueprint $table) => $table->boolean('permitirApoioUsuario')->default(true),
            'ocultarSensivelUsuario' => fn (Blueprint $table) => $table->boolean('ocultarSensivelUsuario')->default(false),
            'tamanhoFonteUsuario' => fn (Blueprint $table) => $table->decimal('tamanhoFonteUsuario', 3, 2)->default(0.25),
            'altoContrasteUsuario' => fn (Blueprint $table) => $table->boolean('altoContrasteUsuario')->default(false),
        ];

        foreach ($columns as $name => $definition) {
            if (!Schema::hasColumn('tbUsuario', $name)) {
                Schema::table('tbUsuario', function (Blueprint $table) use ($definition) { $definition($table); });
            }
        }
    }

    public function down(): void
    {
        if (!Schema::hasTable('tbUsuario')) return;
        $columns = ['preferenciasNotificacaoUsuario','filtrosInteresseUsuario','visibilidadePerfilUsuario','mostrarBioUsuario','permitirApoioUsuario','ocultarSensivelUsuario','tamanhoFonteUsuario','altoContrasteUsuario'];
        foreach ($columns as $name) {
            if (Schema::hasColumn('tbUsuario', $name)) {
                Schema::table('tbUsuario', function (Blueprint $table) use ($name) { $table->dropColumn($name); });
            }
        }
    }
};
