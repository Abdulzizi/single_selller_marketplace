<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Str;

class CartSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = DB::table('products')->pluck('id', 'slug'); // Fetch products dynamically
        $details = DB::table('product_details')->pluck('id', 'description'); // Fetch product details dynamically

        $carts = [
            [
                'id' => Str::uuid(),
                'user_id' => Str::uuid(), // Example guest user
                'product_id' => $products['laptop-asus'] ?? null,
                'product_detail_id' => null, // No specific detail selected
                'quantity' => 1,
                'created_by' => 1,
                'updated_by' => 1,
            ],
            [
                'id' => Str::uuid(),
                'user_id' => null, // Guest user
                'product_id' => $products['mouse-logitech'] ?? null,
                'product_detail_id' => $details['Black Color'] ?? null,
                'quantity' => 2,
                'created_by' => 1,
                'updated_by' => 1,
            ],
        ];

        \App\Models\CartModel::insert($carts);
    }
}
