<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
  /**
   * Run the migrations.
   */
  public function up():void {
    Schema::create('bot_command_options', function (Blueprint $table) {
      $table->uuid('id')->primary();
      $table->foreignId('bot_command_id')->references('id')->on('bot_commands')->onUpdate('cascade')->onDelete('cascade');
      $table->string('name', 32);
      $table->string('description', 100)->nullable()->default(null);
      $table->integer('type');
      $table->timestamps();

      $table->unique(['bot_command_id', 'name']);
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down():void {
    Schema::dropIfExists('bot_command_options');
  }
};
