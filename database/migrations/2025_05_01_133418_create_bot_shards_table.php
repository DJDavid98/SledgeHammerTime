<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
  /**
   * Run the migrations.
   */
  public function up():void {
    Schema::create('bot_shards', function (Blueprint $table) {
      $table->integer('id');
      $table->bigInteger('server_count')->default(0);
      $table->bigInteger('member_count')->nullable();
      $table->timestampTz('started_at');
      $table->timestampsTz();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down():void {
    Schema::dropIfExists('bot_shards');
  }
};
