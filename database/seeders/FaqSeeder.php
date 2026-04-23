<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Faq;

class FaqSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faqs = [
            [
                'question' => 'Apa itu Down Syndrome?',
                'answer' => 'Down Syndrome adalah kondisi genetik di mana seseorang memiliki ekstra kromosom ke-21. Kondisi ini menyebabkan keterlambatan perkembangan fisik dan kognitif.',
                'order' => 1,
            ],
            [
                'question' => 'Kapan waktu terbaik mulai terapi?',
                'answer' => 'Intervensi dini sangat penting. Sebaiknya dimulai sesegera mungkin setelah bayi didiagnosa, biasanya sejak usia beberapa bulan.',
                'order' => 2,
            ],
            [
                'question' => 'Bagaimana cara mendaftar jadi member POTADS?',
                'answer' => 'Anda bisa mendaftar langsung melalui website ini di menu Registrasi atau menghubungi sekretariat wilayah terdekat.',
                'order' => 3,
            ],
            [
                'question' => 'Apakah anak Down Syndrome bisa sekolah umum?',
                'answer' => 'Bisa. Banyak anak dengan Down Syndrome yang berhasil belajar di sekolah inklusi dengan dukungan yang tepat.',
                'order' => 4,
            ],
            [
                'question' => 'Apa saja program rutin POTADS?',
                'answer' => 'Program kami meliputi seminar edukasi, pelatihan orang tua, gathering keluarga, hingga kegiatan seni dan olahraga untuk anak-anak.',
                'order' => 5,
            ],
        ];

        foreach ($faqs as $faq) {
            Faq::create($faq);
        }
    }
}
