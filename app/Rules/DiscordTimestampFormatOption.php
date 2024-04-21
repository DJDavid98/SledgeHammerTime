<?php

namespace App\Rules;

use App\Enums\DiscordTimestampFormat;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class DiscordTimestampFormatOption implements ValidationRule {
  /**
   * Run the validation rule.
   *
   * @param \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString $fail
   */
  public function validate(string $attribute, mixed $value, Closure $fail):void {
    if (DiscordTimestampFormat::tryFrom($value) === null){
      $fail('validation.format')->translate([
        'attribute' => $attribute,
      ]);
    }
  }
}
