<?php

namespace Database\Seeders;

use App\Models\Customer;
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

//            $chunks = 100;
//            $chunkSize = 10;
//            for ($i = 0; $i < $chunks; $i++) {
//                $data = [];
//                for ($j = 0; $j < $chunkSize; $j++) {
//                    $data[] = [
//                        'admin_id' => 1,
//                        'name' => fake()->name(),
//                        'phone' => fake()->phoneNumber,
//                        'phone2' => fake()->phoneNumber,
//                        'phone3' => fake()->phoneNumber,
//                        'id_number' => fake()->unique()->randomNumber(),
//                        'address_id' => fake()->address,
//                        'address' => fake()->address,
//                        'center' => fake()->address,
//                        'governorate' => fake()->address,
//                        'note' => fake()->text(100),
//                        'id_image_front' => 'image',
//                        'id_image_back' => 'image',
//                    ];
//                }
//              $customers =  DB::table('customers')->insert($data);
//            }


            for ($j = 0; $j < 500; $j++) {
                $data= [
                    'admin_id' => 1,
                    'name' => fake()->name(),
                    'phone' => fake()->unique()->numberBetween(100000000000, 999999999999),
                    'phone2' => fake()->unique()->numberBetween(100000000000, 999999999999),
                    'phone3' => fake()->unique()->numberBetween(100000000000, 9999999999),
                    'id_number' => fake()->unique()->numberBetween(10000000000000, 99999999999999),
                    'address_id' => fake()->address,
                    'address' => fake()->address,
                    'center' => fake()->address,
                    'governorate' => fake()->address,
                    'note' => fake()->text(100),
                    'id_image' => 'image',
                ];
                $customer = Customer::create($data);
                $customer->relatives()->create([
                    'name' => fake()->name(),
                    'phone' => fake()->phoneNumber,
                    'note' => fake()->text(100),
                ]);
            }
        }

    }
}
