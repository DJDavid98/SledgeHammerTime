<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Query\Expression;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
  /**
   * Run the migrations.
   */
  public function up():void {
    Schema::create('settings', function (Blueprint $table) {
      $table->uuid('id')->primary()->default(new Expression('gen_random_uuid()'));
      $table->string('setting', 64);
      $table->json('value');
      $table->foreignId('discord_user_id')->references('id')->on('discord_users')->onUpdate('no action')->onDelete('no action');
      $table->timestampsTz();

      $table->unique(['setting', 'discord_user_id']);
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down():void {
    Schema::dropIfExists('settings');
  }
};
