@extends('layouts.admin')
@section('title', 'Kategori')

@section('content')
<div x-data="categoryPage({{ json_encode($categories) }})" class="space-y-6">

    {{-- Header Content --}}
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
        <div>
            <p class="text-slate-500 text-sm font-medium">Manajemen kategori produk menu.</p>
        </div>
        <button @click="openAddModal()"
            class="inline-flex items-center justify-center gap-2 px-4 py-2 bg-slate-900 text-white text-sm font-medium rounded-lg hover:bg-slate-800 transition-colors shadow-sm focus:ring-2 focus:ring-offset-2 focus:ring-slate-900">
            <svg class="w-4.5 h-4.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
            Tambah Kategori
        </button>
    </div>

    {{-- Table Card --}}
    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden flex flex-col">
        
        {{-- Toolbar (Search & Filter) --}}
        <div class="px-6 py-4 border-b border-slate-200 bg-slate-50/50 flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div class="relative max-w-sm w-full">
                <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-4.5 h-4.5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                <input type="text" x-model="search" placeholder="Cari kategori..."
                    class="w-full pl-9 pr-4 py-2 bg-white border border-slate-300 rounded-lg text-sm focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 outline-none transition-shadow placeholder:text-slate-400">
            </div>
            <div class="flex items-center gap-2 text-sm text-slate-600">
                <span>Tampilkan</span>
                <select x-model="perPage" @change="currentPage = 1" class="border-slate-300 rounded-lg py-1.5 pl-3 pr-8 text-sm focus:ring-indigo-500 focus:border-indigo-500 outline-none cursor-pointer bg-white">
                    <option value="5">5</option>
                    <option value="10" selected>10</option>
                    <option value="25">25</option>
                </select>
                <span>baris</span>
            </div>
        </div>

        {{-- Table --}}
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse min-w-[600px]">
                <thead>
                    <tr class="bg-slate-50 border-b border-slate-200">
                        <th class="pl-6 pr-4 py-3 text-xs font-semibold uppercase tracking-wider text-slate-500">#</th>
                        <th class="px-6 py-3 text-xs font-semibold uppercase tracking-wider text-slate-500">Nama Kategori</th>
                        <th class="px-6 py-3 text-xs font-semibold uppercase tracking-wider text-slate-500">Jumlah Produk</th>
                        <th class="pl-4 pr-6 py-3 text-xs font-semibold uppercase tracking-wider text-slate-500 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    <template x-for="(cat, index) in paginatedCategories" :key="cat.id">
                        <tr class="hover:bg-slate-50/70 transition-colors">
                            <td class="pl-6 pr-4 py-4 text-sm text-slate-400 font-mono" x-text="(currentPage-1)*parseInt(perPage) + index + 1"></td>
                            <td class="px-6 py-4">
                                <span class="font-semibold text-slate-900" x-text="cat.name"></span>
                            </td>
                            <td class="px-6 py-4">
                                <span class="inline-flex items-center px-2.5 py-1 rounded-md text-xs font-medium bg-slate-100 text-slate-700 font-mono" x-text="(cat.products_count ?? 0) + ' item'"></span>
                            </td>
                            <td class="pl-4 pr-6 py-4 text-right">
                                <div class="flex items-center justify-end gap-2 text-sm">
                                    <button @click="openEditModal(cat)" class="font-medium text-indigo-600 hover:text-indigo-900 transition-colors">Edit</button>
                                    <span class="text-slate-300">|</span>
                                    <button @click="openDeleteModal(cat)" class="font-medium text-rose-600 hover:text-rose-900 transition-colors">Hapus</button>
                                </div>
                            </td>
                        </tr>
                    </template>
                    <template x-if="filteredCategories.length === 0">
                        <tr><td colspan="4" class="px-6 py-12 text-center text-slate-500 text-sm">Tidak ada kategori yang sesuai dengan pencarian Anda.</td></tr>
                    </template>
                </tbody>
            </table>
        </div>

        {{-- Pagination Footer --}}
        <div class="px-6 py-4 border-t border-slate-200 bg-white flex items-center justify-between">
            <p class="text-sm text-slate-600">
                Menampilkan <span class="font-medium" x-text="paginatedCategories.length"></span> dari <span class="font-medium" x-text="filteredCategories.length"></span> hasil
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
         class="fixed inset-0 z-[100] flex items-center justify-center p-4 bg-slate-900/50 backdrop-blur-sm"
         x-transition:enter="ease-out duration-200" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100">
        <div class="bg-white w-full max-w-md rounded-xl shadow-2xl overflow-hidden" @click.stop
             x-transition:enter="ease-out duration-200" x-transition:enter-start="opacity-0 translate-y-4" x-transition:enter-end="opacity-100 translate-y-0">
            <div class="px-6 py-4 border-b border-slate-100 flex justify-between items-center">
                <h3 class="text-lg font-semibold text-slate-900">Tambah Kategori</h3>
                <button @click="showAdd = false" class="text-slate-400 hover:text-slate-500"><svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg></button>
            </div>
            <form method="POST" action="{{ route('admin.categories.store') }}" class="p-6">
                @csrf
                <div class="mb-6">
                    <label class="block text-sm font-medium text-slate-700 mb-2">Nama Kategori <span class="text-rose-500">*</span></label>
                    <input type="text" name="name" required placeholder="Contoh: Coffee, Dessert..."
                        class="w-full px-4 py-2.5 bg-white border border-slate-300 rounded-lg text-sm focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 outline-none transition-shadow">
                </div>
                <div class="flex gap-3 justify-end">
                    <button type="button" @click="showAdd = false" class="px-4 py-2 text-sm font-medium text-slate-700 bg-white border border-slate-300 rounded-lg hover:bg-slate-50 transition-colors">Batal</button>
                    <button type="submit" class="px-4 py-2 text-sm font-medium text-white bg-indigo-600 rounded-lg hover:bg-indigo-700 transition-colors shadow-sm">Simpan</button>
                </div>
            </form>
        </div>
    </div>

    {{-- ═══ EDIT MODAL ═══ --}}
    <div x-show="showEdit" x-cloak @click.self="showEdit = false"
         class="fixed inset-0 z-[100] flex items-center justify-center p-4 bg-slate-900/50 backdrop-blur-sm"
         x-transition:enter="ease-out duration-200" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100">
        <div class="bg-white w-full max-w-md rounded-xl shadow-2xl overflow-hidden" @click.stop
             x-transition:enter="ease-out duration-200" x-transition:enter-start="opacity-0 translate-y-4" x-transition:enter-end="opacity-100 translate-y-0">
            <div class="px-6 py-4 border-b border-slate-100 flex justify-between items-center">
                <h3 class="text-lg font-semibold text-slate-900">Edit Kategori</h3>
                <button @click="showEdit = false" class="text-slate-400 hover:text-slate-500"><svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg></button>
            </div>
            <form method="POST" :action="'/admin/categories/' + selected?.id" class="p-6">
                @csrf @method('PUT')
                <div class="mb-6">
                    <label class="block text-sm font-medium text-slate-700 mb-2">Nama Kategori <span class="text-rose-500">*</span></label>
                    <input type="text" name="name" :value="selected?.name" required
                        class="w-full px-4 py-2.5 bg-white border border-slate-300 rounded-lg text-sm focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 outline-none transition-shadow">
                </div>
                <div class="flex gap-3 justify-end">
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
            <h3 class="text-lg font-semibold text-slate-900 mb-2">Hapus Kategori?</h3>
            <p class="text-sm text-slate-500 mb-6">Anda yakin ingin menghapus kategori "<span class="font-semibold text-slate-700" x-text="selected?.name"></span>"? Tindakan ini tidak dapat dibatalkan.</p>
            <form method="POST" :action="'/admin/categories/' + selected?.id" class="flex gap-3 w-full">
                @csrf @method('DELETE')
                <button type="button" @click="showDelete = false" class="flex-1 px-4 py-2.5 text-sm font-medium text-slate-700 bg-white border border-slate-300 rounded-lg hover:bg-slate-50 transition-colors">Batal</button>
                <button type="submit" class="flex-1 px-4 py-2.5 text-sm font-medium text-white bg-rose-600 rounded-lg hover:bg-rose-700 transition-colors shadow-sm">Hapus</button>
            </form>
        </div>
    </div>

</div>

<script>
function categoryPage(initialData) {
    return {
        all: initialData,
        search: '',
        perPage: 10,
        currentPage: 1,
        showAdd: false,
        showEdit: false,
        showDelete: false,
        selected: null,

        get filteredCategories() {
            const q = this.search.toLowerCase();
            let data = q ? this.all.filter(c => c.name.toLowerCase().includes(q)) : this.all;
            return data;
        },
        get totalPages() { return Math.max(1, Math.ceil(this.filteredCategories.length / parseInt(this.perPage))); },
        get paginatedCategories() {
            const start = (this.currentPage - 1) * parseInt(this.perPage);
            return this.filteredCategories.slice(start, start + parseInt(this.perPage));
        },
        nextPage() { if (this.currentPage < this.totalPages) this.currentPage++; },
        prevPage() { if (this.currentPage > 1) this.currentPage--; },
        openAddModal() { this.showAdd = true; },
        openEditModal(cat) { this.selected = cat; this.showEdit = true; },
        openDeleteModal(cat) { this.selected = cat; this.showDelete = true; },
        init() {
            this.$watch('search', () => this.currentPage = 1);
            this.$watch('perPage', () => this.currentPage = 1);
        }
    }
}
</script>
@endsection
