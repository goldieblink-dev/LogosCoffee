<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use App\Models\Order;
use App\Models\User;
use App\Models\CafeProfile;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'products'   => Product::count(),
            'categories' => Category::count(),
            'users'      => User::count(),
            'orders'     => Order::count(),
            'orders_pending' => Order::where('status', 'pending')->count(),
        ];
        $profile = CafeProfile::first();
        return view('admin.dashboard', compact('stats', 'profile'));
    }
}
