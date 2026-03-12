@extends('layouts.admin')

@section('title', 'Daftar Produk')

@section('content')
<div x-data="productDashboard({{ json_encode($products) }})" class="space-y-6">
    <!-- Responsive Premium Header & Controls -->
    <div class="flex flex-col lg:flex-row justify-between items-start lg:items-center gap-6">
        <div>
            <h2 class="text-2xl font-black text-gray-900 tracking-tight">Daftar Produk</h2>
        </div>

        <div class="flex flex-col sm:flex-row flex-wrap items-center gap-3 w-full lg:w-auto">
            {{-- Search Input (Pill Design) --}}
            <div class="flex items-center w-full sm:w-auto flex-1 sm:min-w-[300px] bg-white border border-gray-200 rounded-full shadow-sm hover:shadow-md focus-within:ring-2 focus-within:ring-black focus-within:border-transparent px-4 py-0.5 transition-all duration-300 group">
                <div class="flex items-center justify-center shrink-0">
                    <svg class="w-4 h-4 text-gray-400 group-focus-within:text-black transition-colors duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                </div>
                <input 
                    type="text" 
                    x-model="searchQuery" 
                    placeholder="Cari Produk..." 
                    class="w-full flex-1 pl-3 pr-2 py-2.5 bg-transparent border-none text-sm font-semibold focus:ring-0 outline-none placeholder:text-gray-400 placeholder:font-medium"
                >
            </div>

            <div class="flex items-center gap-3 w-full sm:w-auto justify-between sm:justify-start">
                {{-- Category Filter --}}
                <div class="flex items-center gap-2 bg-white border border-gray-200 rounded-2xl px-3 py-2 cursor-pointer shadow-sm shrink-0 hover:bg-gray-50 transition-colors">
                    <span class="text-xs font-bold uppercase tracking-wider text-gray-500">Kategori</span>
                    <select x-model="selectedCategory" class="bg-transparent border-none text-sm font-black focus:ring-0 cursor-pointer p-0 pr-6 outline-none">
                        <option value="">Semua</option>
                        <template x-for="category in categories" :key="category">
                            <option :value="category" x-text="category"></option>
                        </template>
                    </select>
                </div>

                {{-- Rows Selector --}}
                <div class="flex items-center gap-2 bg-white border border-gray-200 rounded-2xl px-3 py-2 cursor-pointer shadow-sm shrink-0 hover:bg-gray-50 transition-colors">
                    <span class="text-xs font-bold uppercase tracking-wider text-gray-500">Rows</span>
                    <select x-model="maxRows" class="bg-transparent border-none text-sm font-black focus:ring-0 cursor-pointer p-0 pr-6 outline-none">
                        <option value="5">5</option>
                        <option value="10" selected>10</option>
                        <option value="25">25</option>
                        <option value="50">50</option>
                    </select>
                </div>
                
                {{-- Add Button --}}
                <a href="{{ route('products.create') }}" class="px-5 py-2.5 bg-black text-white text-xs font-bold rounded-xl hover:bg-gray-800 transition-colors shadow-lg shrink-0 flex items-center gap-2 uppercase tracking-wide">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"/></svg>
                    Produk
                </a>
            </div>
        </div>
    </div>

    {{-- Main Table Container (Pure Data) --}}
    <div class="bg-white border border-gray-200 rounded-2xl shadow-sm overflow-hidden min-h-[400px]">
        <table class="w-full text-left">
            <thead class="bg-gray-50 border-b border-gray-200">
                <tr>
                    <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider text-gray-500">Produk</th>
                    <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider text-gray-500">Kategori</th>
                    <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider text-gray-500">Harga</th>
                    <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider text-gray-500">Status</th>
                    <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider text-gray-500 text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                <template x-for="product in paginatedProducts" :key="product.id">
                    <tr class="hover:bg-gray-50 transition-colors">
                        <td class="px-6 py-4 flex items-center gap-4">
                            <div class="w-12 h-12 bg-gray-100 rounded-lg overflow-hidden flex-shrink-0 border border-gray-200">
                                <template x-if="product.image_url">
                                    <img :src="product.image_url" :alt="product.name" class="w-full h-full object-cover">
                                </template>
                                <template x-if="!product.image_url">
                                    <div class="w-full h-full flex items-center justify-center text-gray-400">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                        </svg>
                                    </div>
                                </template>
                            </div>
                            <div>
                                <p class="font-bold text-gray-900" x-text="product.name"></p>
                                <p class="text-xs text-gray-500 truncate max-w-[200px]" x-text="product.description"></p>
                            </div>
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-700">
                            <span class="px-2 py-1 bg-gray-100 font-medium rounded-lg text-[11px] uppercase tracking-wider" x-text="product.category_name"></span>
                        </td>
                        <td class="px-6 py-4 font-bold text-gray-900" x-text="product.formatted_price"></td>
                        <td class="px-6 py-4">
                            <form :action="'/admin/products/' + product.id + '/toggle'" method="POST">
                                @csrf
                                @method('PATCH')
                                <button type="submit"
                                    class="px-3 py-1 rounded-full text-[10px] font-bold uppercase border transition-all"
                                    :class="product.is_available ? 'bg-green-50 text-green-700 border-green-200 hover:bg-green-100' : 'bg-red-50 text-red-700 border-red-200 hover:bg-red-100'"
                                    x-text="product.is_available ? 'Tersedia' : 'Habis'">
                                </button>
                            </form>
                        </td>
                        <td class="px-6 py-4 text-right">
                            <div class="flex items-center justify-end gap-3">
                                <a :href="'/admin/products/' + product.id + '/edit'" class="text-xs font-bold text-black hover:text-blue-600 transition-colors">Edit</a>
                                <form :action="'/admin/products/' + product.id" method="POST" class="inline" onsubmit="return confirm('Yakin ingin menghapus produk ini?')">
                                    @csrf 
                                    @method('DELETE')
                                    <button type="submit" class="text-xs font-bold text-red-500 hover:text-red-700 transition-colors">Hapus</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                </template>
                <template x-if="paginatedProducts.length === 0">
                    <tr>
                        <td colspan="5" class="px-6 py-10 text-center text-gray-400 font-medium">Data produk tidak ditemukan.</td>
                    </tr>
                </template>
            </tbody>
        </table>
    </div>

    {{-- Custom Pagination (Detached) --}}
    <div class="flex justify-end" x-show="totalPages > 1">
        <div class="flex items-center gap-6">
            <span class="text-xs font-bold text-gray-500 uppercase tracking-wider">
                Page <span class="text-black" x-text="currentPage"></span> of <span class="text-black" x-text="totalPages"></span>
            </span>
            <div class="flex items-center gap-2">
                <button 
                    @click="prevPage()" 
                    :disabled="currentPage === 1"
                    class="w-9 h-9 flex items-center justify-center rounded-xl bg-white border border-gray-200 text-gray-900 hover:bg-gray-50 disabled:opacity-50 disabled:cursor-not-allowed transition-all shadow-sm">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7"/>
                    </svg>
                </button>
                <button 
                    @click="nextPage()" 
                    :disabled="currentPage === totalPages"
                    class="w-9 h-9 flex items-center justify-center rounded-xl bg-white border border-gray-200 text-gray-900 hover:bg-gray-50 disabled:opacity-50 disabled:cursor-not-allowed transition-all shadow-sm">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/>
                    </svg>
                </button>
            </div>
        </div>
    </div>
