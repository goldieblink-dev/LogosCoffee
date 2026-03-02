@extends('layouts.admin')

@section('title', 'Tambah Kategori')

@section('content')
<div class="max-w-2xl bg-white border border-gray-200 rounded-2xl shadow-sm p-8">
    <form action="{{ route('categories.store') }}" method="POST">
        @csrf
        <div class="space-y-6">
            <div>
                <label for="name" class="block text-xs font-bold uppercase tracking-wider text-gray-700 mb-2">Nama
                    Kategori</label>
                <input type="text" name="name" id="name" value="{{ old('name') }}" required autofocus
                    class="w-full px-4 py-2 bg-gray-50 border border-gray-200 rounded-lg focus:outline-none focus:border-black transition-colors">
                @error('name')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex gap-4">
                <button type="submit"
                    class="px-6 py-2 bg-black text-white font-bold rounded-lg hover:bg-gray-900 transition-colors shadow-lg">
                    Simpan Kategori
                </button>
                <a href="{{ route('categories.index') }}"
                    class="px-6 py-2 bg-gray-100 text-gray-700 font-bold rounded-lg hover:bg-gray-200 transition-colors">
                    Batal
                </a>
            </div>
        </div>
    </form>
</div>
@endsection