<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Material;

class MaterialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $materials = [
            [
                'title' => 'Mengenal Down Syndrome',
                'description' => 'Video edukasi lengkap mengenai apa itu Down Syndrome dan bagaimana cara menghadapinya.',
                'type' => 'video',
                'url' => 'https://www.youtube.com/watch?v=5M--xOyGuXk',
                'category' => 'Edukasi',
            ],
            [
                'title' => 'Panduan Stimulasi Dini',
                'description' => 'E-book panduan langkah demi langkah untuk stimulasi dini anak dengan Down Syndrome.',
                'type' => 'file',
                'file_path' => 'materials/panduan_stimulasi.pdf',
                'category' => 'Panduan',
            ],
            [
                'title' => 'Nutrisi untuk Tumbuh Kembang',
                'description' => 'Video seminar bersama ahli gizi mengenai kebutuhan nutrisi khusus.',
                'type' => 'video',
                'url' => 'https://www.youtube.com/watch?v=Jm0783PZ-yY',
                'category' => 'Kesehatan',
            ],
            [
                'title' => 'Terapi Wicara di Rumah',
                'description' => 'Tips dan trik melakukan terapi wicara mandiri untuk anak.',
                'type' => 'video',
                'url' => 'https://www.youtube.com/watch?v=LqUon18E8Xk',
                'category' => 'Terapi',
            ],
            [
                'title' => 'Modul Latihan Motorik Kasar',
                'description' => 'Kumpulan gerakan latihan untuk melatih otot besar anak.',
                'type' => 'file',
                'file_path' => 'materials/latihan_motorik.pdf',
                'category' => 'Latihan',
            ],
        ];

        foreach ($materials as $material) {
            Material::create($material);
        }
    }
}
