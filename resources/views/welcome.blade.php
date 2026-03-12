<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Logos Coffee - Premium Coffee Experience</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Playfair+Display:ital,wght@0,400;0,700;1,400;1,700&display=swap" rel="stylesheet">

        <!-- Styles / Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <style>
            /* ── Hero ── */
            .hero-section {
                position: relative;
                min-height: 90vh;
                display: flex;
                align-items: center;
                justify-content: center;
                text-align: center;
                overflow: hidden;
                background: #111;
            }
            .hero-bg {
                position: absolute;
                inset: 0;
                background-image: url('https://images.unsplash.com/photo-1495474472287-4d71bcdd2085?w=1600&q=80');
                background-size: cover;
                background-position: center;
                opacity: 0.45;
                transform: scale(1.05);
                transition: transform 8s ease;
            }
            .hero-section:hover .hero-bg {
                transform: scale(1);
            }
            .hero-overlay {
                position: absolute;
                inset: 0;
                background: linear-gradient(to bottom, rgba(0,0,0,0.2) 0%, rgba(0,0,0,0.6) 100%);
            }
            .hero-content {
                position: relative;
                z-index: 10;
                color: #fff;
                padding: 2rem;
            }

            /* ── Animations ── */
            @keyframes fade-up {
                from { opacity: 0; transform: translateY(30px); }
                to   { opacity: 1; transform: translateY(0); }
            }
            .anim-1 { animation: fade-up 0.9s ease forwards; }
            .anim-2 { animation: fade-up 0.9s 0.2s ease both; }
            .anim-3 { animation: fade-up 0.9s 0.4s ease both; }
            .anim-4 { animation: fade-up 0.9s 0.6s ease both; }

            /* ── Divider ── */
            .ornament-line {
                display: flex;
                align-items: center;
                gap: 12px;
                justify-content: center;
                margin-bottom: 1.5rem;
            }
            .ornament-line span {
                display: block;
                width: 50px;
                height: 1px;
                background: rgba(255,255,255,0.4);
            }
            .ornament-line i {
                font-size: 10px;
                letter-spacing: 0.3em;
                text-transform: uppercase;
                color: rgba(255,255,255,0.6);
                font-style: normal;
            }

            /* ── Info Bar ── */
            .info-bar-item {
                flex: 1;
                padding: 2rem 1.5rem;
                display: flex;
                align-items: center;
                gap: 1rem;
                border-right: 1px solid #e5e5e5;
            }
            .info-bar-item:last-child { border-right: none; }

            /* ── Product Item ── */
            .product-row {
                display: flex;
                justify-content: space-between;
                align-items: baseline;
                padding: 1rem 0;
                border-bottom: 1px solid #f0f0f0;
                transition: all 0.2s;
            }
            .product-row:last-child { border-bottom: none; }
            .product-row:hover { padding-left: 6px; }

            /* ── CTA Button ── */
            .cta-btn {
                display: inline-block;
                padding: 0.85rem 2.5rem;
                border: 1.5px solid rgba(255,255,255,0.8);
                color: #fff;
                font-size: 0.8rem;
                letter-spacing: 0.25em;
                text-transform: uppercase;
                font-weight: 600;
                font-family: 'Inter', sans-serif;
                transition: all 0.3s;
                cursor: pointer;
                background: transparent;
                text-decoration: none;
            }
            .cta-btn:hover {
                background: #fff;
                color: #111;
            }

            /* ── Section Title ── */
            .section-eyebrow {
                font-size: 0.7rem;
                letter-spacing: 0.35em;
                text-transform: uppercase;
                color: #999;
                margin-bottom: 0.75rem;
                font-family: 'Inter', sans-serif;
            }
        </style>
    </head>
    <body style="background:#fff; color:#1a1a1a; font-family:'Inter',sans-serif; margin:0;">

        {{-- ══════════════════ NAVBAR ══════════════════ --}}
        <nav id="main-navbar" style="
            position: sticky; top: 0; z-index: 50;
            width: 100%;
            background: rgba(255,255,255,0.92);
            backdrop-filter: blur(12px);
            border-bottom: 1px solid #ebebeb;
            transition: transform 0.35s ease, opacity 0.35s ease, box-shadow 0.35s ease;
        ">
            <div style="max-width:1200px; margin:0 auto; padding: 1rem 1.25rem; display:flex; align-items:center; justify-content:center; position:relative;">
                <p style="font-family:'Playfair Display',serif; font-size:clamp(0.85rem, 3vw, 1.5rem); font-weight:700; letter-spacing:0.2em; text-transform:uppercase; color:#111; margin:0; white-space:nowrap;">
                    ~ ~ &nbsp; Logos Coffee &nbsp; ~ ~
                </p>
            </div>
        </nav>
        <script>
            (function () {
                var nav = document.getElementById('main-navbar');
                var lastY = 0;
                window.addEventListener('scroll', function () {
                    var y = window.scrollY;
                    if (y > 60 && y > lastY) {
                        nav.style.transform = 'translateY(-100%)';
                        nav.style.opacity = '0';
                    } else {
                        nav.style.transform = 'translateY(0)';
                        nav.style.opacity = '1';
                        nav.style.boxShadow = y > 10 ? '0 2px 20px rgba(0,0,0,0.07)' : 'none';
                    }
                    lastY = y;
                });
            })();
        </script>

        {{-- ══════════════════ HERO ══════════════════ --}}
        <section class="hero-section">
            <div class="hero-bg"></div>
            <div class="hero-overlay"></div>
            <div class="hero-content">
                <div class="ornament-line anim-1">
                    <span></span><i>Est. 2024</i><span></span>
                </div>
                <h1 class="anim-2" style="font-family:'Playfair Display',serif; font-size:clamp(3rem,8vw,6.5rem); font-weight:700; line-height:1.1; margin:0 0 1.5rem; letter-spacing:-0.01em;">
                    The Art of<br><em>Coffee</em>
                </h1>
                <p class="anim-3" style="font-size:0.9rem; letter-spacing:0.2em; text-transform:uppercase; color:rgba(255,255,255,0.65); margin-bottom:2.5rem; font-weight:400;">
                    Brewing Excellence Since 2024
                </p>
                <a href="{{ route('self-order.index') }}" class="cta-btn anim-4">Order Now</a>
            </div>
        </section>

        <section style="border-bottom:1px solid #ebebeb;">
            <style>
                .info-bar-item {
                    flex: 1;
                    min-width: 200px;
                    padding: 1.5rem 1.25rem;
                    display: flex;
                    align-items: center;
                    gap: 1rem;
                    border-right: 1px solid #e5e5e5;
                    border-bottom: 1px solid #e5e5e5;
                }
                .info-bar-item:last-child { border-right: none; }
                @media (max-width: 640px) {
                    .info-bar-item { border-right: none; }
                }
            </style>
            <div style="max-width:1200px; margin:0 auto; display:flex; flex-wrap:wrap;">
                <div class="info-bar-item">
                    <svg style="width:24px;height:24px;flex-shrink:0;color:#999;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    <div>
                        <p style="font-size:0.65rem;letter-spacing:0.2em;text-transform:uppercase;color:#aaa;margin:0 0 4px;font-weight:600;">Jam Operasional</p>
                        <p style="font-size:1rem;font-weight:500;color:#111;margin:0;">08:00 – 22:00 WIB</p>
                    </div>
                </div>
                <div class="info-bar-item">
                    <svg style="width:24px;height:24px;flex-shrink:0;color:#999;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                    <div>
                        <p style="font-size:0.65rem;letter-spacing:0.2em;text-transform:uppercase;color:#aaa;margin:0 0 4px;font-weight:600;">Lokasi</p>
                        <p style="font-size:1rem;font-weight:500;color:#111;margin:0;">Jl. Kopi No. 123, Pusat Kota</p>
                    </div>
                </div>
                <div class="info-bar-item" style="background:#111; border-right:none; flex-direction:column; align-items:flex-start; gap:0.5rem;">
                    <span style="font-size:0.6rem;padding:3px 8px;background:#fff;color:#111;letter-spacing:0.15em;text-transform:uppercase;font-weight:700;">Special Offer</span>
                    <p style="font-family:'Playfair Display',serif; font-size:1.4rem; font-weight:700; color:#fff; margin:0;">Buy 1 Get 1 Free!</p>
                    <p style="font-size:0.8rem;color:rgba(255,255,255,0.5);margin:0;">Setiap Jumat, pukul 14:00 – 17:00</p>
                </div>
            </div>
        </section>

        {{-- ══════════════════ MENU ══════════════════ --}}
        <section style="max-width:1200px; margin:0 auto; padding:6rem 2rem;">
            <div style="text-align:center; margin-bottom:4rem;">
                <p class="section-eyebrow">What We Serve</p>
                <h2 style="font-family:'Playfair Display',serif; font-size:clamp(2rem,5vw,3.5rem); font-weight:700; margin:0; letter-spacing:-0.01em;">Our Curated Menu</h2>
            </div>

            <div style="display:grid; grid-template-columns:repeat(auto-fit, minmax(min(280px, 100%), 1fr)); gap:3rem 5rem;">
                @forelse($categories as $category)
                <div>
                    <h3 style="font-family:'Playfair Display',serif; font-size:1.4rem; font-weight:700; margin:0 0 0.25rem; padding-bottom:1rem; border-bottom:2px solid #111;">
                        {{ $category->name }}
                    </h3>
                    @foreach($category->products as $product)
                    <div class="product-row">
                        <div style="flex:1; padding-right:1rem;">
                            <div style="display:flex; align-items:center; gap:0.5rem; margin-bottom:2px;">
                                <p style="font-weight:600; font-size:0.95rem; margin:0; color:#111;">{{ $product->name }}</p>
                                @if($product->promo_price)
                                <span style="font-size:0.55rem; padding:2px 6px; background:#111; color:#fff; letter-spacing:0.1em; text-transform:uppercase; font-weight:700;">Promo</span>
                                @endif
                            </div>
                            <p style="font-size:0.8rem; color:#999; margin:0;">{{ \Illuminate\Support\Str::limit($product->description, 55) }}</p>
                        </div>
                        <div style="text-align:right; white-space:nowrap;">
                            @if($product->promo_price)
                            <p style="font-size:0.75rem; color:#bbb; text-decoration:line-through; margin:0;">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                            <p style="font-weight:700; font-size:0.95rem; color:#111; margin:0;">Rp {{ number_format($product->promo_price, 0, ',', '.') }}</p>
                            @else
                            <p style="font-weight:600; font-size:0.95rem; color:#111; margin:0;">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                            @endif
                        </div>
                    </div>
                    @endforeach
                </div>
                @empty
                <div style="grid-column:1/-1; text-align:center; padding:4rem 0; color:#bbb;">
                    <p style="font-style:italic;">Katalog menu sedang dipersiapkan. Segera kembali!</p>
                </div>
                @endforelse
            </div>
        </section>

        {{-- ══════════════════ QUOTE ══════════════════ --}}
        <section style="background:#111; padding:6rem 2rem; text-align:center;">
            <p style="font-size:0.65rem; letter-spacing:0.35em; text-transform:uppercase; color:rgba(255,255,255,0.35); margin-bottom:2rem;">Philosophy</p>
            <blockquote style="font-family:'Playfair Display',serif; font-size:clamp(1.5rem,4vw,3rem); font-style:italic; color:#fff; max-width:800px; margin:0 auto 2.5rem; line-height:1.4; font-weight:400;">
                "Seteguk Makna di Balik Setiap Logos, Secangkir Kopi yang Menginspirasi Jiwa."
            </blockquote>
            <div style="width:40px; height:1px; background:rgba(255,255,255,0.2); margin:0 auto;"></div>
        </section>

        {{-- ══════════════════ FOOTER ══════════════════ --}}
        <footer style="border-top:1px solid #ebebeb; padding:4rem 2rem;">
            <div style="max-width:1200px; margin:0 auto; display:grid; grid-template-columns:repeat(auto-fit,minmax(200px,1fr)); gap:3rem; align-items:start;">
                <div>
                    <p style="font-family:'Playfair Display',serif; font-size:1.2rem; font-weight:700; letter-spacing:0.15em; text-transform:uppercase; margin:0 0 1rem;">Logos Coffee</p>
                    <p style="font-size:0.85rem; color:#999; line-height:1.7; margin:0;">Jl. Kopi No. 123,<br>Kec. Brewed, Pusat Kota,<br>Indonesia 10110</p>
                </div>
                <div>
                    <p style="font-size:0.65rem; letter-spacing:0.25em; text-transform:uppercase; font-weight:700; color:#aaa; margin:0 0 1rem;">Hubungi Kami</p>
                    <a href="tel:081234567890" style="display:block; font-size:0.9rem; color:#555; text-decoration:none; margin-bottom:0.5rem; transition:color 0.2s;">+62 812 3456 7890</a>
                    <a href="mailto:hello@logoscoffe.com" style="display:block; font-size:0.9rem; color:#555; text-decoration:none;">hello@logoscoffe.com</a>
                </div>
                <div>
                    <p style="font-size:0.65rem; letter-spacing:0.25em; text-transform:uppercase; font-weight:700; color:#aaa; margin:0 0 1rem;">Ikuti Kami</p>
                    <div style="display:flex; gap:0.75rem;">
                        <a href="#" style="width:38px;height:38px;border:1px solid #e5e5e5;display:flex;align-items:center;justify-content:center;border-radius:50%;color:#555;transition:all 0.2s;text-decoration:none;">
                            <svg style="width:16px;height:16px;" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg>
                        </a>
                        <a href="#" style="width:38px;height:38px;border:1px solid #e5e5e5;display:flex;align-items:center;justify-content:center;border-radius:50%;color:#555;transition:all 0.2s;text-decoration:none;">
                            <svg style="width:16px;height:16px;" fill="currentColor" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                        </a>
                    </div>
                </div>
                <div style="text-align:right;">
                    <p style="font-size:0.75rem; color:#ccc; margin:0;">© 2024 Logos Coffee.<br>All rights reserved.</p>
                </div>
            </div>
        </footer>

    </body>
</html>
