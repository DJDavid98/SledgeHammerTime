<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BotCommand extends Model {
  protected $fillable = [
    'id',
    'name',
    'description',
    'type',
  ];
}
