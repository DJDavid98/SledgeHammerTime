<?php

namespace App\Rules;

use App\Models\BotTimezone;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class ValidTimezone implements ValidationRule {
  protected const OFFSET_ZONE_REGEX = '/^(Etc\/)?(?:GMT|UTC)\+?(-?\d{1,2})(?::?(\d{2}))?$/i';

  /**
   * Run the validation rule.
   *
   * @param \Closure(string, ?string=): \Illuminate\Translation\PotentiallyTranslatedString $fail
   */
  public function validate(string $attribute, mixed $value, Closure $fail):void {
    if (preg_match(self::OFFSET_ZONE_REGEX, $value)){
      // Allow simple UTC offset
      return;
    }
    if (BotTimezone::where('name', $value)->exists()){
      // Allow known valid timezone names
      return;
    }
    $fail('validation.timezone')->translate([
      'attribute' => $attribute,
    ]);
  }
}
