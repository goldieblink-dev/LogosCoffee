<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class PromoController extends Controller
{
    public function index()
    {
        $products = Product::with('category')->orderBy('name')->get();
        return view('owner.promos.index', compact('products'));
    }

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'promo_price' => 'nullable|numeric|min:0',
        ]);

        $product->update(['promo_price' => $request->promo_price ?: null]);
        return back()->with('success', 'Harga promo berhasil diperbarui.');
    }
}
