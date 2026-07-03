<?php

namespace Database\Seeders;

use App\Models\Symptom;
use Illuminate\Database\Seeder;

class SymptomSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            ['code' => 'G01', 'name' => 'Mual'],
            ['code' => 'G02', 'name' => 'Muntah'],
            ['code' => 'G03', 'name' => 'Muntah berlebihan'],
            ['code' => 'G04', 'name' => 'Pusing'],
            ['code' => 'G05', 'name' => 'Lemas'],
            ['code' => 'G06', 'name' => 'Nafsu makan menurun'],
            ['code' => 'G07', 'name' => 'Nyeri perut'],
            ['code' => 'G08', 'name' => 'Nyeri perut hebat'],
            ['code' => 'G09', 'name' => 'Perdarahan'],
            ['code' => 'G10', 'name' => 'Kaki bengkak'],
            ['code' => 'G11', 'name' => 'Sakit kepala berat'],
            ['code' => 'G12', 'name' => 'Penglihatan kabur'],
            ['code' => 'G13', 'name' => 'Demam'],
            ['code' => 'G14', 'name' => 'Keputihan abnormal'],
            ['code' => 'G15', 'name' => 'Gerakan janin berkurang'],
            ['code' => 'G16', 'name' => 'Sulit buang air besar'],
            ['code' => 'G17', 'name' => 'Perut terasa kembung/penuh'],
            ['code' => 'G18', 'name' => 'Sering haus'],
            ['code' => 'G19', 'name' => 'Sering buang air kecil']
        ];

        foreach ($data as $item) {
            Symptom::create($item);
        }
    }
}
