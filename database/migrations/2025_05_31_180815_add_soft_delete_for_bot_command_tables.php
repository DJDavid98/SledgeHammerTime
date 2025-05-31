<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
  /**
   * Run the migrations.
   */
  public function up():void {
    Schema::table('bot_commands', function (Blueprint $table) {
      $table->softDeletesTz();
    });
    Schema::table('bot_command_options', function (Blueprint $table) {
      $table->softDeletesTz();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down():void {
    Schema::table('bot_commands', function (Blueprint $table) {
      $table->dropSoftDeletesTz();
    });
    Schema::table('bot_command_options', function (Blueprint $table) {
      $table->dropSoftDeletesTz();
    });
  }
};
