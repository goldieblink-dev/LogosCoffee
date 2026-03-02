<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Logos Coffe - Premium Coffee Experience</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Playfair+Display:ital,wght@0,400;0,700;1,400&display=swap" rel="stylesheet">

        <!-- Styles / Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        
        <style>
            @keyframes fade-in {
                from { opacity: 0; transform: translateY(20px); }
                to { opacity: 1; transform: translateY(0); }
            }
            .animate-fade-in {
                animation: fade-in 1s ease-out forwards;
            }
        </style>
    </head>
    <body class="selection:bg-black selection:text-white bg-coffee-dark text-cream font-body antialiased">
        
        <!-- Header Section -->
        <header class="pt-12 pb-16 text-center animate-fade-in">
            <div class="mx-auto w-24 h-24 bg-black rounded-full flex items-center justify-center mb-4 shadow-2xl shadow-black/10">
                <span class="font-heading text-4xl text-coffee-dark font-bold italic tracking-tighter">LC</span>
            </div>
            <h1 class="text-5xl md:text-6xl font-heading font-bold tracking-tight text-gold">Logos Coffe</h1>
            <p class="text-cream/60 mt-2 tracking-widest uppercase text-sm font-medium">Brewing Excellence Since 2024</p>
        </header>

        <main class="max-w-6xl mx-auto px-6 pb-24">
            
            <!-- Info & Promo Section -->
            <section class="grid grid-cols-1 lg:grid-cols-3 gap-8 mb-20 animate-fade-in" style="animation-delay: 0.2s;">
                <!-- Info Bar -->
                <div class="lg:col-span-2 glass-card flex flex-col md:flex-row justify-between items-center gap-8">
                    <div class="flex items-center gap-4 border-r border-black/10 md:pr-8 last:border-0 h-full">
                        <div class="bg-black/5 p-3 rounded-full">
                            <svg class="w-6 h-6 text-gold" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        </div>
                        <div>
                            <h3 class="text-gold font-bold uppercase text-xs tracking-wider">Jam Operasional</h3>
                            <p class="text-cream/80 text-lg">08:00 - 22:00 WIB</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-4 flex-1">
                        <div class="bg-black/5 p-3 rounded-full">
                            <svg class="w-6 h-6 text-gold" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                        </div>
                        <div>
                            <h3 class="text-gold font-bold uppercase text-xs tracking-wider">Lokasi</h3>
                            <p class="text-cream/80 leading-snug">Jl. Kopi No. 123, Pusat Kota, Indonesia</p>
                        </div>
                    </div>
                </div>

                <!-- Promo Box -->
                <div class="promo-card group cursor-pointer">
                    <div class="absolute -right-4 -top-4 w-24 h-24 bg-black rounded-full blur-3xl opacity-5 group-hover:opacity-10 transition-opacity"></div>
                    <div class="relative z-10 h-full flex flex-col justify-between">
                        <div>
                            <span class="bg-gold text-coffee-dark px-2 py-1 rounded text-xs font-black uppercase mb-2 inline-block">Special Offer</span>
                            <h2 class="text-3xl font-heading font-bold mb-2">Buy 1 Get 1 Free!</h2>
                            <p class="text-cream/70 text-sm">Berlaku untuk semua varian Espresso setiap hari Jumat pukul 14:00 - 17:00.</p>
                        </div>
                        <button class="btn-gold mt-6 w-full text-sm">Cek Promo Lainnya</button>
                    </div>
                </div>
            </section>

            <!-- Menu Section -->
            <section class="mb-20 animate-fade-in" style="animation-delay: 0.4s;">
                <div class="text-center mb-16">
                    <h2 class="text-4xl font-heading font-bold text-gold inline-block border-b-2 border-black/10 pb-4">Our Curated Menu</h2>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-x-12 gap-y-16">
                    
                    <!-- Kategori 1 -->
                    <div>
                        <h3 class="menu-category-title">Signature Espresso</h3>
                        <div class="space-y-4">
                            <div class="product-item group">
                                <div class="w-16 h-16 bg-black/5 rounded-lg flex-shrink-0 flex items-center justify-center border border-black/10 transition-transform group-hover:scale-110">
                                    <svg class="w-8 h-8 text-gold/50" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M12 14l9-5-9-5-9 5 9 5z"></path></svg>
                                </div>
                                <div class="flex-1">
                                    <div class="flex justify-between items-baseline mb-1">
                                        <h4 class="font-bold text-lg">Americano Classic</h4>
                                        <span class="text-gold font-bold">Rp 25.000</span>
                                    </div>
                                    <p class="text-cream/50 text-sm leading-relaxed">Ekstraksi biji kopi pilihan dengan air mineral berkualitas tinggi.</p>
                                </div>
                            </div>
                            <div class="product-item border-l-2 border-gold bg-black/5 group">
                                <div class="w-16 h-16 bg-black/10 rounded-lg flex-shrink-0 flex items-center justify-center transition-transform group-hover:scale-110">
                                    <svg class="w-8 h-8 text-gold" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M12 14l9-5-9-5-9 5 9 5z"></path></svg>
                                </div>
                                <div class="flex-1">
                                    <div class="flex justify-between items-baseline mb-1">
                                        <h4 class="font-bold text-lg">Caramel Macchiato</h4>
                                        <div class="flex items-center gap-2">
                                            <span class="bg-gold text-coffee-dark text-[10px] px-1.5 py-0.5 rounded font-black uppercase animate-pulse">Promo</span>
                                            <span class="text-gold font-bold">Rp 32.000</span>
                                        </div>
                                    </div>
                                    <p class="text-cream/50 text-sm leading-relaxed">Paduan espresso, susu premium, dan saus karamel homemade.</p>
                                </div>
                            </div>
                            <div class="product-item group">
                                <div class="w-16 h-16 bg-black/5 rounded-lg flex-shrink-0 flex items-center justify-center border border-black/10 transition-transform group-hover:scale-110">
                                    <svg class="w-8 h-8 text-gold/50" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M12 14L2 9l10-5 10 5-10 5z"></path></svg>
                                </div>
                                <div class="flex-1">
                                    <div class="flex justify-between items-baseline mb-1">
                                        <h4 class="font-bold text-lg">Caffe Latte</h4>
                                        <span class="text-gold font-bold">Rp 28.000</span>
                                    </div>
                                    <p class="text-cream/50 text-sm leading-relaxed">Susu creamy dengan espresso lembut untuk memulai hari.</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Kategori 2 -->
                    <div>
                        <h3 class="menu-category-title">Manual Brew</h3>
                        <div class="space-y-4">
                            <div class="product-item group">
                                <div class="w-16 h-16 bg-black/5 rounded-lg flex-shrink-0 flex items-center justify-center border border-black/10 transition-transform group-hover:scale-110">
                                    <svg class="w-8 h-8 text-gold/50" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M14 10h4.704a2 2 0 011.94 1.515l.504 2.017A2 2 0 0119.208 16H18a4 4 0 01-1 7.874V24a1 1 0 01-1 1H9a1 1 0 01-1-1v-1.126A4 4 0 017 16H5.792a2 2 0 01-1.94-2.468l.504-2.017A2 2 0 016.296 10H11V7a3 3 0 116 0v3z"></path></svg>
                                </div>
                                <div class="flex-1">
                                    <div class="flex justify-between items-baseline mb-1">
                                        <h4 class="font-bold text-lg">V60 Pour Over</h4>
                                        <span class="text-gold font-bold">Rp 30.000</span>
                                    </div>
                                    <p class="text-cream/50 text-sm leading-relaxed">Menonjolkan karakteristik beans single origin pilihan Anda.</p>
                                </div>
                            </div>
                            <div class="product-item group">
                                <div class="w-16 h-16 bg-black/5 rounded-lg flex-shrink-0 flex items-center justify-center border border-black/10 transition-transform group-hover:scale-110">
                                    <svg class="w-8 h-8 text-gold/50" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                                </div>
                                <div class="flex-1">
                                    <div class="flex justify-between items-baseline mb-1">
                                        <h4 class="font-bold text-lg">Japanese Iced Coffee</h4>
                                        <span class="text-gold font-bold">Rp 32.000</span>
                                    </div>
                                    <p class="text-cream/50 text-sm leading-relaxed">Seduhan manual yang didinginkan seketika untuk aroma maksimal.</p>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </section>

            <!-- Quote Section -->
            <section class="py-24 px-6 glass-card text-center mb-20 relative overflow-hidden group animate-fade-in" style="animation-delay: 0.6s;">
                <div class="absolute -left-12 -top-12 w-48 h-48 bg-black/5 rounded-full blur-3xl group-hover:bg-black/10 transition-colors duration-700"></div>
                <div class="relative z-10">
                    <svg class="w-12 h-12 text-gold/20 mx-auto mb-6" fill="currentColor" viewBox="0 0 24 24"><path d="M14.017 21L14.017 18C14.017 16.8954 14.9124 16 16.017 16L19.017 16C19.5693 16 20.017 15.5523 20.017 15L20.017 13C20.017 12.4477 19.5693 12 19.017 12L17.017 12C14.8078 12 13.017 10.2091 13.017 8L13.017 6C13.017 3.79086 14.8079 2 17.017 2L19.017 2C21.2261 2 23.017 3.79086 23.017 6L23.017 12C23.017 16.9706 18.9876 21 14.017 21ZM2.01698 21L2.01698 18C2.01698 16.8954 2.91242 16 4.01698 16L7.01698 16C7.56926 16 8.01698 15.5523 8.01698 15L8.01698 13C8.01698 12.4477 7.56926 12 7.01698 12L5.01698 12C2.80784 12 1.01698 10.2091 1.01698 8L1.01698 6C1.01698 3.79086 2.80784 2 5.01698 2L7.01698 2C9.22612 2 11.017 3.79086 11.017 6L11.017 12C11.017 16.9706 6.98755 21 2.01698 21Z"></path></svg>
                    <p class="font-heading text-3xl md:text-5xl italic leading-tight text-cream/90 max-w-4xl mx-auto">
                        "Seteguk Makna di Balik Setiap Logos, Secangkir Kopi yang Menginspirasi Jiwa."
                    </p>
                    <div class="mt-8 flex items-center justify-center gap-4">
                        <div class="h-[1px] w-12 bg-black/10"></div>
                        <span class="text-gold font-bold tracking-widest uppercase text-xs">Logos Coffe Philosophy</span>
                        <div class="h-[1px] w-12 bg-black/10"></div>
                    </div>
                </div>
            </section>

        </main>

        <!-- Footer Section -->
        <footer class="bg-coffee-muted/50 border-t border-black/5 py-16 px-6 animate-fade-in" style="animation-delay: 0.8s;">
            <div class="max-w-6xl mx-auto grid grid-cols-1 md:grid-cols-3 gap-12">
                <div>
                    <h4 class="text-gold font-heading text-xl mb-6">Lokasi</h4>
                    <p class="text-cream/60 leading-relaxed italic">
                        Jl. Kopi No. 123,<br>
                        Kec. Brewed, Pusat Kota,<br>
                        Indonesia 10110
                    </p>
                </div>
                <div class="text-center md:text-left">
                    <h4 class="text-gold font-heading text-xl mb-6">Hubungi Kami</h4>
                    <a href="tel:081234567890" class="text-cream/60 hover:text-gold transition-colors block mb-2 tracking-widest">+62 812 3456 7890</a>
                    <a href="mailto:hello@logoscoffe.com" class="text-cream/60 hover:text-gold transition-colors block tracking-widest">hello@logoscoffe.com</a>
                </div>
                <div class="text-right md:text-left lg:text-right">
                    <h4 class="text-gold font-heading text-xl mb-6">Ikuti Kami</h4>
                    <div class="flex justify-end md:justify-start lg:justify-end gap-4">
                        <a href="#" class="w-10 h-10 bg-black/5 flex items-center justify-center rounded-full hover:bg-gold hover:text-coffee-dark transition-all">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg>
                        </a>
                        <a href="#" class="w-10 h-10 bg-black/5 flex items-center justify-center rounded-full hover:bg-gold hover:text-coffee-dark transition-all">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                        </a>
                    </div>
                    <p class="text-cream/30 text-[10px] uppercase tracking-widest mt-12">&copy; 2024 Logos Coffe. All rights reserved.</p>
                </div>
            </div>
        </footer>

    </body>
</html>
