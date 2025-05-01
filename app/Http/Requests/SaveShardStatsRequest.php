<?php

namespace App\Http\Requests;

use Auth;
use Illuminate\Foundation\Http\FormRequest;

class SaveShardStatsRequest extends FormRequest {
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
      'id' => 'required|integer|min:0',
      'server_count' => 'required|integer|min:0',
      'member_count' => 'present|nullable|integer|min:0',
      'started_at' => 'required|date',
    ];
  }
}
