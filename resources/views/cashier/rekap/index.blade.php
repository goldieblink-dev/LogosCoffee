@extends('layouts.cashier')
@section('title', 'Rekap Penjualan')

@section('content')
<div class="space-y-8">

    {{-- Header + Period Switch --}}
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
        <div>
            <h3 class="text-3xl font-black text-gray-900 tracking-tighter">Rekap Penjualan</h3>
            <p class="text-xs font-bold text-gray-400 uppercase tracking-widest mt-1">Pesanan berstatus Sudah Dibuat</p>
        </div>
        <div class="flex gap-2">
            @foreach(['daily' => 'Harian', 'weekly' => 'Mingguan', 'monthly' => 'Bulanan'] as $key => $label)
            <a href="{{ route('cashier.rekap.index', ['period' => $key]) }}"
               class="px-4 py-2.5 text-xs font-bold rounded-xl transition-all {{ $period === $key ? 'bg-black text-white shadow-lg shadow-black/10' : 'bg-white text-gray-500 border border-gray-200 hover:bg-gray-50' }}">
               {{ $label }}
            </a>
            @endforeach
        </div>
    </div>

    {{-- Stats Cards --}}
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
        <div class="bg-white p-6 rounded-[2rem] border border-gray-200 shadow-sm">
            <p class="text-[10px] font-black text-gray-400 uppercase tracking-[0.2em] mb-2">Total Pemasukan</p>
            <p class="text-3xl font-black text-gray-900 tracking-tighter">Rp {{ number_format($totalRevenue, 0, ',', '.') }}</p>
        </div>
        <div class="bg-white p-6 rounded-[2rem] border border-gray-200 shadow-sm">
            <p class="text-[10px] font-black text-gray-400 uppercase tracking-[0.2em] mb-2">Jumlah Pesanan</p>
            <p class="text-3xl font-black text-gray-900 tracking-tighter">{{ $totalOrders }} <span class="text-base text-gray-400 font-semibold">pesanan</span></p>
        </div>
        <div class="bg-white p-6 rounded-[2rem] border border-gray-200 shadow-sm">
            <p class="text-[10px] font-black text-gray-400 uppercase tracking-[0.2em] mb-2">Total Item Terjual</p>
            <p class="text-3xl font-black text-gray-900 tracking-tighter">{{ $totalItems }} <span class="text-base text-gray-400 font-semibold">item</span></p>
        </div>
    </div>

    {{-- Orders Table --}}
    <div class="bg-white border border-gray-200 rounded-[2.5rem] shadow-sm overflow-hidden">
        @if($orders->count() > 0)
        <div class="overflow-x-auto no-scrollbar">
            <table class="w-full text-left border-collapse min-w-[600px]">
                <thead class="bg-gray-50/50 border-b border-gray-100">
                    <tr>
                        <th class="pl-10 pr-4 py-5 text-[10px] font-black uppercase tracking-[0.3em] text-gray-400">Meja</th>
                        <th class="px-6 py-5 text-[10px] font-black uppercase tracking-[0.3em] text-gray-400">Pelanggan</th>
                        <th class="px-6 py-5 text-[10px] font-black uppercase tracking-[0.3em] text-gray-400">Item</th>
                        <th class="px-6 py-5 text-[10px] font-black uppercase tracking-[0.3em] text-gray-400">Total</th>
                        <th class="pl-4 pr-10 py-5 text-[10px] font-black uppercase tracking-[0.3em] text-gray-400 text-right">Waktu</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @foreach($orders as $order)
                    <tr class="hover:bg-gray-50 transition-colors">
                        <td class="px-6 py-4">
                            <div class="w-9 h-9 rounded-xl bg-black flex items-center justify-center text-white text-xs font-black">{{ $order->table_number }}</div>
                        </td>
                        <td class="px-6 py-4">
                            <p class="text-sm font-bold text-gray-900">{{ $order->customer_name ?: 'Tanpa Nama' }}</p>
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-600 font-medium">{{ $order->items->sum('quantity') }} item</td>
                        <td class="px-6 py-4 text-sm font-black text-gray-900">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</td>
                        <td class="px-6 py-4 text-xs text-gray-400 font-medium text-right">{{ $order->created_at->format('d M, H:i') }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @else
        <div class="py-20 text-center">
            <div class="w-14 h-14 bg-gray-50 rounded-2xl mx-auto flex items-center justify-center mb-4">
                <svg class="w-7 h-7 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            </div>
            <p class="text-gray-400 font-bold">Belum ada penjualan pada periode ini.</p>
        </div>
        @endif
    </div>

</div>
@endsection
