<?php

namespace App\Http\Requests;

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
      'timezone' => ['nullable', 'string', new MomentTimezoneName()],
      'format' => ['nullable', 'string', new DiscordTimestampFormatOption()],
      'ephemeral' => ['nullable', 'boolean'],
      'header' => ['nullable', 'boolean'],
      'columns' => ['nullable', 'string', new TimestampMessageColumnsOption()],
    ];
  }
}
