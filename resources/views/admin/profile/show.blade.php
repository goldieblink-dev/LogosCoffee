@extends('layouts.admin')

@section('title', 'Profil Cafe')

@section('content')
<div class="max-w-4xl bg-white border border-gray-200 rounded-2xl shadow-sm p-8">
    <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 md:grid-cols-2 gap-10">
            <!-- Basic Info -->
            <div class="space-y-6">
                <div>
                    <label for="name" class="block text-xs font-bold uppercase tracking-wider text-gray-700 mb-2">Nama
                        Cafe</label>
                    <input type="text" name="name" id="name" value="{{ old('name', $profile->name) }}" required
                        class="w-full px-4 py-2 bg-gray-50 border border-gray-200 rounded-lg focus:outline-none focus:border-black transition-colors">
                </div>

                <div>
                    <label for="contact"
                        class="block text-xs font-bold uppercase tracking-wider text-gray-700 mb-2">Kontak / No.
                        HP</label>
                    <input type="text" name="contact" id="contact" value="{{ old('contact', $profile->contact) }}"
                        class="w-full px-4 py-2 bg-gray-50 border border-gray-200 rounded-lg focus:outline-none focus:border-black transition-colors">
                </div>

                <div>
                    <label for="address"
                        class="block text-xs font-bold uppercase tracking-wider text-gray-700 mb-2">Alamat</label>
                    <textarea name="address" id="address" rows="3"
                        class="w-full px-4 py-2 bg-gray-50 border border-gray-200 rounded-lg focus:outline-none focus:border-black transition-colors">{{ old('address', $profile->address) }}</textarea>
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-gray-700 mb-2">Logo Cafe</label>
                    @if($profile->logo)
                    <div class="mb-4 w-24 h-24 bg-black rounded-lg flex items-center justify-center overflow-hidden">
                        <img src="{{ asset('storage/' . $profile->logo) }}" alt="Logo"
                            class="w-full h-full object-contain">
                    </div>
                    @endif
                    <input type="file" name="logo" accept="image/*"
                        class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-black file:text-white hover:file:bg-gray-900 transition-all">
                </div>
            </div>

            <!-- Opening Hours -->
            <div>
                <label class="block text-xs font-bold uppercase tracking-wider text-gray-700 mb-4">Jam
                    Operasional</label>
                <div id="opening-hours-container" class="space-y-3">
                    @php
                    $hours = $profile->opening_hours ?? ['Senin - Jumat' => '08:00 - 22:00'];
                    @endphp
                    @foreach($hours as $day => $time)
                    <div class="flex gap-2 hour-row">
                        <input type="text" name="days[]" value="{{ $day }}" placeholder="Hari (ex: Senin)"
                            class="flex-1 px-3 py-2 bg-gray-50 border border-gray-200 rounded-lg text-sm focus:outline-none focus:border-black">
                        <input type="text" name="times[]" value="{{ $time }}" placeholder="Jam (ex: 08:00 - 20:00)"
                            class="flex-1 px-3 py-2 bg-gray-50 border border-gray-200 rounded-lg text-sm focus:outline-none focus:border-black">
                        <button type="button" onclick="this.parentElement.remove()"
                            class="text-red-500 hover:text-red-700">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>
                    </div>
                    @endforeach
                </div>
                <button type="button" onclick="addHourRow()" class="mt-4 text-xs font-bold text-black hover:underline">+
                    Tambah Baris</button>
            </div>
        </div>

        <div class="mt-10 pt-6 border-t border-gray-100 italic">
            <button type="submit"
                class="px-8 py-3 bg-black text-white font-bold rounded-lg hover:bg-gray-900 transition-colors shadow-lg">
                Simpan Perubahan Profil
            </button>
        </div>
    </form>
</div>

<script>
    function addHourRow() {
        const container = document.getElementById('opening-hours-container');
        const row = document.createElement('div');
        row.className = 'flex gap-2 hour-row';
        row.innerHTML = `
            <input type="text" name="days[]" placeholder="Hari" class="flex-1 px-3 py-2 bg-gray-50 border border-gray-200 rounded-lg text-sm focus:outline-none focus:border-black">
            <input type="text" name="times[]" placeholder="Jam" class="flex-1 px-3 py-2 bg-gray-50 border border-gray-200 rounded-lg text-sm focus:outline-none focus:border-black">
            <button type="button" onclick="this.parentElement.remove()" class="text-red-500 hover:text-red-700">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M6 18L18 6M6 6l12 12"></path></svg>
            </button>
        `;
        container.appendChild(row);
    }
</script>
@endsection