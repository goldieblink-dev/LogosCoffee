<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class PromoProductSeeder extends Seeder
{
    public function run()
    {
        $products = Product::all();
        if ($products->count() > 0) {
            $promo = $products->first();
            $promo->update([
                'promo_price' => $promo->price * 0.8, // 20% off
            ]);
        }
    }
}