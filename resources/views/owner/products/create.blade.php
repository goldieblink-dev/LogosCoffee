@extends('layouts.owner')

@section('title', 'Tambah Produk')

@section('content')
<div class="max-w-3xl bg-white border border-gray-200 rounded-2xl shadow-sm p-8">
    <form action="{{ route('owner.products.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <div class="space-y-6">
                <div>
                    <label for="name" class="block text-xs font-bold uppercase tracking-wider text-gray-700 mb-2">Nama
                        Produk</label>
                    <input type="text" name="name" id="name" value="{{ old('name') }}" required
                        class="w-full px-4 py-2 bg-gray-50 border border-gray-200 rounded-lg focus:outline-none focus:border-black transition-colors">
                    @error('name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label for="category_id"
                        class="block text-xs font-bold uppercase tracking-wider text-gray-700 mb-2">Kategori</label>
                    <select name="category_id" id="category_id" required
                        class="w-full px-4 py-2 bg-gray-50 border border-gray-200 rounded-lg focus:outline-none focus:border-black transition-colors">
                        <option value="">Pilih Kategori</option>
                        @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ old('category_id')==$category->id ? 'selected' : '' }}>{{
                            $category->name }}</option>
                        @endforeach
                    </select>
                    @error('category_id') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label for="price" class="block text-xs font-bold uppercase tracking-wider text-gray-700 mb-2">Harga
                        Normal (Rp)</label>
                    <input type="number" name="price" id="price" value="{{ old('price') }}" required
                        class="w-full px-4 py-2 bg-gray-50 border border-gray-200 rounded-lg focus:outline-none focus:border-black transition-colors">
                    @error('price') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label for="promo_price"
                        class="block text-xs font-bold uppercase tracking-wider text-gray-700 mb-2 text-yellow-600">Harga
                        Promo (Rp) - Opsional</label>
                    <input type="number" name="promo_price" id="promo_price" value="{{ old('promo_price') }}"
                        class="w-full px-4 py-2 bg-yellow-50 border border-yellow-200 rounded-lg focus:outline-none focus:border-yellow-600 transition-colors">
                    @error('promo_price') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div class="flex items-center gap-3">
                    <input type="checkbox" name="is_available" id="is_available" value="1" checked
                        class="w-5 h-5 accent-black">
                    <label for="is_available" class="text-sm font-bold text-gray-700">Produk Tersedia</label>
                </div>
            </div>

            <div class="space-y-6">
                <div>
                    <label for="description"
                        class="block text-xs font-bold uppercase tracking-wider text-gray-700 mb-2">Deskripsi</label>
                    <textarea name="description" id="description" rows="5"
                        class="w-full px-4 py-2 bg-gray-50 border border-gray-200 rounded-lg focus:outline-none focus:border-black transition-colors">{{ old('description') }}</textarea>
                    @error('description') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label for="image" class="block text-xs font-bold uppercase tracking-wider text-gray-700 mb-2">Foto
                        Produk</label>
                    <input type="file" name="image" id="image" accept="image/*"
                        class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-black file:text-white hover:file:bg-gray-900 transition-all">
                    <p class="text-[10px] text-gray-400 mt-2">Format: JPG, PNG, WEBP. Max: 2MB</p>
                    @error('image') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
            </div>
        </div>

        <div class="mt-10 flex gap-4">
            <button type="submit"
                class="px-6 py-2 bg-black text-white font-bold rounded-lg hover:bg-gray-900 transition-colors shadow-lg">
                Simpan Produk
            </button>
            <a href="{{ route('owner.products.index') }}"
                class="px-6 py-2 bg-gray-100 text-gray-700 font-bold rounded-lg hover:bg-gray-200 transition-colors">
                Batal
            </a>
        </div>
    </form>
</div>
@endsection