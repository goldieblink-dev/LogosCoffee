<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Self Order - Logos Coffe</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        .premium-shadow {
            box-shadow: 0 20px 40px -10px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>

<body class="bg-gray-50 flex flex-col min-h-screen items-center justify-center p-6">
    <div class="w-full max-w-md bg-white p-8 rounded-3xl premium-shadow border border-gray-100">
        <div class="text-center mb-8">
            <div class="mx-auto w-16 h-16 bg-black rounded-full flex items-center justify-center mb-4">
                <span class="font-heading text-2xl text-white font-bold italic">LC</span>
            </div>
            <h1 class="text-2xl font-heading font-bold">Logos Coffe</h1>
            <p class="text-gray-500 text-sm mt-1">Silakan masukkan data pelanggan untuk memesan</p>
        </div>

        <form action="{{ route('self-order.info.store') }}" method="POST" class="space-y-6">
            @csrf
            <div>
                <label for="table_number"
                    class="block text-xs font-bold uppercase tracking-wider text-gray-700 mb-2">Nomor Meja</label>
                <input type="number" name="table_number" id="table_number" value="{{ old('table_number', $table) }}"
                    required placeholder="Contoh: 05"
                    class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:border-black transition-colors text-lg font-bold">
            </div>

            <div>
                <label for="customer_name"
                    class="block text-xs font-bold uppercase tracking-wider text-gray-700 mb-2">Nama Lengkap</label>
                <input type="text" name="customer_name" id="customer_name" required placeholder="Nama Anda"
                    class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:border-black transition-colors">
            </div>

            <div>
                <label for="customer_phone"
                    class="block text-xs font-bold uppercase tracking-wider text-gray-700 mb-2">No. HP
                    (Opsional)</label>
                <input type="tel" name="customer_phone" id="customer_phone" placeholder="08xxxxxx"
                    class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:border-black transition-colors">
            </div>

            <button type="submit"
                class="w-full py-4 bg-black text-white font-bold rounded-xl hover:bg-gray-900 transition-colors shadow-lg shadow-black/20">
                Lanjut ke Menu
            </button>
        </form>
    </div>
</body>

</html>