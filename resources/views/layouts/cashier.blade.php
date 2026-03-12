<!DOCTYPE html>
<html lang="id" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Kasir') — Logos Coffee</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Playfair+Display:wght@600;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <style>
        * { box-sizing: border-box; }
        body { font-family: 'Inter', sans-serif; }
        [x-cloak] { display: none !important; }
        .no-scrollbar::-webkit-scrollbar { display: none; }
        .no-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
    </style>
</head>
<body class="h-full bg-[#f8fafc] overflow-hidden text-gray-800" x-data="{ sidebarOpen: false }">

    <div class="flex h-screen overflow-hidden">

        {{-- ═══ SIDEBAR ═══ --}}
        <aside
            :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full lg:translate-x-0'"
            @click.away="if(window.innerWidth < 1024) sidebarOpen = false"
            class="fixed inset-y-0 left-0 z-50 w-64 bg-slate-900 flex flex-col lg:static transition-transform duration-300 ease-in-out shadow-xl lg:shadow-none"
        >
            {{-- Brand --}}
            <div class="px-6 py-8 border-b border-slate-800 flex items-center justify-between">
                <a href="{{ route('cashier.dashboard') }}" class="block">
                    <p class="text-[10px] font-semibold text-slate-400 uppercase tracking-widest mb-1">Kasir Terminal</p>
                    <h1 class="font-playfair text-white text-xl font-bold tracking-tight">Logos Coffee</h1>
                </a>
                <button @click="sidebarOpen = false" class="lg:hidden text-slate-400 hover:text-white transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                </button>
            </div>

            {{-- Nav --}}
            <nav class="flex-1 px-4 py-6 overflow-y-auto no-scrollbar space-y-1">
                @php
                    $navItems = [
                        ['route' => 'cashier.dashboard',  'label' => 'Dashboard',          'icon' => '<path d="M3 13h8V3H3v10zm0 8h8v-6H3v6zm10 0h8V11h-8v10zm0-18v6h8V3h-8z"/>'],
                        ['route' => 'cashier.orders.index',   'label' => 'Pesanan Masuk',  'icon' => '<path d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>'],
                        ['route' => 'cashier.products.index', 'label' => 'Produk Menu',    'icon' => '<path d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>'],
                        ['route' => 'cashier.rekap.index',    'label' => 'Rekap Penjualan','icon' => '<path d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>'],
                    ];
                @endphp

                @foreach($navItems as $item)
                    @if(Route::has($item['route']))
                    <a href="{{ route($item['route']) }}"
                       class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium transition-colors
                              {{ request()->routeIs($item['route']) ? 'bg-slate-800 text-white' : 'text-slate-400 hover:text-white hover:bg-slate-800/50' }}">
                        <svg class="w-4.5 h-4.5 opacity-80" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="stroke-width: 2px;">{ls -al /home/g0ldie/Documents/code/project-fnb/app/Http/Controllers/Cashier/ $item['icon'] !!}</svg>
                        {{ $item['label'] }}
                    </a>
                    @endif
                @endforeach
            </nav>

            {{-- User Profile Area --}}
            <div class="p-4 border-t border-slate-800">
                <div class="flex items-center gap-3 px-2 py-2">
                    <div class="w-9 h-9 rounded-full bg-slate-700 flex items-center justify-center text-white text-sm font-semibold">
                        {{ strtoupper(substr(auth()->user()->name ?? 'K', 0, 1)) }}
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="text-white text-sm font-medium truncate">{{ auth()->user()->name ?? 'Kasir' }}</p>
                        <p class="text-slate-400 text-xs truncate capitalize">{{ auth()->user()->role ?? 'cashier' }}</p>
                    </div>
                </div>
                <form method="POST" action="{{ route('logout') }}" class="mt-3">
                    @csrf
                    <button type="submit" class="w-full flex items-center justify-center gap-2 py-2 rounded-lg text-xs font-medium text-slate-400 hover:text-white hover:bg-slate-800 transition-colors">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                        Keluar
                    </button>
                </form>
            </div>
        </aside>

        {{-- Mobile Sidebar Overlay --}}
        <div x-show="sidebarOpen" x-cloak @click="sidebarOpen = false"
             class="fixed inset-0 z-40 bg-slate-900/60 backdrop-blur-sm lg:hidden transition-opacity duration-300"
             x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
             x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"></div>

        {{-- ═══ MAIN CONTENT ═══ --}}
        <div class="flex-1 flex flex-col min-w-0 overflow-hidden relative">

            {{-- Topbar --}}
            <header class="bg-white border-b border-slate-200 px-6 sm:px-10 h-16 flex items-center justify-between sticky top-0 z-30 flex-shrink-0">
                <div class="flex items-center gap-4">
                    <button @click="sidebarOpen = true" class="lg:hidden text-slate-500 hover:text-slate-900 transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"/></svg>
                    </button>
                    <div>
                        <h2 class="text-xl font-semibold text-slate-900 leading-tight">@yield('title', 'Dashboard')</h2>
                    </div>
                </div>
                
                <div class="flex items-center gap-4">
                    <div class="hidden md:flex flex-col items-end">
                        @php $profile = \App\Models\CafeProfile::first(); @endphp
                        <span class="text-sm font-medium text-slate-900">{{ $profile->name ?? 'Logos Coffee' }}</span>
                        <div class="flex items-center gap-1.5 mt-0.5">
                            <span class="w-1.5 h-1.5 rounded-full bg-blue-500"></span>
                            <span class="text-[10px] font-medium text-slate-500 uppercase tracking-wider">Terminal Kasir Aktif</span>
                        </div>
                    </div>
                    <div class="w-9 h-9 rounded-full bg-blue-100 text-blue-900 border border-blue-200 flex items-center justify-center text-sm font-semibold">
                        {{ strtoupper(substr(auth()->user()->name ?? 'K', 0, 1)) }}
                    </div>
                </div>
            </header>

            {{-- Flash Alerts --}}
            <div class="absolute top-4 right-4 sm:right-6 z-50 w-full max-w-sm pointer-events-none space-y-3">
                @if(session('success'))
                <div x-data="{show: true}" x-show="show" x-init="setTimeout(() => show = false, 4000)" x-cloak x-transition
                     class="pointer-events-auto flex items-center gap-3 bg-emerald-50 border border-emerald-100 text-emerald-800 shadow-sm px-4 py-3 rounded-xl">
                     <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                    <p class="text-sm font-medium">{{ session('success') }}</p>
                </div>
                @endif
                @if(session('error'))
                <div x-data="{show: true}" x-show="show" x-init="setTimeout(() => show = false, 5000)" x-cloak x-transition
                     class="pointer-events-auto flex items-center gap-3 bg-rose-50 border border-rose-100 text-rose-800 shadow-sm px-4 py-3 rounded-xl">
                     <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    <p class="text-sm font-medium">{{ session('error') }}</p>
                </div>
                @endif
            </div>

            {{-- Page Content --}}
            <main class="flex-1 overflow-y-auto no-scrollbar scroll-smooth">
                <div class="max-w-[1200px] mx-auto p-6 sm:p-10">
                    @yield('content')
                </div>
            </main>
        </div>
    </div>

</body>
</html>
