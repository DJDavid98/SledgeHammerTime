<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
  /**
   * Run the migrations.
   */
  public function up():void {
    Schema::create('bot_command_translations', function (Blueprint $table) {
      $table->uuid('id')->primary();
      $table->foreignId('command_id')->references('id')->on('bot_commands')->onUpdate('cascade')->onDelete('cascade');
      $table->foreignUuid('option_id')->nullable()->references('id')->on('bot_command_options')->onUpdate('cascade')->onDelete('cascade');
      $table->string('locale', 10);
      $table->string('field', 50);
      $table->string('value', 255);

      $table->index(['locale', 'field']);
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down():void {
    Schema::dropIfExists('bot_command_translations');
  }
};
