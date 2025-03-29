<?php

namespace App\Models;

use App\Casts\Json;
use App\Enums\DiscordTimestampFormat;
use App\Enums\SettingNames;
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

  /**
   * The attributes that should be cast.
   *
   * @var array
   */
  protected $casts = [
    'value' => Json::class,
  ];

  function discordUser():BelongsTo {
    return $this->belongsTo(DiscordUser::class);
  }

  public function getNameAttribute():SettingNames {
    return SettingNames::from($this->setting);
  }

  static function mergeWithDefaults(array $userSettings):array {
    return array_reduce(SettingNames::cases(), fn(array $acc, SettingNames $case) => [
      ...$acc,
      $case->value => $userSettings[$case->value] ?? null,
    ], []);
  }

  static function getDefaultValue(string|SettingNames $setting) {
    $settingName = is_string($setting) ? SettingNames::from($setting) : $setting;
    switch ($settingName){
      case SettingNames::FORMAT:
        return DiscordTimestampFormat::DEFAULT->value;
      case SettingNames::COLUMNS:
        return TimestampMessageColumns::DEFAULT->value;
      case SettingNames::EPHEMERAL:
      case SettingNames::HEADER:
        return true;
      case SettingNames::TIMEZONE:
        return "GMT";
      case SettingNames::DEFAULT_MINUTES:
        return null;
      default:
        throw new \Exception("Invalid setting: $setting");
    }
  }

  static function shouldDeleteIfMatchingDefault(string $setting, $value):bool {
    if ($value === null) return true;
    switch ($setting){
      case SettingNames::FORMAT->value:
      case SettingNames::COLUMNS->value:
      case SettingNames::TIMEZONE->value:
      case SettingNames::DEFAULT_MINUTES->value:
        return $value === self::getDefaultValue($setting);
      default:
        return false;
    }
  }
}
