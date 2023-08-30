<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Async\Pool;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = Admin::create([
            'name' => 'admin',
            'email' => 'admin@admin.com',
            'password' => '123456',
            'phone' => '123456',
            'role_id' => '1',
        ]);

        if (env('APP_DEBUG')) {
            $chunks = 100;
            $chunkSize = 10;
            for ($i = 0; $i < $chunks; $i++) {
                $data = [];
                for ($j = 0; $j < $chunkSize; $j++) {
                    $data[] = [
                        'name' => fake()->name(),
                        'email' => fake()->unique()->safeEmail(),
                        'password' => '123456',
                        'phone' => fake()->phoneNumber,
                        'role_id' => '1',
                    ];
                }
                DB::table('admins')->insert($data);
            }
        }


    }
}
