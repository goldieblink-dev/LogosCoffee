@extends('layouts.cashier')

@section('title', 'Daftar Pesanan')

@section('content')
<div class="space-y-6" x-data="orderDashboard()">
    <!-- Header with Controls -->
    <div class="flex justify-between items-center">
        <div class="flex items-center gap-4">
            <h2 class="text-sm font-bold text-gray-500 uppercase tracking-widest">Pesanan Masuk</h2>
            <div class="flex items-center gap-2 px-3 py-1 bg-white border border-gray-200 rounded-full shadow-sm">
                <div class="w-2 h-2 bg-green-500 rounded-full animate-pulse"></div>
                <span class="text-[10px] font-bold text-gray-700 uppercase">Live</span>
            </div>
        </div>
        <div class="flex items-center gap-3">
            <span class="text-xs font-medium text-gray-500">Auto Refresh (30s)</span>
            <button @click="toggleRefresh()" :class="autoRefresh ? 'bg-black' : 'bg-gray-200'"
                class="w-10 h-5 rounded-full relative transition-colors duration-200">
                <div :class="autoRefresh ? 'translate-x-5' : 'translate-x-0'"
                    class="absolute top-0.5 left-0.5 w-4 h-4 bg-white rounded-full transition-transform duration-200 shadow-sm">
                </div>
            </button>
        </div>
    </div>

    <div class="bg-white border border-gray-200 rounded-2xl shadow-sm overflow-hidden">
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
                @forelse($orders as $order)
                <tr class="hover:bg-gray-50 transition-colors {{ $order->status == 'paid' ? 'bg-blue-50/20' : '' }}">
                    <td class="px-6 py-4 text-sm text-gray-500">{{ $order->created_at->format('H:i') }}</td>
                    <td class="px-6 py-4 font-bold text-gray-900">#{{ $order->table_number }}</td>
                    <td class="px-6 py-4 font-medium text-gray-900">{{ $order->customer_name }}</td>
                    <td class="px-6 py-4 text-sm font-bold items-center py-2 px-1">Rp {{
                        number_format($order->total_amount, 0, ',', '.') }}</td>
                    <td class="px-6 py-4">
                        @php
                        $statusColors = [
                        'pending' => 'bg-yellow-100 text-yellow-700 border-yellow-200',
                        'paid' => 'bg-blue-100 text-blue-700 border-blue-200',
                        'processing' => 'bg-purple-100 text-purple-700 border-purple-200',
                        'completed' => 'bg-green-100 text-green-700 border-green-200',
                        ];
                        @endphp
                        <span
                            class="px-3 py-1 text-[10px] font-bold uppercase rounded-full border {{ $statusColors[$order->status] ?? 'bg-gray-100 text-gray-700' }}">
                            {{ $order->status_label }}
                        </span>
                    </td>
                    <td class="px-6 py-4 text-right">
                        <a href="{{ route('orders.show', $order) }}"
                            class="text-xs font-bold px-4 py-2 bg-gray-50 hover:bg-black hover:text-white rounded-lg transition-all">Detail</a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="px-6 py-10 text-center text-gray-400 italic">Belum ada pesanan masuk.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
<script>
    function orderDashboard() {
        return {
            autoRefresh: true,
            init() {
                setInterval(() => {
                    if (this.autoRefresh) {
                        window.location.reload();
                    }
                }, 30000); // 30 seconds
            },
            toggleRefresh() {
                this.autoRefresh = !this.autoRefresh;
            }
        }
    }
</script>
@endsection