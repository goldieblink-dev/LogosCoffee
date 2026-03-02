<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Terima Kasih - Logos Coffe</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-50 flex flex-col min-h-screen p-6 items-center justify-center text-center">
    <div class="w-full max-w-md bg-white p-10 rounded-[40px] shadow-sm border border-gray-100">
        <div class="w-20 h-20 bg-green-50 text-green-500 rounded-full flex items-center justify-center mx-auto mb-6">
            <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path>
            </svg>
        </div>

        <h1 class="text-2xl font-heading font-bold mb-2">Pembayaran Berhasil!</h1>
        <p class="text-gray-500 text-sm mb-8">Pesanan Anda sedang diproses oleh kru kami. Harap tunggu di meja Anda.</p>

        <div class="bg-gray-50 p-6 rounded-3xl text-left space-y-4 mb-8">
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-[10px] text-gray-400 font-bold uppercase tracking-widest">Customer</p>
                    <p class="font-bold">{{ $order->customer_name }}</p>
                </div>
                <div class="text-right">
                    <p class="text-[10px] text-gray-400 font-bold uppercase tracking-widest">Meja</p>
                    <p class="font-bold">{{ $order->table_number }}</p>
                </div>
            </div>
            <div class="pt-4 border-t border-gray-200">
                <p class="text-[10px] text-gray-400 font-bold uppercase tracking-widest mb-2">Item Pesanan</p>
                <div class="space-y-2">
                    @foreach($order->items as $item)
                    <div class="flex justify-between text-xs">
                        <span class="text-gray-600">{{ $item->quantity }}x {{ $item->product->name }}</span>
                        <span class="font-bold">Rp {{ number_format($item->price * $item->quantity, 0, ',', '.')
                            }}</span>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>

        <a href="{{ url('/') }}"
            class="inline-block px-8 py-3 bg-black text-white font-bold rounded-xl hover:bg-gray-900 transition-colors shadow-lg shadow-black/20">
            Kembali ke Beranda
        </a>
    </div>
</body>

</html>