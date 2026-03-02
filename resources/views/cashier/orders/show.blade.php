@extends('layouts.cashier')

@section('title', 'Detail Pesanan #LOGOS-' . str_pad($order->id, 5, '0', STR_PAD_LEFT))

@section('content')
<div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
    <!-- Order Info -->
    <div class="lg:col-span-2 space-y-6">
        <div class="bg-white border border-gray-200 rounded-2xl shadow-sm p-8">
            <h3 class="text-xs font-bold uppercase tracking-wider text-gray-400 mb-6">Item Pesanan</h3>
            <div class="space-y-4">
                @foreach($order->items as $item)
                <div class="flex items-center justify-between py-2 border-b border-gray-50 last:border-0">
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 bg-gray-50 rounded-lg overflow-hidden">
                            @if($item->product->image)
                            <img src="{{ asset('storage/' . $item->product->image) }}"
                                class="w-full h-full object-cover">
                            @endif
                        </div>
                        <div>
                            <p class="font-bold text-gray-900">{{ $item->product->name }}</p>
                            <p class="text-xs text-gray-500">Rp {{ number_format($item->price, 0, ',', '.') }} x {{
                                $item->quantity }}</p>
                        </div>
                    </div>
                    <p class="font-bold">Rp {{ number_format($item->price * $item->quantity, 0, ',', '.') }}</p>
                </div>
                @endforeach
            </div>
            <div class="mt-8 pt-6 border-t border-gray-100 flex justify-between items-center">
                <span class="font-bold text-lg">Total Pembayaran</span>
                <span class="font-heading font-bold text-2xl text-black">Rp {{ number_format($order->total_amount, 0,
                    ',', '.') }}</span>
            </div>
        </div>
    </div>

    <!-- Status & Customer -->
    <div class="space-y-6">
        <div class="bg-white border border-gray-200 rounded-2xl shadow-sm p-6">
            <h3 class="text-xs font-bold uppercase tracking-wider text-gray-400 mb-4">Data Pelanggan</h3>
            <div class="space-y-3">
                <div>
                    <p class="text-[10px] text-gray-400 font-bold uppercase">Nama</p>
                    <p class="font-bold">{{ $order->customer_name }}</p>
                </div>
                <div>
                    <p class="text-[10px] text-gray-400 font-bold uppercase">Nomor Meja</p>
                    <p class="font-bold text-lg">Meja #{{ $order->table_number }}</p>
                </div>
                <div>
                    <p class="text-[10px] text-gray-400 font-bold uppercase">Nomor HP</p>
                    <p class="font-bold">{{ $order->customer_phone ?? '-' }}</p>
                </div>
            </div>
        </div>

        <div class="bg-white border border-gray-200 rounded-2xl shadow-sm p-6">
            <h3 class="text-xs font-bold uppercase tracking-wider text-gray-400 mb-4">Update Status</h3>
            <form action="{{ route('orders.update', $order) }}" method="POST" class="space-y-4">
                @csrf
                @method('PUT')
                <select name="status"
                    class="w-full px-4 py-2 bg-gray-50 border border-gray-200 rounded-lg focus:outline-none focus:border-black transition-colors font-bold text-sm">
                    <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Menunggu (Pending)
                    </option>
                    <option value="paid" {{ $order->status == 'paid' ? 'selected' : '' }}>Sudah Bayar (Paid)</option>
                    <option value="processing" {{ $order->status == 'processing' ? 'selected' : '' }}>Sedang Diproses
                        (Processing)</option>
                    <option value="completed" {{ $order->status == 'completed' ? 'selected' : '' }}>Selesai (Completed)
                    </option>
                </select>
                <button type="submit"
                    class="w-full py-2 bg-black text-white font-bold rounded-lg hover:bg-gray-900 transition-colors">Update
                    Status</button>
            </form>
        </div>

        <form action="{{ route('orders.destroy', $order) }}" method="POST"
            onsubmit="return confirm('Yakin ingin menghapus pesanan ini?')">
            @csrf
            @method('DELETE')
            <button type="submit"
                class="w-full py-2 border border-red-200 text-red-500 font-bold rounded-lg hover:bg-red-50 transition-colors text-xs italic">Hapus
                Pesanan</button>
        </form>
    </div>
</div>
@endsection