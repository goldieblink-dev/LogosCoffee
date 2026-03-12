<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">
    <title>Mulai Pesanan - Logos Coffee</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;900&family=Playfair+Display:ital,wght@0,600;0,700;1,600&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body { font-family: 'Inter', sans-serif; }
        .font-playfair { font-family: 'Playfair Display', serif; }
        /* Hide number input arrows */
        input[type=number]::-webkit-inner-spin-button, 
        input[type=number]::-webkit-outer-spin-button { -webkit-appearance: none; margin: 0; }
    </style>
</head>
<body class="bg-gray-50 min-h-screen flex flex-col items-center justify-center relative overflow-hidden sm:p-6 p-0">

    {{-- Background Image for larger screens --}}
    <div class="fixed inset-0 z-0 hidden sm:block">
        <img src="https://images.unsplash.com/photo-1554118811-1e0d58224f24?q=80&w=2047&auto=format&fit=crop" alt="Coffee Background" class="w-full h-full object-cover">
        <div class="absolute inset-0 bg-black/40 backdrop-blur-sm"></div>
    </div>

    {{-- Form Container --}}
    <div class="relative z-10 w-full max-w-md bg-white sm:rounded-[2.5rem] rounded-none shadow-2xl overflow-hidden min-h-screen sm:min-h-0 flex flex-col">
        
        {{-- Hero Header --}}
        <div class="relative h-64 sm:h-56 bg-black flex flex-col justify-end p-8 overflow-hidden shrink-0">
            <img src="https://images.unsplash.com/photo-1509042239860-f550ce710b93?q=80&w=800&auto=format&fit=crop" class="absolute inset-0 w-full h-full object-cover opacity-40">
            <div class="absolute inset-0 bg-gradient-to-t from-black via-black/50 to-transparent"></div>
            
            
            <div class="relative z-10 flex flex-col h-full">
                <!-- Back Button -->
                <a href="{{ auth()->check() ? (auth()->user()->role === 'owner' ? url('/owner') : (auth()->user()->role === 'admin' ? url('/admin') : url('/cashier'))) : url('/') }}" class="self-start w-10 h-10 bg-white/20 hover:bg-white/30 backdrop-blur-md rounded-full flex items-center justify-center text-white transition-colors mb-auto border border-white/20">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7"/></svg>
                </a>
                
                <div class="mt-auto">
                    <div class="flex items-center gap-3 mb-3">
                        <div class="w-10 h-10 bg-white rounded-full flex items-center justify-center text-black font-playfair font-bold text-lg leading-none">LC</div>
                        <span class="text-white/80 text-xs font-bold tracking-[0.2em] uppercase">Logos Coffee</span>
                    </div>
                    <h1 class="text-white font-playfair text-3xl font-bold leading-tight">Mulai<br>Pesanan Anda</h1>
                </div>
            </div>
        </div>

        {{-- Form Content --}}
        <div class="p-8 pb-12 flex-1 flex flex-col">
            <p class="text-sm font-medium text-gray-500 mb-8">Silakan lengkapi data di bawah ini untuk melihat menu dan memulai pesanan.</p>

            @if ($errors->any())
                <div class="mb-6 p-4 rounded-2xl bg-red-50 border border-red-100 text-red-600 text-sm font-medium">
                    <ul class="list-disc list-inside space-y-1">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('self-order.info.store') }}" method="POST" class="space-y-5 flex-1 flex flex-col">
                @csrf
                
                {{-- Field: No Meja --}}
                <div class="space-y-1.5">
                    <label for="table_number" class="block text-[11px] font-black tracking-[0.15em] text-gray-400 uppercase">Nomor Meja <span class="text-red-500">*</span></label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                        </div>
                        <input type="number" name="table_number" id="table_number" value="{{ old('table_number', $table) }}" required
                            pattern="[0-9]*" oninput="this.value = this.value.replace(/[^0-9]/g, '')"
                            class="w-full pl-11 pr-4 py-3.5 bg-gray-50 border border-gray-200 rounded-2xl text-base font-bold text-gray-900 focus:bg-white focus:ring-2 focus:ring-black focus:border-transparent outline-none transition-all placeholder:text-gray-400 placeholder:font-medium"
                            placeholder="Contoh: 5">
                    </div>
                    <p class="text-xs text-gray-400 font-medium ml-1">Hanya angka yang diperbolehkan.</p>
                </div>

                {{-- Field: Nama Pelanggan --}}
                <div class="space-y-1.5">
                    <label for="customer_name" class="block text-[11px] font-black tracking-[0.15em] text-gray-400 uppercase">Nama Panggilan <span class="text-red-500">*</span></label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                        </div>
                        <input type="text" name="customer_name" id="customer_name" value="{{ old('customer_name') }}" required
                            class="w-full pl-11 pr-4 py-3.5 bg-gray-50 border border-gray-200 rounded-2xl text-base font-bold text-gray-900 focus:bg-white focus:ring-2 focus:ring-black focus:border-transparent outline-none transition-all placeholder:text-gray-400 placeholder:font-medium"
                            placeholder="Ketik nama Anda">
                    </div>
                </div>

                {{-- Field: No. HP --}}
                <div class="space-y-1.5">
                    <label for="customer_phone" class="block text-[11px] font-black tracking-[0.15em] text-gray-400 uppercase">Nomor HP/WhatsApp <span class="text-red-500">*</span></label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                        </div>
                        <input type="tel" name="customer_phone" id="customer_phone" value="{{ old('customer_phone') }}" required
                            pattern="[0-9]*" oninput="this.value = this.value.replace(/[^0-9]/g, '')"
                            class="w-full pl-11 pr-4 py-3.5 bg-gray-50 border border-gray-200 rounded-2xl text-base font-bold text-gray-900 focus:bg-white focus:ring-2 focus:ring-black focus:border-transparent outline-none transition-all placeholder:text-gray-400 placeholder:font-medium"
                            placeholder="08xxxxxxxxxx">
                    </div>
                    <p class="text-xs text-gray-400 font-medium ml-1">Hanya angka yang diperbolehkan.</p>
                </div>

                <div class="mt-auto pt-8">
                    <button type="submit" class="w-full py-4 bg-black text-white text-base font-black rounded-2xl flex items-center justify-center gap-2 hover:bg-gray-800 transition-all shadow-xl shadow-black/20 hover:-translate-y-0.5 active:translate-y-0">
                        Lanjut ke Menu
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                    </button>
                    <p class="text-center text-xs text-gray-400 font-medium mt-4">
                        Dengan melanjutkan, Anda menyetujui kebijakan Logos Coffee.
                    </p>
                </div>
            </form>
        </div>
    </div>
</body>
</html>