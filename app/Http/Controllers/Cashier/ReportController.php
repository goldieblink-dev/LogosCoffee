<?php

namespace App\Http\Controllers\Cashier;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use Carbon\Carbon;

class ReportController extends Controller
{
    public function sales(Request $request)
    {
        $period = $request->input('period', 'daily'); // daily, weekly, monthly

        $query = Order::whereIn('status', ['paid', 'completed']);

        if ($period == 'weekly') {
            $query->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()]);
        } elseif ($period == 'monthly') {
            $query->whereMonth('created_at', Carbon::now()->month)->whereYear('created_at', Carbon::now()->year);
        } else {
            // Default to daily
            $query->whereDate('created_at', Carbon::today());
        }

        $orders = $query->orderBy('created_at', 'desc')->get();
        $totalRevenue = $orders->sum('total_amount');
        $totalOrders = $orders->count();

        return view('cashier.reports.sales', compact('orders', 'totalRevenue', 'totalOrders', 'period'));
    }
}
