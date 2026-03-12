<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">
    <title>Menu - Logos Coffee</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&family=Playfair+Display:ital,wght@0,600;0,700;1,600&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <style>
        body { font-family: 'Inter', sans-serif; background-color: #f8fafc; }
        .font-playfair { font-family: 'Playfair Display', serif; }
        .no-scrollbar::-webkit-scrollbar { display: none; }
        .no-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
        [x-cloak] { display: none !important; }
        html { scroll-behavior: smooth; }
        .pb-safe { padding-bottom: env(safe-area-inset-bottom); }
    </style>
</head>
<body x-data="cartApp()" class="text-gray-900 pb-32">

    {{-- HEADER (Sticky) --}}
    <header class="sticky top-0 z-40 bg-white shadow-sm">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 h-16 flex items-center justify-between">
            <div class="flex items-center gap-2 bg-gray-100 pr-3 pl-1 py-1 rounded-full border border-gray-200">
                <div class="w-7 h-7 bg-white rounded-full flex items-center justify-center text-[10px] font-black shadow-sm">
                    {{ substr(session('customer.table_number', 'T'), 0, 2) }}
                </div>
                <span class="text-[10px] font-black tracking-wider uppercase text-gray-600">Meja</span>
            </div>
            
            <div class="absolute left-1/2 -translate-x-1/2 flex items-center gap-2">
                <div class="w-8 h-8 bg-black rounded-full flex items-center justify-center text-white font-playfair font-bold text-sm">LC</div>
                <span class="hidden sm:block font-playfair font-bold tracking-widest uppercase text-sm">Logos Coffee</span>
            </div>

            <button @click="openCart = true" class="relative w-10 h-10 flex items-center justify-center bg-gray-100 rounded-full hover:bg-gray-200 transition-colors border border-gray-200">
                <svg class="w-5 h-5 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/></svg>
                <div x-show="itemCount > 0" x-cloak class="absolute -top-1 -right-1 w-5 h-5 bg-red-600 text-white text-[10px] font-black rounded-full flex items-center justify-center border-2 border-white shadow-sm" x-text="itemCount"></div>
            </button>
        </div>

        {{-- CATEGORY TABS --}}
        <div class="border-t border-gray-100">
            <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-3 overflow-x-auto no-scrollbar flex gap-3">
                @foreach($categories as $category)
                <button @click="scrollToSection('cat-{{ $category->id }}')" 
                        class="cat-link whitespace-nowrap px-5 py-2 rounded-full text-xs font-bold transition-all bg-gray-50 text-gray-600 border border-gray-200 hover:bg-gray-100 hover:text-gray-900 focus:bg-black focus:border-black focus:text-white shrink-0 shadow-sm">
                    {{ $category->name }}
                </button>
                @endforeach
            </div>
        </div>
    </header>

    {{-- MAIN CONTENT --}}
    <main class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-8 space-y-12">

        {{-- PROMO SECTION --}}
        @if($promoProducts->count() > 0)
        <div>
            <div class="flex items-center gap-2 mb-6">
                <div class="w-8 h-8 rounded-full bg-red-100 flex items-center justify-center">
                    <svg class="w-4 h-4 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/></svg>
                </div>
                <h2 class="text-sm font-black uppercase tracking-widest text-gray-900">Spesial Promo</h2>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                @foreach($promoProducts as $product)
                <div class="bg-white rounded-3xl p-4 shadow-sm border border-red-100 flex gap-4 items-center group relative overflow-hidden">
                    <div class="absolute top-0 right-0 bg-red-600 text-white text-[10px] font-black px-3 py-1 rounded-bl-xl shadow-sm uppercase tracking-widest z-10">Hemat {{ round((1 - $product->promo_price / $product->price) * 100) }}%</div>
                    
                    <div class="w-24 h-24 rounded-2xl bg-gray-50 shrink-0 overflow-hidden relative">
                        @if($product->image)
                            <img src="{{ asset('storage/' . $product->image) }}" class="w-full h-full object-cover transition-transform group-hover:scale-105">
                        @else
                            <div class="w-full h-full flex items-center justify-center text-gray-300">
                                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                            </div>
                        @endif
                    </div>
                    
                    <div class="flex-1 min-w-0 py-1 flex flex-col h-full">
                        <h4 class="font-bold text-sm text-gray-900 truncate mb-auto pr-2">{{ $product->name }}</h4>
                        <div class="mt-2 mb-3">
                            <span class="text-[10px] font-medium text-gray-400 line-through block">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
                            <span class="text-base font-black text-red-600 block leading-tight">Rp {{ number_format($product->promo_price, 0, ',', '.') }}</span>
                        </div>
                        <button @click="addToCart({{ $product->id }}, '{{ addslashes($product->name) }}', {{ $product->promo_price }})" class="w-full py-2 bg-red-50 text-red-600 text-xs font-black uppercase tracking-widest rounded-xl hover:bg-red-600 hover:text-white transition-colors border border-red-100 hover:border-red-600 group-hover:shadow-md">Tambah</button>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @endif

        {{-- MENU LISTINGS --}}
        <div class="space-y-12">
            @foreach($categories as $category)
            <div id="cat-{{ $category->id }}" class="scroll-mt-36">
                <div class="flex items-center gap-4 mb-6">
                    <h2 class="text-xl font-playfair font-bold text-gray-900">{{ $category->name }}</h2>
                    <div class="h-px bg-gray-200 flex-1 mt-1"></div>
                </div>
                
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    @foreach($category->products as $product)
                    <div class="bg-white rounded-3xl p-4 shadow-sm border border-gray-100 flex gap-4 relative hover:border-gray-300 transition-colors group">
                        
                        <div class="w-28 h-28 rounded-2xl bg-gray-50 flex-shrink-0 overflow-hidden relative border border-gray-100">
                            @if($product->promo_price)
                                <div class="absolute top-0 left-0 bg-red-600 text-white text-[9px] font-black px-2 py-1 rounded-br-lg shadow-sm z-10 tracking-wider">PROMO</div>
                            @endif
                            @if($product->image)
                                <img src="{{ asset('storage/' . $product->image) }}" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
                            @else
                                <div class="w-full h-full flex items-center justify-center text-gray-300">
                                    <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                </div>
                            @endif
                        </div>
                        
                        <div class="flex-1 flex flex-col min-w-0 py-1">
                            <h4 class="font-bold text-base text-gray-900 leading-tight mb-1 pr-1">{{ $product->name }}</h4>
                            <p class="text-xs text-gray-500 line-clamp-2 mt-0.5">{{ $product->description ?? 'Nikmati kesegaran dan rasa otentik dari pilihan menu unggulan kami.' }}</p>
                            
                            <div class="flex items-end justify-between mt-auto pt-3">
                                <div class="flex flex-col">
                                    @if($product->promo_price)
                                        <span class="text-[10px] font-medium text-gray-400 line-through mb-0.5">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
                                        <span class="text-sm font-black text-red-600">Rp {{ number_format($product->promo_price, 0, ',', '.') }}</span>
                                    @else
                                        <span class="text-sm font-black text-gray-900">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
                                    @endif
                                </div>
                                <div x-data="{ qty: cart[{{ $product->id }}]?.quantity || 0 }" 
                                     @cart-updated.window="qty = cart[{{ $product->id }}]?.quantity || 0"
                                     class="relative z-10">
                                    
                                    <template x-if="qty > 0">
                                        <div class="flex items-center bg-gray-50 rounded-full border border-gray-200 p-1 shadow-inner">
                                            <button @click.prevent="updateQty({{ $product->id }}, -1)" class="w-7 h-7 flex items-center justify-center text-gray-700 bg-white rounded-full shadow-sm hover:bg-gray-100 border border-gray-100 font-bold">−</button>
                                            <span class="w-8 text-center text-xs font-black text-gray-900" x-text="qty"></span>
                                            <button @click.prevent="addToCart({{ $product->id }}, '{{ addslashes($product->name) }}', {{ $product->promo_price ?? $product->price }})" class="w-7 h-7 flex items-center justify-center text-white bg-black rounded-full shadow-sm hover:bg-gray-800 font-bold">+</button>
                                        </div>
                                    </template>
                                    
                                    <template x-if="qty === 0">
                                        <button @click.prevent="addToCart({{ $product->id }}, '{{ addslashes($product->name) }}', {{ $product->promo_price ?? $product->price }})" 
                                                class="w-9 h-9 bg-white border border-gray-200 text-gray-900 rounded-full flex items-center justify-center shadow-sm hover:bg-black hover:text-white hover:border-black transition-colors group-hover:bg-black group-hover:text-white group-hover:border-black">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="stroke-width:2.5px"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/></svg>
                                        </button>
                                    </template>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            @endforeach
        </div>
    </main>

    {{-- FLOATING CHECKOUT BAR --}}
    <div x-show="itemCount > 0" x-cloak 
         x-transition:enter="transition ease-out duration-300 transform"
         x-transition:enter-start="translate-y-full opacity-0"
         x-transition:enter-end="translate-y-0 opacity-100"
         x-transition:leave="transition ease-in duration-200 transform"
         x-transition:leave-start="translate-y-0 opacity-100"
         x-transition:leave-end="translate-y-full opacity-0"
         class="fixed bottom-0 left-0 right-0 p-4 pb-safe z-40">
        <div class="max-w-3xl mx-auto">
            <button @click="openCart = true" class="w-full bg-black text-white p-4 sm:p-5 rounded-3xl shadow-2xl shadow-black/30 border border-gray-800 flex items-center justify-between hover:-translate-y-1 transition-transform group">
                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 bg-white/10 rounded-2xl border border-white/10 flex items-center justify-center relative">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/></svg>
                        <div class="absolute -top-1.5 -right-1.5 w-5 h-5 bg-red-600 text-[10px] font-black rounded-full flex items-center justify-center border-2 border-black" x-text="itemCount"></div>
                    </div>
                    <div class="text-left">
                        <p class="text-[10px] font-bold text-gray-400 tracking-widest uppercase mb-0.5">Keranjang Saya</p>
                        <p class="text-sm font-black tracking-wide">Lihat Pesanan</p>
                    </div>
                </div>
                <div class="flex items-center gap-4">
                    <p class="font-black text-lg tracking-tight" x-text="'Rp ' + Number(cartTotal).toLocaleString('id-ID')"></p>
                    <div class="w-10 h-10 bg-white text-black rounded-xl flex items-center justify-center group-hover:scale-105 transition-transform">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/></svg>
                    </div>
                </div>
            </button>
        </div>
    </div>

    {{-- CART SHEET OVERLAY --}}
    <div x-show="openCart" x-cloak class="fixed inset-0 z-50 flex flex-col justify-end">
        <div class="absolute inset-0 bg-black/60 backdrop-blur-sm" @click="openCart = false"
             x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
             x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"></div>
        
        <div class="relative bg-white w-full max-w-3xl mx-auto rounded-t-[2.5rem] flex flex-col max-h-[90vh] pb-safe shadow-2xl"
             x-transition:enter="transition ease-out duration-300 transform" x-transition:enter-start="translate-y-full" x-transition:enter-end="translate-y-0"
             x-transition:leave="transition ease-in duration-200 transform" x-transition:leave-start="translate-y-0" x-transition:leave-end="translate-y-full">
            
            <div class="p-6 sm:p-8 shrink-0 border-b border-gray-100">
                <div class="w-16 h-1.5 bg-gray-200 rounded-full mx-auto mb-6 cursor-pointer hover:bg-gray-300 transition-colors" @click="openCart = false"></div>
                <div class="flex items-center justify-between">
                    <div>
                        <h2 class="text-2xl font-black text-gray-900 tracking-tight">Konfirmasi Pesanan</h2>
                        <p class="text-xs font-bold text-gray-400 uppercase tracking-widest mt-1">Meja {{ session('customer.table_number') }} · {{ session('customer.customer_name') }}</p>
                    </div>
                    <button @click="openCart = false" class="w-10 h-10 bg-gray-50 rounded-full flex items-center justify-center text-gray-500 hover:bg-gray-200 hover:text-gray-900 transition-colors border border-gray-100">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                    </button>
                </div>
            </div>

            <div class="flex-1 overflow-y-auto p-6 sm:p-8 space-y-4 no-scrollbar">
                <template x-for="(item, id) in cart" :key="id">
                    <div class="flex items-center justify-between bg-white p-4 sm:p-5 rounded-3xl border border-gray-200 shadow-sm hover:border-gray-300 transition-colors">
                        <div class="flex-1 min-w-0 pr-4">
                            <h4 class="font-bold text-base text-gray-900 truncate mb-1" x-text="item.name"></h4>
                            <p class="text-sm font-black text-gray-600" x-text="'Rp ' + Number(item.price).toLocaleString('id-ID')"></p>
                        </div>
                        <div class="flex items-center bg-gray-50 rounded-full border border-gray-200 p-1 shadow-inner shrink-0">
                            <button type="button" @click="updateQty(id, -1)" class="w-9 h-9 flex items-center justify-center text-gray-700 bg-white rounded-full border border-gray-100 shadow-sm hover:bg-gray-50 font-bold">−</button>
                            <span class="w-10 text-center text-sm font-black text-gray-900" x-text="item.quantity"></span>
                            <button type="button" @click="addToCart(id, item.name, item.price)" class="w-9 h-9 flex items-center justify-center text-white bg-black rounded-full shadow-sm hover:bg-gray-800 font-bold">+</button>
                        </div>
                    </div>
                </template>
                <template x-if="itemCount === 0">
                    <div class="py-16 text-center">
                        <div class="w-20 h-20 bg-gray-50 rounded-full flex items-center justify-center mx-auto mb-5 border border-gray-100">
                            <svg class="w-10 h-10 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                        </div>
                        <p class="text-gray-900 font-bold text-lg mb-1">Keranjang masih kosong</p>
                        <p class="text-gray-400 text-sm font-medium">Silakan pilih menu favorit Anda di atas.</p>
                    </div>
                </template>
            </div>

            <div class="p-6 sm:p-8 bg-gray-50 shrink-0 border-t border-gray-200">
                <form action="{{ route('self-order.checkout') }}" method="POST">
                    @csrf
                    <div id="hidden-inputs"></div>
                    <div class="bg-white rounded-3xl p-5 border border-gray-200 shadow-sm mb-6">
                        <div class="flex justify-between items-center mb-3 text-sm">
                            <span class="text-gray-500 font-medium tracking-wide">Jumlah Item</span>
                            <span class="font-bold text-gray-900" x-text="itemCount + ' Produk'"></span>
                        </div>
                        <div class="h-px bg-gray-100 w-full mb-3"></div>
                        <div class="flex items-center justify-between">
                            <span class="text-sm font-black uppercase text-gray-900 tracking-widest">Total Pembayaran</span>
                            <span class="text-3xl font-black text-gray-900 tracking-tighter" x-text="'Rp ' + Number(cartTotal).toLocaleString('id-ID')"></span>
                        </div>
                    </div>
                    
                    <button type="submit" :disabled="itemCount === 0" 
                            class="w-full py-4 sm:py-5 text-base font-black rounded-2xl flex items-center justify-center gap-2 transition-all shadow-xl disabled:opacity-50 disabled:cursor-not-allowed border border-transparent"
                            :class="itemCount > 0 ? 'bg-black text-white hover:bg-gray-800 shadow-black/20 hover:-translate-y-0.5 border-black' : 'bg-gray-100 text-gray-400 shadow-none border-gray-200'">
                        Lanjut Pembayaran
                        <svg class="w-5 h-5 border-2 border-current rounded-full p-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 12h14M12 5l7 7-7 7"/></svg>
                    </button>
                    <div class="flex items-center justify-center gap-2 mt-5 text-gray-400">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 11V7m0 4v4m0 0h4m-4 0H8m0-9a4 4 0 118 0v2H8V7z"/></svg>
                        <p class="text-[10px] uppercase font-black tracking-widest">Pembayaran 100% Aman via QRIS</p>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function cartApp() {
            return {
                cart: {},
                openCart: false,
                itemCount: 0,
                cartTotal: 0,
                
                init() {
                    try {
                        let saved = sessionStorage.getItem('logos_cart');
                        if (saved) {
                            this.cart = JSON.parse(saved);
                            this.calculate();
                        }
                    } catch(e){}
                    this.updateHiddenInputs();
                },
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
                    if(!this.cart[id]) return;
                    this.cart[id].quantity += delta;
                    if (this.cart[id].quantity <= 0) {
                        delete this.cart[id];
                    }
                    if(Object.keys(this.cart).length === 0) {
                        this.openCart = false;
                    }
                    this.calculate();
                },
                calculate() {
                    let count = 0, total = 0;
                    for (let id in this.cart) {
                        count += this.cart[id].quantity;
                        total += this.cart[id].price * this.cart[id].quantity;
                    }
                    this.itemCount = count;
                    this.cartTotal = total;
                    
                    sessionStorage.setItem('logos_cart', JSON.stringify(this.cart));
                    this.updateHiddenInputs();
                    
                    window.dispatchEvent(new CustomEvent('cart-updated'));
                },
                updateHiddenInputs() {
                    let container = document.getElementById('hidden-inputs');
                    if(!container) return;
                    container.innerHTML = '';
                    for (let id in this.cart) {
                        container.innerHTML += `<input type="hidden" name="cart[${id}][id]" value="${id}">`;
                        container.innerHTML += `<input type="hidden" name="cart[${id}][quantity]" value="${this.cart[id].quantity}">`;
                    }
                },
                scrollToSection(id) {
                    const el = document.getElementById(id);
                    if (el) {
                        const offset = 120;
                        const top = el.getBoundingClientRect().top + window.scrollY - offset;
                        window.scrollTo({ top, behavior: 'smooth' });
                    }
                }
            }
        }
    </script>
</body>
</html>