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
            // Laptop Asus
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
                'product_id' => $products['laptop-asus'] ?? null,
                'type' => 'Storage Upgrade',
                'description' => 'Upgrade to 1TB SSD',
                'price' => 2000000,
                'created_by' => 1,
                'updated_by' => 1,
            ],

            // Mouse Logitech
            [
                'id' => Str::uuid(),
                'product_id' => $products['mouse-logitech'] ?? null,
                'type' => 'Color Option',
                'description' => 'Black Color',
                'price' => 0,
                'created_by' => 1,
                'updated_by' => 1,
            ],
            [
                'id' => Str::uuid(),
                'product_id' => $products['mouse-logitech'] ?? null,
                'type' => 'Color Option',
                'description' => 'White Color',
                'price' => 0,
                'created_by' => 1,
                'updated_by' => 1,
            ],

            // Blender Phillips
            [
                'id' => Str::uuid(),
                'product_id' => $products['blender-phillips'] ?? null,
                'type' => 'Capacity',
                'description' => '2L Jug',
                'price' => 100000,
                'created_by' => 1,
                'updated_by' => 1,
            ],

            // Hair Dryer Dyson
            [
                'id' => Str::uuid(),
                'product_id' => $products['hair-dryer-dyson'] ?? null,
                'type' => 'Color Option',
                'description' => 'Pink Edition',
                'price' => 50000,
                'created_by' => 1,
                'updated_by' => 1,
            ],

            // Nike Air Max
            [
                'id' => Str::uuid(),
                'product_id' => $products['nike-air-max'] ?? null,
                'type' => 'Size',
                'description' => 'Size 42',
                'price' => 0,
                'created_by' => 1,
                'updated_by' => 1,
            ],
            [
                'id' => Str::uuid(),
                'product_id' => $products['nike-air-max'] ?? null,
                'type' => 'Size',
                'description' => 'Size 44',
                'price' => 0,
                'created_by' => 1,
                'updated_by' => 1,
            ],

            // LEGO Star Wars
            [
                'id' => Str::uuid(),
                'product_id' => $products['lego-star-wars'] ?? null,
                'type' => 'Special Edition',
                'description' => 'Collector’s Edition with Extra Figures',
                'price' => 200000,
                'created_by' => 1,
                'updated_by' => 1,
            ],

            // Samsung Galaxy S21
            [
                'id' => Str::uuid(),
                'product_id' => $products['samsung-galaxy-s21'] ?? null,
                'type' => 'Storage Option',
                'description' => '256GB Storage',
                'price' => 1500000,
                'created_by' => 1,
                'updated_by' => 1,
            ],

            // Wireless Charger Anker
            [
                'id' => Str::uuid(),
                'product_id' => $products['wireless-charger-anker'] ?? null,
                'type' => 'Fast Charge',
                'description' => 'Supports 15W Fast Charging',
                'price' => 100000,
                'created_by' => 1,
                'updated_by' => 1,
            ],

            // Dyson Vacuum Cleaner
            [
                'id' => Str::uuid(),
                'product_id' => $products['dyson-vacuum-cleaner'] ?? null,
                'type' => 'Accessory',
                'description' => 'Comes with Extra Brush Attachments',
                'price' => 300000,
                'created_by' => 1,
                'updated_by' => 1,
            ],

            // Oral-B Electric Toothbrush
            [
                'id' => Str::uuid(),
                'product_id' => $products['oral-b-electric-toothbrush'] ?? null,
                'type' => 'Brush Heads',
                'description' => 'Includes 3 Extra Brush Heads',
                'price' => 50000,
                'created_by' => 1,
                'updated_by' => 1,
            ],
        ];

        DB::table('product_details')->insert($details);
    }
}