</div>

<script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
<script>
    function productDashboard(initialProducts) {
        // Hydrate data for Alpine
        const hydratedProducts = initialProducts.map(p => ({
            ...p,
            category_name: p.category ? p.category.name : 'Unknown',
            image_url: p.image ? '/storage/' + p.image : null,
            formatted_price: 'Rp ' + new Intl.NumberFormat('id-ID').format(p.price)
        }));

        // Extract unique categories
        const uniqueCategories = [...new Set(hydratedProducts.map(p => p.category_name))].sort();

        return {
            allProducts: hydratedProducts,
            searchQuery: '',
            selectedCategory: '',
            maxRows: 10,
            currentPage: 1,
            categories: uniqueCategories,

            get totalPages() {
                return Math.max(1, Math.ceil(this.filteredProducts.length / parseInt(this.maxRows)));
            },

            get filteredProducts() {
                let filtered = this.allProducts;

                // Category Filter
                if (this.selectedCategory !== '') {
                    filtered = filtered.filter(p => p.category_name === this.selectedCategory);
                }

                // Search Filter
                if (this.searchQuery.trim() !== '') {
                    const q = this.searchQuery.toLowerCase();
                    filtered = filtered.filter(p => {
                        return p.name.toLowerCase().includes(q) || 
                               (p.description && p.description.toLowerCase().includes(q));
                    });
                }

                return filtered;
            },

            get paginatedProducts() {
                const start = (this.currentPage - 1) * parseInt(this.maxRows);
                const end = start + parseInt(this.maxRows);
                return this.filteredProducts.slice(start, end);
            },

            nextPage() {
                if (this.currentPage < this.totalPages) {
                    this.currentPage++;
                }
            },

            prevPage() {
                if (this.currentPage > 1) {
                    this.currentPage--;
                }
            },

            init() {
                // Reset page to 1 when search, category, or maxRows changes
                this.$watch('searchQuery', () => this.currentPage = 1);
                this.$watch('selectedCategory', () => this.currentPage = 1);
                this.$watch('maxRows', () => this.currentPage = 1);
            }
        }
    }
</script>
@endsection