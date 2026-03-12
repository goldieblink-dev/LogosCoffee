<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;

class DashboardController extends Controller
{
    public function index()
    {
        $totalRevenue   = Order::where('status', 'completed')->sum('total_amount');
        $todayRevenue   = Order::where('status', 'completed')->whereDate('created_at', today())->sum('total_amount');
        $totalOrders    = Order::where('status', 'completed')->count();
        $totalProducts  = Product::count();

        return view('owner.dashboard', compact('totalRevenue', 'todayRevenue', 'totalOrders', 'totalProducts'));
    }
}
