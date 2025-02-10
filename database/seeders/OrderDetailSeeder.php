<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Str;

class OrderDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $orders = DB::table('orders')->pluck('id')->toArray(); // ambil semua order id
        $products = DB::table('products')->pluck('id')->toArray();

        $orderDetails = [];
        foreach ($orders as $orderId) {
            $productCount = rand(1, 5); // setiap order memiliki 1-5 product
            for ($i = 1; $i <= $productCount; $i++) {
                $quantity = rand(1, 10); // Random quantity
                $price = rand(100, 500); // Random price

                $orderDetails[] = [
                    'id' => Str::uuid()->toString(),
                    'order_id' => $orderId,
                    'product_id' => $products[array_rand($products)], // Random product ID
                    'quantity' => $quantity,
                    'price' => $price,
                    'total' => $price * $quantity,
                    'created_by' => 0,
                    'updated_by' => 0,
                    'deleted_by' => 0,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }
        }

        DB::table('order_details')->insert($orderDetails);
    }
}
