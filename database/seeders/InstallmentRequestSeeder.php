<?php

namespace Database\Seeders;

use App\Models\Customer;
use App\Models\InstallmentRequest;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class InstallmentRequestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $customers = collect(Customer::whiteList()->get('id')->pluck('id')->toArray());

        for ($j = 0; $j < 100; $j++) {
            $data = [
                'admin_id' => 1,
                'customer_id' => $customers->random(),
                'price' => fake()->numberBetween(10000, 99999),
                'deposit' => fake()->randomNumber(4),
                'product' =>  fake()->text(100),
            ];

            $installmentRequestSeeder = InstallmentRequest::create($data);
            $installmentRequestSeeder->customers()->attach($customers->random(30));
        }
    }
}
