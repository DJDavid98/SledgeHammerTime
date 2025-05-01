<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BotShard extends Model {
  protected $fillable = [
    'id',
    'server_count',
    'member_count',
    'started_at',
  ];
}
