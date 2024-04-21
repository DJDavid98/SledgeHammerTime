<?php

namespace App\Models;

use App\Enums\DiscordTimestampFormat;
use App\Enums\TimestampMessageColumns;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Settings extends Model {
  use HasFactory;

  protected $fillable = [
    'setting',
    'value',
  ];

  function discordUser():BelongsTo {
    return $this->belongsTo(DiscordUser::class);
  }

  static function isDefaultValue(string $setting, $value):bool {
    if ($value === null) return true;
    switch ($setting){
      case "format":
        return $value === DiscordTimestampFormat::DEFAULT->value;
      case "columns":
        return $value === TimestampMessageColumns::DEFAULT->value;
      case "ephemeral":
      case "header":
        return $value === true;
      case "timezone":
        return $value === "GMT";
      default:
        return false;
    }
  }
}
