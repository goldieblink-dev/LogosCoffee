<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Menu - Logos Coffe</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <style>
        .cart-overlay {
            backdrop-filter: blur(10px);
        }

        .no-scrollbar::-webkit-scrollbar {
            display: none;
        }

        .no-scrollbar {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }
    </style>
</head>

<body class="bg-gray-50 pb-24" x-data="cartApp()">
    <!-- Header -->
    <header class="bg-white p-4 sticky top-0 z-30 shadow-sm border-b border-gray-100">
        <div class="flex items-center justify-between max-w-2xl mx-auto">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 bg-black rounded-full flex items-center justify-center">
                    <span class="font-heading text-sm text-white font-bold italic">LC</span>
                </div>
                <div>
                    <h1 class="font-heading font-bold text-sm">Meja {{ session('customer.table_number') }}</h1>
                    <p class="text-[10px] text-gray-500 font-bold uppercase tracking-tighter">{{
                        session('customer.customer_name') }}</p>
                </div>
            </div>
            <button @click="openCart = true" class="relative p-2">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                </svg>
                <template x-if="itemCount > 0">
                    <span
                        class="absolute top-0 right-0 bg-red-500 text-white text-[10px] font-bold w-4 h-4 rounded-full flex items-center justify-center"
                        x-text="itemCount"></span>
                </template>
            </button>
        </div>
    </header>

    <div class="max-w-2xl mx-auto p-4 space-y-8">
        <!-- Promo Section -->
        @if($promoProducts->count() > 0)
        <section>
            <h2 class="font-heading font-bold text-lg mb-4 flex items-center gap-2">
                <span class="p-1 bg-yellow-400 rounded text-xs uppercase tracking-tighter">Hot</span> Penawaran Spesial
            </h2>
            <div class="flex gap-4 overflow-x-auto no-scrollbar pb-2">
                @foreach($promoProducts as $product)
                <div class="min-w-[280px] bg-white rounded-2xl p-4 border border-gray-100 shadow-sm">
                    <div class="flex gap-4">
                        <div class="w-24 h-24 bg-gray-50 rounded-xl overflow-hidden flex-shrink-0">
                            @if($product->image)
                            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}"
                                class="w-full h-full object-cover">
                            @else
                            <div class="w-full h-full flex items-center justify-center text-gray-300">
                                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path
                                        d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                                    </path>
                                </svg>
                            </div>
                            @endif
                        </div>
                        <div class="flex-1 flex flex-col justify-between">
                            <div>
                                <h3 class="font-bold text-sm leading-tight">{{ $product->name }}</h3>
                                <div class="mt-1">
                                    <span class="text-black font-bold text-sm">Rp {{
                                        number_format($product->promo_price, 0, ',', '.') }}</span>
                                    <span class="text-gray-400 text-[10px] line-through ml-1">Rp {{
                                        number_format($product->price, 0, ',', '.') }}</span>
                                </div>
                            </div>
                            <button
                                @click="addToCart({{$product->id}}, '{{$product->name}}', {{$product->promo_price}})"
                                class="mt-2 w-full py-1.5 bg-black text-white text-xs font-bold rounded-lg">+
                                Tambah</button>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </section>
        @endif

        <!-- Menu Categories -->
        @foreach($categories as $category)
        <section>
            <h2 class="font-heading font-bold text-lg mb-4 border-l-4 border-black pl-3">{{ $category->name }}</h2>
            <div class="space-y-4">
                @foreach($category->products as $product)
                <div class="flex gap-4 bg-white p-3 rounded-2xl border border-gray-100 shadow-sm">
                    <div class="w-20 h-20 bg-gray-50 rounded-xl overflow-hidden flex-shrink-0">
                        @if($product->image)
                        <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}"
                            class="w-full h-full object-cover">
                        @else
                        <div class="w-full h-full flex items-center justify-center text-gray-300">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                                </path>
                            </svg>
                        </div>
                        @endif
                    </div>
                    <div class="flex-1 flex flex-col justify-between">
                        <div>
                            <h3 class="font-bold text-sm leading-tight">{{ $product->name }}</h3>
                            <p class="text-[10px] text-gray-500 mt-1 line-clamp-2">{{ $product->description }}</p>
                        </div>
                        <div class="flex items-center justify-between mt-2">
                            <span class="text-black font-bold text-sm">
                                @if($product->promo_price)
                                Rp {{ number_format($product->promo_price, 0, ',', '.') }}
                                @else
                                Rp {{ number_format($product->price, 0, ',', '.') }}
                                @endif
                            </span>
                            <button
                                @click="addToCart({{$product->id}}, '{{$product->name}}', {{$product->promo_price ?? $product->price}})"
                                class="px-3 py-1 bg-gray-900 text-white text-[10px] font-bold rounded-lg">Pesan</button>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </section>
        @endforeach
    </div>

    <!-- Cart Bar -->
    <div x-show="itemCount > 0"
        class="fixed bottom-0 left-0 right-0 p-4 bg-white/80 cart-overlay border-t border-gray-100 z-40">
        <div class="max-w-2xl mx-auto">
            <button @click="openCart = true"
                class="w-full py-4 bg-black text-white rounded-2xl font-bold flex items-center justify-between px-6 shadow-xl shadow-black/20">
                <div class="flex items-center gap-3">
                    <span class="bg-white/20 px-2 py-0.5 rounded text-xs" x-text="itemCount + ' item'"></span>
                    <span class="text-sm">Lihat Keranjang</span>
                </div>
                <span class="text-sm" x-text="'Rp ' + new Intl.NumberFormat('id-ID').format(cartTotal)"></span>
            </button>
        </div>
    </div>

    <!-- Cart Overlay -->
    <div x-show="openCart" class="fixed inset-0 z-50 bg-black/40 cart-overlay" @click.self="openCart = false">
        <div class="absolute bottom-0 left-0 right-0 bg-white rounded-t-[32px] p-6 max-h-[90vh] overflow-y-auto"
            x-transition:enter="transition ease-out duration-300 transform" x-transition:enter-start="translate-y-full"
            x-transition:enter-end="translate-y-0">
            <div class="w-12 h-1.5 bg-gray-200 rounded-full mx-auto mb-6" @click="openCart = false"></div>
            <h2 class="font-heading font-bold text-xl mb-6">Keranjang Anda</h2>
            <div class="space-y-4 mb-8">
                <template x-for="(item, id) in cart" :key="id">
                    <div class="flex items-center justify-between p-3 bg-gray-50 rounded-2xl">
                        <div class="flex-1">
                            <h4 class="font-bold text-sm" x-text="item.name"></h4>
                            <p class="text-xs text-gray-500"
                                x-text="'Rp ' + new Intl.NumberFormat('id-ID').format(item.price)"></p>
                        </div>
                        <div class="flex items-center gap-3">
                            <button @click="updateQty(id, -1)"
                                class="w-8 h-8 rounded-full border border-gray-300 flex items-center justify-center font-bold">-</button>
                            <span class="font-bold w-4 text-center" x-text="item.quantity"></span>
                            <button @click="updateQty(id, 1)"
                                class="w-8 h-8 rounded-full border border-gray-300 flex items-center justify-center font-bold">+</button>
                        </div>
                    </div>
                </template>
            </div>

            <form action="{{ route('self-order.checkout') }}" method="POST">
                @csrf
                <template x-for="(item, id) in cart" :key="'p-' + id">
                    <input type="hidden" :name="'cart['+id+'][id]'" :value="id">
                    <input type="hidden" :name="'cart['+id+'][quantity]'" :value="item.quantity">
                </template>

                <div class="flex justify-between items-center mb-6">
                    <span class="text-gray-500 font-bold uppercase tracking-wider text-xs">Total Pembayaran</span>
                    <span class="font-heading font-bold text-xl"
                        x-text="'Rp ' + new Intl.NumberFormat('id-ID').format(cartTotal)"></span>
                </div>

                <button type="submit"
                    class="w-full py-4 bg-black text-white font-bold rounded-2xl shadow-xl shadow-black/20">Bayar
                    Sekarang</button>
            </form>
        </div>
    </div>

    <script>
        function cartApp() {
            return {
                cart: {},
                openCart: false,
                itemCount: 0,
                cartTotal: 0,
                addToCart(id, name, price) {
                    price = parseFloat(price) || 0;
                    if (this.cart[id]) {
                        this.cart[id].quantity++;
                    } else {
                        this.cart[id] = { name, price, quantity: 1 };
                    }
                    this.calculate();
                },
                updateQty(id, delta) {
                    this.cart[id].quantity += delta;
                    if (this.cart[id].quantity <= 0) {
                        delete this.cart[id];
                    }
                    this.calculate();
                },
                calculate() {
                    let count = 0;
                    let total = 0;
                    for (let id in this.cart) {
                        count += this.cart[id].quantity;
                        total += this.cart[id].price * this.cart[id].quantity;
                    }
                    this.itemCount = count;
                    this.cartTotalota            }
            }
        }
    </script>
</body>

</html>