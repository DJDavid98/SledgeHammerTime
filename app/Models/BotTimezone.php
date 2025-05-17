<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class BotTimezone extends Model {
  use HasUuids;

  public $timestamps = false;

  protected $fillable = [
    'name',
  ];
}
