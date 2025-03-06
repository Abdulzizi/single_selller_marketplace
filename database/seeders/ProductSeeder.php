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
            [
                'id' => Str::uuid(),
                'category_id' => $categories['home-and-kitchen'] ?? null,
                'name' => 'Blender Phillips',
                'slug' => 'blender-phillips',
                'description' => 'Phillips Blender with multiple speed settings',
                'price' => 500000,
                'is_available' => 1,
                'created_by' => 1,
                'updated_by' => 1,
            ],
            [
                'id' => Str::uuid(),
                'category_id' => $categories['beauty-and-personal-care'] ?? null,
                'name' => 'Hair Dryer Dyson',
                'slug' => 'hair-dryer-dyson',
                'description' => 'Dyson Hair Dryer with advanced heat control',
                'price' => 2500000,
                'is_available' => 1,
                'created_by' => 1,
                'updated_by' => 1,
            ],
            [
                'id' => Str::uuid(),
                'category_id' => $categories['clothing-shoes-and-jewelry'] ?? null,
                'name' => 'Nike Air Max',
                'slug' => 'nike-air-max',
                'description' => 'Nike Air Max shoes for running and casual wear',
                'price' => 1200000,
                'is_available' => 1,
                'created_by' => 1,
                'updated_by' => 1,
            ],
            [
                'id' => Str::uuid(),
                'category_id' => $categories['toys-and-games'] ?? null,
                'name' => 'LEGO Star Wars',
                'slug' => 'lego-star-wars',
                'description' => 'LEGO Star Wars set with detailed models',
                'price' => 800000,
                'is_available' => 1,
                'created_by' => 1,
                'updated_by' => 1,
            ],
            [
                'id' => Str::uuid(),
                'category_id' => $categories['electronics'] ?? null,
                'name' => 'Samsung Galaxy S21',
                'slug' => 'samsung-galaxy-s21',
                'description' => 'Samsung Galaxy S21 with high-resolution display',
                'price' => 20000000,
                'is_available' => 1,
                'created_by' => 1,
                'updated_by' => 1,
            ],
            [
                'id' => Str::uuid(),
                'category_id' => $categories['accessories'] ?? null,
                'name' => 'Wireless Charger Anker',
                'slug' => 'wireless-charger-anker',
                'description' => 'Anker wireless charger with fast charging support',
                'price' => 250000,
                'is_available' => 1,
                'created_by' => 1,
                'updated_by' => 1,
            ],
            [
                'id' => Str::uuid(),
                'category_id' => $categories['home-and-kitchen'] ?? null,
                'name' => 'Dyson Vacuum Cleaner',
                'slug' => 'dyson-vacuum-cleaner',
                'description' => 'Dyson Vacuum Cleaner for home and office use',
                'price' => 4000000,
                'is_available' => 1,
                'created_by' => 1,
                'updated_by' => 1,
            ],
            [
                'id' => Str::uuid(),
                'category_id' => $categories['beauty-and-personal-care'] ?? null,
                'name' => 'Oral-B Electric Toothbrush',
                'slug' => 'oral-b-electric-toothbrush',
                'description' => 'Oral-B Electric Toothbrush with multiple modes',
                'price' => 300000,
                'is_available' => 1,
                'created_by' => 1,
                'updated_by' => 1,
            ],
        ];

        DB::table('products')->insert($products);
    }
}
