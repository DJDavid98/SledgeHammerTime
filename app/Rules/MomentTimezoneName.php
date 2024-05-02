<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class MomentTimezoneName implements ValidationRule {
  protected $validTimezoneNames = [];

  public function __construct() {
    $latestData = $this->readMomentTimezonePackedData();
    $this->validTimezoneNames = [
      ...array_map(fn($zoneString) => explode('|', $zoneString, 2)[0], $latestData['zones']),
      ...array_map(fn($linkString) => explode('|', $linkString, 2)[1], $latestData['links']),
    ];
  }

  protected function readMomentTimezonePackedData() {
    $dataPath = base_path('node_modules/moment-timezone/data/packed/latest.json');

    $jsonData = file_get_contents($dataPath);

    return json_decode($jsonData, true);
  }

  /**
   * Run the validation rule.
   *
   * @param \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString $fail
   */
  public function validate(string $attribute, mixed $value, Closure $fail):void {
    if (!in_array($value, $this->validTimezoneNames, true)){
      $fail('validation.timezone')->translate([
        'attribute' => $attribute,
      ]);
    }
  }
}
