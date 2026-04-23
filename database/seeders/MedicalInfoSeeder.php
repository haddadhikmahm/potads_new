<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\MedicalInfo;
use Illuminate\Support\Str;

class MedicalInfoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $infos = [
            [
                'title' => 'Pentingnya Echocardiography pada Bayi Baru Lahir',
                'category' => 'medis',
                'content' => 'Kebanyakan bayi dengan Down Syndrome lahir dengan kelainan jantung bawaan. Oleh karena itu, pemeriksaan echo sangat krusial...',
                'status' => 'published',
            ],
            [
                'title' => 'Strategi Belajar Visual untuk Anak DS',
                'category' => 'akademis',
                'content' => 'Anak-anak dengan Down Syndrome cenderung menjadi pembelajar visual yang kuat. Menggunakan kartu gambar dapat membantu mereka...',
                'status' => 'published',
            ],
            [
                'title' => 'Menangani Hipotonia pada Balita',
                'category' => 'medis',
                'content' => 'Hipotonia atau kelemahan otot adalah ciri umum. Fisioterapi rutin dapat membantu memperkuat otot dasar tubuh...',
                'status' => 'published',
            ],
            [
                'title' => 'Kurikulum Modifikasi untuk Sekolah Inklusi',
                'category' => 'akademis',
                'content' => 'Sekolah inklusi membutuhkan kurikulum yang dimodifikasi sesuai dengan kemampuan masing-masing anak agar hasil maksimal...',
                'status' => 'published',
            ],
        ];

        foreach ($infos as $info) {
            $info['slug'] = Str::slug($info['title']);
            MedicalInfo::create($info);
        }
    }
}
