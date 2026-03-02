<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Owner') - Logos Coffe</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-50 flex min-h-screen">
    <!-- Sidebar -->
    <aside class="w-64 bg-black text-white p-6 flex flex-col fixed h-full">
        <div class="mb-10 text-center">
            <div class="mx-auto w-12 h-12 bg-white rounded-full flex items-center justify-center mb-2">
                <span class="font-heading text-xl text-black font-bold italic">LC</span>
            </div>
            <h2 class="font-heading text-lg font-bold">Owner Dashboard</h2>
        </div>

        <nav class="flex-1 space-y-2">
            <a href="/owner"
                class="block px-4 py-2 {{ request()->is('owner') ? 'bg-gray-900' : 'hover:bg-white/10' }} rounded-lg text-sm font-medium transition-colors">Ringkasan</a>

            <div
                class="pt-4 pb-2 text-[10px] font-bold uppercase tracking-widest text-gray-500 border-t border-white/10 mt-4">
                Inventaris & Harga</div>
            <a href="/owner/products"
                class="block px-4 py-2 {{ request()->is('owner/products*') ? 'bg-gray-900' : 'hover:bg-white/10' }} rounded-lg text-sm font-medium transition-colors">Produk
                & Promo</a>

            <div
                class="pt-4 pb-2 text-[10px] font-bold uppercase tracking-widest text-gray-500 border-t border-white/10 mt-4">
                Analitik</div>
            <a href="/owner/reports/sales"
                class="block px-4 py-2 {{ request()->is('owner/reports*') ? 'bg-gray-900' : 'hover:bg-white/10' }} rounded-lg text-sm font-medium transition-colors">Laporan
                Penjualan</a>
        </nav>

        <form method="POST" action="{{ route('logout') }}" class="mt-auto">
            @csrf
            <button type="submit"
                class="w-full px-4 py-2 text-left text-sm font-medium text-gray-400 hover:text-white transition-colors">
                Keluar
            </button>
        </form>
    </aside>

    <!-- Main Content -->
    <main class="flex-1 ml-64 p-10">
        <header class="mb-8 flex justify-between items-center">
            <h1 class="text-3xl font-heading font-bold">@yield('title')</h1>
            <div class="flex items-center gap-2">
                <span class="text-sm font-medium text-gray-500">Owner, </span>
                <span class="text-sm font-bold">{{ auth()->user()->name }}</span>
            </div>
        </header>

        @if(session('success'))
        <div class="bg-green-100 border border-green-200 text-green-700 px-4 py-3 rounded-lg mb-6 text-sm">
            {{ session('success') }}
        </div>
        @endif

        @yield('content')
    </main>
</body>

</html>