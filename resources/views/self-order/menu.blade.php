<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Menu - Logos Coffee</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Playfair+Display:ital,wght@0,400;0,700;1,400&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            background: #fafafa;
            color: #1a1a1a;
            font-family: 'Inter', sans-serif;
            min-height: 100vh;
        }

        /* ── Scrollbar ── */
        .no-scrollbar::-webkit-scrollbar { display: none; }
        .no-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }

        /* ══ HEADER ══ */
        .site-header {
            background: #111;
            position: sticky;
            top: 0;
            z-index: 30;
        }
        .site-header-inner {
            max-width: 680px;
            margin: 0 auto;
            padding: 0.9rem 1.25rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            position: relative;
        }
        .table-chip {
            display: flex;
            align-items: center;
            gap: 7px;
            background: rgba(255,255,255,0.1);
            border-radius: 20px;
            padding: 5px 12px 5px 7px;
        }
        .table-dot {
            width: 28px; height: 28px;
            background: #fff;
            border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            font-family: 'Playfair Display', serif;
            font-weight: 700; font-size: 11px;
            color: #111;
        }
        .table-label {
            font-size: 0.75rem;
            font-weight: 600;
            color: rgba(255,255,255,0.85);
            letter-spacing: 0.02em;
        }
        .brand-center {
            position: absolute;
            left: 50%; transform: translateX(-50%);
            font-family: 'Playfair Display', serif;
            font-size: clamp(0.8rem, 3vw, 1rem);
            font-weight: 700;
            letter-spacing: 0.25em;
            text-transform: uppercase;
            color: #fff;
            white-space: nowrap;
        }
        .cart-btn {
            position: relative;
            background: rgba(255,255,255,0.1);
            border: none;
            cursor: pointer;
            color: #fff;
            padding: 8px;
            border-radius: 50%;
            width: 38px; height: 38px;
            display: flex; align-items: center; justify-content: center;
            transition: background 0.2s;
        }
        .cart-btn:hover { background: rgba(255,255,255,0.2); }
        .cart-badge {
            position: absolute;
            top: -2px; right: -2px;
            background: #fff;
            color: #111;
            font-size: 9px;
            font-weight: 800;
            width: 16px; height: 16px;
            border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
        }

        /* ══ CATEGORY TABS ══ */
        .cat-tabs-wrap {
            background: #fff;
            border-bottom: 1px solid #ebebeb;
            position: sticky;
            top: 56px;
            z-index: 20;
        }
        .cat-tabs {
            max-width: 680px;
            margin: 0 auto;
            padding: 0 1.25rem;
            display: flex;
            gap: 6px;
            overflow-x: auto;
            padding-bottom: 0;
        }
        .cat-tabs::-webkit-scrollbar { display: none; }
        .cat-tab {
            flex-shrink: 0;
            padding: 0.75rem 1rem;
            font-size: 0.8rem;
            font-weight: 600;
            color: #aaa;
            cursor: pointer;
            border: none;
            background: none;
            border-bottom: 2px solid transparent;
            transition: color 0.2s, border-color 0.2s;
            white-space: nowrap;
            letter-spacing: 0.02em;
        }
        .cat-tab:hover { color: #111; }
        .cat-tab.active { color: #111; border-bottom-color: #111; }

        /* ══ PAGE CONTENT ══ */
        .page-content {
            max-width: 680px;
            margin: 0 auto;
            padding: 0 1.25rem 7rem;
        }

        /* ══ PROMO STRIP ══ */
        .promo-strip {
            margin: 1.25rem 0;
            display: flex;
            gap: 0.75rem;
            overflow-x: auto;
        }
        .promo-strip::-webkit-scrollbar { display: none; }
        .promo-pill {
            flex-shrink: 0;
            background: #111;
            color: #fff;
            border-radius: 12px;
            padding: 0.85rem 1.1rem;
            display: flex;
            align-items: center;
            gap: 0.75rem;
            min-width: 200px;
            cursor: pointer;
            transition: background 0.2s;
        }
        .promo-pill:hover { background: #2a2a2a; }
        .promo-thumb {
            width: 44px; height: 44px;
            border-radius: 8px;
            background: rgba(255,255,255,0.15);
            overflow: hidden;
            display: flex; align-items: center; justify-content: center;
            flex-shrink: 0;
        }
        .promo-thumb img { width: 100%; height: 100%; object-fit: cover; }
        .promo-info { flex: 1; min-width: 0; }
        .promo-pill-name { font-size: 0.82rem; font-weight: 700; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
        .promo-pill-price { font-size: 0.72rem; color: rgba(255,255,255,0.6); margin-top: 2px; }
        .promo-pill-old { text-decoration: line-through; }
        .promo-pill-add {
            width: 28px; height: 28px;
            border-radius: 50%;
            background: rgba(255,255,255,0.15);
            border: none;
            color: #fff;
            font-size: 1.1rem;
            display: flex; align-items: center; justify-content: center;
            cursor: pointer;
            flex-shrink: 0;
        }

        /* ══ CATEGORY SECTION ══ */
        .cat-section { padding-top: 2rem; }
        .cat-heading {
            font-family: 'Playfair Display', serif;
            font-size: 1.6rem;
            font-weight: 700;
            color: #111;
            margin-bottom: 1rem;
        }

        /* ══ PRODUCT LIST ITEM ══ */
        .product-item {
            display: flex;
            align-items: center;
            gap: 1rem;
            padding: 1rem 0;
            border-bottom: 1px solid #f0f0f0;
            cursor: pointer;
            transition: background 0.15s;
        }
        .product-item:last-child { border-bottom: none; }
        .product-thumb {
            width: 76px; height: 76px;
            border-radius: 12px;
            background: #ebebeb;
            overflow: hidden;
            display: flex; align-items: center; justify-content: center;
            flex-shrink: 0;
        }
        .product-thumb img { width: 100%; height: 100%; object-fit: cover; }
        .product-thumb-placeholder { color: #ccc; }
        .product-details { flex: 1; min-width: 0; }
        .product-item-name {
            font-weight: 700;
            font-size: 0.92rem;
            color: #111;
            margin-bottom: 3px;
            display: flex;
            align-items: center;
            gap: 6px;
        }
        .product-item-desc {
            font-size: 0.78rem;
            color: #999;
            line-height: 1.5;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }
        .product-item-price-row {
            display: flex;
            align-items: center;
            gap: 6px;
            margin-top: 6px;
        }
        .product-item-price {
            font-weight: 700;
            font-size: 0.88rem;
            color: #111;
        }
        .product-item-price-old {
            font-size: 0.75rem;
            color: #bbb;
            text-decoration: line-through;
        }
        .promo-tag {
            display: inline-block;
            font-size: 0.58rem;
            padding: 2px 6px;
            background: #111;
            color: #fff;
            border-radius: 4px;
            font-weight: 700;
            letter-spacing: 0.08em;
            text-transform: uppercase;
        }
        .product-add-btn {
            width: 36px; height: 36px;
            border-radius: 50%;
            background: #111;
            border: none;
            color: #fff;
            font-size: 1.3rem;
            display: flex; align-items: center; justify-content: center;
            cursor: pointer;
            flex-shrink: 0;
            transition: background 0.2s, transform 0.15s;
            line-height: 1;
        }
        .product-add-btn:hover { background: #333; transform: scale(1.08); }

        /* ══ CART BAR ══ */
        .cart-bar {
            position: fixed;
            bottom: 0; left: 0; right: 0;
            padding: 1rem 1.25rem 1.25rem;
            z-index: 40;
            background: linear-gradient(to top, #fafafa 70%, transparent);
        }
        .cart-bar-btn {
            max-width: 680px;
            margin: 0 auto;
            display: flex;
            background: #111;
            color: #fff;
            border: none;
            border-radius: 16px;
            padding: 1rem 1.5rem;
            font-weight: 700;
            font-size: 0.9rem;
            cursor: pointer;
            align-items: center;
            justify-content: space-between;
            width: 100%;
            transition: background 0.2s;
            box-shadow: 0 4px 24px rgba(0,0,0,0.15);
        }
        .cart-bar-btn:hover { background: #2a2a2a; }
        .cart-count-pill {
            background: rgba(255,255,255,0.15);
            border-radius: 6px;
            padding: 2px 8px;
            font-size: 0.78rem;
        }

        /* ══ CART SHEET ══ */
        .cart-sheet {
            position: absolute;
            bottom: 0; left: 0; right: 0;
            background: #fff;
            border-radius: 24px 24px 0 0;
            padding: 1.5rem;
            max-height: 90vh;
            overflow-y: auto;
        }
        .cart-handle {
            width: 40px; height: 4px;
            background: #ddd;
            border-radius: 4px;
            margin: 0 auto 1.5rem;
            cursor: pointer;
        }
        .cart-item {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0.85rem;
            background: #f8f8f8;
            border-radius: 12px;
            margin-bottom: 0.65rem;
        }
        .qty-btn {
            width: 32px; height: 32px;
            border-radius: 8px;
            border: 1px solid #ddd;
            background: #fff;
            color: #111;
            font-size: 1rem;
            font-weight: 700;
            cursor: pointer;
            display: flex; align-items: center; justify-content: center;
            transition: border-color 0.2s;
        }
        .qty-btn:hover { border-color: #111; }
        .checkout-btn {
            width: 100%;
            padding: 1rem;
            background: #111;
            color: #fff;
            border: none;
            border-radius: 14px;
            font-family: 'Inter', sans-serif;
            font-weight: 700;
            font-size: 0.95rem;
            cursor: pointer;
            letter-spacing: 0.05em;
            transition: background 0.2s;
        }
        .checkout-btn:hover { background: #333; }

        [x-cloak] { display: none !important; }
    </style>
</head>

<body x-data="cartApp()">

    {{-- ══ HEADER ══ --}}
    <header class="site-header">
        <div class="site-header-inner">
            <div class="table-chip">
                <div class="table-dot">{{ substr(session('customer.table_number', 'T'), 0, 2) }}</div>
                <span class="table-label">Meja {{ session('customer.table_number') }}</span>
            </div>
            <span class="brand-center">Logos Coffee</span>
            <button class="cart-btn" @click="openCart = true">
                <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                </svg>
                <template x-if="itemCount > 0">
                    <span class="cart-badge" x-text="itemCount"></span>
                </template>
            </button>
        </div>
    </header>

    {{-- ══ PAGE CONTENT ══ --}}
    <div class="page-content">



        {{-- ── MENU CATEGORIES ── --}}
        @foreach($categories as $category)
        <div id="cat-{{ $category->id }}" class="cat-section">
            <h2 class="cat-heading">{{ $category->name }}</h2>
            <div>
                @foreach($category->products as $product)
                <div class="product-item">
                    <div class="product-thumb">
                        @if($product->image)
                            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}">
                        @else
                            <svg class="product-thumb-placeholder" width="28" height="28" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                        @endif
                    </div>
                    <div class="product-details">
                        <div class="product-item-name">
                            {{ $product->name }}
                            @if($product->promo_price)
                                <span class="promo-tag">Promo</span>
                            @endif
                        </div>
                        <p class="product-item-desc">{{ \Illuminate\Support\Str::limit($product->description, 60) }}</p>
                        <div class="product-item-price-row">
                            @if($product->promo_price)
                                <span class="product-item-price-old">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
                                <span class="product-item-price">Rp {{ number_format($product->promo_price, 0, ',', '.') }}</span>
                            @else
                                <span class="product-item-price">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
                            @endif
                        </div>
                    </div>
                    <button class="product-add-btn"
                        @click="addToCart({{ $product->id }}, '{{ $product->name }}', {{ $product->promo_price ?? $product->price }})">
                        +
                    </button>
                </div>
                @endforeach
            </div>
        </div>
        @endforeach

    </div>

    {{-- ══ CART BOTTOM BAR ══ --}}
    <div class="cart-bar" x-show="itemCount > 0" x-cloak>
        <button class="cart-bar-btn" @click="openCart = true">
            <div style="display:flex; align-items:center; gap:10px;">
                <span class="cart-count-pill" x-text="itemCount + ' item'"></span>
                <span>Lihat Keranjang</span>
            </div>
            <span x-text="'Rp ' + new Intl.NumberFormat('id-ID').format(cartTotal)"></span>
        </button>
    </div>

    {{-- ══ CART OVERLAY SHEET ══ --}}
    <div x-show="openCart" x-cloak
        style="position:fixed; inset:0; z-index:50; background:rgba(0,0,0,0.5); backdrop-filter:blur(4px);"
        @click.self="openCart = false">
        <div class="cart-sheet"
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="transform translate-y-full"
            x-transition:enter-end="transform translate-y-0">

            <div class="cart-handle" @click="openCart = false"></div>

            <h2 style="font-family:'Playfair Display',serif; font-size:1.3rem; font-weight:700; color:#111; margin:0 0 1.25rem;">
                Keranjang Anda
            </h2>

            <div style="margin-bottom:1.5rem;">
                <template x-for="(item, id) in cart" :key="id">
                    <div class="cart-item">
                        <div style="flex:1;">
                            <p style="font-weight:700; font-size:0.88rem; color:#111; margin:0 0 2px;" x-text="item.name"></p>
                            <p style="font-size:0.75rem; color:#666; margin:0;"
                                x-text="'Rp ' + new Intl.NumberFormat('id-ID').format(item.price)"></p>
                        </div>
                        <div style="display:flex; align-items:center; gap:10px; margin-left:1rem;">
                            <button class="qty-btn" @click="updateQty(id, -1)">−</button>
                            <span style="font-weight:700; font-size:0.88rem; min-width:16px; text-align:center;" x-text="item.quantity"></span>
                            <button class="qty-btn" @click="updateQty(id, 1)">+</button>
                        </div>
                    </div>
                </template>
            </div>

            <form action="{{ route('self-order.checkout') }}" method="POST">
                @csrf
                <template x-for="(entry, index) in Object.entries(cart)" :key="'p-' + entry[0]">
                    <div>
                        <input type="hidden" :name="'cart['+entry[0]+'][id]'" :value="entry[0]">
                        <input type="hidden" :name="'cart['+entry[0]+'][quantity]'" :value="entry[1].quantity">
                    </div>
                </template>

                <div style="display:flex; justify-content:space-between; align-items:center; padding:1rem 0; border-top:1px solid #f0f0f0; margin-bottom:1rem;">
                    <span style="font-size:0.75rem; letter-spacing:0.1em; text-transform:uppercase; color:#999; font-weight:700;">Total Pembayaran</span>
                    <span style="font-family:'Playfair Display',serif; font-size:1.3rem; font-weight:700; color:#111;"
                        x-text="'Rp ' + new Intl.NumberFormat('id-ID').format(cartTotal)"></span>
                </div>

                <button type="submit" class="checkout-btn">Bayar Sekarang</button>
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
                    let count = 0, total = 0;
                    for (let id in this.cart) {
                        count += this.cart[id].quantity;
                        total += this.cart[id].price * this.cart[id].quantity;
                    }
                    this.itemCount = count;
                    this.cartTotal = total;
                }
            }
        }

        function scrollToSection(id, btn) {
            const el = document.getElementById(id);
            if (el) {
                const offset = 110;
                const top = el.getBoundingClientRect().top + window.scrollY - offset;
                window.scrollTo({ top, behavior: 'smooth' });
            }
            document.querySelectorAll('.cat-tab').forEach(t => t.classList.remove('active'));
            btn.classList.add('active');
        }
    </script>

</body>
</html>