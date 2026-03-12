<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">
    <title>Terima Kasih - Logos Coffee</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&family=Playfair+Display:ital,wght@0,600;0,700;1,600&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body { font-family: 'Inter', sans-serif; background-color: #f8fafc; }
        .font-playfair { font-family: 'Playfair Display', serif; }
        .pb-safe { padding-bottom: env(safe-area-inset-bottom); }
        
        /* Receipt ticket edge effect */
        .ticket-edge {
            background-image: radial-gradient(circle at 12px 0, transparent 12px, white 13px);
            background-size: 24px 24px;
            background-position: -12px 0px;
            background-repeat: repeat-x;
            height: 24px;
            width: 100%;
            position: absolute;
            top: -24px;
            left: 0;
            filter: drop-shadow(0 -10px 10px rgba(0,0,0,0.02));
        }
    </style>
</head>
<body class="text-gray-900 min-h-screen flex flex-col pt-12">

    <main class="flex-1 max-w-md mx-auto w-full px-4 flex flex-col justify-center pb-12">
        
        {{-- Success Animation/Header --}}
        <div class="text-center mb-10">
            <div class="w-20 h-20 bg-emerald-50 rounded-full flex items-center justify-center mx-auto mb-6 relative">
                <div class="absolute inset-0 bg-emerald-500 rounded-full animate-ping opacity-20"></div>
                <div class="w-14 h-14 bg-emerald-500 rounded-full flex items-center justify-center shadow-lg shadow-emerald-500/30">
                    <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg>
                </div>
            </div>
            
            <h1 class="font-playfair text-3xl font-bold text-gray-900 mb-2">Terima Kasih</h1>
            <p class="text-sm text-gray-500 font-medium px-4">Pembayaran Anda telah diterima. Kami sedang menyiapkan pesanan Anda.</p>
        </div>

        {{-- Digital Receipt --}}
        <div class="relative bg-white pt-8 pb-6 px-6 shadow-xl shadow-gray-200/50 flex flex-col">
            <div class="ticket-edge hidden sm:block"></div>
            
            <div class="text-center mb-6 border-b-2 border-dashed border-gray-200 pb-6">
                <div class="w-10 h-10 bg-black rounded-full flex items-center justify-center text-white font-playfair font-bold text-lg mx-auto mb-3">LC</div>
                <p class="text-[10px] font-black tracking-[0.2em] uppercase text-gray-400">Logos Coffee</p>
                <h2 class="font-mono text-xl font-bold tracking-widest text-gray-900 mt-1">#LC-{{ str_pad($order->id, 5, '0', STR_PAD_LEFT) }}</h2>
                <p class="text-xs text-gray-400 font-medium mt-1">{{ $order->created_at->format('d M Y, H:i') }}</p>
            </div>

            <div class="space-y-4 mb-6">
                <div class="flex justify-between items-center text-sm">
                    <span class="text-gray-400 font-medium">Pelanggan</span>
                    <span class="font-bold text-gray-900">{{ $order->customer_name }}</span>
                </div>
                <div class="flex justify-between items-center text-sm">
                    <span class="text-gray-400 font-medium">Kasir</span>
                    <span class="font-bold text-gray-900">Self-Order</span>
                </div>
                <div class="flex justify-between items-center text-sm">
                    <span class="text-gray-400 font-medium">Nomor Meja</span>
                    <span class="w-8 h-8 bg-gray-100 rounded-full flex items-center justify-center font-black text-xs">{{ $order->table_number }}</span>
                </div>
            </div>

            <div class="border-t-2 border-dashed border-gray-200 pt-6 mb-6">
                <div class="space-y-3">
                    @foreach($order->items as $item)
                    <div class="flex justify-between items-start">
                        <div class="flex-1 pr-4">
                            <span class="font-bold text-sm text-gray-900">{{ $item->product->name }}</span>
                            <div class="text-[11px] text-gray-400 font-medium mt-0.5">{{ $item->quantity }} x Rp {{ number_format($item->price, 0, ',', '.') }}</div>
                        </div>
                        <span class="font-bold text-sm text-gray-900 shrink-0">Rp {{ number_format($item->price * $item->quantity, 0, ',', '.') }}</span>
                    </div>
                    @endforeach
                </div>
            </div>

            <div class="border-t-2 border-dashed border-gray-200 pt-6">
                <div class="flex justify-between items-end mb-1">
                    <span class="text-[11px] font-black uppercase tracking-widest text-gray-400">Total Pembayaran</span>
                    <span class="text-2xl font-black text-gray-900 tracking-tighter">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</span>
                </div>
                <div class="flex justify-between items-center text-xs mt-2">
                    <span class="text-gray-400">Metode</span>
                    <span class="font-bold text-gray-900 uppercase">QRIS</span>
                </div>
            </div>
            
            {{-- Ticket bottom edge --}}
            <div class="absolute left-0 bottom-0 w-full h-4 bg-[url('data:image/svg+xml;base64,PHN2ZyB4bWxucz0naHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmcnIHdpZHRoPScxMicgaGVpZ2h0PScxMic+PHBhdGggZD0nTTUuOSAwbDYuMSA2LjFMNS45IDEyIDAgNi4xbDYuMS02LjF6JyBmaWxsPScjZjhmYWZjJy8+PC9zdmc+')] bg-repeat-x rotate-180 transform translate-y-2 hidden sm:block"></div>
        </div>

        {{-- Next Action --}}
        <div class="mt-8 pb-safe text-center">
            <a href="{{ route('self-order.index') }}" class="inline-flex items-center justify-center gap-2 px-8 py-3.5 bg-white text-black border border-gray-200 text-sm font-black rounded-full hover:bg-gray-50 transition-all shadow-sm">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                Kembali ke Beranda
            </a>
            
            {{-- Reset Session Storage Cart Script --}}
            <script>
                sessionStorage.removeItem('logos_cart');
            </script>
        </div>

    </main>
</body>
</html>