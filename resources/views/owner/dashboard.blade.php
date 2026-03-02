@extends('layouts.owner')

@section('title', 'Ringkasan Bisnis')

@section('content')
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
    <!-- Sales Stats -->
    <div class="bg-black text-white p-6 rounded-2xl shadow-xl">
        <h3 class="text-gray-400 text-xs font-bold uppercase tracking-wider mb-2">Omzet Hari Ini</h3>
        <p class="text-3xl font-heading font-bold">Rp {{ number_format($dailyRevenue, 0, ',', '.') }}</p>
    </div>

    <div class="bg-white p-6 border border-gray-200 rounded-2xl shadow-sm">
        <h3 class="text-gray-400 text-xs font-bold uppercase tracking-wider mb-2">Total Omzet Keseluruhan</h3>
        <p class="text-2xl font-heading font-bold">Rp {{ number_format($totalRevenue, 0, ',', '.') }}</p>
    </div>

    <div class="bg-white p-6 border border-gray-200 rounded-2xl shadow-sm">
        <h3 class="text-gray-400 text-xs font-bold uppercase tracking-wider mb-2">Total Pesanan</h3>
        <p class="text-4xl font-heading font-bold">{{ $totalOrders }}</p>
    </div>

    <div class="bg-white p-6 border border-gray-200 rounded-2xl shadow-sm">
        <h3 class="text-gray-400 text-xs font-bold uppercase tracking-wider mb-2">Total Produk</h3>
        <p class="text-4xl font-heading font-bold">{{ $totalProducts }}</p>
    </div>
</div>

<div class="mt-10">
    <a href="{{ route('owner.reports.sales') }}"
        class="inline-block px-8 py-4 bg-black text-white font-bold rounded-2xl hover:bg-gray-900 transition-all shadow-lg">
        Lihat Laporan Detail & Analitik &rarr;
    </a>
</div>
@endsection