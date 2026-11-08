<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('cache_locks', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_unicode_ci';
            $table->string('key', 255);
            $table->string('owner', 255);
            $table->integer('expiration');

            $table->primary(['key']);

            $table->index(['expiration'], 'cache_locks_expiration_index');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cache_locks');
    }
};
