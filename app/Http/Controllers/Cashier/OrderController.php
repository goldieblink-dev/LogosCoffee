<?php

namespace App\Http\Controllers\Cashier;

use App\Http\Controllers\Controller;
use App\Models\Order;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with('items.product')
            ->whereIn('status', ['paid', 'processing', 'completed'])
            ->latest()
            ->get();
        return view('cashier.orders.index', compact('orders'));
    }

    public function show(Order $order)
    {
        $order->load('items.product');
        return response()->json($order);
    }

    public function updateStatus(\Illuminate\Http\Request $request, Order $order)
    {
        $request->validate(['status' => 'required|in:paid,processing,completed']);
        $order->update(['status' => $request->status]);
        return back()->with('success', 'Status pesanan diperbarui.');
    }
}
