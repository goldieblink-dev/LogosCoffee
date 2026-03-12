@extends('layouts.admin')
@section('title', 'Pesanan')

@section('content')
<div x-data="ordersPage({{ json_encode($orders) }})" class="space-y-6">

    {{-- Header --}}
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-8">
        <div>
            <h3 class="text-3xl font-black text-gray-900 tracking-tighter">Pesanan</h3>
            <p class="text-xs font-bold text-gray-400 uppercase tracking-widest mt-1" x-text="filteredOrders.length + ' Pesanan Ditemukan'"></p>
        </div>
    </div>

    {{-- Controls --}}
    <div class="flex flex-col md:flex-row items-stretch md:items-center gap-4 mb-6">
        {{-- Search --}}
        <div class="relative flex-1">
            <svg class="absolute left-3.5 top-1/2 -translate-y-1/2 w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
            <input type="text" x-model="search" placeholder="Cari nama pelanggan atau no. meja..."
                class="w-full pl-11 pr-4 py-3 bg-white border border-gray-200 rounded-2xl text-sm focus:ring-2 focus:ring-black focus:border-transparent outline-none font-bold placeholder:text-gray-400 placeholder:font-medium transition-all shadow-sm">
        </div>

        {{-- Status Filter Pills --}}
        <div class="flex flex-wrap items-center gap-2">
            <template x-for="s in [
                {value:'', label:'Semua'},
                {value:'paid', label:'Belum Dibuat'},
                {value:'processing', label:'Sedang Dibuat'},
                {value:'completed', label:'Sudah Dibuat'}
            ]" :key="s.value">
                <button @click="filterStatus = s.value; currentPage = 1"
                    :class="filterStatus === s.value ? 'bg-black text-white shadow-lg shadow-black/10' : 'bg-white text-gray-500 border border-gray-200 hover:bg-gray-50'"
                    class="px-3.5 py-2 text-xs font-bold rounded-xl transition-all whitespace-nowrap"
                    x-text="s.label"></button>
            </template>
        </div>

        {{-- Per Page --}}
        <div class="flex items-center gap-2 bg-white border border-gray-200 rounded-2xl px-4 py-2.5 shadow-sm shrink-0 self-end md:self-auto">
            <span class="text-[10px] font-black text-gray-400 uppercase tracking-widest">Baris</span>
            <select x-model="perPage" @change="currentPage = 1" class="border-none bg-transparent text-sm font-black focus:ring-0 outline-none cursor-pointer p-0 pr-1">
                <option value="10">10</option>
                <option value="25">25</option>
                <option value="50">50</option>
            </select>
        </div>
    </div>

    {{-- Table --}}
    <div class="w-full bg-white border border-gray-200 rounded-[2.5rem] shadow-sm overflow-hidden mb-12">
        <div class="overflow-x-auto no-scrollbar touch-pan-x">
            <table class="w-full text-left border-collapse min-w-[700px]">
                <thead class="bg-gray-50/50 border-b border-gray-100">
                    <tr>
                        <th class="pl-10 pr-4 py-6 text-[10px] font-black uppercase tracking-[0.3em] text-gray-400">No. Meja</th>
                        <th class="px-6 py-6 text-[10px] font-black uppercase tracking-[0.3em] text-gray-400">Pelanggan</th>
                        <th class="px-6 py-6 text-[10px] font-black uppercase tracking-[0.3em] text-gray-400">Total</th>
                        <th class="px-6 py-6 text-[10px] font-black uppercase tracking-[0.3em] text-gray-400">Status</th>
                        <th class="px-6 py-6 text-[10px] font-black uppercase tracking-[0.3em] text-gray-400">Waktu</th>
                        <th class="pl-4 pr-10 py-6 text-[10px] font-black uppercase tracking-[0.3em] text-gray-400 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    <template x-for="order in paginatedOrders" :key="order.id">
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="px-6 py-4">
                                <div class="w-10 h-10 rounded-xl bg-black flex items-center justify-center text-white text-sm font-black" x-text="order.table_number"></div>
                            </td>
                            <td class="px-6 py-4">
                                <p class="font-bold text-gray-900 text-sm" x-text="order.customer_name || 'Tanpa Nama'"></p>
                                <p class="text-xs text-gray-400 font-medium" x-text="order.customer_phone || '-'"></p>
                            </td>
                            <td class="px-6 py-4">
                                <p class="font-black text-gray-900 text-sm" x-text="'Rp ' + Number(order.total_amount).toLocaleString('id-ID')"></p>
                            </td>
                            <td class="px-6 py-4">
                                <span class="px-2.5 py-1 text-[10px] font-black uppercase rounded-lg tracking-wider"
                                    :class="{
                                        'bg-blue-50 text-blue-700 border border-blue-100': order.status === 'paid',
                                        'bg-purple-50 text-purple-700 border border-purple-100': order.status === 'processing',
                                        'bg-emerald-50 text-emerald-700 border border-emerald-100': order.status === 'completed',
                                    }"
                                    x-text="{
                                        paid: 'Belum Dibuat',
                                        processing: 'Sedang Dibuat',
                                        completed: 'Sudah Dibuat',
                                    }[order.status] || order.status"></span>
                            </td>
                            <td class="px-6 py-4 text-xs text-gray-500 font-medium" x-text="formatDate(order.created_at)"></td>
                            <td class="px-6 py-4 text-right">
                                <div class="flex items-center justify-end gap-2">
                                    <button @click="openDetailModal(order)" class="px-3 py-1.5 text-xs font-bold text-black bg-gray-100 hover:bg-black hover:text-white rounded-lg transition-all">Detail</button>
                                    <button @click="openDeleteModal(order)" class="px-3 py-1.5 text-xs font-bold text-red-600 bg-red-50 hover:bg-red-600 hover:text-white rounded-lg transition-all">Hapus</button>
                                </div>
                            </td>
                        </tr>
                    </template>
                    <template x-if="filteredOrders.length === 0">
                        <tr>
                            <td colspan="6" class="px-6 py-16 text-center">
                                <div class="flex flex-col items-center gap-3">
                                    <div class="w-14 h-14 bg-gray-50 rounded-2xl flex items-center justify-center">
                                        <svg class="w-7 h-7 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
                                    </div>
                                    <p class="text-sm font-bold text-gray-400">Tidak ada pesanan ditemukan.</p>
                                </div>
                            </td>
                        </tr>
                    </template>
                </tbody>
            </table>
        </div>

        {{-- Pagination --}}
        <div class="flex items-center justify-between px-8 py-4 border-t border-gray-100" x-show="totalPages > 1">
            <span class="text-xs font-bold text-gray-500">Halaman <span class="text-black" x-text="currentPage"></span> dari <span class="text-black" x-text="totalPages"></span></span>
            <div class="flex gap-1">
                <button @click="prevPage" :disabled="currentPage===1" class="w-9 h-9 flex items-center justify-center rounded-xl bg-white border border-gray-200 hover:bg-gray-50 disabled:opacity-40 transition-all">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
                </button>
                <button @click="nextPage" :disabled="currentPage===totalPages" class="w-9 h-9 flex items-center justify-center rounded-xl bg-white border border-gray-200 hover:bg-gray-50 disabled:opacity-40 transition-all">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                </button>
            </div>
        </div>
    </div>

    {{-- ═══ DETAIL MODAL ═══ --}}
    <div x-show="showDetail" x-cloak @click.self="showDetail = false"
         class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/60 backdrop-blur-sm"
         x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100">
        <div class="bg-white w-full max-w-lg rounded-2xl shadow-2xl overflow-hidden" @click.stop
             x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100">
            {{-- Modal Header --}}
            <div class="flex items-center justify-between px-6 py-5 border-b border-gray-100">
                <div>
                    <h3 class="font-black text-gray-900">Detail Pesanan</h3>
                    <p class="text-xs font-bold text-gray-400 mt-0.5">Meja <span x-text="selected?.table_number"></span> — <span x-text="selected?.customer_name || 'Tanpa Nama'"></span></p>
                </div>
                <button @click="showDetail = false" class="w-9 h-9 flex items-center justify-center rounded-xl bg-gray-50 hover:bg-gray-100 transition-colors">
                    <svg class="w-4.5 h-4.5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"/></svg>
                </button>
            </div>

            {{-- Items List --}}
            <div class="px-6 py-4 max-h-64 overflow-y-auto space-y-3">
                <template x-for="item in selected?.items || []" :key="item.id">
                    <div class="flex items-center justify-between gap-4">
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 bg-gray-100 rounded-xl flex items-center justify-center text-xs font-black text-gray-600" x-text="item.quantity + 'x'"></div>
                            <p class="text-sm font-bold text-gray-800" x-text="item.product?.name || 'Produk Dihapus'"></p>
                        </div>
                        <p class="text-sm font-black text-gray-900 shrink-0" x-text="'Rp ' + Number(item.price * item.quantity).toLocaleString('id-ID')"></p>
                    </div>
                </template>
            </div>

            {{-- Total & Status Update --}}
            <div class="px-6 py-4 bg-gray-50 border-t border-gray-100 space-y-4">
                <div class="flex items-center justify-between">
                    <span class="text-sm font-black text-gray-500 uppercase tracking-wider">Total</span>
                    <span class="text-xl font-black text-gray-900" x-text="'Rp ' + Number(selected?.total_amount).toLocaleString('id-ID')"></span>
                </div>
                <form method="POST" :action="'/admin/orders/' + selected?.id + '/status'" class="flex items-center gap-3">
                    @csrf @method('PATCH')
                    <select name="status" class="flex-1 px-4 py-2.5 border border-gray-200 rounded-xl text-sm font-bold focus:ring-2 focus:ring-black outline-none bg-white">
                        <template x-for="s in [
                            {value:'paid', label:'Belum Dibuat'},
                            {value:'processing', label:'Sedang Dibuat'},
                            {value:'completed', label:'Sudah Dibuat'}
                        ]" :key="s.value">
                            <option :value="s.value" :selected="selected?.status === s.value" x-text="s.label"></option>
                        </template>
                    </select>
                    <button type="submit" class="px-4 py-2.5 bg-black text-white text-sm font-black rounded-xl hover:bg-gray-800 transition-colors">Update</button>
                </form>
            </div>
        </div>
    </div>

    {{-- ═══ DELETE MODAL ═══ --}}
    <div x-show="showDelete" x-cloak @click.self="showDelete = false"
         class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/60 backdrop-blur-sm"
         x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100">
        <div class="bg-white w-full max-w-sm rounded-2xl shadow-2xl p-6" @click.stop>
            <div class="w-12 h-12 bg-red-50 rounded-2xl flex items-center justify-center mb-4">
                <svg class="w-6 h-6 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
            </div>
            <h3 class="text-lg font-black mb-1">Hapus Pesanan?</h3>
            <p class="text-sm text-gray-500 mb-5">Pesanan dari "<span class="font-bold text-black" x-text="selected?.customer_name || 'Meja ' + selected?.table_number"></span>" akan dihapus permanen.</p>
            <form method="POST" :action="'/admin/orders/' + selected?.id">
                @csrf @method('DELETE')
                <div class="flex gap-2">
                    <button type="button" @click="showDelete = false" class="flex-1 py-2.5 text-sm font-bold text-gray-700 bg-gray-100 rounded-xl hover:bg-gray-200 transition-colors">Batal</button>
                    <button type="submit" class="flex-1 py-2.5 text-sm font-bold text-white bg-red-500 rounded-xl hover:bg-red-600 transition-colors">Ya, Hapus</button>
                </div>
            </form>
        </div>
    </div>

