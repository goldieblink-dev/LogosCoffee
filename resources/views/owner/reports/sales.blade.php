@extends('layouts.owner')

@section('title', 'Laporan Penjualan & Analitik')

@section('content')
<div class="space-y-8">
    <!-- Filter -->
    <div class="bg-white p-6 border border-gray-200 rounded-2xl shadow-sm">
        <form action="{{ route('owner.reports.sales') }}" method="GET" class="flex flex-wrap items-end gap-4">
            <div>
                <label class="block text-[10px] font-bold uppercase tracking-widest text-gray-400 mb-2">Mulai
                    Tanggal</label>
                <input type="date" name="start_date" value="{{ $startDate }}"
                    class="px-4 py-2 bg-gray-50 border border-gray-200 rounded-lg text-sm">
            </div>
            <div>
                <label class="block text-[10px] font-bold uppercase tracking-widest text-gray-400 mb-2">Sampai
                    Tanggal</label>
                <input type="date" name="end_date" value="{{ $endDate }}"
                    class="px-4 py-2 bg-gray-50 border border-gray-200 rounded-lg text-sm">
            </div>
            <button type="submit"
                class="px-6 py-2 bg-black text-white font-bold rounded-lg hover:bg-gray-900 transition-colors">
                Filter Laporan
            </button>
        </form>
    </div>

    <!-- Stats Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <!-- Revenue Card -->
        <div class="bg-black text-white p-8 border border-black rounded-3xl shadow-xl relative overflow-hidden">
            <div class="relative z-10">
                <p class="text-xs font-bold uppercase tracking-widest text-gray-400 mb-2">Total Omzet (Periode Terpilih)
                </p>
                <h3 class="text-4xl font-heading font-bold">Rp {{ number_format($totalRevenue, 0, ',', '.') }}</h3>
                <p class="text-sm text-gray-400 mt-4">{{ $totalOrders }} Pesanan Berhasil</p>
            </div>
            <!-- Decorative circle -->
            <div class="absolute -right-10 -bottom-10 w-40 h-40 bg-white/5 rounded-full"></div>
        </div>

        <!-- Best Sellers -->
        <div class="bg-white p-8 border border-gray-200 rounded-3xl shadow-sm">
            <p class="text-xs font-bold uppercase tracking-widest text-gray-400 mb-4">Produk Terlaris</p>
            <div class="space-y-4">
                @forelse($bestSellers as $item)
                <div
                    class="flex items-center justify-between p-3 bg-gray-50 rounded-xl hover:bg-gray-100 transition-colors">
                    <div class="flex items-center gap-3">
                        <div
                            class="w-10 h-10 bg-black text-white rounded-lg flex items-center justify-center font-bold text-xs">
                            #{{ $loop->iteration }}
                        </div>
                        <div>
                            <p class="text-sm font-bold text-gray-900">{{ $item->product->name }}</p>
                            <p class="text-[10px] text-gray-500">{{ $item->product->category->name }}</p>
                        </div>
                    </div>
                    <div class="text-right">
                        <p class="text-sm font-bold text-black">{{ $item->total_qty }}</p>
                        <p class="text-[10px] text-gray-500 uppercase font-bold tracking-tighter">Terjual</p>
                    </div>
                </div>
                @empty
                <p class="text-center py-10 text-gray-400 italic">Belum ada data penjualan.</p>
                @endforelse
            </div>
        </div>
    </div>

    <!-- Transaction List -->
    <div class="bg-white border border-gray-200 rounded-3xl shadow-sm overflow-hidden">
        <div class="px-8 py-6 border-b border-gray-100 flex justify-between items-center">
            <h3 class="font-bold text-gray-900">Rincian Transaksi</h3>
            <span class="px-3 py-1 bg-green-50 text-green-700 text-[10px] font-bold uppercase rounded-full">Success
                Only</span>
        </div>
        <table class="w-full text-left">
            <thead class="bg-gray-50/50 border-b border-gray-100">
                <tr>
                    <th class="px-8 py-4 text-[10px] font-bold uppercase tracking-widest text-gray-400">Tanggal</th>
                    <th class="px-8 py-4 text-[10px] font-bold uppercase tracking-widest text-gray-400">Pelanggan</th>
                    <th class="px-8 py-4 text-[10px] font-bold uppercase tracking-widest text-gray-400">Total Transaksi
                    </th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @foreach($orders as $order)
                <tr class="hover:bg-gray-50/50 transition-colors">
                    <td class="px-8 py-4">
                        <p class="text-sm font-bold text-gray-900">{{ $order->created_at->format('d/m/Y') }}</p>
                        <p class="text-[10px] text-gray-500">{{ $order->created_at->format('H:i') }}</p>
                    </td>
                    <td class="px-8 py-4">
                        <p class="text-sm font-bold text-gray-900">{{ $order->customer_name }}</p>
                        <p class="text-[10px] text-gray-500">Meja #{{ $order->table_number }}</p>
                    </td>
                    <td class="px-8 py-4">
                        <span class="text-sm font-bold text-black font-mono">Rp {{ number_format($order->total_amount,
                            0, ',', '.') }}</span>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection