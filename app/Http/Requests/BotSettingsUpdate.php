<?php

namespace App\Http\Requests;

use App\Enums\SettingNames;
use App\Rules\DiscordTimestampFormatOption;
use App\Rules\MomentTimezoneName;
use App\Rules\TimestampMessageColumnsOption;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class BotSettingsUpdate extends FormRequest {
  /**
   * Determine if the user is authorized to make this request.
   */
  public function authorize():bool {
    $user = Auth::user();
    if (!$user){
      return false;
    }

    $discordUserId = $this->route('discordUserId');

    return $user->discordUsers()->where('id', $discordUserId)->exists();
  }

  /**
   * Get the validation rules that apply to the request.
   *
   * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
   */
  public function rules():array {
    return [
      SettingNames::TIMEZONE->value => ['nullable', 'string', new MomentTimezoneName()],
      SettingNames::FORMAT->value => ['nullable', 'string', new DiscordTimestampFormatOption()],
      SettingNames::FORMAT_MINIMAL_REPLY->value => ['nullable', 'boolean'],
      SettingNames::EPHEMERAL->value => ['nullable', 'boolean'],
      SettingNames::HEADER->value => ['nullable', 'boolean'],
      SettingNames::BOLD_PREVIEW->value => ['nullable', 'boolean'],
      SettingNames::TELEMETRY->value => ['nullable', 'boolean'],
      SettingNames::COLUMNS->value => ['nullable', 'string', new TimestampMessageColumnsOption()],
      SettingNames::DEFAULT_AT_HOUR->value => ['nullable', 'integer', 'between:0,23'],
      SettingNames::DEFAULT_AT_MINUTE->value => ['nullable', 'integer', 'between:0,59'],
      SettingNames::DEFAULT_AT_SECOND->value => ['nullable', 'integer', 'between:0,59'],
    ];
  }
}
