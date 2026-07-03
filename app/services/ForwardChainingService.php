<?php

namespace App\Services;

use App\Models\Rule;
use App\Models\Symptom;

class ForwardChainingService
{
  public function diagnose(array $selectedSymptoms, array $cfUser = [])
  {
    $rules = Rule::with('diagnosis')->get();
    $results = [];
    $rejectedRules = [];

    foreach ($rules as $rule) {
      $ruleSymptoms = explode(',', $rule->symptoms);
      $matched = array_intersect($ruleSymptoms, $selectedSymptoms);

      /*
            |--------------------------------------------------------------------------
            | RULE TIDAK TERPENUHI
            |--------------------------------------------------------------------------
            */
      if (count($matched) !== count($ruleSymptoms)) {
        if (count($matched) > 0) {
          $missingCodes = array_diff($ruleSymptoms, $selectedSymptoms);
          $missingNames = Symptom::whereIn('code', $missingCodes)->pluck('name')->toArray();
          $rejectedRules[] = [
            'rule_code' => $rule->code,
            'diagnosis' => $rule->diagnosis->name,
            'missing_symptoms' => $missingNames,
          ];
        }
        continue;
      }

      /*
            |--------------------------------------------------------------------------
            | CF EVIDENCE
            |--------------------------------------------------------------------------
            */
      $userValues = [];
      foreach ($ruleSymptoms as $code) {
        $userValues[] = $cfUser[$code] ?? 1;
      }
      $cfEvidence = min($userValues);

      /*
            |--------------------------------------------------------------------------
            | CF RULE
            |--------------------------------------------------------------------------
            */
      $cfRule = $cfEvidence * $rule->cf_expert;
      $diagnosisId = $rule->diagnosis_id;

      /*
            |--------------------------------------------------------------------------
            | DETAIL RULE
            |--------------------------------------------------------------------------
            */
      $ruleDetail = [
        'rule_code' => $rule->code,
        'rule_symptoms' => $ruleSymptoms,
        'cf_user' => $userValues,
        'cf_evidence' => $cfEvidence,
        'cf_expert' => $rule->cf_expert,
        'cf_rule' => round($cfRule, 4),
      ];

      /*
            |--------------------------------------------------------------------------
            | HASIL PERTAMA
            |--------------------------------------------------------------------------
            */
      if (!isset($results[$diagnosisId])) {
        $results[$diagnosisId] = [
          'diagnosis' => $rule->diagnosis,
          'cf' => $cfRule,
          'matched' => $matched,
          'matched_names' => Symptom::whereIn('code', $matched)->pluck('name')->toArray(),
          'fired_rules' => [$rule->code],
          'calculations' => [$ruleDetail],
          'combine_steps' => [],
        ];
      } else {
        /*
                |--------------------------------------------------------------------------
                | CF COMBINE
                |--------------------------------------------------------------------------
                */
        $old = $results[$diagnosisId]['cf'];
        $new = $old + ($cfRule * (1 - $old));

        $results[$diagnosisId]['combine_steps'][] = [
          'old' => round($old, 4),
          'rule' => round($cfRule, 4),
          'result' => round($new, 4),
        ];

        $results[$diagnosisId]['cf'] = $new;
        $results[$diagnosisId]['matched'] = array_unique(
          array_merge($results[$diagnosisId]['matched'], $matched)
        );
        $results[$diagnosisId]['matched_names'] = Symptom::whereIn(
          'code',
          $results[$diagnosisId]['matched']
        )->pluck('name')->toArray();
        $results[$diagnosisId]['fired_rules'][] = $rule->code;
        $results[$diagnosisId]['calculations'][] = $ruleDetail;
      }
    }

    if (empty($results)) {
      return null;
    }

    /*
        |--------------------------------------------------------------------------
        | PERSENTASE DAN DESKRIPSI
        |--------------------------------------------------------------------------
        */
    foreach ($results as &$result) {
      $result['percentage'] = round($result['cf'] * 100);

      $result['reason'] = 'Sistem menemukan kecocokan pada gejala '
        . implode(', ', $result['matched_names'])
        . '. Berdasarkan pola gejala tersebut, kondisi ini menjadi kemungkinan yang paling sesuai.';

      /*
            |--------------------------------------------------------------------------
            | EXPLANATION FACILITY
            |--------------------------------------------------------------------------
            */
      $result['explanation'] = [
        'how' => 'Sistem menganalisis gejala yang Anda pilih dan membandingkannya dengan basis pengetahuan yang dimiliki. Beberapa gejala yang Anda alami memiliki pola yang sesuai dengan kondisi '
          . $result['diagnosis']->name
          . '.',
        'why' => 'Selama konsultasi, sistem mengajukan beberapa pertanyaan tambahan karena gejala-gejala tersebut diperlukan untuk membedakan beberapa kondisi yang memiliki kemiripan gejala sehingga hasil diagnosis dapat lebih akurat.',
        'what_if' => 'Sistem juga mempertimbangkan beberapa kemungkinan kondisi lainnya. Namun kondisi tersebut tidak dipilih sebagai hasil utama karena terdapat gejala penting yang belum terpenuhi.',
      ];
    }

    usort($results, fn($a, $b) => $b['cf'] <=> $a['cf']);
    $results = array_slice($results, 0, 3);

    /*
        |--------------------------------------------------------------------------
        | TAMBAHKAN REJECTED RULES KE HASIL
        |--------------------------------------------------------------------------
        */
    foreach ($results as &$result) {
      $result['rejected_rules'] = $rejectedRules;
    }

    return $results;
  }
}
