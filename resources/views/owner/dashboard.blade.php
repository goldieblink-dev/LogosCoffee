@extends('layouts.owner')
@section('title', 'Dashboard Owner')

@section('content')
<div class="space-y-8">

    <div class="flex flex-col sm:flex-row justify-between items-start gap-4">
        <div>
            <h3 class="text-3xl font-black text-gray-900 tracking-tighter">Dashboard Owner</h3>
            <p class="text-xs font-bold text-gray-400 uppercase tracking-widest mt-1">Ikhtisar Bisnis Logos Coffee</p>
        </div>
        <a href="{{ route('owner.reports.index') }}" class="flex items-center gap-2 px-5 py-3 bg-black text-white text-sm font-black rounded-2xl hover:bg-gray-800 transition-all shadow-lg shadow-black/10 hover:-translate-y-0.5">
            <svg class="w-4.5 h-4.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg>
            Laporan Lengkap
        </a>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
        <a href="{{ route('owner.reports.index') }}" class="bg-white p-6 rounded-[2rem] border border-gray-200 shadow-sm hover:border-amber-200 hover:-translate-y-1 transition-all group">
            <div class="w-12 h-12 rounded-2xl bg-amber-50 flex items-center justify-center mb-4">
                <svg class="w-6 h-6 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            </div>
            <p class="text-[10px] font-black text-gray-400 uppercase tracking-[0.2em] mb-1">Total Omzet</p>
            <p class="text-2xl font-black text-gray-900 tracking-tighter">Rp {{ number_format($totalRevenue, 0, ',', '.') }}</p>
            <p class="text-xs text-gray-400 mt-1">Semua waktu</p>
        </a>
        <a href="{{ route('owner.reports.index', ['period'=>'daily']) }}" class="bg-white p-6 rounded-[2rem] border border-gray-200 shadow-sm hover:border-emerald-200 hover:-translate-y-1 transition-all">
            <div class="w-12 h-12 rounded-2xl bg-emerald-50 flex items-center justify-center mb-4">
                <svg class="w-6 h-6 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/></svg>
            </div>
            <p class="text-[10px] font-black text-gray-400 uppercase tracking-[0.2em] mb-1">Pendapatan Hari Ini</p>
            <p class="text-2xl font-black text-gray-900 tracking-tighter">Rp {{ number_format($todayRevenue, 0, ',', '.') }}</p>
            <p class="text-xs text-gray-400 mt-1">{{ now()->format('d M Y') }}</p>
        </a>
        <a href="{{ route('owner.reports.index') }}" class="bg-white p-6 rounded-[2rem] border border-gray-200 shadow-sm hover:border-blue-200 hover:-translate-y-1 transition-all">
            <div class="w-12 h-12 rounded-2xl bg-blue-50 flex items-center justify-center mb-4">
                <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
            </div>
            <p class="text-[10px] font-black text-gray-400 uppercase tracking-[0.2em] mb-1">Total Pesanan</p>
            <p class="text-2xl font-black text-gray-900 tracking-tighter">{{ $totalOrders }}</p>
            <p class="text-xs text-gray-400 mt-1">Pesanan selesai</p>
        </a>
        <a href="{{ route('owner.products.index') }}" class="bg-white p-6 rounded-[2rem] border border-gray-200 shadow-sm hover:border-purple-200 hover:-translate-y-1 transition-all">
            <div class="w-12 h-12 rounded-2xl bg-purple-50 flex items-center justify-center mb-4">
                <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/></svg>
            </div>
            <p class="text-[10px] font-black text-gray-400 uppercase tracking-[0.2em] mb-1">Total Produk</p>
            <p class="text-2xl font-black text-gray-900 tracking-tighter">{{ $totalProducts }}</p>
            <p class="text-xs text-gray-400 mt-1">Produk terdaftar</p>
        </a>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <a href="{{ route('owner.products.index') }}" class="bg-white border border-gray-200 rounded-[2rem] shadow-sm p-6 flex items-center gap-4 hover:border-black/20 hover:-translate-y-1 transition-all group">
            <div class="w-14 h-14 rounded-2xl bg-gray-100 flex items-center justify-center shrink-0 group-hover:bg-black group-hover:text-white transition-colors">
                <svg class="w-7 h-7 text-gray-400 group-hover:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"/></svg>
            </div>
            <div>
                <h4 class="font-black text-gray-900">Tambah Produk</h4>
                <p class="text-sm text-gray-400 font-medium mt-0.5">Tambah menu baru & atur harga jual</p>
            </div>
        </a>
        <a href="{{ route('owner.promos.index') }}" class="bg-white border border-gray-200 rounded-[2rem] shadow-sm p-6 flex items-center gap-4 hover:border-black/20 hover:-translate-y-1 transition-all group">
            <div class="w-14 h-14 rounded-2xl bg-gray-100 flex items-center justify-center shrink-0 group-hover:bg-black group-hover:text-white transition-colors">
                <svg class="w-7 h-7 text-gray-400 group-hover:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/></svg>
            </div>
            <div>
                <h4 class="font-black text-gray-900">Kelola Promo</h4>
                <p class="text-sm text-gray-400 font-medium mt-0.5">Tentukan diskon & harga promo produk</p>
            </div>
        </a>
    </div>

</div>
@endsection
