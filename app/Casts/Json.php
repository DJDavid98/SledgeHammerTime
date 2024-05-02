<?php

namespace App\Casts;

use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use Illuminate\Database\Eloquent\Model;

class Json implements CastsAttributes {
  /**
   * Cast the given value.
   *
   * @param array<string, mixed> $attributes
   */
  public function get(Model $model, string $key, mixed $value, array $attributes):mixed {
    return json_decode($value, true, flags: JSON_THROW_ON_ERROR);
  }

  /**
   * Prepare the given value for storage.
   *
   * @param array<string, mixed> $attributes
   */
  public function set(Model $model, string $key, mixed $value, array $attributes):string {
    return json_encode($value, JSON_THROW_ON_ERROR);
  }
}
