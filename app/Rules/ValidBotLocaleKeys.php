<?php

namespace App\Rules;

use App\Enums\DiscordBotLocales;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class ValidBotLocaleKeys implements ValidationRule {
  /**
   * Run the validation rule.
   *
   * @param \Closure(string, ?string=): \Illuminate\Translation\PotentiallyTranslatedString $fail
   */
  public function validate(string $attribute, mixed $value, Closure $fail):void {
    if (!is_array($value)){
      return;
    }

    $keys = array_keys($value);
    $invalidKeys = [];
    foreach ($keys as $key){
      if (DiscordBotLocales::tryFrom($key) === null){
        $invalidKeys[] = $key;
      }
    }
    if (count($invalidKeys) > 0){
      $fail("Invalid locale keys provided: ".implode(', ', $invalidKeys));
    }
  }
}
