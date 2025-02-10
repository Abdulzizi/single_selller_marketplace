<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Str;

class ProductDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = DB::table('products')->pluck('id', 'slug');

        $details = [
            [
                'id' => Str::uuid(),
                'product_id' => $products['laptop-asus'] ?? null,
                'type' => 'RAM Upgrade',
                'description' => 'Upgrade to 32GB RAM',
                'price' => 2500000,
                'created_by' => 1,
                'updated_by' => 1,
            ],
            [
                'id' => Str::uuid(),
                'product_id' => $products['mouse-logitech'] ?? null,
                'type' => 'Color Option',
                'description' => 'Black Color',
                'price' => 0,
                'created_by' => 1,
                'updated_by' => 1,
            ],
        ];

        DB::table('product_details')->insert($details);
    }
}
