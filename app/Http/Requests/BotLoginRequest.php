<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BotLoginRequest extends FormRequest {
  /**
   * Determine if the user is authorized to make this request.
   */
  public function authorize():bool {
    return is_numeric($this->route('discordUserId')) && is_string($this->route('locale'));
  }

  /**
   * Get the validation rules that apply to the request.
   *
   * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
   */
  public function rules():array {
    return [
      'name' => ['required', 'string', 'max:32'],
      'display_name' => ['nullable', 'string', 'max:32'],
      'discriminator' => ['required', 'integer', 'min:0', 'max:9999'],
      'avatar' => ['nullable', 'string', 'max:64'],
    ];
  }
}
