<?php

namespace Database\Seeders;

use App\Models\Article;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ArticleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = User::where('role', 'admin')->first();
        
        if (!$admin) {
            return;
        }

        $articles = [
            [
                'title' => 'Mendidik Anak dengan Down Syndrome: Panduan untuk Orang Tua Baru',
                'content' => 'Menerima diagnosis Down Syndrome bagi anak tercinta tentu memberikan rasa campur aduk. Namun, ingatlah bahwa Anda tidak sendiri. Artikel ini membahas langkah-langkah awal yang dapat dilakukan orang tua untuk memberikan stimulasi yang tepat sejak dini...',
                'category' => 'Tips Parenting',
                'status' => 'published',
            ],
            [
                'title' => 'Pentingnya Terapi Okupasi bagi Tumbuh Kembang Motorik Anak',
                'content' => 'Terapi okupasi membantu anak-anak dengan kebutuhan khusus untuk belajar melakukan aktivitas harian secara mandiri. Bagi anak ADS, terapi ini sangat krusial untuk melatih kekuatan otot tangan dan koordinasi mata-tangan...',
                'category' => 'Kesehatan',
                'status' => 'published',
            ],
            [
                'title' => 'Kisah Inspiratif: Muhammad, Atlet Renang Kebanggaan POTADS Jabar',
                'content' => 'Siapa bilang anak-anak dengan Down Syndrome tidak bisa berprestasi? Kenalkan Muhammad, seorang remaja hebat yang telah memenangkan berbagai medali emas di kejuaraan renang paralimpik tingkat nasional...',
                'category' => 'Inspirasi',
                'status' => 'published',
            ],
            [
                'title' => 'Persiapan Memasuki Sekolah Inklusi',
                'content' => 'Menentukan sekolah yang tepat adalah keputusan besar. Sekolah inklusi menawarkan lingkungan di mana anak-anak ADS dapat belajar bersama rekan sebaya mereka tanpa hambatan, namun ada beberapa hal yang perlu dipersiapkan oleh orang tua dan sekolah...',
                'category' => 'Edukasi',
                'status' => 'draft',
            ],
        ];

        foreach ($articles as $article) {
            Article::updateOrCreate(
                ['title' => $article['title']],
                array_merge($article, [
                    'slug' => Str::slug($article['title']),
                    'author_id' => $admin->id,
                ])
            );
        }
    }
}
