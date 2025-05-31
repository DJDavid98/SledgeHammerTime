<?php

namespace App\Http\Requests;

use App\Enums\DiscordBotCommandOptionType;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Enum;

class TelemetryRequest extends FormRequest {
  /**
   * Determine if the user is authorized to make this request.
   */
  public function authorize():bool {
    return Auth::check();
  }

  /**
   * Get the validation rules that apply to the request.
   *
   * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
   */
  public function rules():array {
    return [
      'locale' => 'required|string|min:1|max:10',
      'commandId' => 'required|numeric',
      'options' => 'nullable|array|max:25',
      'options.*.name' => 'required|string|min:1|max:32',
      'options.*.type' => ['required', 'integer', new Enum(DiscordBotCommandOptionType::class)],
    ];
  }
}
