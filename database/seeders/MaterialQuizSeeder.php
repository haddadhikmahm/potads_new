<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MaterialQuizSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $materials = \App\Models\Material::all();
        
        $quizzes = [
            [
                ['question' => 'Kromosom nomor berapakah yang mengalami kelebihan pada individu dengan Down Syndrome?', 'options' => ['a' => '21', 'b' => '22', 'c' => '23', 'd' => '18'], 'answer' => 'a'],
                ['question' => 'Siapakah organisasi di Indonesia yang menjadi wadah bagi orang tua anak dengan Down Syndrome?', 'options' => ['a' => 'POTADS', 'b' => 'KONI', 'c' => 'PGRI', 'd' => 'IDAI'], 'answer' => 'a'],
                ['question' => 'Warna pita apa yang menjadi simbol kesadaran Down Syndrome?', 'options' => ['a' => 'Biru dan Kuning', 'b' => 'Merah dan Putih', 'c' => 'Hitam dan Putih', 'd' => 'Hijau dan Biru'], 'answer' => 'a']
            ],
            [
                ['question' => 'Kapan waktu yang paling tepat untuk memberikan stimulasi bagi anak Down Syndrome?', 'options' => ['a' => 'Sedini mungkin (Sejak bayi)', 'b' => 'Setelah usia sekolah', 'c' => 'Setelah dewasa', 'd' => 'Hanya saat sakit'], 'answer' => 'a'],
                ['question' => 'Stimulasi apa yang fokus pada kemampuan gerak otot besar seperti berjalan?', 'options' => ['a' => 'Motorik Kasar', 'b' => 'Motorik Halus', 'c' => 'Wicara', 'd' => 'Kognitif'], 'answer' => 'a']
            ],
            [
                ['question' => 'Pemeriksaan kesehatan apa yang sering disarankan secara berkala untuk anak Down Syndrome?', 'options' => ['a' => 'Fungsi Tiroid & Jantung', 'b' => 'Kesehatan kuku saja', 'c' => 'Warna rambut', 'd' => 'Tinggi badan saja'], 'answer' => 'a'],
                ['question' => 'Diet apa yang biasanya disarankan untuk anak dengan Down Syndrome?', 'options' => ['a' => 'Gizi seimbang & hindari gula berlebih', 'b' => 'Hanya makan nasi', 'c' => 'Diet tanpa air minum', 'd' => 'Makan makanan cepat saji'], 'answer' => 'a']
            ]
        ];

        foreach ($materials as $index => $material) {
            $quizIndex = $index % count($quizzes);
            $material->update([
                'quiz_data' => $quizzes[$quizIndex]
            ]);
        }
    }
}
