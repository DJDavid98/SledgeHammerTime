<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
  /**
   * Run the migrations.
   */
  public function up():void {
    Schema::table('bot_command_translations', function (Blueprint $table) {
      $table->index(['command_id', 'option_id', 'choice_id']);
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down():void {
    Schema::table('bot_command_translations', function (Blueprint $table) {
      $table->dropIndex(['command_id', 'option_id', 'choice_id']);
    });
  }
};
