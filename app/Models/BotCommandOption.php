<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class BotCommandOption extends Model {
  use HasUuids;

  protected $fillable = [
    'bot_command_id',
    'name',
    'type',
    'description',
    'required',
    'order',
  ];

  function command():BelongsTo {
    return $this->belongsTo(BotCommand::class);
  }

  function translations():HasMany {
    return $this->hasMany(BotCommandTranslation::class, 'option_id');
  }
}
