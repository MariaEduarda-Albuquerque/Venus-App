<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('tbadmin', function (Blueprint $table) {
            $table->string('codpostalAdmin', 8);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tbadmin', function (Blueprint $table) {
            $table->dropColumn([
                'codpostalAdmin',
            ]);
        });
    }
};
