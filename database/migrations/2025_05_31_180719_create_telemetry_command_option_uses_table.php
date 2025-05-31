<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
  /**
   * Run the migrations.
   */
  public function up():void {
    Schema::create('telemetry_command_option_uses', function (Blueprint $table) {
      $table->uuid('id')->primary();
      $table->foreignUuid('bot_command_option_id')->references('id')->on('bot_command_options')->onUpdate('cascade')->onDelete('cascade');
      $table->timestampTz('created_at')->nullable();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down():void {
    Schema::dropIfExists('telemetry_command_option_uses');
  }
};
