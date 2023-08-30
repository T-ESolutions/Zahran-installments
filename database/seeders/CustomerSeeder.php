<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (env('APP_DEBUG')) {
            $chunks = 100;
            $chunkSize = 10;
            for ($i = 0; $i < $chunks; $i++) {
                $data = [];
                for ($j = 0; $j < $chunkSize; $j++) {
                    $data[] = [
                        'admin_id' => 1,
                        'name' => fake()->name(),
                        'phone' => fake()->phoneNumber,
                        'phone2' => fake()->phoneNumber,
                        'phone3' => fake()->phoneNumber,
                        'id_number' => fake()->unique()->randomNumber(),
                        'address_id' => fake()->address,
                        'address' => fake()->address,
                        'center' => fake()->address,
                        'government' => fake()->address,
                        'note' => fake()->text(100),
                        'id_image_front' => 'image',
                        'id_image_back' => 'image',
                    ];
                }
                DB::table('customers')->insert($data);
            }
        }

    }
}
