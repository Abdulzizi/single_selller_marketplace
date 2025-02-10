<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Str;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = DB::table('users')->pluck('id')->toArray();
        $productDetails = DB::table('product_details')->pluck('id')->toArray();

        $orders = [];
        for ($i = 1; $i <= 10; $i++) { // buat 10 orders
            $orders[] = [
                'id' => Str::uuid()->toString(),
                'user_id' => $users[array_rand($users)], // Random user ID
                'product_detail_id' => $productDetails[array_rand($productDetails)], // Random product_detail ID
                'total_price' => rand(1000, 10000), // Random total price
                'status' => 'pending',
                'created_by' => 0,
                'updated_by' => 0,
                'deleted_by' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        DB::table('orders')->insert($orders);
    }
}
