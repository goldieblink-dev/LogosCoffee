@extends('layouts.owner')
@section('title', 'Laporan Penjualan')

@section('content')
<div class="space-y-8">

    {{-- Header --}}
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
        <div>
            <h3 class="text-3xl font-black text-gray-900 tracking-tighter">Laporan Penjualan</h3>
            <p class="text-xs font-bold text-gray-400 uppercase tracking-widest mt-1">Analitik Bisnis Logos Coffee</p>
        </div>
        <div class="flex gap-2">
            @foreach(['daily'=>'Harian','weekly'=>'Mingguan','monthly'=>'Bulanan','yearly'=>'Tahunan'] as $key => $label)
            <a href="{{ route('owner.reports.index', ['period' => $key]) }}"
               class="px-4 py-2.5 text-xs font-bold rounded-xl transition-all {{ $period === $key ? 'bg-black text-white shadow-lg shadow-black/10' : 'bg-white text-gray-500 border border-gray-200 hover:bg-gray-50' }}">
               {{ $label }}
            </a>
            @endforeach
        </div>
    </div>

    {{-- Summary Cards --}}
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
        <div class="bg-white p-6 rounded-[2rem] border border-gray-200 shadow-sm">
            <p class="text-[10px] font-black text-gray-400 uppercase tracking-[0.2em] mb-2">Total Omzet</p>
            <p class="text-3xl font-black text-gray-900 tracking-tighter">Rp {{ number_format($totalRevenue, 0, ',', '.') }}</p>
            <p class="text-xs text-emerald-600 font-bold mt-1">Pesanan selesai</p>
        </div>
        <div class="bg-white p-6 rounded-[2rem] border border-gray-200 shadow-sm">
            <p class="text-[10px] font-black text-gray-400 uppercase tracking-[0.2em] mb-2">Total Pesanan</p>
            <p class="text-3xl font-black text-gray-900 tracking-tighter">{{ $totalOrders }} <span class="text-base text-gray-400 font-semibold">pesanan</span></p>
        </div>
        <div class="bg-white p-6 rounded-[2rem] border border-gray-200 shadow-sm">
            <p class="text-[10px] font-black text-gray-400 uppercase tracking-[0.2em] mb-2">Rata-rata per Pesanan</p>
            <p class="text-3xl font-black text-gray-900 tracking-tighter">Rp {{ $totalOrders > 0 ? number_format($totalRevenue / $totalOrders, 0, ',', '.') : '0' }}</p>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        {{-- Top Products --}}
        <div class="bg-white border border-gray-200 rounded-[2.5rem] shadow-sm overflow-hidden">
            <div class="px-8 py-5 border-b border-gray-100">
                <h4 class="font-black text-gray-900">🏆 Produk Terlaris</h4>
            </div>
            @if($topProducts->count() > 0)
            <div class="divide-y divide-gray-100">
                @foreach($topProducts as $index => $item)
                <div class="flex items-center justify-between px-8 py-4 hover:bg-gray-50 transition-colors">
                    <div class="flex items-center gap-3">
                        <div class="w-8 h-8 rounded-xl flex items-center justify-center text-xs font-black
                            {{ $index === 0 ? 'bg-amber-400 text-white' : ($index === 1 ? 'bg-gray-300 text-white' : ($index === 2 ? 'bg-orange-400 text-white' : 'bg-gray-100 text-gray-500')) }}">
                            {{ $index + 1 }}
                        </div>
                        <div>
                            <p class="text-sm font-bold text-gray-900">{{ $item->product?->name ?? 'Produk Dihapus' }}</p>
                            <p class="text-xs text-gray-400">{{ $item->product?->category?->name ?? '-' }}</p>
                        </div>
                    </div>
                    <div class="text-right">
                        <p class="text-sm font-black text-gray-900">{{ $item->total_sold }} terjual</p>
                        <p class="text-xs text-gray-400 font-medium">Rp {{ number_format($item->total_revenue, 0, ',', '.') }}</p>
                    </div>
                </div>
                @endforeach
            </div>
            @else
            <div class="py-16 text-center text-gray-400 text-sm font-medium">Belum ada data penjualan.</div>
            @endif
        </div>

        {{-- Transactions Table --}}
        <div class="bg-white border border-gray-200 rounded-[2.5rem] shadow-sm overflow-hidden">
            <div class="px-8 py-5 border-b border-gray-100">
                <h4 class="font-black text-gray-900">Transaksi Terakhir</h4>
            </div>
            @if($orders->count() > 0)
            <div class="divide-y divide-gray-100 max-h-96 overflow-y-auto no-scrollbar">
                @foreach($orders->take(20) as $order)
                <div class="flex items-center justify-between px-8 py-4 hover:bg-gray-50 transition-colors">
                    <div class="flex items-center gap-3">
                        <div class="w-9 h-9 rounded-xl bg-black flex items-center justify-center text-white text-xs font-black">{{ $order->table_number }}</div>
                        <div>
                            <p class="text-sm font-bold text-gray-900">{{ $order->customer_name ?: 'Tanpa Nama' }}</p>
                            <p class="text-xs text-gray-400">{{ $order->created_at->format('d M, H:i') }}</p>
                        </div>
                    </div>
                    <p class="text-sm font-black text-gray-900">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</p>
                </div>
                @endforeach
            </div>
            @else
            <div class="py-16 text-center text-gray-400 text-sm font-medium">Tidak ada transaksi pada periode ini.</div>
            @endif
        </div>
    </div>

</div>
@endsection
