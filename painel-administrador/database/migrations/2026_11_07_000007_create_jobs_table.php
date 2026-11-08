<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('jobs', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_unicode_ci';
            $table->bigInteger('id')->unsigned()->autoIncrement();
            $table->string('queue', 255);
            $table->longText('payload');
            $table->tinyInteger('attempts')->unsigned();
            $table->integer('reserved_at')->unsigned()->nullable()->default(null);
            $table->integer('available_at')->unsigned();
            $table->integer('created_at')->unsigned();

            $table->primary(['id']);

            $table->index(['queue'], 'jobs_queue_index');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('jobs');
    }
};
