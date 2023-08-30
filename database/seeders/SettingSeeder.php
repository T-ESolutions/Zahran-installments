<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Support\Facades\Cache;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            'site_name_ar' => 'Zahran',
            'site_name_en' => 'Zahran',
            'logo' => 'uploads/setting/zahran.png',
            'logo_login' => 'uploads/setting/zahran.png',
            'copyright' => 'جميع الحقوق محفوظة منصة Zahran، تنفيذ و تطوير بواسطة',
            'images_size' => '1000',
         ];

        Cache::forget('settings');
        Setting::setMany($data);
    }
}
