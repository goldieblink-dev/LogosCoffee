<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">
    <title>Pembayaran - Logos Coffee</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&family=Playfair+Display:ital,wght@0,600;0,700;1,600&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body { font-family: 'Inter', sans-serif; background-color: #f8fafc; }
        .font-playfair { font-family: 'Playfair Display', serif; }
        .pb-safe { padding-bottom: env(safe-area-inset-bottom); }
    </style>
</head>
<body class="text-gray-900 min-h-screen flex flex-col">

    {{-- HEADER --}}
    <header class="bg-white/80 backdrop-blur-md border-b border-gray-100 shadow-sm sticky top-0 z-40">
        <div class="max-w-md mx-auto px-4 h-16 flex items-center justify-center relative">
            <a href="javascript:history.back()" class="absolute left-4 w-10 h-10 bg-gray-100 rounded-full flex items-center justify-center text-gray-500 hover:bg-gray-200 transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7"/></svg>
            </a>
            <div class="flex items-center gap-2">
                <div class="w-8 h-8 bg-black rounded-full flex items-center justify-center text-white font-playfair font-bold text-sm">LC</div>
                <span class="font-playfair font-bold text-lg tracking-tight">Pembayaran</span>
            </div>
        </div>
    </header>

    {{-- MAIN CONTENT --}}
    <main class="flex-1 max-w-md mx-auto w-full px-4 py-8 flex flex-col">
        
        {{-- Step Indicator --}}
        <div class="flex items-center justify-center gap-2 mb-8">
            <div class="w-2 h-2 rounded-full bg-gray-300"></div>
            <div class="w-2 h-2 rounded-full bg-gray-300"></div>
            <div class="w-6 h-2 rounded-full bg-black"></div>
        </div>

        <div class="text-center mb-8">
            <h1 class="font-playfair text-2xl font-bold text-gray-900 mb-2">Scan QRIS</h1>
            <p class="text-sm text-gray-500 font-medium">Buka aplikasi m-banking atau e-wallet Anda dan scan kode QR di bawah ini.</p>
        </div>

        {{-- QRIS Card --}}
        <div class="bg-white rounded-[2.5rem] shadow-xl shadow-gray-200/50 border border-gray-100 p-8 mb-6 flex flex-col items-center relative overflow-hidden">
            <div class="absolute top-0 inset-x-0 h-2 bg-gradient-to-r from-blue-500 via-sky-400 to-blue-500"></div>
            
            <div class="flex items-center gap-2 bg-blue-50 text-blue-700 px-4 py-1.5 rounded-full mb-6">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/></svg>
                <span class="text-xs font-black tracking-widest uppercase">QRIS Verified</span>
            </div>

            <div class="bg-white border-2 border-dashed border-gray-200 p-4 rounded-3xl mb-4">
                <img src="https://api.qrserver.com/v1/create-qr-code/?size=250x250&data=LOGOSCOFFEE-ORDER-{{ $order->id }}" alt="QRIS" class="w-48 h-48 sm:w-56 sm:h-56 object-contain rounded-xl">
            </div>

            <p class="text-2xl font-black text-gray-900 tracking-tighter mb-1">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</p>
            <p class="text-[10px] font-bold text-gray-400 tracking-widest uppercase">Total Tagihan</p>
        </div>

        {{-- Order Summary --}}
        <div class="bg-white rounded-3xl border border-gray-100 p-6 mb-8 shadow-sm">
            <h3 class="text-[11px] font-black tracking-widest uppercase text-gray-400 mb-4 pb-2 border-b border-gray-100">Ringkasan Pesanan</h3>
            
            <div class="space-y-3">
                <div class="flex justify-between items-center text-sm">
                    <span class="text-gray-500 font-medium">Order ID</span>
                    <span class="font-bold text-gray-900 tracking-wider">#LC-{{ str_pad($order->id, 5, '0', STR_PAD_LEFT) }}</span>
                </div>
                <div class="flex justify-between items-center text-sm">
                    <span class="text-gray-500 font-medium">Pelanggan</span>
                    <span class="font-bold text-gray-900">{{ $order->customer_name }}</span>
                </div>
                <div class="flex justify-between items-center text-sm">
                    <span class="text-gray-500 font-medium">Nomor Meja</span>
                    <span class="w-8 h-8 bg-black text-white rounded-lg flex items-center justify-center font-black text-xs">{{ $order->table_number }}</span>
                </div>
            </div>
        </div>

        {{-- Action Button --}}
        <div class="mt-auto pb-safe">
            <form action="{{ route('self-order.payment.process', $order) }}" method="POST">
                @csrf
                <button type="submit" class="w-full py-4 bg-black text-white text-base font-black rounded-2xl flex items-center justify-center gap-2 hover:bg-gray-800 transition-all shadow-xl shadow-black/20 hover:-translate-y-0.5 active:translate-y-0">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    Saya Sudah Membayar
                </button>
            </form>
            <p class="text-center text-xs text-gray-400 font-medium mt-4">
                Sistem akan memverifikasi pembayaran Anda secara otomatis.
            </p>
        </div>

    </main>
</body>
</html>