<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use Carbon\Carbon;

class ReportController extends Controller
{
    public function index()
    {
        $period = request('period', 'monthly');

        $query = Order::where('status', 'completed');

        if ($period === 'daily') {
            $query->whereDate('created_at', today());
        } elseif ($period === 'weekly') {
            $query->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()]);
        } elseif ($period === 'monthly') {
            $query->whereMonth('created_at', now()->month)->whereYear('created_at', now()->year);
        } elseif ($period === 'yearly') {
            $query->whereYear('created_at', now()->year);
        }

        $orders       = $query->with('items.product')->latest()->get();
        $totalRevenue = $orders->sum('total_amount');
        $totalOrders  = $orders->count();

        // Best-selling products
        $topProducts = OrderItem::whereHas('order', function ($q) use ($period) {
            $q->where('status', 'completed');
            if ($period === 'daily')   $q->whereDate('created_at', today());
            if ($period === 'weekly')  $q->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()]);
            if ($period === 'monthly') $q->whereMonth('created_at', now()->month)->whereYear('created_at', now()->year);
            if ($period === 'yearly')  $q->whereYear('created_at', now()->year);
        })
        ->with('product.category')
        ->selectRaw('product_id, SUM(quantity) as total_sold, SUM(price * quantity) as total_revenue')
        ->groupBy('product_id')
        ->orderByDesc('total_sold')
        ->take(10)
        ->get();

        return view('owner.reports.index', compact('orders', 'totalRevenue', 'totalOrders', 'topProducts', 'period'));
    }
}
