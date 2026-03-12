@extends('layouts.owner')
@section('title', 'Produk & Harga')

@section('content')
<div x-data="productsPage({{ json_encode($products) }})" class="space-y-6">

    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-8">
        <div>
            <h3 class="text-3xl font-black text-gray-900 tracking-tighter">Produk & Harga</h3>
            <p class="text-xs font-bold text-gray-400 uppercase tracking-widest mt-1" x-text="products.length + ' Produk Terdaftar'"></p>
        </div>
        <button @click="openAdd()" class="flex items-center gap-2 px-6 py-3.5 bg-black text-white text-sm font-black rounded-2xl hover:bg-gray-800 transition-all shadow-lg shadow-black/10 hover:-translate-y-0.5">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="stroke-width:3px"><path d="M12 4v16m8-8H4"/></svg>
            Tambah Produk
        </button>
    </div>

    <div class="flex flex-col sm:flex-row gap-4 mb-6">
        <div class="relative flex-1">
            <svg class="absolute left-3.5 top-1/2 -translate-y-1/2 w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
            <input x-model="search" placeholder="Cari produk..." class="w-full pl-11 pr-4 py-3 bg-white border border-gray-200 rounded-2xl text-sm font-bold focus:ring-2 focus:ring-black outline-none shadow-sm placeholder:text-gray-400 placeholder:font-medium">
        </div>
    </div>

    <div class="bg-white border border-gray-200 rounded-[2.5rem] shadow-sm overflow-hidden mb-12">
        <div class="overflow-x-auto no-scrollbar">
            <table class="w-full text-left border-collapse min-w-[650px]">
                <thead class="bg-gray-50/50 border-b border-gray-100">
                    <tr>
                        <th class="pl-10 pr-4 py-5 text-[10px] font-black uppercase tracking-[0.3em] text-gray-400">Produk</th>
                        <th class="px-6 py-5 text-[10px] font-black uppercase tracking-[0.3em] text-gray-400">Kategori</th>
                        <th class="px-6 py-5 text-[10px] font-black uppercase tracking-[0.3em] text-gray-400">Harga</th>
                        <th class="px-6 py-5 text-[10px] font-black uppercase tracking-[0.3em] text-gray-400">Harga Promo</th>
                        <th class="pl-4 pr-10 py-5 text-[10px] font-black uppercase tracking-[0.3em] text-gray-400 text-right">Aksi</th>
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
                            <td class="px-6 py-4">
                                <template x-if="product.promo_price">
                                    <span class="px-2.5 py-1 text-[10px] font-black bg-red-50 text-red-600 border border-red-100 rounded-xl" x-text="'Rp ' + Number(product.promo_price).toLocaleString('id-ID')"></span>
                                </template>
                                <template x-if="!product.promo_price">
                                    <span class="text-gray-300 text-xs font-bold">—</span>
                                </template>
                            </td>
                            <td class="px-6 py-4 text-right">
                                <div class="flex items-center justify-end gap-2">
                                    <button @click="openEdit(product)" class="px-3 py-1.5 text-xs font-bold text-black bg-gray-100 hover:bg-black hover:text-white rounded-lg transition-all">Edit</button>
                                    <button @click="openDelete(product)" class="px-3 py-1.5 text-xs font-bold text-red-600 bg-red-50 hover:bg-red-600 hover:text-white rounded-lg transition-all">Hapus</button>
                                </div>
                            </td>
                        </tr>
                    </template>
                    <template x-if="filteredProducts.length === 0">
                        <tr><td colspan="5" class="py-10 text-center text-gray-400 text-sm font-medium">Tidak ada produk ditemukan.</td></tr>
                    </template>
                </tbody>
            </table>
        </div>
    </div>

    {{-- ADD MODAL --}}
    <div x-show="showAdd" x-cloak @click.self="showAdd=false" class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/60 backdrop-blur-sm" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100">
        <div class="bg-white w-full max-w-md rounded-2xl shadow-2xl p-6" @click.stop x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100">
            <h3 class="text-lg font-black mb-5">Tambah Produk Baru</h3>
            <form method="POST" action="{{ route('owner.products.store') }}" enctype="multipart/form-data" class="space-y-4">
                @csrf
                <div>
                    <label class="block text-[10px] font-black text-gray-400 uppercase tracking-widest mb-1.5">Nama Produk *</label>
                    <input type="text" name="name" required class="w-full px-4 py-2.5 border border-gray-200 rounded-xl text-sm font-semibold focus:ring-2 focus:ring-black outline-none">
                </div>
                <div>
                    <label class="block text-[10px] font-black text-gray-400 uppercase tracking-widest mb-1.5">Kategori *</label>
                    <select name="category_id" required class="w-full px-4 py-2.5 border border-gray-200 rounded-xl text-sm font-semibold focus:ring-2 focus:ring-black outline-none bg-white">
                        @foreach($categories as $cat)
                            <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block text-[10px] font-black text-gray-400 uppercase tracking-widest mb-1.5">Harga (Rp) *</label>
                    <input type="number" name="price" min="0" required class="w-full px-4 py-2.5 border border-gray-200 rounded-xl text-sm font-semibold focus:ring-2 focus:ring-black outline-none">
                </div>
                <div>
                    <label class="block text-[10px] font-black text-gray-400 uppercase tracking-widest mb-1.5">Deskripsi</label>
                    <textarea name="description" rows="2" class="w-full px-4 py-2.5 border border-gray-200 rounded-xl text-sm font-semibold focus:ring-2 focus:ring-black outline-none resize-none"></textarea>
                </div>
                <div>
                    <label class="block text-[10px] font-black text-gray-400 uppercase tracking-widest mb-1.5">Foto Produk</label>
                    <input type="file" name="image" accept="image/*" class="w-full text-sm">
                </div>
                <div class="flex items-center gap-2">
                    <input type="checkbox" name="is_available" id="add_avail" value="1" checked class="rounded">
                    <label for="add_avail" class="text-sm font-bold text-gray-700">Produk tersedia</label>
                </div>
                <div class="flex gap-2 pt-2">
                    <button type="button" @click="showAdd=false" class="flex-1 py-2.5 text-sm font-bold text-gray-700 bg-gray-100 rounded-xl hover:bg-gray-200">Batal</button>
                    <button type="submit" class="flex-1 py-2.5 text-sm font-bold text-white bg-black rounded-xl hover:bg-gray-800">Simpan</button>
                </div>
            </form>
        </div>
    </div>

    {{-- EDIT MODAL --}}
    <div x-show="showEdit" x-cloak @click.self="showEdit=false" class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/60 backdrop-blur-sm" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100">
        <div class="bg-white w-full max-w-md rounded-2xl shadow-2xl p-6" @click.stop x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100">
            <h3 class="text-lg font-black mb-5">Edit Produk</h3>
            <form method="POST" :action="'/owner/products/' + selected?.id" enctype="multipart/form-data" class="space-y-4">
                @csrf @method('PUT')
                <div>
                    <label class="block text-[10px] font-black text-gray-400 uppercase tracking-widest mb-1.5">Nama Produk *</label>
                    <input type="text" name="name" :value="selected?.name" required class="w-full px-4 py-2.5 border border-gray-200 rounded-xl text-sm font-semibold focus:ring-2 focus:ring-black outline-none">
                </div>
                <div>
                    <label class="block text-[10px] font-black text-gray-400 uppercase tracking-widest mb-1.5">Kategori *</label>
                    <select name="category_id" required class="w-full px-4 py-2.5 border border-gray-200 rounded-xl text-sm font-semibold focus:ring-2 focus:ring-black outline-none bg-white">
                        @foreach($categories as $cat)
                            <option value="{{ $cat->id }}" x-bind:selected="selected?.category_id == {{ $cat->id }}">{{ $cat->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block text-[10px] font-black text-gray-400 uppercase tracking-widest mb-1.5">Harga (Rp) *</label>
                    <input type="number" name="price" :value="selected?.price" min="0" required class="w-full px-4 py-2.5 border border-gray-200 rounded-xl text-sm font-semibold focus:ring-2 focus:ring-black outline-none">
                </div>
                <div>
                    <label class="block text-[10px] font-black text-gray-400 uppercase tracking-widest mb-1.5">Deskripsi</label>
                    <textarea name="description" rows="2" class="w-full px-4 py-2.5 border border-gray-200 rounded-xl text-sm font-semibold focus:ring-2 focus:ring-black outline-none resize-none" x-text="selected?.description"></textarea>
                </div>
                <div>
                    <label class="block text-[10px] font-black text-gray-400 uppercase tracking-widest mb-1.5">Foto Baru (opsional)</label>
                    <input type="file" name="image" accept="image/*" class="w-full text-sm">
                </div>
                <div class="flex items-center gap-2">
                    <input type="checkbox" name="is_available" id="edit_avail" value="1" :checked="selected?.is_available" class="rounded">
                    <label for="edit_avail" class="text-sm font-bold text-gray-700">Produk tersedia</label>
                </div>
                <div class="flex gap-2 pt-2">
                    <button type="button" @click="showEdit=false" class="flex-1 py-2.5 text-sm font-bold text-gray-700 bg-gray-100 rounded-xl hover:bg-gray-200">Batal</button>
                    <button type="submit" class="flex-1 py-2.5 text-sm font-bold text-white bg-black rounded-xl hover:bg-gray-800">Update</button>
                </div>
            </form>
        </div>
    </div>

    {{-- DELETE MODAL --}}
    <div x-show="showDelete" x-cloak @click.self="showDelete=false" class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/60 backdrop-blur-sm" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100">
        <div class="bg-white w-full max-w-sm rounded-2xl shadow-2xl p-6" @click.stop>
            <div class="w-12 h-12 bg-red-50 rounded-2xl flex items-center justify-center mb-4">
                <svg class="w-6 h-6 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
            </div>
            <h3 class="text-lg font-black mb-1">Hapus Produk?</h3>
            <p class="text-sm text-gray-500 mb-5">"<span class="font-bold text-black" x-text="selected?.name"></span>" akan dihapus permanen.</p>
            <form method="POST" :action="'/owner/products/' + selected?.id">
                @csrf @method('DELETE')
                <div class="flex gap-2">
                    <button type="button" @click="showDelete=false" class="flex-1 py-2.5 text-sm font-bold text-gray-700 bg-gray-100 rounded-xl hover:bg-gray-200">Batal</button>
                    <button type="submit" class="flex-1 py-2.5 text-sm font-bold text-white bg-red-500 rounded-xl hover:bg-red-600">Ya, Hapus</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
function productsPage(data) {
    return {
        products: data, search: '', showAdd: false, showEdit: false, showDelete: false, selected: null,
        get filteredProducts() {
            if (!this.search) return this.products;
            return this.products.filter(p => p.name.toLowerCase().includes(this.search.toLowerCase()));
        },
        openAdd() { this.selected = null; this.showAdd = true; },
        openEdit(p) { this.selected = {...p}; this.showEdit = true; },
        openDelete(p) { this.selected = p; this.showDelete = true; },
    }
}
</script>
@endsection
