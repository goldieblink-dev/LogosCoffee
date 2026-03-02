<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class SelfOrderController extends Controller
{
    public function index(Request $request)
    {
        $table = $request->query('table');
        return view('self-order.index', compact('table'));
    }

    public function storeCustomerInfo(Request $request)
    {
        $request->validate([
            'table_number' => 'required',
            'customer_name' => 'required|string|max:255',
            'customer_phone' => 'nullable|string',
        ]);

        Session::put('customer', $request->only('table_number', 'customer_name', 'customer_phone'));

        return redirect()->route('self-order.menu');
    }

    public function menu()
    {
        if (!Session::has('customer')) {
            return redirect()->route('self-order.index');
        }

        $categories = Category::with(['products' => function ($q) {
            $q->where('is_available', true);
        }])->get();

        $promoProducts = Product::where('is_available', true)
            ->whereNotNull('promo_price')
            ->where('promo_price', '>', 0)
            ->get();

        return view('self-order.menu', compact('categories', 'promoProducts'));
    }

    public function checkout(Request $request)
    {
        $cart = $request->cart; // Expecting array of {id, quantity}
        if (empty($cart)) {
            return back()->with('error', 'Keranjang masih kosong.');
        }

        $customer = Session::get('customer');
        $total = 0;
        $items = [];

        foreach ($cart as $item) {
            if (!isset($item['id']) || !isset($item['quantity']))
                continue;

            $product = Product::find($item['id']);
            if ($product) {
                $price = $product->promo_price ?? $product->price;
                $lineTotal = $price * $item['quantity'];
                $total += $lineTotal;
                $items[] = [
                    'product_id' => $product->id,
                    'quantity' => $item['quantity'],
                    'price' => $price,
                ];
            }
        }

        $order = Order::create([
            'table_number' => $customer['table_number'],
            'customer_name' => $customer['customer_name'],
            'customer_phone' => $customer['customer_phone'],
            'total_amount' => $total,
            'status' => 'pending',
        ]);

        foreach ($items as $item) {
            $order->items()->create($item);
        }

        Session::put('current_order_id', $order->id);

        return redirect()->route('self-order.payment', $order);
    }

    public function payment(Order $order)
    {
        return view('self-order.payment', compact('order'));
    }

    public function processPayment(Order $order)
    {
        // Mock payment success
        $order->update([
            'status' => 'paid',
            'payment_method' => 'QRIS',
        ]);

        return redirect()->route('self-order.success', $order);
    }

    public function success(Order $order)
    {
        return view('self-order.success', compact('order'));
    }
}