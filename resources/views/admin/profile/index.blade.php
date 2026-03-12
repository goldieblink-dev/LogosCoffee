@extends('layouts.admin')
@section('title', 'Profil Cafe')
@section('breadcrumb', 'Pengaturan Info Logo & Jam Operasional')

@section('content')
<div class="max-w-4xl">
    <div class="bg-white border border-gray-200 rounded-[2.5rem] shadow-sm overflow-hidden mb-12">
        <form action="{{ route('admin.profile.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            
            {{-- Header/Logo Section --}}
            <div class="p-8 border-b border-gray-100 bg-gray-50/50 flex flex-col sm:flex-row items-center sm:items-start gap-6">
                <div class="w-32 h-32 rounded-[2rem] bg-white border border-gray-200 shadow-sm flex items-center justify-center overflow-hidden shrink-0 relative group">
                    @if($profile->logo)
                        <img src="{{ Storage::url($profile->logo) }}" alt="Logo" class="w-full h-full object-cover">
                    @else
                        <svg class="w-10 h-10 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                    @endif
                    <div class="absolute inset-0 bg-black/60 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity backdrop-blur-sm">
                        <span class="text-white text-xs font-black uppercase tracking-wider">Ubah Logo</span>
                    </div>
                    <input type="file" name="logo" accept="image/*" class="absolute inset-0 opacity-0 cursor-pointer">
                </div>
                <div class="flex-1 text-center sm:text-left">
                    <h3 class="text-xl font-black text-gray-900 mb-1">Logo Cafe</h3>
                    <p class="text-sm text-gray-500 font-medium mb-4">Gunakan gambar persegi (1:1) beresolusi tinggi (maks 2MB).</p>
                    <div class="inline-flex items-center justify-center px-4 py-2.5 bg-white border border-gray-200 rounded-xl text-xs font-bold text-gray-700 shadow-sm pointer-events-none uppercase tracking-wider">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"/></svg>
                        Upload Foto Baru
                    </div>
                </div>
            </div>

            <div class="p-6 md:p-10 grid grid-cols-1 lg:grid-cols-2 gap-10">
                {{-- Info Umum --}}
                <div class="space-y-6">
                    <h4 class="text-sm font-black flex items-center gap-2 pb-3 border-b border-gray-100 uppercase tracking-widest text-gray-800">
                        <svg class="w-4.5 h-4.5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                        Informasi Umum
                    </h4>
                    <div>
                        <label class="block text-[10px] font-black text-gray-400 uppercase tracking-[0.2em] mb-2">Nama Cafe <span class="text-red-500">*</span></label>
                        <input type="text" name="name" value="{{ old('name', $profile->name) }}" required
                            class="w-full px-4 py-3 bg-white border border-gray-200 rounded-2xl text-sm font-semibold focus:ring-2 focus:ring-black outline-none transition-shadow shadow-sm">
                    </div>
                    <div>
                        <label class="block text-[10px] font-black text-gray-400 uppercase tracking-[0.2em] mb-2">Kontak (WA/Telp)</label>
                        <input type="text" name="contact" value="{{ old('contact', $profile->contact) }}"
                            class="w-full px-4 py-3 bg-white border border-gray-200 rounded-2xl text-sm font-semibold focus:ring-2 focus:ring-black outline-none transition-shadow shadow-sm">
                    </div>
                    <div>
                        <label class="block text-[10px] font-black text-gray-400 uppercase tracking-[0.2em] mb-2">Alamat Lengkap</label>
                        <textarea name="address" rows="4"
                            class="w-full px-4 py-3 bg-white border border-gray-200 rounded-2xl text-sm font-semibold focus:ring-2 focus:ring-black outline-none transition-shadow resize-none shadow-sm">{{ old('address', $profile->address) }}</textarea>
                    </div>
                </div>

                {{-- Jam Operasional --}}
                <div class="space-y-6">
                    <div class="flex items-center justify-between pb-3 border-b border-gray-100">
                        <h4 class="text-sm font-black flex items-center gap-2 uppercase tracking-widest text-gray-800">
                            <svg class="w-4.5 h-4.5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            Jam Operasional
                        </h4>
                    </div>
                    <div class="space-y-3">
                        @foreach(['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'] as $index => $day)
                        @php 
                            $englishDays = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];
                            $engDay = $englishDays[$index];
                            $hours = $profile->opening_hours[$engDay] ?? ['open'=>'08:00','close'=>'22:00','closed'=>false]; 
                        @endphp
                        <div x-data="{ closed: {{ isset($hours['closed']) && $hours['closed'] ? 'true' : 'false' }} }" class="bg-white rounded-2xl p-4 border border-gray-200 shadow-sm transition-all" :class="closed ? 'opacity-60 bg-gray-50' : ''">
                            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3">
                                <span class="text-[10px] font-black w-20 text-gray-900 uppercase tracking-[0.2em]">{{ $day }}</span>
                                
                                <div class="flex items-center gap-2 flex-1 relative">
                                    <div class="flex items-center gap-2 transition-opacity duration-200" :class="closed ? 'opacity-0 invisible absolute' : 'opacity-100 visible relative'">
                                        <input type="time" name="opening_hours[{{ $engDay }}][open]" value="{{ $hours['open'] }}"
                                            class="px-3 py-2 bg-white border border-gray-200 rounded-xl text-xs font-bold focus:ring-2 focus:ring-black outline-none shadow-sm">
                                        <span class="text-gray-300 font-black">-</span>
                                        <input type="time" name="opening_hours[{{ $engDay }}][close]" value="{{ $hours['close'] }}"
                                            class="px-3 py-2 bg-white border border-gray-200 rounded-xl text-xs font-bold focus:ring-2 focus:ring-black outline-none shadow-sm">
                                    </div>
                                    <div class="flex-1 transition-opacity duration-200" :class="closed ? 'opacity-100 visible relative' : 'opacity-0 invisible absolute'">
                                        <span class="text-[10px] font-black text-red-500 uppercase tracking-[0.2em] bg-red-50 px-3 py-1.5 rounded-lg border border-red-100">Tutup / Libur</span>
                                    </div>
                                </div>
                                <div class="w-14 flex justify-end">
                                    <label class="relative inline-flex items-center cursor-pointer">
                                        <input type="checkbox" name="opening_hours[{{ $engDay }}][closed]" value="1" class="sr-only peer" x-model="closed">
                                        <div class="w-9 h-5 bg-black peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-200 after:border after:rounded-full after:h-4 after:w-4 after:transition-all peer-checked:bg-gray-200"></div>
                                    </label>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="p-6 sm:px-10 sm:py-6 border-t border-gray-100 bg-gray-50/50 flex justify-end">
                <button type="submit" class="w-full sm:w-auto px-8 py-3.5 bg-black text-white text-sm font-black rounded-xl hover:bg-gray-800 transition-all shadow-lg shadow-black/10 hover:-translate-y-0.5 flex items-center justify-center gap-2 tracking-wider">
                    <svg class="w-4.5 h-4.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                    SIMPAN PENGATURAN
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
