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
            'copyright' => 'جميع الحقوق محفوظة شركة Zahran، تنفيذ و تطوير بواسطة شركة TES',
            'images_size' => '1000',
            'monthly_profit_percent' => 30,


            'check_amount' => 5000,
            'first_name' => 'Zahran',
            'second_name' => 'Zahran',
            'third_name' => 'Zahran',
            'fourth_name' => 'Zahran',
            'discount_percentage' => 1.5,

        ];

        Cache::forget('settings');
        Setting::setMany($data);
    }
}
