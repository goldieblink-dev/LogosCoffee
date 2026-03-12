@extends('layouts.admin')

@section('title', 'Daftar Pesanan')

@section('content')
<div class="space-y-6" x-data="orderDashboard({{ json_encode($orders->map(function($order) {
    return [
        'id'             => $order->id,
        'order_code'     => '#LOGOS-' . str_pad($order->id, 5, '0', STR_PAD_LEFT),
        'table_number'   => $order->table_number,
        'customer_name'  => $order->customer_name,
        'customer_phone' => $order->customer_phone ?? '-',
        'total_amount'   => number_format($order->total_amount, 0, ',', '.'),
        'total_raw'      => $order->total_amount,
        'status'         => $order->status,
        'status_label'   => $order->status_label,
        'created_at'     => $order->created_at->format('d-m-Y H:i'),
        'created_at_full'=> $order->created_at->format('d M Y, H:i'),
        'items'          => $order->items->map(function($i) {
            return [
                'name'     => $i->product->name,
                'price'    => number_format($i->price, 0, ',', '.'),
                'subtotal' => number_format($i->price * $i->quantity, 0, ',', '.'),
                'quantity' => $i->quantity,
                'image'    => $i->product->image ? asset('storage/' . $i->product->image) : null,
            ];
        })->values(),
    ];
})) }})" class="space-y-6">
    <!-- Responsive Premium Header & Controls -->
    <div class="flex flex-col lg:flex-row justify-between items-start lg:items-center gap-6">
        <div>
            <h2 class="text-2xl font-black text-gray-900 tracking-tight">Daftar Pesanan</h2>
            <div class="flex items-center gap-2 mt-2">
                <div class="flex items-center gap-1.5 px-2.5 py-1 bg-green-50 border border-green-100 rounded-full">
                    <div class="w-2 h-2 bg-green-500 rounded-full animate-pulse shadow-[0_0_8px_rgba(34,197,94,0.5)]"></div>
                    <span class="text-[10px] font-black text-green-700 uppercase tracking-widest leading-none mt-0.5">Live Monitoring</span>
                </div>
            </div>
        </div>

        <div class="flex flex-col sm:flex-row flex-wrap items-center gap-3 w-full lg:w-auto">
            {{-- Search Input (Pill Design) --}}
            <div class="flex items-center w-full sm:w-auto flex-1 sm:min-w-[340px] bg-white border border-gray-200 rounded-full shadow-sm hover:shadow-md focus-within:ring-2 focus-within:ring-black focus-within:border-transparent px-4 py-0.5 transition-all duration-300 group">
                <div class="flex items-center justify-center shrink-0">
                    <svg class="w-4 h-4 text-gray-400 group-focus-within:text-black transition-colors duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                </div>
                <input 
                    type="text" 
                    x-model="searchQuery" 
                    placeholder="Cari Pesanan (Nama / Kode / Meja)..." 
                    class="w-full flex-1 pl-3 pr-2 py-2.5 bg-transparent border-none text-sm font-semibold focus:ring-0 outline-none placeholder:text-gray-400 placeholder:font-medium"
                >
            </div>

            <div class="flex items-center gap-3 w-full sm:w-auto justify-between sm:justify-start">
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
                {{-- Auto Refresh Toggle has been removed per user request --}}
            </div>
        </div>
    </div>

    <div class="bg-white border border-gray-200 rounded-2xl shadow-sm overflow-hidden min-h-[400px]">
        <table class="w-full text-left">
            <thead class="bg-gray-50 border-b border-gray-200">
                <tr>
                    <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider text-gray-500">Waktu</th>
                    <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider text-gray-500">Meja</th>
                    <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider text-gray-500">Pelanggan</th>
                    <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider text-gray-500">Total</th>
                    <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider text-gray-500">Status</th>
                    <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider text-gray-500 text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                <template x-for="order in filteredOrders" :key="order.id">
                    <tr class="hover:bg-gray-50 transition-colors" :class="order.status === 'paid' ? 'bg-blue-50/20' : ''">
                        <td class="px-6 py-4 text-sm text-gray-500" x-text="order.created_at"></td>
                        <td class="px-6 py-4 font-bold text-gray-900" x-text="'#' + order.table_number"></td>
                        <td class="px-6 py-4 font-medium text-gray-900" x-text="order.customer_name"></td>
                        <td class="px-6 py-4 text-sm font-bold items-center py-2 px-1" x-text="'Rp ' + order.total_amount"></td>
                        <td class="px-6 py-4">
                            <span
                                class="px-3 py-1 text-[10px] font-bold uppercase rounded-full border"
                                :class="{
                                    'bg-yellow-100 text-yellow-700 border-yellow-200': order.status === 'pending',
                                    'bg-blue-100 text-blue-700 border-blue-200': order.status === 'paid',
                                    'bg-purple-100 text-purple-700 border-purple-200': order.status === 'processing',
                                    'bg-green-100 text-green-700 border-green-200': order.status === 'completed',
                                }"
                                x-text="order.status_label">
                            </span>
                        </td>
                        <td class="px-6 py-4 text-right">
                            <button
                                @click="openModal(order.id, order)"
                                class="text-xs font-bold px-4 py-2 bg-gray-50 hover:bg-black hover:text-white rounded-lg transition-all">
                                Detail
                            </button>
                        </td>
                    </tr>
                </template>
                <template x-if="filteredOrders.length === 0">
                    <tr>
                        <td colspan="6" class="px-6 py-10 text-center text-gray-400 italic">Pesanan tidak ditemukan.</td>
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

    {{-- ══════════════════════════════════
         ORDER DETAIL MODAL (redesigned)
    ══════════════════════════════════ --}}
    {{-- ════════════════════════════════════════════════
         ORDER DETAIL MODAL (TECHNICAL MINI V3)
         Side-by-Side | High Contrast | Compact UX
    ════════════════════════════════════════════════ --}}
    <div
        x-show="showModal"
        x-cloak
        class="fixed inset-0 z-50 flex items-center justify-center p-4 sm:p-6"
        style="background: rgba(0,0,0,0.6); backdrop-filter: blur(8px);"
        @click.self="showModal = false"
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
    >
        <div
            class="bg-white w-full max-w-3xl rounded-3xl shadow-2xl overflow-hidden flex flex-col max-h-[85vh] border border-gray-100"
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0 scale-95"
            x-transition:enter-end="opacity-100 scale-100"
            @click.stop
        >
            {{-- Technical Thin Header --}}
            <div class="bg-black px-6 py-4 flex items-center justify-between sticky top-0 z-30">
                <div class="flex items-center gap-4">
                    <h3 class="text-white font-black text-base tracking-tight" x-text="selectedOrder?.order_code"></h3>
                    <div class="h-4 w-[1px] bg-gray-800"></div>
                    <p class="text-[9px] text-gray-400 font-bold uppercase tracking-widest" x-text="selectedOrder?.created_at_full"></p>
                </div>
                <button @click="showModal = false" class="p-1.5 rounded-lg hover:bg-white/10 transition-all text-gray-500 hover:text-white">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>

            <div class="flex flex-col md:flex-row h-full overflow-hidden">
                
                {{-- Left: Order Items (Tight List) --}}
                <div class="flex-[1.4] border-r border-gray-100 overflow-y-auto no-scrollbar bg-gray-50/30 p-6">
                    <div class="flex items-center justify-between mb-4">
                        <p class="text-[10px] font-black uppercase tracking-widest text-gray-400">Order Items</p>
                        <span class="text-xs font-black px-2 py-0.5 bg-black text-white rounded-md" x-text="selectedOrder?.items?.length"></span>
                    </div>

                    <div class="space-y-2">
                        <template x-for="item in selectedOrder?.items" :key="item.name">
                            <div class="flex items-center gap-4 p-3 bg-white rounded-xl border border-gray-100 hover:border-gray-200 transition-all">
                                <div class="w-10 h-10 rounded-lg overflow-hidden flex-shrink-0 border border-gray-50 bg-gray-50">
                                    <template x-if="item.image">
                                        <img :src="item.image" class="w-full h-full object-cover">
                                    </template>
                                    <template x-if="!item.image">
                                        <div class="w-full h-full flex items-center justify-center text-gray-200">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                            </svg>
                                        </div>
                                    </template>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <p class="font-black text-gray-900 text-[13px] leading-tight truncate" x-text="item.name"></p>
                                    <p class="text-[10px] font-bold text-gray-400" x-text="item.quantity + 'x · ' + item.price"></p>
                                </div>
                                <div class="text-right">
                                    <p class="font-black text-gray-900 text-[13px]" x-text="'Rp ' + item.subtotal"></p>
                                </div>
                            </div>
                        </template>
                    </div>

                    <div class="mt-4 pt-4 border-t border-dashed border-gray-200 flex justify-between items-center">
                        <span class="text-[9px] font-black uppercase tracking-widest text-gray-400">Grand Total</span>
                        <span class="text-xl font-black text-black tracking-tight" x-text="'Rp ' + selectedOrder?.total_amount"></span>
                    </div>
                </div>

                {{-- Right: Customer & Actions (Fixed) --}}
                <div class="flex-1 p-6 flex flex-col justify-between overflow-y-auto no-scrollbar">
                    <div class="space-y-6">
                        {{-- Status Pill --}}
                        <div>
                            <p class="text-[10px] font-black uppercase tracking-widest text-gray-400 mb-2">Order Status</p>
                            <span class="inline-flex px-3 py-1 text-[10px] font-black uppercase rounded-lg tracking-wider"
                                :class="{
                                    'bg-yellow-500/10 text-yellow-600': selectedOrder?.status === 'pending',
                                    'bg-blue-500/10 text-blue-600': selectedOrder?.status === 'paid',
                                    'bg-purple-500/10 text-purple-600': selectedOrder?.status === 'processing',
                                    'bg-green-500/10 text-green-600': selectedOrder?.status === 'completed',
                                }"
                                x-text="selectedOrder?.status_label">
                            </span>
                        </div>

                        {{-- Customer Grid --}}
                        <div class="space-y-4">
                            <p class="text-[10px] font-black uppercase tracking-widest text-gray-400">Customer Details</p>
                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <p class="text-[9px] font-bold text-gray-400 uppercase mb-0.5">Name</p>
                                    <p class="font-black text-gray-900 text-[13px]" x-text="selectedOrder?.customer_name"></p>
                                </div>
                                <div>
                                    <p class="text-[9px] font-bold text-gray-400 uppercase mb-0.5">Table</p>
                                    <p class="font-black text-gray-900 text-[13px]" x-text="'#' + selectedOrder?.table_number"></p>
                                </div>
                                <div class="col-span-2">
                                    <p class="text-[9px] font-bold text-gray-400 uppercase mb-0.5">Phone (WhatsApp)</p>
                                    <p class="font-bold text-gray-700 text-[13px] flex items-center gap-1.5">
                                        <span class="w-1.5 h-1.5 bg-green-500 rounded-full"></span>
                                        <span x-text="selectedOrder?.customer_phone"></span>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Actions Bar --}}
                    <div class="mt-8 pt-6 border-t border-gray-100 space-y-3">
                        <form :action="'/admin/orders/' + selectedOrder?.id" method="POST" class="space-y-2">
                            @csrf
                            @method('PUT')
                            <div class="relative">
                                <select name="status" class="w-full h-11 pl-4 pr-10 py-1 bg-gray-50 border-none rounded-xl text-xs font-black focus:ring-1 focus:ring-black outline-none appearance-none cursor-pointer">
                                    <option value="pending" :selected="selectedOrder?.status === 'pending'">Set Belum Dibayar</option>
                                    <option value="paid" :selected="selectedOrder?.status === 'paid'">Set Belum Dibuat</option>
                                    <option value="processing" :selected="selectedOrder?.status === 'processing'">Set Sedang Dibuat</option>
                                    <option value="completed" :selected="selectedOrder?.status === 'completed'">Set Dibuat</option>
                                </select>
                                <div class="absolute right-3 top-1/2 -translate-y-1/2 pointer-events-none text-gray-400">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7"/>
                                    </svg>
                                </div>
                            </div>
                            <button type="submit" class="w-full py-3 bg-black text-white text-[11px] font-black uppercase tracking-widest rounded-xl hover:bg-gray-800 transition-all active:scale-[0.98]">
                                Update Status
                            </button>
                        </form>
                        
                        <form :action="'/admin/orders/' + selectedOrder?.id" method="POST" onsubmit="return confirm('Hapus pesanan ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="w-full py-2.5 text-[9px] font-black uppercase tracking-widest text-red-500 border border-red-50 hover:bg-red-50 transition-all rounded-xl">
                                Delete Record
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<style>
    [x-cloak] { display: none !important; }
    .no-scrollbar::-webkit-scrollbar { display: none; }
    .no-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
