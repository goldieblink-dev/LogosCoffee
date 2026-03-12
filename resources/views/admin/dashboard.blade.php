@extends('layouts.admin')
@section('title', 'Dashboard')

@section('content')
<div class="mb-8">
    <p class="text-slate-500 text-sm font-medium">Overview of your cafe's system and performance.</p>
</div>

<div class="space-y-8">

    {{-- Stats Grid --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 md:gap-6">
        @php
        $cards = [
            ['label'=>'Total Produk','value'=>$stats['products'],'color'=>'bg-blue-50 text-blue-600','icon'=>'<path d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>'],
            ['label'=>'Kategori','value'=>$stats['categories'],'color'=>'bg-emerald-50 text-emerald-600','icon'=>'<path d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A2 2 0 013 12V7a4 4 0 014-4z"/>'],
            ['label'=>'Pengguna','value'=>$stats['users'],'color'=>'bg-purple-50 text-purple-600','icon'=>'<path d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>'],
            ['label'=>'Total Pesanan','value'=>$stats['orders'],'color'=>'bg-amber-50 text-amber-600','icon'=>'<path d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>'],
        ];
        @endphp
        @foreach($cards as $card)
        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6 hover:shadow-md transition-shadow">
            <div class="flex items-center justify-between mb-4">
                <div class="{{ $card['color'] }} w-12 h-12 rounded-xl flex items-center justify-center">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="stroke-width: 2px;">{!! $card['icon'] !!}</svg>
                </div>
            </div>
            <div>
                <p class="text-3xl font-bold text-slate-900">{{ $card['value'] }}</p>
                <p class="text-sm font-medium text-slate-500 mt-1">{{ $card['label'] }}</p>
            </div>
        </div>
        @endforeach
    </div>

    {{-- Quick Links --}}
    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
        <div class="px-6 py-5 border-b border-slate-100">
            <h3 class="text-sm font-semibold text-slate-900">Akses Cepat Panel</h3>
        </div>
        <div class="p-6">
            <div class="grid grid-cols-1 min-[450px]:grid-cols-2 lg:grid-cols-4 gap-4">
                <a href="{{ route('admin.categories.index') }}" class="flex items-center gap-3 px-5 py-4 rounded-xl border border-slate-200 hover:border-slate-300 hover:bg-slate-50 text-sm font-medium text-slate-700 transition-colors">
                    <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A2 2 0 013 12V7a4 4 0 014-4z"/></svg>
                    Kategori Menu
                </a>
                <a href="{{ route('admin.products.index') }}" class="flex items-center gap-3 px-5 py-4 rounded-xl border border-slate-200 hover:border-slate-300 hover:bg-slate-50 text-sm font-medium text-slate-700 transition-colors">
                    <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/></svg>
                    Produk Menu
                </a>
                <a href="{{ route('admin.users.index') }}" class="flex items-center gap-3 px-5 py-4 rounded-xl border border-slate-200 hover:border-slate-300 hover:bg-slate-50 text-sm font-medium text-slate-700 transition-colors">
                    <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                    Pengguna Sistem
                </a>
                <a href="{{ route('admin.profile.show') }}" class="flex items-center gap-3 px-5 py-4 rounded-xl border border-slate-200 hover:border-slate-300 hover:bg-slate-50 text-sm font-medium text-slate-700 transition-colors">
                    <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                    Profil Cafe
                </a>
            </div>
        </div>
    </div>

</div>
@endsection
