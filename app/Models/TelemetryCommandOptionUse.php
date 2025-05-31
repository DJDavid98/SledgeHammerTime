<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TelemetryCommandOptionUse extends Model {
  use HasUuids;

  const UPDATED_AT = null;

  protected $fillable = [
    'bot_command_option_id',
  ];

  function option():BelongsTo {
    return $this->belongsTo(BotCommandOption::class);
  }
}
