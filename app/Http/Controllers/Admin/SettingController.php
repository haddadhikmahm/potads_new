<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{
    public function index()
    {
        $settings = Setting::all()->groupBy('group');
        
        // Ensure default settings exist if table is empty
        if ($settings->isEmpty()) {
            $this->seedDefaults();
            $settings = Setting::all()->groupBy('group');
        }
        
        return view('admin.settings.index', compact('settings'));
    }

    public function update(Request $request)
    {
        $inputs = $request->except('_token', '_method');
        
        foreach ($inputs as $key => $value) {
            $setting = Setting::where('key', $key)->first();
            if ($setting) {
                if ($setting->type === 'image' && $request->hasFile($key)) {
                    if ($setting->value) {
                        Storage::disk('public')->delete($setting->value);
                    }
                    $setting->value = $request->file($key)->store('settings', 'public');
                } else {
                    $setting->value = $value;
                }
                $setting->save();
            }
        }

        return redirect()->route('admin.settings.index')->with('success', 'Pengaturan berhasil diperbarui.');
    }

    private function seedDefaults()
    {
        $defaults = [
            ['key' => 'site_name', 'value' => 'POTADS', 'label' => 'Nama Situs', 'type' => 'text', 'group' => 'general'],
            ['key' => 'site_description', 'value' => 'Persatuan Orang Tua Anak dengan Down Syndrome', 'label' => 'Deskripsi Situs', 'type' => 'textarea', 'group' => 'general'],
            ['key' => 'contact_email', 'value' => 'info@potads.org', 'label' => 'Email Kontak', 'type' => 'text', 'group' => 'contact'],
            ['key' => 'contact_phone', 'value' => '021-1234567', 'label' => 'Telepon Kontak', 'type' => 'text', 'group' => 'contact'],
            ['key' => 'social_facebook', 'value' => 'https://facebook.com/potads', 'label' => 'Facebook URL', 'type' => 'text', 'group' => 'social'],
            ['key' => 'social_instagram', 'value' => 'https://instagram.com/potads', 'label' => 'Instagram URL', 'type' => 'text', 'group' => 'social'],
        ];

        foreach ($defaults as $default) {
            Setting::create($default);
        }
    }
}
