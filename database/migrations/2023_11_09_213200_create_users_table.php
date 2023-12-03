<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Query\Expression;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
  /**
   * Run the migrations.
   */
  public function up():void {
    Schema::create('users', function (Blueprint $table) {
      $table->uuid('id')->primary()->default(new Expression('gen_random_uuid()'));
      $table->string('name', 50);
      $table->timestampsTz();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down():void {
    Schema::dropIfExists('users');
  }
};
