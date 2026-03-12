<?php

namespace App\Http\Controllers\Cashier;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Carbon\Carbon;

class SalesController extends Controller
{
    public function index()
    {
        $period = request('period', 'daily');

        $query = Order::where('status', 'completed');

        if ($period === 'daily') {
            $query->whereDate('created_at', today());
        } elseif ($period === 'weekly') {
            $query->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()]);
        } elseif ($period === 'monthly') {
            $query->whereMonth('created_at', now()->month)->whereYear('created_at', now()->year);
        }

        $orders       = $query->with('items.product')->latest()->get();
        $totalRevenue = $orders->sum('total_amount');
        $totalOrders  = $orders->count();
        $totalItems   = $orders->flatMap->items->sum('quantity');

        return view('cashier.rekap.index', compact('orders', 'totalRevenue', 'totalOrders', 'totalItems', 'period'));
    }
}
