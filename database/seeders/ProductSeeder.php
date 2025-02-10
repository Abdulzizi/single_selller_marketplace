<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Str;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = DB::table('categories')->pluck('id', 'slug');

        $products = [
            [
                'id' => Str::uuid(),
                'category_id' => $categories['electronics'] ?? null,
                'name' => 'Laptop Asus',
                'slug' => 'laptop-asus',
                'description' => 'Laptop Asus Core i5 16GB RAM 512GB SSD',
                'price' => 13500000,
                'is_available' => 1,
                'created_by' => 1,
                'updated_by' => 1,
            ],
            [
                'id' => Str::uuid(),
                'category_id' => $categories['accessories'] ?? null,
                'name' => 'Mouse Logitech',
                'slug' => 'mouse-logitech',
                'description' => 'Mouse Logitech G502 with advanced features',
                'price' => 150000,
                'is_available' => 1,
                'created_by' => 1,
                'updated_by' => 1,
            ],
        ];

        DB::table('products')->insert($products);
    }
}
