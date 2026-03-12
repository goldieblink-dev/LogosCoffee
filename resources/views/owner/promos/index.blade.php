@extends('layouts.owner')
@section('title', 'Manajemen Promo')

@section('content')
<div x-data="promosPage({{ json_encode($products) }})" class="space-y-6">

    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-8">
        <div>
            <h3 class="text-3xl font-black text-gray-900 tracking-tighter">Manajemen Promo</h3>
            <p class="text-xs font-bold text-gray-400 uppercase tracking-widest mt-1" x-text="products.filter(p=>p.promo_price).length + ' Produk Sedang Promo'"></p>
        </div>
    </div>

    <div class="flex flex-col sm:flex-row gap-4 mb-6">
        <div class="relative flex-1">
            <svg class="absolute left-3.5 top-1/2 -translate-y-1/2 w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
            <input x-model="search" placeholder="Cari produk..." class="w-full pl-11 pr-4 py-3 bg-white border border-gray-200 rounded-2xl text-sm font-bold focus:ring-2 focus:ring-black outline-none shadow-sm placeholder:text-gray-400 placeholder:font-medium">
        </div>
        <div class="flex gap-2">
            <button @click="filter=''" :class="filter==='' ? 'bg-black text-white' : 'bg-white border border-gray-200 text-gray-500'" class="px-4 py-2.5 text-xs font-bold rounded-xl transition-all">Semua</button>
            <button @click="filter='promo'" :class="filter==='promo' ? 'bg-black text-white' : 'bg-white border border-gray-200 text-gray-500'" class="px-4 py-2.5 text-xs font-bold rounded-xl transition-all">Aktif Promo</button>
            <button @click="filter='no-promo'" :class="filter==='no-promo' ? 'bg-black text-white' : 'bg-white border border-gray-200 text-gray-500'" class="px-4 py-2.5 text-xs font-bold rounded-xl transition-all">Tanpa Promo</button>
        </div>
    </div>

    <div class="bg-white border border-gray-200 rounded-[2.5rem] shadow-sm overflow-hidden mb-12">
        <div class="overflow-x-auto no-scrollbar">
            <table class="w-full text-left border-collapse min-w-[600px]">
                <thead class="bg-gray-50/50 border-b border-gray-100">
                    <tr>
                        <th class="pl-10 pr-4 py-5 text-[10px] font-black uppercase tracking-[0.3em] text-gray-400">Produk</th>
                        <th class="px-6 py-5 text-[10px] font-black uppercase tracking-[0.3em] text-gray-400">Harga Normal</th>
                        <th class="px-6 py-5 text-[10px] font-black uppercase tracking-[0.3em] text-gray-400">Harga Promo</th>
                        <th class="px-6 py-5 text-[10px] font-black uppercase tracking-[0.3em] text-gray-400">Diskon</th>
                        <th class="pl-4 pr-10 py-5 text-[10px] font-black uppercase tracking-[0.3em] text-gray-400 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    <template x-for="product in filteredProducts" :key="product.id">
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="px-6 py-4">
                                <p class="font-bold text-gray-900 text-sm" x-text="product.name"></p>
                                <p class="text-xs text-gray-400" x-text="product.category?.name"></p>
                            </td>
                            <td class="px-6 py-4 text-sm font-black text-gray-900" x-text="'Rp ' + Number(product.price).toLocaleString('id-ID')"></td>
                            <td class="px-6 py-4">
                                <template x-if="product.promo_price">
                                    <span class="px-2.5 py-1 text-[10px] font-black bg-red-50 text-red-600 border border-red-100 rounded-xl" x-text="'Rp ' + Number(product.promo_price).toLocaleString('id-ID')"></span>
                                </template>
                                <template x-if="!product.promo_price">
                                    <span class="text-gray-300 text-xs font-bold">—</span>
                                </template>
                            </td>
                            <td class="px-6 py-4">
                                <template x-if="product.promo_price">
                                    <span class="text-sm font-black text-emerald-600" x-text="Math.round((1 - product.promo_price / product.price) * 100) + '% off'"></span>
                                </template>
                                <template x-if="!product.promo_price">
                                    <span class="text-gray-300 text-xs">—</span>
                                </template>
                            </td>
                            <td class="px-6 py-4 text-right">
                                <button @click="openEdit(product)" class="px-3 py-1.5 text-xs font-bold text-black bg-gray-100 hover:bg-black hover:text-white rounded-lg transition-all">Set Promo</button>
                            </td>
                        </tr>
                    </template>
                </tbody>
            </table>
        </div>
    </div>

    {{-- Edit Promo Modal --}}
    <div x-show="showEdit" x-cloak @click.self="showEdit=false" class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/60 backdrop-blur-sm" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100">
        <div class="bg-white w-full max-w-sm rounded-2xl shadow-2xl p-6" @click.stop x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100">
            <h3 class="font-black text-gray-900 text-lg mb-1">Set Harga Promo</h3>
            <p class="text-sm text-gray-500 mb-5" x-text="selected?.name"></p>
            <form method="POST" :action="'/owner/promos/' + selected?.id" class="space-y-4">
                @csrf @method('PATCH')
                <div>
                    <label class="block text-[10px] font-black text-gray-400 uppercase tracking-widest mb-1.5">Harga Normal</label>
                    <p class="text-xl font-black text-gray-900" x-text="'Rp ' + Number(selected?.price).toLocaleString('id-ID')"></p>
                </div>
                <div>
                    <label class="block text-[10px] font-black text-gray-400 uppercase tracking-widest mb-1.5">Harga Promo (Rp)</label>
                    <input type="number" name="promo_price" :value="selected?.promo_price || ''" min="0" :max="selected?.price"
                        placeholder="Kosongkan untuk hapus promo"
                        class="w-full px-4 py-2.5 border border-gray-200 rounded-xl text-sm font-semibold focus:ring-2 focus:ring-black outline-none">
                    <p class="text-xs text-gray-400 mt-1 font-medium">Kosongkan untuk menghapus promo yang aktif.</p>
                </div>
                <div class="flex gap-2 pt-2">
                    <button type="button" @click="showEdit=false" class="flex-1 py-2.5 text-sm font-bold text-gray-700 bg-gray-100 rounded-xl hover:bg-gray-200">Batal</button>
                    <button type="submit" class="flex-1 py-2.5 text-sm font-bold text-white bg-black rounded-xl hover:bg-gray-800">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
function promosPage(data) {
    return {
        products: data, search: '', filter: '', showEdit: false, selected: null,
        get filteredProducts() {
            return this.products.filter(p => {
                const matchSearch = !this.search || p.name.toLowerCase().includes(this.search.toLowerCase());
                const matchFilter = !this.filter
                    || (this.filter === 'promo' && p.promo_price)
                    || (this.filter === 'no-promo' && !p.promo_price);
                return matchSearch && matchFilter;
            });
        },
        openEdit(p) { this.selected = {...p}; this.showEdit = true; },
    }
}
</script>
@endsection
