@extends('layouts.cashier')

@section('title', 'Cashier Dashboard')

@section('content')
<div class="grid grid-cols-1 md:grid-cols-3 gap-6">
    <div class="bg-white p-6 border border-gray-200 rounded-2xl shadow-sm">
        <h3 class="text-gray-400 text-xs font-bold uppercase tracking-wider mb-2">Penjualan Hari Ini</h3>
        <p class="text-3xl font-heading font-bold">Rp {{ number_format(\App\Models\Order::daily()->whereIn('status',
            ['paid', 'completed'])->sum('total_amount'), 0, ',', '.') }}</p>
    </div>
    <div class="bg-white p-6 border border-gray-200 rounded-2xl shadow-sm">
        <h3 class="text-gray-400 text-xs font-bold uppercase tracking-wider mb-2">Pesanan Masuk (Hari Ini)</h3>
        <p class="text-4xl font-heading font-bold">{{ \App\Models\Order::daily()->count() }}</p>
    </div>
    <div class="bg-white p-6 border border-gray-200 rounded-2xl shadow-sm">
        <h3 class="text-gray-400 text-xs font-bold uppercase tracking-wider mb-2">Status Produk</h3>
        <p class="text-4xl font-heading font-bold">{{ \App\Models\Product::where('is_available', true)->count() }}</p>
        <p class="text-[10px] text-gray-500 mt-1 italic">Produk tersedia untuk dipesan</p>
    </div>
</div>
@endsection