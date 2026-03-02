<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $totalRevenue = Order::whereIn('status', ['paid', 'completed'])->sum('total_amount');
        $totalOrders = Order::count();
        $totalProducts = Product::count();
        $dailyRevenue = Order::daily()->whereIn('status', ['paid', 'completed'])->sum('total_amount');

        return view('owner.dashboard', compact('totalRevenue', 'totalOrders', 'totalProducts', 'dailyRevenue'));
    }
}