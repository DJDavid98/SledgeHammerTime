<?php

namespace App\Models;

use App\Traits\HasUiInfo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Redis;

class DiscordUser extends Model {
  use HasFactory, HasUiInfo;

  /**
   * The attributes that are mass assignable.
   *
   * @var array<int, string>
   */
  protected $fillable = [
    'id',
    'name',
    'display_name',
    'discriminator',
    'avatar',
    'access_token',
    'refresh_token',
    'scopes',
    'token_expires',
    'user_id',
  ];

  protected $casts = [
    // Since this is a bigint JS might lose precision if it's left as number
    'id' => 'string',
  ];

  function user():BelongsTo {
    return $this->belongsTo(User::class);
  }

  function settings():HasMany {
    return $this->hasMany(Settings::class);
  }

  function getPublicNameAttribute():string {
    return $this->display_name ?? (trim($this->discriminator) !== '0' ? "{$this->name}#{$this->discriminator}" : $this->name);
  }

  function mapToUiInfo():array {
    return [
      'id' => $this->id,
      'name' => $this->public_name,
      'avatar' => $this->avatar,
      'discriminator' => $this->discriminator,
    ];
  }

  public function getSettingsCacheKey():string {
    return "user-settings-{$this->id}";
  }

  public function getSettingsCacheDurationSeconds():int {
    return 5 * 60;
  }

  public function clearSettingsCache():void {
    Redis::delete($this->getSettingsCacheKey());
  }

  public function getSettingsRecord():array {
    $cacheKey = $this->getSettingsCacheKey();

    $cachedData = Redis::get($cacheKey);
    if ($cachedData){
      return json_decode($cachedData, true);
    }

    $settings = $this->settings()->get(['setting', 'value'])->reduce(fn(array $acc, Settings $s) => [
      ...$acc,
      $s->setting => $s->value,
    ], []);
    Redis::set($cacheKey, json_encode($settings, JSON_THROW_ON_ERROR), 'EX', $this->getSettingsCacheDurationSeconds());

    return $settings;
  }
}
