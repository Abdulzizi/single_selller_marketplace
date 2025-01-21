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
                'description' => 'Devices and gadgets such as phones, laptops, and accessories.',
                'slug' => 'electronics',
                'created_by' => 1,
                'updated_by' => 1,
            ],
            [
                'id' => Str::uuid(),
                'name' => 'Fashion',
                'description' => 'Clothing, footwear, and accessories for men and women.',
                'slug' => 'fashion',
                'created_by' => 1,
                'updated_by' => 1,
            ],
            [
                'id' => Str::uuid(),
                'name' => 'Home Appliances',
                'description' => 'Appliances and tools for home and kitchen use.',
                'slug' => 'home-appliances',
                'created_by' => 1,
                'updated_by' => 1,
            ],
            [
                'id' => Str::uuid(),
                'name' => 'Books',
                'description' => 'Books, novels, and educational materials.',
                'slug' => 'books',
                'created_by' => 1,
                'updated_by' => 1,
            ],
            [
                'id' => Str::uuid(),
                'name' => 'Sports',
                'description' => 'Sports equipment, clothing, and accessories.',
                'slug' => 'sports',
                'created_by' => 1,
                'updated_by' => 1,
            ],
        ];

        DB::table('categories')->insert($categories);
    }
}
