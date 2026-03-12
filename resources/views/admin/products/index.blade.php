@extends('layouts.admin')
@section('title', 'Produk')

@section('content')
<div x-data="productPage({{ json_encode($products) }}, {{ json_encode($categories) }})" class="space-y-6">

    {{-- Header Content --}}
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
        <div>
            <p class="text-slate-500 text-sm font-medium">Manajemen data produk menu restoran.</p>
        </div>
        <button @click="openAddModal()"
            class="inline-flex items-center justify-center gap-2 px-4 py-2 bg-slate-900 text-white text-sm font-medium rounded-lg hover:bg-slate-800 transition-colors shadow-sm focus:ring-2 focus:ring-offset-2 focus:ring-slate-900">
            <svg class="w-4.5 h-4.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
            Tambah Produk
        </button>
    </div>

    {{-- Filters & Search --}}
    <div class="flex flex-col gap-4">
        {{-- Search & Per Page & Category --}}
        <div class="flex flex-col md:flex-row items-stretch md:items-center gap-4 justify-between">
            
            <div class="relative flex-1 max-w-sm">
                <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-4.5 h-4.5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                <input type="text" x-model="search" placeholder="Cari nama produk..."
                    class="w-full pl-9 pr-4 py-2 bg-white border border-slate-300 rounded-lg text-sm focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 outline-none transition-shadow placeholder:text-slate-400">
            </div>

            <div class="flex flex-wrap items-center gap-4">
                {{-- Per Page --}}
                <div class="flex items-center gap-2 text-sm text-slate-600">
                    <span>Tampilkan</span>
                    <select x-model="perPage" @change="currentPage = 1" class="border border-slate-300 rounded-lg py-1.5 pl-3 pr-8 text-sm focus:ring-indigo-500 focus:border-indigo-500 outline-none cursor-pointer bg-white">
                        <option value="5">5</option>
                        <option value="10" selected>10</option>
                        <option value="25">25</option>
                    </select>
                    <span>baris</span>
                </div>

                {{-- Category Dropdown --}}
                <div class="relative" x-data="{ openCat: false }" @click.outside="openCat = false">
                    <button @click="openCat = !openCat" type="button"
                        class="inline-flex items-center justify-between min-w-[150px] px-4 py-2 text-sm font-medium text-slate-700 bg-white border border-slate-300 rounded-lg shadow-sm hover:bg-slate-50 focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 transition-colors">
                        <span x-text="filterCategory === '' ? 'Semua Menu' : categories.find(c => c.id == filterCategory)?.name || 'Kategori'"></span>
                        <svg class="w-4 h-4 ml-2 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                    </button>

                    <!-- Dropdown menu -->
                    <div x-show="openCat" x-cloak
                        x-transition:enter="transition ease-out duration-100" x-transition:enter-start="transform opacity-0 scale-95" x-transition:enter-end="transform opacity-100 scale-100" 
                        x-transition:leave="transition ease-in duration-75" x-transition:leave-start="transform opacity-100 scale-100" x-transition:leave-end="transform opacity-0 scale-95"
                        class="absolute right-0 z-10 w-48 mt-2 origin-top-right bg-white border border-slate-200 rounded-xl shadow-lg focus:outline-none overflow-hidden py-1">
                        <button @click="filterCategory = ''; currentPage = 1; openCat = false" 
                            :class="filterCategory === '' ? 'bg-slate-50 text-indigo-600 font-semibold' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900'"
                            class="block w-full text-left px-4 py-2.5 text-sm transition-colors">
                            Semua Menu
                        </button>
                        <template x-for="cat in categories" :key="cat.id">
                            <button @click="filterCategory = cat.id; currentPage = 1; openCat = false" 
                                :class="filterCategory == cat.id ? 'bg-slate-50 text-indigo-600 font-semibold' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900'"
                                class="block w-full text-left px-4 py-2.5 text-sm transition-colors" x-text="cat.name">
                            </button>
                        </template>
                    </div>
                </div>
            </div>
        </div>
    </div>


    {{-- Table Card --}}
    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden flex flex-col">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse min-w-[800px]">
                <thead>
                    <tr class="bg-slate-50 border-b border-slate-200">
                        <th class="pl-6 pr-4 py-3 text-xs font-semibold uppercase tracking-wider text-slate-500">Produk</th>
                        <th class="px-6 py-3 text-xs font-semibold uppercase tracking-wider text-slate-500">Kategori</th>
                        <th class="px-6 py-3 text-xs font-semibold uppercase tracking-wider text-slate-500">Harga</th>
                        <th class="px-6 py-3 text-xs font-semibold uppercase tracking-wider text-slate-500">Status</th>
                        <th class="pl-4 pr-6 py-3 text-xs font-semibold uppercase tracking-wider text-slate-500 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    <template x-for="product in paginatedProducts" :key="product.id">
                        <tr class="hover:bg-slate-50/70 transition-colors">
                            <td class="pl-6 pr-4 py-4">
                                <div class="flex items-center gap-4">
                                    <div class="w-12 h-12 rounded-lg bg-slate-100 overflow-hidden flex-shrink-0 border border-slate-200">
                                        <template x-if="product.image">
                                            <img :src="'/storage/' + product.image" class="w-full h-full object-cover">
                                        </template>
                                        <template x-if="!product.image">
                                            <div class="w-full h-full flex items-center justify-center text-slate-400">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                            </div>
                                        </template>
                                    </div>
                                    <div>
                                        <p class="font-semibold text-slate-900 text-sm" x-text="product.name"></p>
                                        <p class="text-slate-500 text-xs truncate max-w-[200px]" x-text="product.description || '-'"></p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <span class="inline-flex items-center px-2.5 py-1 rounded-md text-xs font-medium bg-slate-100 text-slate-700 font-mono" x-text="product.category?.name ?? '-'"></span>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex flex-col">
                                    <span class="font-mono font-medium text-slate-900 text-sm" x-text="'Rp ' + new Intl.NumberFormat('id-ID').format(product.promo_price || product.price)"></span>
                                    <template x-if="product.promo_price">
                                        <span class="text-xs text-slate-400 line-through font-mono mt-0.5" x-text="'Rp ' + new Intl.NumberFormat('id-ID').format(product.price)"></span>
                                    </template>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <form :action="'/admin/products/' + product.id + '/toggle'" method="POST" class="inline">
                                    @csrf @method('PATCH')
                                    <button type="submit"
                                        :class="product.is_available ? 'bg-emerald-50 text-emerald-700 ring-emerald-600/20' : 'bg-rose-50 text-rose-700 ring-rose-600/20'"
                                        class="inline-flex items-center rounded-md px-2 py-1 text-xs font-medium ring-1 ring-inset transition-colors"
                                        x-text="product.is_available ? 'Tersedia' : 'Kosong'"></button>
                                </form>
                            </td>
                            <td class="pl-4 pr-6 py-4 text-right">
                                <div class="flex items-center justify-end gap-2 text-sm">
                                    <button @click="openEditModal(product)" class="font-medium text-indigo-600 hover:text-indigo-900 transition-colors">Edit</button>
                                    <span class="text-slate-300">|</span>
                                    <button @click="openDeleteModal(product)" class="font-medium text-rose-600 hover:text-rose-900 transition-colors">Hapus</button>
                                </div>
                            </td>
                        </tr>
                    </template>
                    <template x-if="filteredProducts.length === 0">
                        <tr><td colspan="5" class="px-6 py-12 text-center text-slate-500 text-sm">Tidak ada produk yang sesuai.</td></tr>
                    </template>
                </tbody>
            </table>
        </div>

        {{-- Pagination Footer --}}
        <div class="px-6 py-4 border-t border-slate-200 bg-white flex items-center justify-between">
            <p class="text-sm text-slate-600">
                Menampilkan <span class="font-medium" x-text="paginatedProducts.length"></span> dari <span class="font-medium" x-text="filteredProducts.length"></span> hasil
            </p>
            <div class="flex items-center gap-1" x-show="totalPages > 1">
                <button @click="prevPage" :disabled="currentPage===1" class="p-2 rounded-lg border border-slate-200 hover:bg-slate-50 text-slate-600 disabled:opacity-50 disabled:cursor-not-allowed transition-colors">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
                </button>
                <div class="px-4 text-sm font-medium text-slate-700">
                    <span x-text="currentPage"></span> / <span x-text="totalPages"></span>
                </div>
                <button @click="nextPage" :disabled="currentPage===totalPages" class="p-2 rounded-lg border border-slate-200 hover:bg-slate-50 text-slate-600 disabled:opacity-50 disabled:cursor-not-allowed transition-colors">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                </button>
            </div>
        </div>
    </div>


    {{-- ═══ ADD MODAL ═══ --}}
    <div x-show="showAdd" x-cloak @click.self="showAdd = false"
         class="fixed inset-0 z-[100] flex items-center justify-center p-4 bg-slate-900/50 backdrop-blur-sm overflow-y-auto"
         x-transition:enter="ease-out duration-200" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100">
        <div class="bg-white w-full max-w-lg rounded-xl shadow-2xl overflow-hidden my-auto" @click.stop
             x-transition:enter="ease-out duration-200" x-transition:enter-start="opacity-0 translate-y-4" x-transition:enter-end="opacity-100 translate-y-0">
            <div class="px-6 py-4 border-b border-slate-100 flex justify-between items-center bg-slate-50/50">
                <h3 class="text-lg font-semibold text-slate-900">Tambah Produk</h3>
                <button @click="showAdd = false" class="text-slate-400 hover:text-slate-500"><svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg></button>
            </div>
            <form method="POST" action="{{ route('admin.products.store') }}" enctype="multipart/form-data" class="p-6 space-y-5">
                @csrf
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                    <div class="sm:col-span-2">
                        <label class="block text-sm font-medium text-slate-700 mb-1.5">Nama Produk <span class="text-rose-500">*</span></label>
                        <input type="text" name="name" required class="w-full px-3.5 py-2.5 bg-white border border-slate-300 rounded-lg text-sm focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 outline-none transition-shadow">
                    </div>
                    <div class="sm:col-span-2">
                        <label class="block text-sm font-medium text-slate-700 mb-1.5">Kategori <span class="text-rose-500">*</span></label>
                        <select name="category_id" required class="w-full px-3.5 py-2.5 bg-white border border-slate-300 rounded-lg text-sm focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 outline-none transition-shadow">
                            <option value="">Pilih Kategori</option>
                            @foreach($categories as $cat)
                                <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1.5">Harga Normal <span class="text-rose-500">*</span></label>
                        <div class="relative">
                            <span class="absolute left-3 top-1/2 -translate-y-1/2 text-slate-500 text-sm">Rp</span>
                            <input type="number" name="price" min="0" required class="w-full pl-9 pr-3.5 py-2.5 bg-white border border-slate-300 rounded-lg text-sm focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 outline-none transition-shadow font-mono">
                        </div>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1.5">Harga Promo</label>
                        <div class="relative">
                            <span class="absolute left-3 top-1/2 -translate-y-1/2 text-slate-500 text-sm">Rp</span>
                            <input type="number" name="promo_price" min="0" class="w-full pl-9 pr-3.5 py-2.5 bg-white border border-slate-300 rounded-lg text-sm focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 outline-none transition-shadow font-mono">
                        </div>
                    </div>
                    <div class="sm:col-span-2">
                        <label class="block text-sm font-medium text-slate-700 mb-1.5">Foto Produk</label>
                        <input type="file" name="image" accept="image/*" class="w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-600 hover:file:bg-indigo-100 transition-colors border border-slate-200 rounded-lg p-1.5 cursor-pointer">
                    </div>
                    <div class="sm:col-span-2">
                        <label class="block text-sm font-medium text-slate-700 mb-1.5">Deskripsi</label>
                        <textarea name="description" rows="3" class="w-full px-3.5 py-2.5 bg-white border border-slate-300 rounded-lg text-sm focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 outline-none transition-shadow resize-none"></textarea>
                    </div>
                    <div class="sm:col-span-2 flex items-center gap-2 pt-1">
                        <input type="checkbox" name="is_available" id="add_avail" checked class="w-4 h-4 rounded border-slate-300 text-indigo-600 focus:ring-indigo-600">
                        <label for="add_avail" class="text-sm font-medium text-slate-700">Tandai produk sebagai tersedia</label>
                    </div>
                </div>
                <div class="flex gap-3 justify-end pt-4 border-t border-slate-100 mt-6">
                    <button type="button" @click="showAdd = false" class="px-4 py-2 text-sm font-medium text-slate-700 bg-white border border-slate-300 rounded-lg hover:bg-slate-50 transition-colors">Batal</button>
                    <button type="submit" class="px-4 py-2 text-sm font-medium text-white bg-indigo-600 rounded-lg hover:bg-indigo-700 transition-colors shadow-sm">Simpan Produk</button>
                </div>
            </form>
        </div>
    </div>


    {{-- ═══ EDIT MODAL ═══ --}}
    <div x-show="showEdit" x-cloak @click.self="showEdit = false"
         class="fixed inset-0 z-[100] flex items-center justify-center p-4 bg-slate-900/50 backdrop-blur-sm overflow-y-auto"
         x-transition:enter="ease-out duration-200" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100">
        <div class="bg-white w-full max-w-lg rounded-xl shadow-2xl overflow-hidden my-auto" @click.stop
             x-transition:enter="ease-out duration-200" x-transition:enter-start="opacity-0 translate-y-4" x-transition:enter-end="opacity-100 translate-y-0">
            <div class="px-6 py-4 border-b border-slate-100 flex justify-between items-center bg-slate-50/50">
                <h3 class="text-lg font-semibold text-slate-900">Edit Produk</h3>
                <button @click="showEdit = false" class="text-slate-400 hover:text-slate-500"><svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg></button>
            </div>
            <form method="POST" :action="'/admin/products/' + selected?.id" enctype="multipart/form-data" class="p-6 space-y-5">
                @csrf @method('PUT')
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                    <div class="sm:col-span-2">
                        <label class="block text-sm font-medium text-slate-700 mb-1.5">Nama Produk <span class="text-rose-500">*</span></label>
                        <input type="text" name="name" :value="selected?.name" required class="w-full px-3.5 py-2.5 bg-white border border-slate-300 rounded-lg text-sm focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 outline-none transition-shadow">
                    </div>
                    <div class="sm:col-span-2">
                        <label class="block text-sm font-medium text-slate-700 mb-1.5">Kategori <span class="text-rose-500">*</span></label>
                        <select name="category_id" required class="w-full px-3.5 py-2.5 bg-white border border-slate-300 rounded-lg text-sm focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 outline-none transition-shadow">
                            @foreach($categories as $cat)
                                <option value="{{ $cat->id }}" x-bind:selected="selected?.category_id == {{ $cat->id }}">{{ $cat->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1.5">Harga Normal <span class="text-rose-500">*</span></label>
                        <div class="relative">
                            <span class="absolute left-3 top-1/2 -translate-y-1/2 text-slate-500 text-sm">Rp</span>
                            <input type="number" name="price" min="0" :value="selected?.price" required class="w-full pl-9 pr-3.5 py-2.5 bg-white border border-slate-300 rounded-lg text-sm focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 outline-none transition-shadow font-mono">
                        </div>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1.5">Harga Promo</label>
                        <div class="relative">
                            <span class="absolute left-3 top-1/2 -translate-y-1/2 text-slate-500 text-sm">Rp</span>
                            <input type="number" name="promo_price" min="0" :value="selected?.promo_price" class="w-full pl-9 pr-3.5 py-2.5 bg-white border border-slate-300 rounded-lg text-sm focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 outline-none transition-shadow font-mono">
                        </div>
                    </div>
                    <div class="sm:col-span-2">
                        <label class="block text-sm font-medium text-slate-700 mb-1.5">Foto Baru (Opsional)</label>
                        <input type="file" name="image" accept="image/*" class="w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-600 hover:file:bg-indigo-100 transition-colors border border-slate-200 rounded-lg p-1.5 cursor-pointer">
                        <template x-if="selected?.image">
                            <p class="text-xs text-slate-500 mt-2 flex items-center gap-1">
                                <svg class="w-4 h-4 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                Produk ini sudah memiliki foto. Upload untuk mengganti.
                            </p>
                        </template>
                    </div>
                    <div class="sm:col-span-2">
                        <label class="block text-sm font-medium text-slate-700 mb-1.5">Deskripsi</label>
                        <textarea name="description" rows="3" x-text="selected?.description" class="w-full px-3.5 py-2.5 bg-white border border-slate-300 rounded-lg text-sm focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 outline-none transition-shadow resize-none"></textarea>
                    </div>
                    <div class="sm:col-span-2 flex items-center gap-2 pt-1">
                        <input type="checkbox" name="is_available" id="edit_avail" :checked="selected?.is_available" class="w-4 h-4 rounded border-slate-300 text-indigo-600 focus:ring-indigo-600">
                        <label for="edit_avail" class="text-sm font-medium text-slate-700">Tandai produk sebagai tersedia</label>
                    </div>
                </div>
                <div class="flex gap-3 justify-end pt-4 border-t border-slate-100 mt-6">
                    <button type="button" @click="showEdit = false" class="px-4 py-2 text-sm font-medium text-slate-700 bg-white border border-slate-300 rounded-lg hover:bg-slate-50 transition-colors">Batal</button>
                    <button type="submit" class="px-4 py-2 text-sm font-medium text-white bg-indigo-600 rounded-lg hover:bg-indigo-700 transition-colors shadow-sm">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>

    {{-- ═══ DELETE MODAL ═══ --}}
    <div x-show="showDelete" x-cloak @click.self="showDelete = false"
         class="fixed inset-0 z-[100] flex items-center justify-center p-4 bg-slate-900/50 backdrop-blur-sm"
         x-transition:enter="ease-out duration-200" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100">
        <div class="bg-white w-full max-w-sm rounded-xl shadow-2xl p-6 text-center" @click.stop
             x-transition:enter="ease-out duration-200" x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100">
            <div class="w-12 h-12 rounded-full bg-rose-100 flex items-center justify-center mx-auto mb-4">
                <svg class="w-6 h-6 text-rose-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
            </div>
            <h3 class="text-lg font-semibold text-slate-900 mb-2">Hapus Produk?</h3>
            <p class="text-sm text-slate-500 mb-6">Anda yakin ingin menghapus produk "<span class="font-semibold text-slate-700" x-text="selected?.name"></span>"? Ini juga akan menghapus foto terkait. Tindakan ini tidak dapat dibatalkan.</p>
            <form method="POST" :action="'/admin/products/' + selected?.id" class="flex gap-3 w-full">
                @csrf @method('DELETE')
                <button type="button" @click="showDelete = false" class="flex-1 px-4 py-2.5 text-sm font-medium text-slate-700 bg-white border border-slate-300 rounded-lg hover:bg-slate-50 transition-colors">Batal</button>
                <button type="submit" class="flex-1 px-4 py-2.5 text-sm font-medium text-white bg-rose-600 rounded-lg hover:bg-rose-700 transition-colors shadow-sm">Hapus</button>
            </form>
        </div>
    </div>

</div>

<script>
function productPage(initialProducts, initialCategories) {
    return {
        all: initialProducts,
        categories: initialCategories,
        search: '',
        filterCategory: '',
        perPage: 10,
        currentPage: 1,
        showAdd: false,
        showEdit: false,
        showDelete: false,
        selected: null,

        get filteredProducts() {
            let data = this.all;
            if (this.filterCategory !== '') data = data.filter(p => p.category_id == this.filterCategory);
            if (this.search.trim()) {
                const q = this.search.toLowerCase();
                data = data.filter(p => p.name.toLowerCase().includes(q) || (p.description || '').toLowerCase().includes(q));
            }
            return data;
        },
        get totalPages() { return Math.max(1, Math.ceil(this.filteredProducts.length / parseInt(this.perPage))); },
        get paginatedProducts() {
            const start = (this.currentPage - 1) * parseInt(this.perPage);
            return this.filteredProducts.slice(start, start + parseInt(this.perPage));
        },
        nextPage() { if (this.currentPage < this.totalPages) this.currentPage++; },
        prevPage() { if (this.currentPage > 1) this.currentPage--; },
        openAddModal() { this.selected = null; this.showAdd = true; },
        openEditModal(p) { this.selected = {...p}; this.showEdit = true; },
        openDeleteModal(p) { this.selected = p; this.showDelete = true; },
        init() {
            this.$watch('search', () => this.currentPage = 1);
            this.$watch('filterCategory', () => this.currentPage = 1);
            this.$watch('perPage', () => this.currentPage = 1);
        }
    }
}
</script>
@endsection
