@extends('layouts.cashier')
@section('title', 'Dashboard Kasir')

@section('content')
<div class="space-y-6" x-data="{ countdown: 30 }" x-init="setInterval(() => { countdown--; if(countdown <= 0) window.location.reload(); }, 1000)">

    {{-- Header --}}
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-8">
        <div>
            <h3 class="text-3xl font-black text-gray-900 tracking-tighter">Terminal Kasir</h3>
            <p class="text-xs font-bold text-gray-400 uppercase tracking-widest mt-1">Shift {{ now()->format('d M Y') }}</p>
        </div>
        <div class="flex items-center gap-3">
            <div class="flex items-center gap-2 px-4 py-2.5 bg-white border border-gray-200 rounded-2xl shadow-sm">
                <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                <span class="text-xs font-bold text-gray-500">Refresh dalam <span class="text-black" x-text="countdown + 's'"></span></span>
            </div>
            <a href="{{ route('cashier.orders.index') }}" class="flex items-center gap-2 px-5 py-3 bg-black text-white text-sm font-black rounded-2xl hover:bg-gray-800 transition-all shadow-lg shadow-black/10 hover:-translate-y-0.5">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
                Lihat Pesanan
            </a>
        </div>
    </div>

    {{-- Stats Cards --}}
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
        {{-- Pesanan Aktif --}}
        <a href="{{ route('cashier.orders.index') }}" class="bg-white p-6 rounded-[2rem] border border-gray-200 shadow-sm relative overflow-hidden group hover:border-blue-200 hover:-translate-y-1 transition-all">
            <div class="flex justify-between items-start mb-4">
                <div class="w-12 h-12 rounded-2xl bg-blue-50 flex items-center justify-center">
                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                </div>
                <span class="text-[10px] font-black text-blue-400 uppercase tracking-widest">Live</span>
            </div>
            <h4 class="text-[10px] font-black text-gray-400 uppercase tracking-[0.2em] mb-1">Pesanan Aktif</h4>
            <div class="flex items-end gap-2">
                <span class="text-4xl font-black text-gray-900 tracking-tighter">{{ $activeOrders }}</span>
                <span class="text-sm font-bold text-blue-500 mb-1">pesanan</span>
            </div>
            <p class="text-xs text-gray-400 font-medium mt-1">Menunggu & Sedang Dibuat</p>
        </a>

        {{-- Pemasukan Shift Ini --}}
        <a href="{{ route('cashier.rekap.index') }}" class="bg-white p-6 rounded-[2rem] border border-gray-200 shadow-sm relative overflow-hidden group hover:border-emerald-200 hover:-translate-y-1 transition-all">
            <div class="flex justify-between items-start mb-4">
                <div class="w-12 h-12 rounded-2xl bg-emerald-50 flex items-center justify-center">
                    <svg class="w-6 h-6 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                </div>
                <span class="text-[10px] font-black text-emerald-400 uppercase tracking-widest">Hari ini</span>
            </div>
            <h4 class="text-[10px] font-black text-gray-400 uppercase tracking-[0.2em] mb-1">Pemasukan Shift Ini</h4>
            <div class="flex items-end gap-2">
                <span class="text-3xl font-black text-gray-900 tracking-tighter">Rp {{ number_format($shiftRevenue, 0, ',', '.') }}</span>
            </div>
            <p class="text-xs text-gray-400 font-medium mt-1">Pesanan selesai hari ini</p>
        </a>

        {{-- Meja Terpakai --}}
        <a href="{{ route('cashier.orders.index') }}" class="bg-white p-6 rounded-[2rem] border border-gray-200 shadow-sm relative overflow-hidden group hover:border-orange-200 hover:-translate-y-1 transition-all">
            <div class="flex justify-between items-start mb-4">
                <div class="w-12 h-12 rounded-2xl bg-orange-50 flex items-center justify-center">
                    <svg class="w-6 h-6 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                </div>
                <span class="text-[10px] font-black text-orange-400 uppercase tracking-widest">Live</span>
            </div>
            <h4 class="text-[10px] font-black text-gray-400 uppercase tracking-[0.2em] mb-1">Meja Terpakai</h4>
            <div class="flex items-end gap-2">
                <span class="text-4xl font-black text-gray-900 tracking-tighter">{{ $occupiedTables }}</span>
                <span class="text-sm font-bold text-gray-400 mb-1">meja aktif</span>
            </div>
            <p class="text-xs text-gray-400 font-medium mt-1">Memiliki pesanan aktif</p>
        </a>
    </div>

    {{-- Recent Active Orders --}}
    <div class="bg-white border border-gray-200 rounded-[2.5rem] shadow-sm overflow-hidden">
        <div class="px-8 py-5 border-b border-gray-100 flex items-center justify-between">
            <h4 class="font-black text-gray-900">Pesanan Terbaru</h4>
            <a href="{{ route('cashier.orders.index') }}" class="text-xs font-black text-gray-400 hover:text-black transition-colors uppercase tracking-wider">Lihat Semua →</a>
        </div>

        @if($recentOrders->count() > 0)
        <div class="divide-y divide-gray-100">
            @foreach($recentOrders as $order)
            <div class="flex items-center justify-between px-8 py-4 hover:bg-gray-50 transition-colors">
                <div class="flex items-center gap-4">
                    <div class="w-10 h-10 rounded-xl bg-black flex items-center justify-center text-white text-sm font-black">{{ $order->table_number }}</div>
                    <div>
                        <p class="text-sm font-bold text-gray-900">{{ $order->customer_name ?: 'Tanpa Nama' }}</p>
                        <p class="text-xs text-gray-400 font-medium">{{ $order->items->count() }} item · {{ $order->created_at->diffForHumans() }}</p>
                    </div>
                </div>
                <div class="flex items-center gap-3">
                    <span class="px-2.5 py-1 text-[10px] font-black uppercase rounded-xl tracking-wider"
                        @class([
                            'bg-blue-50 text-blue-700' => $order->status === 'paid',
                            'bg-purple-50 text-purple-700' => $order->status === 'processing',
                            'bg-emerald-50 text-emerald-700' => $order->status === 'completed',
                        ])>
                        {{ ['paid' => 'Belum Dibuat', 'processing' => 'Sedang Dibuat', 'completed' => 'Sudah Dibuat'][$order->status] ?? $order->status }}
                    </span>
                    <span class="text-sm font-black text-gray-900">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</span>
                </div>
            </div>
            @endforeach
        </div>
        @else
        <div class="py-16 text-center">
            <div class="w-14 h-14 bg-gray-50 rounded-full mx-auto flex items-center justify-center mb-3">
                <svg class="w-7 h-7 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
            </div>
            <p class="text-sm font-bold text-gray-400">Belum ada pesanan aktif saat ini.</p>
        </div>
        @endif
    </div>

</div>
@endsection
