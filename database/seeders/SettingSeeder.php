<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Setting;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $settings = [
            ['key' => 'site_name', 'value' => 'PIK POTADS', 'label' => 'Nama Situs', 'type' => 'text', 'group' => 'general'],
            ['key' => 'site_description', 'value' => 'Pusat Informasi & Konsultasi Persatuan Orang Tua Anak dengan Down Syndrome', 'label' => 'Deskripsi Situs', 'type' => 'textarea', 'group' => 'general'],
            ['key' => 'contact_email', 'value' => 'jawabarat@potads.org', 'label' => 'Email Kontak', 'type' => 'text', 'group' => 'contact'],
            ['key' => 'contact_phone', 'value' => '+62 812-3456-7890', 'label' => 'Telepon Kontak', 'type' => 'text', 'group' => 'contact'],
            ['key' => 'contact_address', 'value' => 'Jl. Braga No. 123, Bandung, Jawa Barat', 'label' => 'Alamat', 'type' => 'textarea', 'group' => 'contact'],
            ['key' => 'social_facebook', 'value' => 'https://facebook.com/potads.jabar', 'label' => 'Facebook URL', 'type' => 'text', 'group' => 'social'],
            ['key' => 'social_instagram', 'value' => 'https://instagram.com/potads_jabar', 'label' => 'Instagram URL', 'type' => 'text', 'group' => 'social'],
            ['key' => 'social_youtube', 'value' => 'https://youtube.com/@potads', 'label' => 'Youtube URL', 'type' => 'text', 'group' => 'social'],
        ];

        foreach ($settings as $setting) {
            Setting::updateOrCreate(['key' => $setting['key']], $setting);
        }
    }
}
