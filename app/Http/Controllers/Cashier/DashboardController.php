<?php

namespace App\Http\Controllers\Cashier;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;

class DashboardController extends Controller
{
    public function index()
    {
        // Pesanan aktif = yang sudah dibayar tapi belum selesai
        $activeOrders = Order::whereIn('status', ['paid', 'processing'])->count();

        // Pemasukan shift ini = pesanan selesai hari ini
        $shiftRevenue = Order::where('status', 'completed')
            ->whereDate('created_at', today())
            ->sum('total_amount');

        // Meja yang sedang digunakan (ada pesanan aktif)
        $occupiedTables = Order::whereIn('status', ['paid', 'processing'])
            ->distinct('table_number')
            ->count('table_number');

        // Total produk aktif (sebagai proxy untuk kapasitas meja)
        $recentOrders = Order::with('items.product')
            ->whereIn('status', ['paid', 'processing'])
            ->latest()
            ->take(5)
            ->get();

        return view('cashier.dashboard', compact(
            'activeOrders',
            'shiftRevenue',
            'occupiedTables',
            'recentOrders'
        ));
    }
}
