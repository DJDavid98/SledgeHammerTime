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
      $table->foreignUuid('choice_id')->nullable()->default(null)->references('id')->on('bot_command_option_choices')->onUpdate('cascade')->onDelete('cascade');
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down():void {
    Schema::table('bot_command_translations', function (Blueprint $table) {
      $table->dropColumn(['choice_id']);
    });
  }
};
