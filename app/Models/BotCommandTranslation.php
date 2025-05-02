<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class BotCommandTranslation extends Model {
  use HasUuids;

  public $timestamps = false;

  protected $fillable = [
    'command_id',
    'option_id',
    'locale',
    'field',
    'value',
  ];

  protected $casts = [
    'command_id' => 'string',
  ];

  public function command() {
    return $this->belongsTo(BotCommand::class, 'command_id');
  }

  public function option() {
    return $this->belongsTo(BotCommandOption::class, 'option_id');
  }
}
