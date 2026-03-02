@extends('layouts.admin')

@section('title', 'Dashboard Overview')

@section('content')
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
    <!-- Sales Stats -->
    <div class="bg-white p-6 border border-gray-200 rounded-2xl shadow-sm">
        <h3 class="text-gray-400 text-xs font-bold uppercase tracking-wider mb-2">Penjualan Hari Ini</h3>
        <p class="text-3xl font-heading font-bold">Rp {{ number_format(\App\Models\Order::daily()->whereIn('status',
            ['paid', 'completed'])->sum('total_amount'), 0, ',', '.') }}</p>
    </div>

    <div class="bg-white p-6 border border-gray-200 rounded-2xl shadow-sm">
        <h3 class="text-gray-400 text-xs font-bold uppercase tracking-wider mb-2">Pesanan Masuk</h3>
        <p class="text-4xl font-heading font-bold">{{ \App\Models\Order::daily()->count() }}</p>
    </div>

    <!-- Product Status -->
    <div class="bg-white p-6 border border-gray-200 rounded-2xl shadow-sm">
        <h3 class="text-gray-400 text-xs font-bold uppercase tracking-wider mb-2">Total Produk</h3>
        <p class="text-4xl font-heading font-bold">{{ \App\Models\Product::count() }}</p>
        <p class="text-[10px] text-gray-500 mt-1 italic">{{ \App\Models\Product::where('is_available', true)->count() }}
            Tersedia</p>
    </div>

    <!-- Setup Stats -->
    <div class="bg-white p-6 border border-gray-200 rounded-2xl shadow-sm">
        <h3 class="text-gray-400 text-xs font-bold uppercase tracking-wider mb-2">Status Kafe</h3>
        @php $profile = \App\Models\CafeProfile::first(); @endphp
        <div class="flex items-center gap-2">
            @if($profile)
            <div class="w-2 h-2 bg-green-500 rounded-full"></div>
            <p class="text-sm font-bold">Aktif</p>
            @else
            <div class="w-2 h-2 bg-red-500 rounded-full"></div>
            <p class="text-sm font-bold">Belum Setup</p>
            @endif
        </div>
        <p class="text-[10px] text-gray-500 mt-1 italic">{{ $profile ? 'Profil dan jam operasional aktif' : 'Lengkapi
            data profil' }}</p>
    </div>
</div>
@endsection