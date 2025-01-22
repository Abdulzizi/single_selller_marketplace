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
        ];

        \App\Models\CategoryModel::insert($categories);
    }
}
