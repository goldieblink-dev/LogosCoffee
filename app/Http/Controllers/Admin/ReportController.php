<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function sales(Request $request)
    {
        $period = $request->get('period', 'daily'); // daily, weekly, monthly

        $query = Order::where('status', 'paid')->orWhere('status', 'completed');

        if ($period == 'daily') {
            $orders = (clone $query)->daily()->latest()->get();
        }
        elseif ($period == 'weekly') {
            $orders = (clone $query)->weekly()->latest()->get();
        }
        else {
            $orders = (clone $query)->monthly()->latest()->get();
        }

        $totalRevenue = $orders->sum('total_amount');
        $totalOrders = $orders->count();

        return view('admin.reports.sales', compact('orders', 'totalRevenue', 'totalOrders', 'period'));
    }
}