</style>

<script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
<script>
    function orderDashboard(initialOrders) {
        return {
            autoRefresh: false,
            showModal: false,
            selectedOrder: null,
            searchQuery: '',
            maxRows: 10,
            currentPage: 1,
            allOrders: initialOrders,

            get totalPages() {
                let filtered = this.allOrders;
                if (this.searchQuery.trim() !== '') {
                    const q = this.searchQuery.toLowerCase();
                    filtered = filtered.filter(o => {
                        return o.customer_name.toLowerCase().includes(q) || 
                               o.order_code.toLowerCase().includes(q) || 
                               String(o.table_number).includes(q);
                    });
                }
                return Math.max(1, Math.ceil(filtered.length / parseInt(this.maxRows)));
            },

            get filteredOrders() {
                let filtered = this.allOrders;

                if (this.searchQuery.trim() !== '') {
                    const q = this.searchQuery.toLowerCase();
                    filtered = filtered.filter(o => {
                        return o.customer_name.toLowerCase().includes(q) || 
                               o.order_code.toLowerCase().includes(q) || 
                               String(o.table_number).includes(q);
                    });
                }

                // Calculate pagination range
                const start = (this.currentPage - 1) * parseInt(this.maxRows);
                const end = start + parseInt(this.maxRows);
                return filtered.slice(start, end);
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

            openModal(id, data) {
                this.selectedOrder = data;
                this.showModal = true;
            },
            init() {
                // Reset page to 1 when search or maxRows changes
                this.$watch('searchQuery', () => this.currentPage = 1);
                this.$watch('maxRows', () => this.currentPage = 1);
            }
        }
    }
</script>
@endsection