@extends('layouts.admin')

@section('title', 'Daftar Kategori')

@section('content')
<div class="mb-6 flex justify-end">
    <a href="{{ route('categories.create') }}"
        class="px-6 py-2 bg-black text-white font-bold rounded-lg hover:bg-gray-900 transition-colors shadow-lg">
        + Tambah Kategori
    </a>
</div>

<div class="bg-white border border-gray-200 rounded-2xl shadow-sm overflow-hidden">
    <table class="w-full text-left">
        <thead class="bg-gray-50 border-b border-gray-200">
            <tr>
                <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider text-gray-500">Nama</th>
                <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider text-gray-500">Slug</th>
                <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider text-gray-500">Produk</th>
                <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider text-gray-500 text-right">Aksi</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-200">
            @forelse($categories as $category)
            <tr class="hover:bg-gray-50 transition-colors">
                <td class="px-6 py-4 font-medium text-gray-900">{{ $category->name }}</td>
                <td class="px-6 py-4 text-sm text-gray-500">{{ $category->slug }}</td>
                <td class="px-6 py-4 text-sm text-gray-500">{{ $category->products_count ?? 0 }}</td>
                <td class="px-6 py-4 text-right space-x-3">
                    <a href="{{ route('categories.edit', $category) }}"
                        class="text-sm font-bold text-black hover:underline">Edit</a>
                    <form action="{{ route('categories.destroy', $category) }}" method="POST" class="inline"
                        onsubmit="return confirm('Yakin ingin menghapus kategori ini?')">
                        @csrf @method('DELETE')
                        <button type="submit" class="text-sm font-bold text-red-600 hover:underline">Hapus</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="4" class="px-6 py-10 text-center text-gray-500">Belum ada kategori.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection