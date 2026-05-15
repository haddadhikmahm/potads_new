@extends('layouts.admin')

@section('title', 'Manajemen Tim Yayasan')

@section('header_title', 'Tim Yayasan')
@section('header_breadcrumb', 'Manajemen Tim')

@section('content')
<div class="space-y-6">
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
        <div class="flex flex-col">
            <h3 class="text-lg font-bold text-slate-800">Daftar Tim Yayasan</h3>
        </div>

        <div class="flex items-center gap-4 w-full md:w-auto">
            <form action="{{ route('admin.teams.index') }}" method="GET" class="flex gap-2 w-full md:w-auto">
                <div class="relative w-full md:w-64">
                    <span class="absolute left-3 top-1/2 -translate-y-1/2 text-slate-400">
                        <i data-lucide="search" class="w-4 h-4"></i>
                    </span>
                    <input type="text" name="search" value="{{ request('search') }}" 
                        placeholder="Cari nama, jabatan..." 
                        class="w-full pl-9 pr-4 py-2 bg-white border border-slate-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-potads-blue/5 text-sm shadow-sm">
                </div>
                <button type="submit" class="p-2 bg-potads-blue text-white rounded-lg hover:bg-blue-800 transition-all">
                    <i data-lucide="filter" class="w-4 h-4"></i>
                </button>
                @if(request('search'))
                    <a href="{{ route('admin.teams.index') }}" class="p-2 bg-red-50 text-red-500 rounded-lg hover:bg-red-100 transition-all">
                        <i data-lucide="rotate-ccw" class="w-4 h-4"></i>
                    </a>
                @endif
            </form>

            <a href="{{ route('admin.teams.create') }}" class="px-6 py-2.5 bg-potads-blue text-white rounded-xl font-bold hover:bg-blue-900 transition-all shadow-sm flex items-center gap-2 text-sm flex-shrink-0">
                <i data-lucide="plus" class="w-4 h-4"></i>
                Tambah Anggota
            </a>
        </div>
    </div>

    <div class="bg-white rounded-3xl shadow-sm border border-slate-100 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-slate-50 border-b border-slate-100">
                        <th class="py-4 px-6 text-xs font-bold text-slate-400 uppercase tracking-wider">No</th>
                        <th class="py-4 px-6 text-xs font-bold text-slate-400 uppercase tracking-wider">Profil</th>
                        <th class="py-4 px-6 text-xs font-bold text-slate-400 uppercase tracking-wider">Nama & Jabatan</th>
                        <th class="py-4 px-6 text-xs font-bold text-slate-400 uppercase tracking-wider">Status</th>
                        <th class="py-4 px-6 text-xs font-bold text-slate-400 uppercase tracking-wider text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-50">
                    @forelse($teams as $team)
                        <tr class="hover:bg-slate-50/50 transition-colors">
                            <td class="py-4 px-6 text-sm text-slate-500">{{ $loop->iteration }}</td>
                            <td class="py-4 px-6">
                                @if($team->image)
                                    <img src="{{ asset('storage/' . $team->image) }}" alt="{{ $team->name }}" class="w-12 h-12 rounded-full object-cover border-2 border-white shadow-sm">
                                @else
                                    <div class="w-12 h-12 rounded-full bg-potads-blue text-white flex items-center justify-center font-bold shadow-sm">
                                        {{ substr($team->name, 0, 1) }}
                                    </div>
                                @endif
                            </td>
                            <td class="py-4 px-6">
                                <p class="text-sm font-bold text-slate-800">{{ $team->name }}</p>
                                <p class="text-xs text-slate-500 mt-0.5">{{ $team->role }}</p>
                            </td>
                            <td class="py-4 px-6">
                                @if($team->is_active)
                                    <span class="px-3 py-1 bg-emerald-50 text-emerald-600 rounded-full text-xs font-bold border border-emerald-100">Aktif</span>
                                @else
                                    <span class="px-3 py-1 bg-red-50 text-red-600 rounded-full text-xs font-bold border border-red-100">Tidak Aktif</span>
                                @endif
                            </td>
                            <td class="py-4 px-6 text-right">
                                <div class="flex items-center justify-end gap-2">
                                    <a href="{{ route('admin.teams.edit', $team) }}" class="p-2 text-potads-blue hover:bg-blue-50 rounded-lg transition-colors" title="Edit">
                                        <i data-lucide="edit-2" class="w-4 h-4"></i>
                                    </a>
                                    <form action="{{ route('admin.teams.destroy', $team) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="p-2 text-red-500 hover:bg-red-50 rounded-lg transition-colors btn-delete-confirm" title="Hapus">
                                            <i data-lucide="trash-2" class="w-4 h-4"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="py-8 px-6 text-center text-slate-400 font-medium">Belum ada data anggota tim.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
