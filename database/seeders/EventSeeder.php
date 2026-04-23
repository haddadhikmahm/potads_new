<?php

namespace Database\Seeders;

use App\Models\Event;
use Illuminate\Database\Seeder;

class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $events = [
            [
                'title' => 'Webinar Inklusi: Memahami Down Syndrome',
                'description' => 'Webinar daring yang membahas tentang apa itu Down Syndrome dan bagaimana cara memberikan dukungan terbaik bagi anak-anak agar dapat berkembang optimal.',
                'event_date' => now()->addDays(7),
                'location' => 'Zoom Meeting',
                'status' => 'mendatang',
            ],
            [
                'title' => 'Workshop Kerajinan Tangan Anak Luar Biasa',
                'description' => 'Pelatihan membuat kerajinan tangan sederhana untuk melatih motorik halus anak-anak ADS (Anak dengan Down Syndrome).',
                'event_date' => now()->addDays(14),
                'location' => 'Sekretariat POTADS Jabar, Bandung',
                'status' => 'mendatang',
            ],
            [
                'title' => 'Senam Ceria Sahabat POTADS',
                'description' => 'Kegiatan rutin senam pagi bersama anak-anak dan orang tua anggota POTADS untuk menjaga kesehatan dan menjalin silaturahmi.',
                'event_date' => now()->subDays(2),
                'location' => 'Gedung Sate, Bandung',
                'status' => 'aktif',
            ],
            [
                'title' => 'Seminar Nutrisi & Gizi Seimbang',
                'description' => 'Seminar mendalam mengenai pola makan dan nutrisi yang tepat untuk menunjang tumbuh kembang anak-anak penyandang Down Syndrome.',
                'event_date' => now()->addDays(30),
                'location' => 'Hotel Horison, Bandung',
                'status' => 'draft',
            ],
        ];

        foreach ($events as $event) {
            Event::updateOrCreate(['title' => $event['title']], $event);
        }
    }
}
