<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
  /**
   * Run the migrations.
   */
  public function up():void {
    Schema::create('bot_commands', function (Blueprint $table) {
      $table->bigInteger('id')->primary();
      $table->string('name', 32)->unique();
      $table->string('description', 100)->nullable()->default(null);
      $table->integer('type');
      $table->timestampsTz();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down():void {
    Schema::dropIfExists('bot_commands');
  }
};
