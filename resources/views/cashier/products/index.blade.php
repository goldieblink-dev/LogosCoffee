@extends('layouts.cashier')

@section('title', 'Daftar Produk')

@section('content')
<div class="mb-6 flex justify-end">
    <a href="{{ route('products.create') }}"
        class="px-6 py-2 bg-black text-white font-bold rounded-lg hover:bg-gray-900 transition-colors shadow-lg">
        + Tambah Produk
    </a>
</div>

<div class="bg-white border border-gray-200 rounded-2xl shadow-sm overflow-hidden">
    <table class="w-full text-left">
        <thead class="bg-gray-50 border-b border-gray-200">
            <tr>
                <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider text-gray-500">Produk</th>
                <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider text-gray-500">Kategori</th>
                <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider text-gray-500">Harga</th>
                <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider text-gray-500">Status</th>
                <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider text-gray-500 text-right">Aksi</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-200">
            @forelse($products as $product)
            <tr class="hover:bg-gray-50 transition-colors">
                <td class="px-6 py-4 flex items-center gap-4">
                    <div class="w-12 h-12 bg-gray-100 rounded-lg overflow-hidden flex-shrink-0 border border-gray-200">
                        @if($product->image)
                        <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}"
                            class="w-full h-full object-cover">
                        @else
                        <div class="w-full h-full flex items-center justify-center text-gray-400">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                                </path>
                            </svg>
                        </div>
                        @endif
                    </div>
                    <div>
                        <p class="font-bold text-gray-900">{{ $product->name }}</p>
                        <p class="text-xs text-gray-500 truncate max-w-[200px]">{{ $product->description }}</p>
                    </div>
                </td>
                <td class="px-6 py-4 text-sm text-gray-700">
                    <span class="px-2 py-1 bg-gray-100 rounded text-xs">{{ $product->category->name }}</span>
                </td>
                <td class="px-6 py-4 font-bold text-gray-900">Rp {{ number_format($product->price, 0, ',', '.') }}</td>
                <td class="px-6 py-4">
                    <form action="{{ route('products.toggle', $product) }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <button type="submit"
                            class="px-3 py-1 rounded-full text-[10px] font-bold uppercase border transition-all 
                            {{ $product->is_available ? 'bg-green-50 text-green-700 border-green-200 hover:bg-green-100' : 'bg-red-50 text-red-700 border-red-200 hover:bg-red-100' }}">
                            {{ $product->is_available ? 'Tersedia' : 'Habis' }}
                        </button>
                    </form>
                </td>
                <td class="px-6 py-4 text-right space-x-3">
                    <a href="{{ route('products.edit', $product) }}"
                        class="text-sm font-bold text-black hover:underline">Edit</a>
                    <form action="{{ route('products.destroy', $product) }}" method="POST" class="inline"
                        onsubmit="return confirm('Yakin ingin menghapus produk ini?')">
                        @csrf @method('DELETE')
                        <button type="submit" class="text-sm font-bold text-red-600 hover:underline">Hapus</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5" class="px-6 py-10 text-center text-gray-500">Belum ada produk.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection