<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
  /**
   * Run the migrations.
   */
  public function up():void {
    Schema::table('bot_command_options', function (Blueprint $table) {
      $table->boolean('required')->default(false);
      $table->integer('order')->nullable()->default(null);
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down():void {
    Schema::table('bot_command_options', function (Blueprint $table) {
      $table->dropColumn(['required', 'order']);
    });
  }
};
