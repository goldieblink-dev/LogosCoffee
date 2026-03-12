@extends('layouts.admin')
@section('title', 'Pengguna')
@section('breadcrumb', 'Manajemen Akun Pengguna')

@section('content')
<div x-data="userPage({{ json_encode($users) }})">

    {{-- Header & Add Button --}}
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-6 mb-8">
        <div>
            <h3 class="text-3xl font-black text-gray-900 tracking-tighter">Pengguna</h3>
            <p class="text-xs font-bold text-gray-400 uppercase tracking-widest mt-1" x-text="filteredUsers.length + ' Pengguna Terdaftar'"></p>
        </div>
        <button @click="openAddModal()"
            class="w-full sm:w-auto flex items-center justify-center gap-3 px-6 py-4 bg-black text-white text-sm font-black rounded-2xl hover:bg-gray-800 transition-all shadow-lg shadow-black/10 hover:-translate-y-1">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="stroke-width: 3px;"><path d="M12 4v16m8-8H4"/></svg>
            Tambah Pengguna
        </button>
    </div>

    {{-- Controls --}}
    <div class="flex flex-col md:flex-row items-stretch md:items-center gap-4 mb-6">
        <div class="relative flex-1">
            <svg class="absolute left-3.5 top-1/2 -translate-y-1/2 w-4.5 h-4.5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
            <input type="text" x-model="search" placeholder="Cari nama atau email..."
                class="w-full pl-11 pr-4 py-3 bg-white border border-gray-200 rounded-2xl text-sm focus:ring-2 focus:ring-black focus:border-transparent outline-none font-bold placeholder:text-gray-400 placeholder:font-medium transition-all shadow-sm">
        </div>
        
        <div class="flex flex-wrap items-center gap-2 overflow-x-auto no-scrollbar pb-1 md:pb-0">
            <template x-for="role in ['', 'admin', 'cashier', 'owner']" :key="role">
                <button @click="filterRole = role; currentPage = 1"
                    :class="filterRole === role ? 'bg-black text-white shadow-lg shadow-black/10' : 'bg-white text-gray-500 border border-gray-200 hover:bg-gray-50'"
                    class="px-4 py-2 text-xs font-bold rounded-xl transition-all capitalize whitespace-nowrap"
                    x-text="role === '' ? 'Semua Role' : role"></button>
            </template>
        </div>
        
        <div class="flex items-center gap-2 bg-white border border-gray-200 rounded-2xl px-4 py-2.5 shadow-sm shrink-0 self-end md:self-auto">
            <span class="text-[10px] font-black text-gray-400 uppercase tracking-widest">Baris</span>
            <select x-model="perPage" @change="currentPage = 1" class="border-none bg-transparent text-sm font-black focus:ring-0 outline-none cursor-pointer p-0 pr-1">
                <option value="5">5</option>
                <option value="10" selected>10</option>
                <option value="25">25</option>
            </select>
        </div>
    </div>

    {{-- Table Container --}}
    <div class="w-full bg-white border border-gray-200 rounded-[2.5rem] shadow-sm overflow-hidden mb-12">
        <div class="overflow-x-auto no-scrollbar touch-pan-x">
            <table class="w-full text-left border-collapse min-w-[700px]">
                <thead class="bg-gray-50/50 border-b border-gray-100">
                    <tr>
                        <th class="pl-10 pr-4 py-6 text-[10px] font-black uppercase tracking-[0.3em] text-gray-400">Nama</th>
                        <th class="px-6 py-6 text-[10px] font-black uppercase tracking-[0.3em] text-gray-400">Email</th>
                        <th class="px-6 py-6 text-[10px] font-black uppercase tracking-[0.3em] text-gray-400">Role</th>
                        <th class="pl-4 pr-10 py-6 text-[10px] font-black uppercase tracking-[0.3em] text-gray-400 text-right">Aksi</th>
                    </tr>
                </thead>
            <tbody class="divide-y divide-gray-100">
                <template x-for="user in paginatedUsers" :key="user.id">
                    <tr class="hover:bg-gray-50 transition-colors">
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3">
                                <div class="w-9 h-9 rounded-full bg-black flex items-center justify-center text-white text-sm font-black" x-text="user.name.charAt(0).toUpperCase()"></div>
                                <p class="font-bold text-gray-900 text-sm" x-text="user.name"></p>
                            </div>
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-600" x-text="user.email"></td>
                        <td class="px-6 py-4">
                            <span class="px-2 py-1 text-[10px] font-black uppercase rounded-lg capitalize tracking-wider"
                                :class="{
                                    'bg-black text-white': user.role === 'admin',
                                    'bg-blue-50 text-blue-700': user.role === 'cashier',
                                    'bg-amber-50 text-amber-700': user.role === 'owner',
                                }" x-text="user.role"></span>
                        </td>
                        <td class="px-6 py-4 text-right">
                            <div class="flex items-center justify-end gap-2">
                                <button @click="openEditModal(user)" class="px-3 py-1.5 text-xs font-bold text-black bg-gray-100 hover:bg-black hover:text-white rounded-lg transition-all">Edit</button>
                                <button @click="openDeleteModal(user)" class="px-3 py-1.5 text-xs font-bold text-red-600 bg-red-50 hover:bg-red-600 hover:text-white rounded-lg transition-all">Hapus</button>
                            </div>
                        </td>
                    </tr>
                </template>
                <template x-if="filteredUsers.length === 0">
                    <tr><td colspan="4" class="px-6 py-10 text-center text-gray-400 text-sm font-medium">Tidak ada pengguna ditemukan.</td></tr>
                </template>
            </tbody>
        </table>
    </div>

    {{-- Pagination --}}
    <div class="flex items-center justify-between mt-4" x-show="totalPages > 1">
        <span class="text-xs font-bold text-gray-500">Halaman <span class="text-black" x-text="currentPage"></span> dari <span class="text-black" x-text="totalPages"></span></span>
        <div class="flex gap-1">
            <button @click="prevPage" :disabled="currentPage===1" class="w-9 h-9 flex items-center justify-center rounded-xl bg-white border border-gray-200 hover:bg-gray-50 disabled:opacity-40 transition-all">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
            </button>
            <button @click="nextPage" :disabled="currentPage===totalPages" class="w-9 h-9 flex items-center justify-center rounded-xl bg-white border border-gray-200 hover:bg-gray-50 disabled:opacity-40 transition-all">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
            </button>
        </div>
    </div>

    {{-- ═══ ADD MODAL ═══ --}}
    <div x-show="showAdd" x-cloak @click.self="showAdd = false"
         class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/60 backdrop-blur-sm"
         x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100">
        <div class="bg-white w-full max-w-md rounded-2xl shadow-2xl p-6" @click.stop
             x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100">
            <h3 class="text-lg font-black mb-5">Tambah Pengguna</h3>
            <form method="POST" action="{{ route('admin.users.store') }}" class="space-y-4">
                @csrf
                <div>
                    <label class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-1.5">Nama Lengkap *</label>
                    <input type="text" name="name" required class="w-full px-4 py-2.5 border border-gray-200 rounded-xl text-sm font-semibold focus:ring-2 focus:ring-black outline-none">
                </div>
                <div>
                    <label class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-1.5">Email *</label>
                    <input type="email" name="email" required class="w-full px-4 py-2.5 border border-gray-200 rounded-xl text-sm font-semibold focus:ring-2 focus:ring-black outline-none">
                </div>
                <div>
                    <label class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-1.5">Password *</label>
                    <input type="password" name="password" required minlength="8" class="w-full px-4 py-2.5 border border-gray-200 rounded-xl text-sm font-semibold focus:ring-2 focus:ring-black outline-none">
                </div>
                <div>
                    <label class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-1.5">Role *</label>
                    <select name="role" required class="w-full px-4 py-2.5 border border-gray-200 rounded-xl text-sm font-semibold focus:ring-2 focus:ring-black outline-none bg-white">
                        <option value="cashier">Kasir (Cashier)</option>
                        <option value="owner">Pemilik (Owner)</option>
                        <option value="admin">Admin</option>
                    </select>
                </div>
                <div class="flex gap-2 pt-2">
                    <button type="button" @click="showAdd = false" class="flex-1 py-2.5 text-sm font-bold text-gray-700 bg-gray-100 rounded-xl hover:bg-gray-200 transition-colors">Batal</button>
                    <button type="submit" class="flex-1 py-2.5 text-sm font-bold text-white bg-black rounded-xl hover:bg-gray-800 transition-colors">Simpan</button>
                </div>
            </form>
        </div>
    </div>

    {{-- ═══ EDIT MODAL ═══ --}}
    <div x-show="showEdit" x-cloak @click.self="showEdit = false"
         class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/60 backdrop-blur-sm"
         x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100">
        <div class="bg-white w-full max-w-md rounded-2xl shadow-2xl p-6" @click.stop
             x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100">
            <h3 class="text-lg font-black mb-5">Edit Pengguna</h3>
            <form method="POST" :action="'/admin/users/' + selected?.id" class="space-y-4">
                @csrf @method('PUT')
                <div>
                    <label class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-1.5">Nama Lengkap *</label>
                    <input type="text" name="name" :value="selected?.name" required class="w-full px-4 py-2.5 border border-gray-200 rounded-xl text-sm font-semibold focus:ring-2 focus:ring-black outline-none">
                </div>
                <div>
                    <label class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-1.5">Email *</label>
                    <input type="email" name="email" :value="selected?.email" required class="w-full px-4 py-2.5 border border-gray-200 rounded-xl text-sm font-semibold focus:ring-2 focus:ring-black outline-none">
                </div>
                <div>
                    <label class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-1.5">Password Baru (kosongkan jika tidak diganti)</label>
                    <input type="password" name="password" minlength="8" class="w-full px-4 py-2.5 border border-gray-200 rounded-xl text-sm font-semibold focus:ring-2 focus:ring-black outline-none">
                </div>
                <div>
                    <label class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-1.5">Role *</label>
                    <select name="role" required class="w-full px-4 py-2.5 border border-gray-200 rounded-xl text-sm font-semibold focus:ring-2 focus:ring-black outline-none bg-white">
                        <option value="cashier" :selected="selected?.role === 'cashier'">Kasir (Cashier)</option>
                        <option value="owner" :selected="selected?.role === 'owner'">Pemilik (Owner)</option>
                        <option value="admin" :selected="selected?.role === 'admin'">Admin</option>
                    </select>
                </div>
                <div class="flex gap-2 pt-2">
                    <button type="button" @click="showEdit = false" class="flex-1 py-2.5 text-sm font-bold text-gray-700 bg-gray-100 rounded-xl hover:bg-gray-200 transition-colors">Batal</button>
                    <button type="submit" class="flex-1 py-2.5 text-sm font-bold text-white bg-black rounded-xl hover:bg-gray-800 transition-colors">Update</button>
                </div>
            </form>
        </div>
    </div>

    {{-- ═══ DELETE MODAL ═══ --}}
    <div x-show="showDelete" x-cloak @click.self="showDelete = false"
         class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/60 backdrop-blur-sm"
         x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100">
        <div class="bg-white w-full max-w-sm rounded-2xl shadow-2xl p-6" @click.stop>
            <div class="w-12 h-12 bg-red-50 rounded-2xl flex items-center justify-center mb-4">
                <svg class="w-6 h-6 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
            </div>
            <h3 class="text-lg font-black mb-1">Hapus Pengguna?</h3>
            <p class="text-sm text-gray-500 mb-5">Akun "<span class="font-bold text-black" x-text="selected?.name"></span>" akan dihapus permanen.</p>
            <form method="POST" :action="'/admin/users/' + selected?.id">
                @csrf @method('DELETE')
                <div class="flex gap-2">
                    <button type="button" @click="showDelete = false" class="flex-1 py-2.5 text-sm font-bold text-gray-700 bg-gray-100 rounded-xl hover:bg-gray-200 transition-colors">Batal</button>
                    <button type="submit" class="flex-1 py-2.5 text-sm font-bold text-white bg-red-500 rounded-xl hover:bg-red-600 transition-colors">Ya, Hapus</button>
                </div>
            </form>
        </div>
    </div>

