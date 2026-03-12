<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Str;

class DummyDataSeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['name' => 'Coffee', 'icon' => 'coffee'],
            ['name' => 'Non-Coffee', 'icon' => 'glass'],
            ['name' => 'Food', 'icon' => 'utensils'],
            ['name' => 'Snacks', 'icon' => 'cookie'],
        ];

        foreach ($categories as $cat) {
            $category = Category::create([
                'name' => $cat['name'],
                'slug' => Str::slug($cat['name']),
            ]);

            if ($cat['name'] === 'Coffee') {
                $products = [
                    ['name' => 'Espresso', 'price' => 15000, 'description' => 'Single shot espresso.'],
                    ['name' => 'Americano', 'price' => 20000, 'description' => 'Espresso with hot water.'],
                    ['name' => 'Cafe Latte', 'price' => 25000, 'description' => 'Espresso with steamed milk.'],
                    ['name' => 'Cappuccino', 'price' => 25000, 'description' => 'Espresso with frothed milk.'],
                ];
            } elseif ($cat['name'] === 'Non-Coffee') {
                $products = [
                    ['name' => 'Matcha Latte', 'price' => 28000, 'description' => 'Premium matcha with milk.'],
                    ['name' => 'Chocolate Hot', 'price' => 25000, 'description' => 'Rich dark chocolate.'],
                    ['name' => 'Iced Tea', 'price' => 10000, 'description' => 'Fresh brewed jasmine tea.'],
                ];
            } elseif ($cat['name'] === 'Food') {
                $products = [
                    ['name' => 'Nasi Goreng LC', 'price' => 35000, 'description' => 'Special fried rice with egg.'],
                    ['name' => 'Mie Goreng LC', 'price' => 30000, 'description' => 'Fried noodles with vegetables.'],
                ];
            } else {
                $products = [
                    ['name' => 'French Fries', 'price' => 18000, 'description' => 'Crispy golden fries.'],
                    ['name' => 'Croissant', 'price' => 22000, 'description' => 'Buttery flaky pastry.'],
                ];
            }

            foreach ($products as $prod) {
                Product::create([
                    'category_id' => $category->id,
                    'name' => $prod['name'],
                    'slug' => Str::slug($prod['name']) . '-' . uniqid(),
                    'description' => $prod['description'],
                    'price' => $prod['price'],
                    'is_available' => true,
                ]);
            }
        }
    }
}
