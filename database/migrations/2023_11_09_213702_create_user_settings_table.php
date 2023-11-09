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
        Schema::create('user_settings', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('setting', 64);
            $table->json('value');
            $table->foreignId('user_id')->references('id')->on('discord_users')->onUpdate('no action')->onDelete('no action');
            $table->timestampsTz();

            $table->unique(['setting', 'user_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_settings');
    }
};
