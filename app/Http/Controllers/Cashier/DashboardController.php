<?php

namespace App\Http\Controllers\Cashier;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Product;

class DashboardController extends Controller
{
    public function index()
    {
        $todaySales = Order::daily()->whereIn('status', ['paid', 'completed'])->sum('total_amount');
        $todayOrders = Order::daily()->count();
        $availableProducts = Product::where('is_available', true)->count();

        return view('cashier.dashboard', compact('todaySales', 'todayOrders', 'availableProducts'));
    }
}