@extends('layouts.cashier')
@section('title', 'Pesanan Masuk')

@section('content')
<div x-data="ordersPage({{ json_encode($orders) }})" class="space-y-6">

    {{-- Header --}}
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-8">
        <div>
            <h3 class="text-3xl font-black text-gray-900 tracking-tighter">Pesanan Masuk</h3>
            <p class="text-xs font-bold text-gray-400 uppercase tracking-widest mt-1" x-text="filteredOrders.length + ' Pesanan Aktif'"></p>
        </div>
        {{-- Auto-refresh indicator --}}
        <div class="flex items-center gap-2 px-4 py-2.5 bg-white border border-gray-200 rounded-2xl shadow-sm">
            <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
            <span class="text-xs font-bold text-gray-500">Auto-refresh <span class="text-black" x-text="countdown + 's'"></span></span>
        </div>
    </div>

    {{-- Status Filter --}}
    <div class="flex flex-wrap items-center gap-2 mb-6">
        <template x-for="s in [
            {value:'', label:'Semua'},
            {value:'paid', label:'Belum Dibuat'},
            {value:'processing', label:'Sedang Dibuat'},
            {value:'completed', label:'Sudah Dibuat'}
        ]" :key="s.value">
            <button @click="filterStatus = s.value"
                :class="filterStatus === s.value ? 'bg-black text-white shadow-lg shadow-black/10' : 'bg-white text-gray-500 border border-gray-200 hover:bg-gray-50'"
                class="px-4 py-2 text-xs font-bold rounded-xl transition-all whitespace-nowrap"
                x-text="s.label"></button>
        </template>
    </div>

    {{-- Orders Grid --}}
    <div x-show="filteredOrders.length > 0" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5">
        <template x-for="order in filteredOrders" :key="order.id">
            <div class="bg-white border border-gray-200 rounded-[2rem] shadow-sm overflow-hidden hover:border-black/20 transition-all group">
                {{-- Card Header --}}
                <div class="flex justify-between items-center px-5 pt-5 pb-3">
                    <div class="flex items-center gap-3">
                        <div class="w-11 h-11 rounded-[1rem] bg-black flex items-center justify-center text-white text-base font-black" x-text="order.table_number"></div>
                        <div>
                            <p class="font-black text-gray-900 text-sm" x-text="order.customer_name || 'Tanpa Nama'"></p>
                            <p class="text-xs text-gray-400 font-medium" x-text="formatDate(order.created_at)"></p>
                        </div>
                    </div>
                    <span class="px-2.5 py-1 text-[10px] font-black uppercase rounded-xl tracking-wider"
                        :class="{
                            'bg-blue-50 text-blue-700': order.status === 'paid',
                            'bg-purple-50 text-purple-700': order.status === 'processing',
                            'bg-emerald-50 text-emerald-700': order.status === 'completed',
                        }"
                        x-text="{paid:'Belum Dibuat', processing:'Sedang Dibuat', completed:'Sudah Dibuat'}[order.status]"></span>
                </div>

                {{-- Items preview --}}
                <div class="px-5 py-3 border-t border-gray-50 space-y-1.5">
                    <template x-for="(item, i) in order.items.slice(0, 3)" :key="item.id">
                        <div class="flex justify-between text-xs">
                            <span class="font-bold text-gray-700" x-text="item.quantity + 'x ' + (item.product?.name || 'Produk Dihapus')"></span>
                            <span class="text-gray-400 font-medium" x-text="'Rp ' + Number(item.price * item.quantity).toLocaleString('id-ID')"></span>
                        </div>
                    </template>
                    <template x-if="order.items.length > 3">
                        <p class="text-[11px] text-gray-400 font-bold" x-text="'+ ' + (order.items.length - 3) + ' item lagi'"></p>
                    </template>
                </div>

                {{-- Footer --}}
                <div class="px-5 py-3 bg-gray-50/80 border-t border-gray-100 flex items-center justify-between gap-2">
                    <div>
                        <p class="text-[10px] text-gray-400 font-bold">Total</p>
                        <p class="text-sm font-black text-gray-900" x-text="'Rp ' + Number(order.total_amount).toLocaleString('id-ID')"></p>
                    </div>
                    <button @click="openDetail(order)"
                        class="px-4 py-2 text-xs font-bold text-white bg-black rounded-xl hover:bg-gray-800 transition-colors">
                        Kelola
                    </button>
                </div>
            </div>
        </template>
    </div>

    <template x-if="filteredOrders.length === 0">
        <div class="bg-white border border-gray-200 rounded-[2.5rem] p-16 text-center">
            <div class="w-16 h-16 bg-gray-50 rounded-full mx-auto flex items-center justify-center mb-4">
                <svg class="w-8 h-8 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
            </div>
            <h4 class="text-lg font-black text-gray-900 mb-1">Tidak ada pesanan aktif</h4>
            <p class="text-sm text-gray-400 font-medium">Pesanan baru yang sudah dibayar akan muncul di sini.</p>
        </div>
    </template>

    {{-- ═══ DETAIL + STATUS MODAL ═══ --}}
    <div x-show="showDetail" x-cloak @click.self="showDetail = false"
         class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/60 backdrop-blur-sm"
         x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100">
        <div class="bg-white w-full max-w-md rounded-2xl shadow-2xl overflow-hidden" @click.stop
             x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100">
            {{-- Modal Header --}}
            <div class="px-6 py-5 flex justify-between items-start border-b border-gray-100">
                <div>
                    <h3 class="font-black text-gray-900 text-lg">Detail Pesanan</h3>
                    <p class="text-xs text-gray-400 font-medium mt-0.5">Meja <span x-text="selected?.table_number"></span> — <span x-text="selected?.customer_name || 'Tanpa Nama'"></span></p>
                </div>
                <button @click="showDetail = false" class="w-9 h-9 flex items-center justify-center rounded-xl bg-gray-50 hover:bg-gray-100 transition-colors">
                    <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"/></svg>
                </button>
            </div>

            {{-- Items --}}
            <div class="px-6 py-4 max-h-60 overflow-y-auto space-y-3">
                <template x-for="item in (selected?.items || [])" :key="item.id">
                    <div class="flex items-center justify-between gap-3">
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 bg-gray-100 rounded-xl flex items-center justify-center text-xs font-black text-gray-600" x-text="item.quantity + 'x'"></div>
                            <span class="text-sm font-bold text-gray-800" x-text="item.product?.name || 'Produk Dihapus'"></span>
                        </div>
                        <span class="text-sm font-black text-gray-900 shrink-0" x-text="'Rp ' + Number(item.price * item.quantity).toLocaleString('id-ID')"></span>
                    </div>
                </template>
            </div>

            <div class="px-6 py-3 border-t border-gray-100 flex justify-between items-center bg-gray-50">
                <span class="text-xs font-black text-gray-400 uppercase tracking-widest">Total Pembayaran</span>
                <span class="font-black text-gray-900 text-lg" x-text="'Rp ' + Number(selected?.total_amount).toLocaleString('id-ID')"></span>
            </div>

            {{-- Status Update --}}
            <div class="px-6 py-5 border-t border-gray-100">
                <p class="text-[10px] font-black text-gray-400 uppercase tracking-[0.2em] mb-3">Ubah Status Pesanan</p>
                <div class="grid grid-cols-3 gap-2">
                    @foreach([
                        ['value' => 'paid',       'label' => 'Belum Dibuat', 'color' => 'bg-blue-50 text-blue-700 border-blue-200'],
                        ['value' => 'processing', 'label' => 'Sedang Dibuat', 'color' => 'bg-purple-50 text-purple-700 border-purple-200'],
                        ['value' => 'completed',  'label' => 'Sudah Dibuat', 'color' => 'bg-emerald-50 text-emerald-700 border-emerald-200'],
                    ] as $s)
                    <form method="POST" :action="'/cashier/orders/' + selected?.id + '/status'">
                        @csrf @method('PATCH')
                        <input type="hidden" name="status" value="{{ $s['value'] }}">
                        <button type="submit"
                            class="w-full px-2 py-2.5 text-[10px] font-black uppercase rounded-xl border transition-all tracking-wide {{ $s['color'] }} hover:scale-105 active:scale-95"
                            :class="selected?.status === '{{ $s['value'] }}' ? 'ring-2 ring-offset-1 ring-current' : ''">
                            {{ $s['label'] }}
                        </button>
                    </form>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

</div>

<script>
function ordersPage(initialData) {
    return {
        all: initialData,
        filterStatus: '',
        showDetail: false,
        selected: null,
        countdown: 30,
        timer: null,

        get filteredOrders() {
            if (!this.filterStatus) return this.all;
            return this.all.filter(o => o.status === this.filterStatus);
        },
        openDetail(order) { this.selected = order; this.showDetail = true; },
        formatDate(dt) {
            if (!dt) return '-';
            return new Date(dt).toLocaleTimeString('id-ID', { hour: '2-digit', minute: '2-digit' });
        },
        init() {
            this.timer = setInterval(() => {
                this.countdown--;
                if (this.countdown <= 0) window.location.reload();
            }, 1000);
        }
    }
}
</script>
@endsection
