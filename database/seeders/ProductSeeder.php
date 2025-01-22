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
        $categories = DB::table('categories')->pluck('id', 'slug'); // Fetch categories dynamically

        $products = [
            [
                'id' => Str::uuid(),
                'category_id' => $categories['electronics'] ?? null,
                'name' => 'Laptop Asus',
                'slug' => 'laptop-asus',
                'description' => 'Laptop Asus Core i5 16GB RAM 512GB SSD',
                'price' => 13500000,
                'stock' => 10,
                'weight' => 2,
                'created_by' => 1,
                'updated_by' => 1,
            ],
            [
                'id' => Str::uuid(),
                'category_id' => $categories['accessories'] ?? null,
                'name' => 'Mouse Logitech',
                'slug' => 'mouse-logitech',
                'description' => 'Mouse Logitech G502',
                'price' => 150000,
                'stock' => 50,
                'weight' => 0.5,
                'created_by' => 1,
                'updated_by' => 1,
            ],
        ];

        \App\Models\ProductModel::insert($products);
    }
}
