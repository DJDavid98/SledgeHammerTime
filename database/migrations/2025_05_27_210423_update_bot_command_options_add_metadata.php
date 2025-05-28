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
      $table->float('min_value')->nullable()->default(null);
      $table->float('max_value')->nullable()->default(null);
      $table->integer('min_length')->nullable()->default(null);
      $table->integer('max_length')->nullable()->default(null);
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down():void {
    Schema::table('bot_command_options', function (Blueprint $table) {
      $table->dropColumn(['min_value', 'max_value', 'min_length', 'max_length']);
    });
  }
};
