<?php

namespace App\Services;

use App\Models\Rule;
use App\Models\Symptom;

class CertaintyFactorService
{
  public function calculate(array $answers)
  {
    $rules = Rule::with('diagnosis')->get();
    $results = [];
    foreach ($rules as $rule) {
      $ruleSymptoms = explode(',', $rule->symptoms);
      $matched = array_filter(
        $ruleSymptoms,
        fn($code) => isset($answers[$code]) && $answers[$code] > 0
      );
      if (empty($matched)) {
        continue;
      }
      $matchPercentage = count($matched) / count($ruleSymptoms);
      $totalCf = 0;
      foreach ($matched as $code) {
        $totalCf += $answers[$code];
      }
      $averageCfUser = $totalCf / count($matched);
      $cfRule = $matchPercentage * $averageCfUser * $rule->cf_expert;
      $diagnosisId = $rule->diagnosis_id;
      if (!isset($results[$diagnosisId])) {
        $results[$diagnosisId] = [
          'diagnosis' => $rule->diagnosis,
          'cf' => $cfRule,
          'matched' => $matched
        ];
      } else {
        $old = $results[$diagnosisId]['cf'];
        $results[$diagnosisId]['cf'] = $old + ($cfRule * (1 - $old));
        $results[$diagnosisId]['matched'] = array_unique(
          array_merge(
            $results[$diagnosisId]['matched'],
            $matched
          )
        );
      }
    }
    foreach ($results as &$result) {
      $result['percentage'] = round($result['cf'] * 100);
      $symptoms = Symptom::whereIn('code', $result['matched'])->pluck('name')->toArray();
      $result['reason'] = 'Diagnosis ini dipilih karena Anda mengalami gejala ' . implode(', ', $symptoms) . '.';
    }
    usort($results, fn($a, $b) => $b['cf'] <=> $a['cf']);
    return array_slice($results, 0, 3);
  }
}
