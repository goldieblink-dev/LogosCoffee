<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Pembayaran - Logos Coffe</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-50 flex flex-col min-h-screen p-6 items-center">
    <div class="w-full max-w-md bg-white p-8 rounded-[32px] shadow-sm border border-gray-100 text-center">
        <h1 class="text-xl font-heading font-bold mb-2">Selesaikan Pembayaran</h1>
        <p class="text-gray-500 text-sm mb-8">Scan QRIS di bawah ini untuk membayar</p>

        <div class="bg-gray-50 p-6 rounded-3xl border border-dashed border-gray-200 mb-8 inline-block mx-auto">
            <!-- Mock QRIS -->
            <div class="bg-white p-4 rounded-xl shadow-sm border border-gray-100">
                <img src="https://api.qrserver.com/v1/create-qr-code/?size=200x200&data=LOGOSCOFFE-ORDER-{{ $order->id }}"
                    alt="QRIS" class="w-48 h-48 mx-auto">
            </div>
            <div class="mt-4 flex items-center justify-center gap-2">
                <span class="font-bold text-lg">QRIS</span>
                <span class="text-gray-400">|</span>
                <span class="text-xs font-bold text-gray-400">LOGOS COFFE</span>
            </div>
        </div>

        <div class="space-y-3 mb-8 text-left">
            <div class="flex justify-between text-sm">
                <span class="text-gray-500 font-medium">Total Bill</span>
                <span class="font-bold">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</span>
            </div>
            <div class="flex justify-between text-sm">
                <span class="text-gray-500 font-medium">Order ID</span>
                <span class="font-mono text-xs">#LOGOS-{{ str_pad($order->id, 5, '0', STR_PAD_LEFT) }}</span>
            </div>
            <div class="flex justify-between text-sm">
                <span class="text-gray-500 font-medium">Meja</span>
                <span class="font-bold">{{ $order->table_number }}</span>
            </div>
        </div>

        <form action="{{ route('self-order.payment.process', $order) }}" method="POST">
            @csrf
            <button type="submit"
                class="w-full py-4 bg-black text-white font-bold rounded-2xl shadow-xl shadow-black/20 flex items-center justify-center gap-3">
                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                </svg>
                Saya Sudah Bayar
            </button>
        </form>

        <p class="mt-6 text-[10px] text-gray-400 italic">Sistem akan memverifikasi pembayaran Anda secara otomatis.</p>
    </div>
</body>

</html>