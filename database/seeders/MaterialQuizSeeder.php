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
                ['question' => 'Kromosom nomor berapakah yang mengalami kelebihan pada individu dengan Down Syndrome?', 'a' => '21', 'b' => '22', 'c' => '23', 'd' => '18', 'answer' => 'a'],
                ['question' => 'Siapakah organisasi di Indonesia yang menjadi wadah bagi orang tua anak dengan Down Syndrome?', 'a' => 'POTADS', 'b' => 'KONI', 'c' => 'PGRI', 'd' => 'IDAI', 'answer' => 'a'],
                ['question' => 'Apa kepanjangan dari POTADS?', 'a' => 'Persatuan Orang Tua Anak dengan Down Syndrome', 'b' => 'Pusat Orang Tua Anak Down Syndrome', 'c' => 'Perkumpulan Orang Tua Anak Disabilitas', 'd' => 'Persatuan Orang Tua Anak Disabilitas Seluruhnya', 'answer' => 'a']
            ],
            [
                ['question' => 'Kapan waktu yang paling tepat untuk memberikan stimulasi bagi anak Down Syndrome?', 'a' => 'Sedini mungkin (Sejak bayi)', 'b' => 'Setelah usia sekolah', 'c' => 'Setelah dewasa', 'd' => 'Hanya saat sakit', 'answer' => 'a'],
                ['question' => 'Stimulasi apa yang fokus pada kemampuan gerak otot besar seperti berjalan?', 'a' => 'Motorik Kasar', 'b' => 'Motorik Halus', 'c' => 'Wicara', 'd' => 'Kognitif', 'answer' => 'a']
            ]
        ];

        foreach ($materials as $index => $material) {
            $quizSet = $quizzes[$index % count($quizzes)];
            foreach ($quizSet as $q) {
                \App\Models\Quiz::create([
                    'material_id' => $material->id,
                    'question' => $q['question'],
                    'option_a' => $q['a'],
                    'option_b' => $q['b'],
                    'option_c' => $q['c'],
                    'option_d' => $q['d'],
                    'correct_answer' => $q['answer']
                ]);
            }
        }
    }
}
