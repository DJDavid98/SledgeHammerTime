<?php

namespace App\Models;

use App\Traits\HasUiInfo;
use Illuminate\Database\Eloquent\Concerns\HasVersion4Uuids as HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BotCommandTranslation extends Model {
  use HasUuids, HasUiInfo;

  public $timestamps = false;

  protected $fillable = [
    'command_id',
    'option_id',
    'choice_id',
    'locale',
    'field',
    'value',
  ];

  protected $casts = [
    'command_id' => 'string',
  ];

  public function command():BelongsTo {
    return $this->belongsTo(BotCommand::class, 'command_id');
  }

  public function option():BelongsTo {
    return $this->belongsTo(BotCommandOption::class, 'option_id');
  }

  public function choice():BelongsTo {
    return $this->belongsTo(BotCommandOptionChoice::class, 'choice_id');
  }

  public function mapToUiInfo():array {
    return [
      'commandId' => $this->command_id,
      'optionId' => $this->option_id,
      'choiceId' => $this->choice_id,
      'locale' => $this->locale,
      'field' => $this->field,
      'value' => $this->value,
    ];
  }
}
