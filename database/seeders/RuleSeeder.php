<?php

namespace Database\Seeders;

use App\Models\Rule;
use App\Models\Diagnosis;
use Illuminate\Database\Seeder;

class RuleSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            ['code' => 'R01', 'symptoms' => 'G01,G06', 'diagnosis' => 'D01', 'cf' => 0.6],
            ['code' => 'R02', 'symptoms' => 'G01,G02', 'diagnosis' => 'D01', 'cf' => 0.8],
            ['code' => 'R03', 'symptoms' => 'G01,G05', 'diagnosis' => 'D01', 'cf' => 0.8],
            ['code' => 'R04', 'symptoms' => 'G01,G02,G06', 'diagnosis' => 'D01', 'cf' => 1.0],

            ['code' => 'R05', 'symptoms' => 'G02,G05', 'diagnosis' => 'D02', 'cf' => 0.6],
            ['code' => 'R06', 'symptoms' => 'G02,G06', 'diagnosis' => 'D02', 'cf' => 0.8],
            ['code' => 'R07', 'symptoms' => 'G02,G04', 'diagnosis' => 'D02', 'cf' => 1.0],
            ['code' => 'R08', 'symptoms' => 'G02,G05,G06', 'diagnosis' => 'D02', 'cf' => 1.0],

            ['code' => 'R09', 'symptoms' => 'G03,G05', 'diagnosis' => 'D03', 'cf' => 1.0],
            ['code' => 'R10', 'symptoms' => 'G03,G06', 'diagnosis' => 'D03', 'cf' => 1.0],
            ['code' => 'R11', 'symptoms' => 'G03,G05,G06', 'diagnosis' => 'D03', 'cf' => 1.0],
            ['code' => 'R12', 'symptoms' => 'G03,G02,G05', 'diagnosis' => 'D03', 'cf' => 1.0],

            ['code' => 'R13', 'symptoms' => 'G04,G05', 'diagnosis' => 'D04', 'cf' => 0.4],
            ['code' => 'R14', 'symptoms' => 'G04,G05,G06', 'diagnosis' => 'D04', 'cf' => 0.4],
            ['code' => 'R15', 'symptoms' => 'G04,G05,G02', 'diagnosis' => 'D04', 'cf' => 0.4],

            ['code' => 'R16', 'symptoms' => 'G07,G05', 'diagnosis' => 'D05', 'cf' => 0.6],
            ['code' => 'R17', 'symptoms' => 'G07,G04', 'diagnosis' => 'D05', 'cf' => 0.6],

            ['code' => 'R18', 'symptoms' => 'G08,G09', 'diagnosis' => 'D06', 'cf' => 1.0],
            ['code' => 'R19', 'symptoms' => 'G08,G09,G05', 'diagnosis' => 'D06', 'cf' => 1.0],
            ['code' => 'R20', 'symptoms' => 'G08,G09,G04', 'diagnosis' => 'D06', 'cf' => 1.0],

            ['code' => 'R21', 'symptoms' => 'G10,G05', 'diagnosis' => 'D07', 'cf' => 1.0],
            ['code' => 'R22', 'symptoms' => 'G10,G04', 'diagnosis' => 'D07', 'cf' => 1.0],

            ['code' => 'R23', 'symptoms' => 'G11,G12', 'diagnosis' => 'D08', 'cf' => 1.0],
            ['code' => 'R24', 'symptoms' => 'G10,G11', 'diagnosis' => 'D08', 'cf' => 1.0],
            ['code' => 'R25', 'symptoms' => 'G10,G12', 'diagnosis' => 'D08', 'cf' => 1.0],
            ['code' => 'R26', 'symptoms' => 'G10,G11,G12', 'diagnosis' => 'D08', 'cf' => 1.0],

            ['code' => 'R27', 'symptoms' => 'G13,G05', 'diagnosis' => 'D09', 'cf' => 0.4],
            ['code' => 'R28', 'symptoms' => 'G13,G14', 'diagnosis' => 'D09', 'cf' => 0.6],
            ['code' => 'R29', 'symptoms' => 'G13,G07', 'diagnosis' => 'D09', 'cf' => 0.4],
            ['code' => 'R30', 'symptoms' => 'G14,G05', 'diagnosis' => 'D09', 'cf' => 0.2],

            ['code' => 'R31', 'symptoms' => 'G15,G05', 'diagnosis' => 'D10', 'cf' => 1.0],
            ['code' => 'R32', 'symptoms' => 'G15,G04', 'diagnosis' => 'D10', 'cf' => 1.0],
            ['code' => 'R33', 'symptoms' => 'G15,G13', 'diagnosis' => 'D10', 'cf' => 1.0],

            ['code' => 'R34', 'symptoms' => 'G03,G05', 'diagnosis' => 'D11', 'cf' => 0.8],
            ['code' => 'R35', 'symptoms' => 'G03,G05,G18', 'diagnosis' => 'D11', 'cf' => 0.8],

            ['code' => 'R36', 'symptoms' => 'G16,G17', 'diagnosis' => 'D12', 'cf' => 1.0],
            ['code' => 'R37', 'symptoms' => 'G16,G07', 'diagnosis' => 'D12', 'cf' => 1.0],

            ['code' => 'R38', 'symptoms' => 'G13,G07,G14', 'diagnosis' => 'D13', 'cf' => 0.8],
            ['code' => 'R39', 'symptoms' => 'G13,G05,G07', 'diagnosis' => 'D13', 'cf' => 0.6],

            ['code' => 'R40', 'symptoms' => 'G11,G10', 'diagnosis' => 'D14', 'cf' => 0.8],
            ['code' => 'R41', 'symptoms' => 'G11,G04,G10', 'diagnosis' => 'D14', 'cf' => 1.0],

            ['code' => 'R42', 'symptoms' => 'G08,G09,G05', 'diagnosis' => 'D15', 'cf' => 0.8],
            ['code' => 'R43', 'symptoms' => 'G08,G09,G15', 'diagnosis' => 'D15', 'cf' => 1.0],

            ['code' => 'R44', 'symptoms' => 'G08,G09,G04', 'diagnosis' => 'D16', 'cf' => 1.0],
            ['code' => 'R45', 'symptoms' => 'G08,G09,G05,G04', 'diagnosis' => 'D16', 'cf' => 1.0],

            ['code' => 'R46', 'symptoms' => 'G15,G05', 'diagnosis' => 'D17', 'cf' => 0.8],
            ['code' => 'R47', 'symptoms' => 'G15,G06', 'diagnosis' => 'D17', 'cf' => 0.8],

            ['code' => 'R48', 'symptoms' => 'G15,G13', 'diagnosis' => 'D18', 'cf' => 1.0],
            ['code' => 'R49', 'symptoms' => 'G15,G09', 'diagnosis' => 'D18', 'cf' => 1.0],

            ['code' => 'R50', 'symptoms' => 'G18,G19', 'diagnosis' => 'D19', 'cf' => 1.0],
            ['code' => 'R51', 'symptoms' => 'G18,G19,G05', 'diagnosis' => 'D19', 'cf' => 1.0],

            ['code' => 'R52', 'symptoms' => 'G06,G05', 'diagnosis' => 'D20', 'cf' => 0.8],
            ['code' => 'R53', 'symptoms' => 'G06,G05,G04', 'diagnosis' => 'D20', 'cf' => 0.8],
        ];

        Rule::truncate();

        foreach ($data as $item) {
            $diagnosis = Diagnosis::where('code', $item['diagnosis'])->first();

            if (!$diagnosis) {
                continue;
            }

            Rule::create([
                'code' => $item['code'],
                'symptoms' => $item['symptoms'],
                'diagnosis_id' => $diagnosis->id,
                'cf_expert' => $item['cf'],
            ]);
        }
    }
}
