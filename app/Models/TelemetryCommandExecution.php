<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TelemetryCommandExecution extends Model {
  use HasUuids;

  const UPDATED_AT = null;

  protected $fillable = [
    'bot_command_id',
  ];

  function command():BelongsTo {
    return $this->belongsTo(BotCommand::class);
  }
}
