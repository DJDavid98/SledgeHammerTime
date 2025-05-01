<?php

namespace App\Http\Requests;

use App\Enums\DiscordBotCommandType;
use App\Rules\ValidBotLocaleKeys;
use Auth;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

class UpdateBotCommandsRequest extends FormRequest {
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
      '*' => 'required|array|min:1',
      '*.id' => 'required|numeric',
      '*.name' => 'required|string|min:1|max:32',
      '*.type' => ['required', 'integer', new Enum(DiscordBotCommandType::class)],
      '*.name_localizations' => ['nullable', 'array', new ValidBotLocaleKeys()],
      '*.name_localizations.*' => 'string|min:1|max:32',
      '*.description' => 'nullable|string|min:1|max:100',
      '*.description_localizations' => ['nullable', 'array', new ValidBotLocaleKeys()],
      '*.description_localizations.*' => 'string|min:1|max:100',
    ];
  }
}
