<?php

namespace App\Rules;

use App\Enums\TimestampMessageColumns;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class TimestampMessageColumnsOption implements ValidationRule {
  /**
   * Run the validation rule.
   *
   * @param \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString $fail
   */
  public function validate(string $attribute, mixed $value, Closure $fail):void {
    if (TimestampMessageColumns::tryFrom($value) === null){
      $fail('validation.columns')->translate([
        'attribute' => $attribute,
      ]);
    }
  }
}
