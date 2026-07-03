<?php

namespace Database\Seeders;

use App\Models\Diagnosis;
use Illuminate\Database\Seeder;

class DiagnosisSeeder extends Seeder
{
    public function run(): void
    {

        Diagnosis::insert([
            [
                'code' => 'D01',
                'name' => 'Morning sickness',
                'status' => 'normal',
                'solution' => 'Istirahat dan makan sedikit tetapi sering'
            ],
            [
                'code' => 'D02',
                'name' => 'Mual muntah sedang',
                'status' => 'perlu_kontrol',
                'solution' => 'Konsultasi ke bidan'
            ],
            [
                'code' => 'D03',
                'name' => 'Hiperemesis gravidarum',
                'status' => 'perlu_kontrol',
                'solution' => 'Periksa ke fasilitas kesehatan'
            ],
            [
                'code' => 'D04',
                'name' => 'Anemia',
                'status' => 'perlu_kontrol',
                'solution' => 'Konsumsi tablet tambah darah'
            ],
            [
                'code' => 'D05',
                'name' => 'Nyeri kehamilan normal',
                'status' => 'normal',
                'solution' => 'Istirahat'
            ],
            [
                'code' => 'D06',
                'name' => 'Risiko keguguran',
                'status' => 'perlu_kontrol',
                'solution' => 'Segera ke fasilitas kesehatan'
            ],
            [
                'code' => 'D07',
                'name' => 'Edema',
                'status' => 'perlu_kontrol',
                'solution' => 'Kurangi aktivitas'
            ],
            [
                'code' => 'D08',
                'name' => 'Preeklamsia',
                'status' => 'perlu_kontrol',
                'solution' => 'Segera periksa'
            ],
            [
                'code' => 'D09',
                'name' => 'Infeksi',
                'status' => 'perlu_kontrol',
                'solution' => 'Periksa ke bidan'
            ],
            [
                'code' => 'D10',
                'name' => 'Gangguan janin',
                'status' => 'perlu_kontrol',
                'solution' => 'Segera periksa'
            ],
            [
                'code' => 'D11',
                'name' => 'Dehidrasi',
                'status' => 'perlu_kontrol',
                'solution' => 'Perbanyak cairan'
            ],
            [
                'code' => 'D12',
                'name' => 'Sembelit pada kehamilan',
                'status' => 'normal',
                'solution' => 'Perbanyak serat'
            ],
            [
                'code' => 'D13',
                'name' => 'Infeksi saluran kemih',
                'status' => 'perlu_kontrol',
                'solution' => 'Periksa ke dokter'
            ],
            [
                'code' => 'D14',
                'name' => 'Hipertensi kehamilan',
                'status' => 'perlu_kontrol',
                'solution' => 'Kontrol tekanan darah'
            ],
            [
                'code' => 'D15',
                'name' => 'Solusio plasenta',
                'status' => 'perlu_kontrol',
                'solution' => 'Segera ke fasilitas kesehatan'
            ],
            [
                'code' => 'D16',
                'name' => 'Kehamilan ektopik',
                'status' => 'perlu_kontrol',
                'solution' => 'Segera ke fasilitas kesehatan'
            ],
            [
                'code' => 'D17',
                'name' => 'Janin kurang berkembang',
                'status' => 'perlu_kontrol',
                'solution' => 'Periksa USG'
            ],
            [
                'code' => 'D18',
                'name' => 'Gawat janin',
                'status' => 'perlu_kontrol',
                'solution' => 'Segera ke fasilitas kesehatan'
            ],
            [
                'code' => 'D19',
                'name' => 'Diabetes gestasional',
                'status' => 'perlu_kontrol',
                'solution' => 'Cek gula darah'
            ],
            [
                'code' => 'D20',
                'name' => 'Gangguan nutrisi ibu',
                'status' => 'perlu_kontrol',
                'solution' => 'Perbaiki pola makan'
            ]
        ]);
    }
}