</div>

<script>
function userPage(initialData) {
    return {
        all: initialData,
        search: '',
        filterRole: '',
        perPage: 10,
        currentPage: 1,
        showAdd: false,
        showEdit: false,
        showDelete: false,
        selected: null,

        get filteredUsers() {
            let data = this.all;
            if (this.filterRole) data = data.filter(u => u.role === this.filterRole);
            if (this.search.trim()) {
                const q = this.search.toLowerCase();
                data = data.filter(u => u.name.toLowerCase().includes(q) || u.email.toLowerCase().includes(q));
            }
            return data;
        },
        get totalPages() { return Math.max(1, Math.ceil(this.filteredUsers.length / parseInt(this.perPage))); },
        get paginatedUsers() {
            const start = (this.currentPage - 1) * parseInt(this.perPage);
            return this.filteredUsers.slice(start, start + parseInt(this.perPage));
        },
        nextPage() { if (this.currentPage < this.totalPages) this.currentPage++; },
        prevPage() { if (this.currentPage > 1) this.currentPage--; },
        openAddModal() { this.selected = null; this.showAdd = true; },
        openEditModal(u) { this.selected = {...u}; this.showEdit = true; },
        openDeleteModal(u) { this.selected = u; this.showDelete = true; },
        init() {
            this.$watch('search', () => this.currentPage = 1);
            this.$watch('filterRole', () => this.currentPage = 1);
            this.$watch('perPage', () => this.currentPage = 1);
        }
    }
}
</script>
@endsection
