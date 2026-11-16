<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

// Fluxo do agendamento: aguardando (Agendado) -> confirmada -> encerrada (Realizado) | cancelada.
// O enum não tinha "confirmada"; a coluna vira string para aceitar o novo status.
return new class extends Migration
{
    public function up(): void
    {
        Schema::table('tbconsulta', function (Blueprint $table) {
            $table->string('statusConsulta', 20)->default('aguardando')->change();
        });
    }

    public function down(): void
    {
        DB::table('tbconsulta')->where('statusConsulta', 'confirmada')->update(['statusConsulta' => 'aguardando']);

        Schema::table('tbconsulta', function (Blueprint $table) {
            $table->enum('statusConsulta', ['aguardando', 'em_andamento', 'encerrada', 'cancelada'])->default('aguardando')->change();
        });
    }
};
