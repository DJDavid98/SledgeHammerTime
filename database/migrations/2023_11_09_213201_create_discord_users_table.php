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
        Schema::create('discord_users', function (Blueprint $table) {
            $table->bigInteger('id')->primary();
            $table->string('name', 32);
            $table->char('discriminator', 4);
            $table->string('avatar', 64)->nullable();
            $table->string('access_token', 128)->nullable();
            $table->string('refresh_token', 128)->nullable();
            $table->string('scopes', 128)->nullable();
            $table->timestampTz('token_expires')->nullable();
            $table->uuid('user_id')->nullable();
            $table->uuid('display_name')->nullable();
            $table->timestampsTz();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('discord_users');
    }
};
