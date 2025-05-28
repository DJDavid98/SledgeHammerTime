<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
  /**
   * Run the migrations.
   */
  public function up():void {
    Schema::create('bot_command_option_choices', function (Blueprint $table) {
      $table->uuid('id')->primary();
      $table->foreignUuid('bot_command_option_id')->references('id')->on('bot_command_options')->onUpdate('cascade')->onDelete('cascade');
      $table->jsonb('value')->index();
      $table->string('name', 100);

      $table->unique(['bot_command_option_id', 'value']);
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down():void {
    Schema::dropIfExists('bot_command_option_choices');
  }
};
