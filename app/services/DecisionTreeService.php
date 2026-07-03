<?php

namespace App\Services;

use App\Models\Rule;
use App\Models\Symptom;

class DecisionTreeService
{
  public function getNextSymptom(array $selected, array $asked = [])
  {
    $rules = Rule::all();
    $counter = [];
    foreach ($rules as $rule) {
      $codes = explode(',', $rule->symptoms);
      if (count(array_intersect($selected, $codes)) === 0) {
        continue;
      }
      foreach ($codes as $code) {
        if (in_array($code, $selected)) {
          continue;
        }
        if (in_array($code, $asked)) {
          continue;
        }
        $counter[$code] = ($counter[$code] ?? 0) + 1;
      }
    }
    if (empty($counter)) {
      return null;
    }
    arsort($counter);
    $nextCode = array_key_first($counter);
    return Symptom::where('code', $nextCode)->first();
  }

  public function getProgress(array $selected, array $asked = [])
  {
    $rules = Rule::all();
    $candidate = [];
    foreach ($rules as $rule) {
      $codes = explode(',', $rule->symptoms);
      if (count(array_intersect($selected, $codes)) === 0) {
        continue;
      }
      foreach ($codes as $code) {
        $candidate[$code] = true;
      }
    }
    $total = count($candidate);
    if ($total === 0) {
      return 100;
    }
    $known = count(array_unique(array_merge($selected, $asked)));
    return min(round(($known / $total) * 100), 100);
  }
}
