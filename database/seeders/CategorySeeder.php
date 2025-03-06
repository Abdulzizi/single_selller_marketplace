<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Str;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'id' => Str::uuid(),
                'name' => 'Electronics',
                'slug' => 'electronics',
                'description' => 'All kinds of electronic devices',
                'created_by' => 1,
                'updated_by' => 1,
            ],
            [
                'id' => Str::uuid(),
                'name' => 'Accessories',
                'slug' => 'accessories',
                'description' => 'Accessories for various devices',
                'created_by' => 1,
                'updated_by' => 1,
            ],
            [
                'id' => Str::uuid(),
                'name' => 'Home and Kitchen',
                'slug' => 'home-and-kitchen',
                'description' => 'Home and kitchen appliances',
                'created_by' => 1,
                'updated_by' => 1,
            ],
            [
                'id' => Str::uuid(),
                'name' => 'Beauty and Personal Care',
                'slug' => 'beauty-and-personal-care',
                'description' => 'Beauty and personal care products',
                'created_by' => 1,
                'updated_by' => 1,
            ],
            [
                'id' => Str::uuid(),
                'name' => 'Clothing, Shoes and Jewelry',
                'slug' => 'clothing-shoes-and-jewelry',
                'description' => 'Clothing, shoes and jewelry',
                'created_by' => 1,
                'updated_by' => 1,
            ],
            [
                'id' => Str::uuid(),
                'name' => 'Toys and Games',
                'slug' => 'toys-and-games',
                'description' => 'Toys and games for children',
                'created_by' => 1,
                'updated_by' => 1,
            ],
            [
                'id' => Str::uuid(),
                'name' => 'Sports and Outdoors',
                'slug' => 'sports-and-outdoors',
                'description' => 'Sports and outdoor activities',
                'created_by' => 1,
                'updated_by' => 1,
            ],
            [
                'id' => Str::uuid(),
                'name' => 'Pet Supplies',
                'slug' => 'pet-supplies',
                'description' => 'Pet supplies',
                'created_by' => 1,
                'updated_by' => 1,
            ],
            [
                'id' => Str::uuid(),
                'name' => 'Automotive',
                'slug' => 'automotive',
                'description' => 'Automotive related products',
                'created_by' => 1,
                'updated_by' => 1,
            ],
            [
                'id' => Str::uuid(),
                'name' => 'Baby Products',
                'slug' => 'baby-products',
                'description' => 'Baby products',
                'created_by' => 1,
                'updated_by' => 1,
            ],
        ];

        \App\Models\CategoryModel::insert($categories);
    }
}
