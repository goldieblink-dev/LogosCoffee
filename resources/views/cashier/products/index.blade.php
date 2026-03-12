@extends('layouts.cashier')
@section('title', 'Ketersediaan Produk')

@section('content')
<div x-data="productsPage({{ json_encode($products) }})" class="space-y-6">

    {{-- Header --}}
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-8">
        <div>
            <h3 class="text-3xl font-black text-gray-900 tracking-tighter">Produk Menu</h3>
            <p class="text-xs font-bold text-gray-400 uppercase tracking-widest mt-1" x-text="products.filter(p=>p.is_available).length + ' dari ' + products.length + ' Tersedia'"></p>
        </div>
    </div>

    {{-- Search + Filter --}}
    <div class="flex flex-col sm:flex-row gap-4 mb-6">
        <div class="relative flex-1">
            <svg class="absolute left-3.5 top-1/2 -translate-y-1/2 w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
            <input type="text" x-model="search" placeholder="Cari nama produk..."
                class="w-full pl-11 pr-4 py-3 bg-white border border-gray-200 rounded-2xl text-sm focus:ring-2 focus:ring-black outline-none font-bold placeholder:text-gray-400 placeholder:font-medium shadow-sm">
        </div>
        <div class="flex gap-2">
            <button @click="filter = ''" :class="filter==='' ? 'bg-black text-white' : 'bg-white text-gray-500 border border-gray-200'" class="px-4 py-2.5 text-xs font-bold rounded-xl transition-all">Semua</button>
            <button @click="filter = 'available'" :class="filter==='available' ? 'bg-black text-white' : 'bg-white text-gray-500 border border-gray-200'" class="px-4 py-2.5 text-xs font-bold rounded-xl transition-all">Tersedia</button>
            <button @click="filter = 'empty'" :class="filter==='empty' ? 'bg-black text-white' : 'bg-white text-gray-500 border border-gray-200'" class="px-4 py-2.5 text-xs font-bold rounded-xl transition-all">Kosong</button>
        </div>
    </div>

    {{-- Table --}}
    <div class="w-full bg-white border border-gray-200 rounded-[2.5rem] shadow-sm overflow-hidden">
        <div class="overflow-x-auto no-scrollbar">
            <table class="w-full text-left border-collapse min-w-[500px]">
                <thead class="bg-gray-50/50 border-b border-gray-100">
                    <tr>
                        <th class="pl-10 pr-4 py-5 text-[10px] font-black uppercase tracking-[0.3em] text-gray-400">Produk</th>
                        <th class="px-6 py-5 text-[10px] font-black uppercase tracking-[0.3em] text-gray-400">Kategori</th>
                        <th class="px-6 py-5 text-[10px] font-black uppercase tracking-[0.3em] text-gray-400">Harga</th>
                        <th class="pl-4 pr-10 py-5 text-[10px] font-black uppercase tracking-[0.3em] text-gray-400 text-right">Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    <template x-for="product in filteredProducts" :key="product.id">
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="px-6 py-4">
                                <p class="font-bold text-gray-900 text-sm" x-text="product.name"></p>
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-500 font-medium" x-text="product.category?.name || '-'"></td>
                            <td class="px-6 py-4 text-sm font-black text-gray-900" x-text="'Rp ' + Number(product.price).toLocaleString('id-ID')"></td>
                            <td class="px-6 py-4 text-right">
                                <form method="POST" :action="'/cashier/products/' + product.id + '/toggle'" class="inline">
                                    @csrf @method('PATCH')
                                    <button type="submit"
                                        class="relative inline-flex items-center gap-2 px-4 py-2 text-xs font-black rounded-xl border transition-all"
                                        :class="product.is_available ? 'bg-emerald-50 text-emerald-700 border-emerald-200 hover:bg-emerald-500 hover:text-white hover:border-emerald-500' : 'bg-red-50 text-red-600 border-red-200 hover:bg-red-500 hover:text-white hover:border-red-500'">
                                        <span class="w-1.5 h-1.5 rounded-full" :class="product.is_available ? 'bg-emerald-500' : 'bg-red-500'"></span>
                                        <span x-text="product.is_available ? 'Tersedia' : 'Kosong'"></span>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    </template>
                    <template x-if="filteredProducts.length === 0">
                        <tr><td colspan="4" class="py-10 text-center text-gray-400 text-sm font-medium">Tidak ada produk ditemukan.</td></tr>
                    </template>
                </tbody>
            </table>
        </div>
    </div>

</div>

<script>
function productsPage(data) {
    return {
        products: data,
        search: '',
        filter: '',
        get filteredProducts() {
            return this.products.filter(p => {
                const matchSearch = !this.search || p.name.toLowerCase().includes(this.search.toLowerCase());
                const matchFilter = !this.filter
                    || (this.filter === 'available' && p.is_available)
                    || (this.filter === 'empty' && !p.is_available);
                return matchSearch && matchFilter;
            });
        }
    }
}
</script>
@endsection
