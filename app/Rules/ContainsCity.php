<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class ContainsCity implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string, ?string=): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $cities = config('pakistan.cities');

        foreach ($cities as $city) {
            if (stripos($value, $city) !== false) {
                return;
            }
        }

        $fail('The :attribute must contain a valid Pakistani city name.');
    }
}
