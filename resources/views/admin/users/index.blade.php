@extends('layouts.admin')

@section('title', 'Manajemen User')

@section('content')
<div class="mb-6 flex justify-end">
    <a href="{{ route('users.create') }}"
        class="px-6 py-2 bg-black text-white font-bold rounded-lg hover:bg-gray-900 transition-colors shadow-lg">
        + Tambah User
    </a>
</div>

<div class="bg-white border border-gray-200 rounded-2xl shadow-sm overflow-hidden">
    <table class="w-full text-left">
        <thead class="bg-gray-50 border-b border-gray-200">
            <tr>
                <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider text-gray-500">Nama</th>
                <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider text-gray-500">Email</th>
                <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider text-gray-500">Peran</th>
                <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider text-gray-500">Dibuat Pada</th>
                <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider text-gray-500 text-right">Aksi</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-200">
            @foreach($users as $user)
            <tr class="hover:bg-gray-50 transition-colors">
                <td class="px-6 py-4 font-medium text-gray-900">{{ $user->name }}</td>
                <td class="px-6 py-4 text-sm text-gray-700">{{ $user->email }}</td>
                <td class="px-6 py-4">
                    <span
                        class="px-3 py-1 text-[10px] font-bold uppercase rounded-full border {{ $user->role === 'admin' ? 'bg-black text-white border-black' : 'bg-gray-100 text-gray-700 border-gray-200' }}">
                        {{ $user->role }}
                    </span>
                </td>
                <td class="px-6 py-4 text-sm text-gray-500">{{ $user->created_at->format('d M Y') }}</td>
                <td class="px-6 py-4 text-right space-x-3">
                    <a href="{{ route('users.edit', $user) }}"
                        class="text-sm font-bold text-black hover:underline">Edit</a>
                    @if($user->id !== auth()->id())
                    <form action="{{ route('users.destroy', $user) }}" method="POST" class="inline"
                        onsubmit="return confirm('Yakin ingin menghapus user ini?')">
                        @csrf @method('DELETE')
                        <button type="submit" class="text-sm font-bold text-red-600 hover:underline">Hapus</button>
                    </form>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection