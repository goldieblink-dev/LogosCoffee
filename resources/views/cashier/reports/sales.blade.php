@extends('layouts.cashier')

@section('title', 'Rekap Penjualan')

@section('content')
<div class="space-y-8">
    <!-- Period Selector -->
    <div class="flex items-center gap-2 p-1 bg-gray-100 rounded-xl w-fit">
        <a href="{{ route('reports.sales', ['period' => 'daily']) }}"
            class="px-6 py-2 rounded-lg text-sm font-bold transition-all {{ $period == 'daily' ? 'bg-white text-black shadow-sm' : 'text-gray-500 hover:text-black' }}">Harian</a>
        <a href="{{ route('reports.sales', ['period' => 'weekly']) }}"
            class="px-6 py-2 rounded-lg text-sm font-bold transition-all {{ $period == 'weekly' ? 'bg-white text-black shadow-sm' : 'text-gray-500 hover:text-black' }}">Mingguan</a>
        <a href="{{ route('reports.sales', ['period' => 'monthly']) }}"
            class="px-6 py-2 rounded-lg text-sm font-bold transition-all {{ $period == 'monthly' ? 'bg-white text-black shadow-sm' : 'text-gray-500 hover:text-black' }}">Bulanan</a>
    </div>

    <!-- Stats -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <div class="bg-white border border-gray-200 rounded-2xl p-6 shadow-sm">
            <p class="text-xs font-bold uppercase tracking-wider text-gray-400 mb-2">Total Penjualan</p>
            <h3 class="text-3xl font-heading font-bold text-black">Rp {{ number_format($totalRevenue, 0, ',', '.') }}
            </h3>
        </div>
        <div class="bg-white border border-gray-200 rounded-2xl p-6 shadow-sm">
            <p class="text-xs font-bold uppercase tracking-wider text-gray-400 mb-2">Jumlah Pesanan</p>
            <h3 class="text-3xl font-heading font-bold text-black">{{ $totalOrders }}</h3>
        </div>
    </div>

    <!-- Orders Table -->
    <div class="bg-white border border-gray-200 rounded-2xl shadow-sm overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-100 bg-gray-50/50">
            <h3 class="font-bold text-gray-900">Rincian Transaksi - {{ ucfirst($period) }}</h3>
        </div>
        <table class="w-full text-left">
            <thead class="bg-white border-b border-gray-200">
                <tr>
                    <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider text-gray-500">Tanggal & Waktu</th>
                    <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider text-gray-500">Pelanggan</th>
                    <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider text-gray-500">Total</th>
                    <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider text-gray-500 text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse($orders as $order)
                <tr>
                    <td class="px-6 py-4">
                        <p class="text-sm font-bold text-gray-900">{{ $order->created_at->format('d M Y') }}</p>
                        <p class="text-[10px] text-gray-500">{{ $order->created_at->format('H:i') }}</p>
                    </td>
                    <td class="px-6 py-4">
                        <p class="text-sm font-bold text-gray-900">{{ $order->customer_name }}</p>
                        <p class="text-[10px] text-gray-500">Meja #{{ $order->table_number }}</p>
                    </td>
                    <td class="px-6 py-4 text-sm font-bold text-black">
                        Rp {{ number_format($order->total_amount, 0, ',', '.') }}
                    </td>
                    <td class="px-6 py-4 text-right">
                        <a href="{{ route('orders.show', $order) }}"
                            class="text-xs font-bold text-gray-400 hover:text-black">Detail</a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="px-6 py-10 text-center text-gray-400 italic">Tidak ada transaksi ditemukan
                        untuk periode ini.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection