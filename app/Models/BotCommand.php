<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class BotCommand extends Model {
  protected $fillable = [
    'id',
    'name',
    'description',
    'type',
  ];

  function options():HasMany {
    return $this->hasMany(BotCommandOption::class)
      ->orderBy('required', 'desc')
      ->orderBy('order');
  }
}