</div>

<script>
function ordersPage(initialData) {
    return {
        all: initialData,
        search: '',
        filterStatus: '',
        perPage: 10,
        currentPage: 1,
        showDetail: false,
        showDelete: false,
        selected: null,

        get filteredOrders() {
            let data = this.all;
            if (this.filterStatus) data = data.filter(o => o.status === this.filterStatus);
            if (this.search.trim()) {
                const q = this.search.toLowerCase();
                data = data.filter(o =>
                    (o.customer_name && o.customer_name.toLowerCase().includes(q)) ||
                    String(o.table_number).includes(q)
                );
            }
            return data;
        },
        get totalPages() { return Math.max(1, Math.ceil(this.filteredOrders.length / parseInt(this.perPage))); },
        get paginatedOrders() {
            const start = (this.currentPage - 1) * parseInt(this.perPage);
            return this.filteredOrders.slice(start, start + parseInt(this.perPage));
        },
        nextPage() { if (this.currentPage < this.totalPages) this.currentPage++; },
        prevPage() { if (this.currentPage > 1) this.currentPage--; },
        openDetailModal(o) { this.selected = o; this.showDetail = true; },
        openDeleteModal(o) { this.selected = o; this.showDelete = true; },
        formatDate(dt) {
            if (!dt) return '-';
            return new Date(dt).toLocaleDateString('id-ID', { day:'2-digit', month:'short', year:'numeric', hour:'2-digit', minute:'2-digit' });
        },
        init() {
            this.$watch('search', () => this.currentPage = 1);
            this.$watch('filterStatus', () => this.currentPage = 1);
        }
    }
}
</script>
@endsection
