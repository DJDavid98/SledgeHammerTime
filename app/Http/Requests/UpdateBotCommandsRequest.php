<?php

namespace App\Http\Requests;

use App\Enums\DiscordBotCommandOptionType;
use App\Enums\DiscordBotCommandType;
use App\Rules\ValidBotLocaleKeys;
use Auth;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
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
      '*.options' => 'nullable|array|max:25',
      '*.options.*.name' => 'required|string|min:1|max:32',
      '*.options.*.type' => ['required', 'integer', new Enum(DiscordBotCommandOptionType::class)],
      '*.options.*.required' => 'boolean',
      '*.options.*.min_value' => 'nullable|numeric',
      '*.options.*.max_value' => 'nullable|numeric',
      '*.options.*.min_length' => 'nullable|integer|min:0|max:100',
      '*.options.*.max_length' => 'nullable|integer|min:1|max:100',
      '*.options.*.name_localizations' => ['nullable', 'array', new ValidBotLocaleKeys()],
      '*.options.*.name_localizations.*' => 'string|min:1|max:32',
      '*.options.*.description' => 'nullable|string|min:1|max:100',
      '*.options.*.description_localizations' => ['nullable', 'array', new ValidBotLocaleKeys()],
      '*.options.*.description_localizations.*' => 'string|min:1|max:100',
      '*.options.*.choices.*' => 'array|nullable|min:1|max:25',
      '*.options.*.choices.*.name' => 'string|min:1|max:32',
      '*.options.*.choices.*.name_localizations' => ['nullable', 'array', new ValidBotLocaleKeys()],
      '*.options.*.choices.*.name_localizations.*' => 'string|min:1|max:100',
      '*.options.*.choices.*.value' => [
        'required',
        Rule::anyOf([
          'string|min:1|max:100',
          'numeric',
        ]),
      ],
    ];
  }
}
