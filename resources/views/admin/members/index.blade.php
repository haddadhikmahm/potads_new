@extends('layouts.admin')

@section('title', 'Daftar Member')

@section('header_title', 'Member')
@section('header_breadcrumb', 'Management Portal')

@section('content')
<div class="mb-8 flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
    <form action="{{ route('admin.members.index') }}" method="GET" class="flex gap-2 w-full md:w-auto">
        <div class="relative w-full md:w-80">
            <span class="absolute left-4 top-1/2 -translate-y-1/2 text-slate-400">
                <i data-lucide="search" class="w-4 h-4"></i>
            </span>
            <input type="text" name="search" value="{{ request('search') }}" 
                placeholder="Cari Nama, Username, Email..." 
                class="w-full pl-10 pr-4 py-2.5 bg-white border border-slate-100 rounded-xl focus:outline-none focus:ring-2 focus:ring-potads-blue/5 text-sm shadow-sm">
        </div>
        <button type="submit" class="p-2.5 bg-potads-blue text-white rounded-xl hover:bg-blue-800 transition-all flex items-center gap-2">
            <i data-lucide="filter" class="w-5 h-5"></i>
            <span class="text-xs font-bold md:hidden">Filter</span>
        </button>
        @if(request('search'))
            <a href="{{ route('admin.members.index') }}" class="p-2.5 bg-red-50 text-red-500 rounded-xl hover:bg-red-100 transition-all" title="Reset">
                <i data-lucide="rotate-ccw" class="w-5 h-5"></i>
            </a>
        @endif
    </form>

    <a href="{{ route('admin.members.create') }}" class="px-8 py-3 bg-potads-yellow text-slate-900 rounded-full font-bold shadow-lg shadow-yellow-400/20 hover:scale-[1.02] active:scale-[0.98] transition-all flex items-center gap-2">
        <i data-lucide="plus-circle" class="w-5 h-5"></i>
        Tambah Member
    </a>
</div>

<div class="bg-white rounded-[2.5rem] shadow-sm border border-slate-100 overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-left">
            <thead>
                <tr class="bg-slate-50/30 border-b border-slate-100">
                    <th class="px-8 py-6 text-[11px] font-bold text-slate-400 uppercase tracking-wider w-24">No</th>
                    <th class="px-8 py-6 text-[11px] font-bold text-slate-400 uppercase tracking-wider">Nama / Username</th>
                    <th class="px-8 py-6 text-[11px] font-bold text-slate-400 uppercase tracking-wider">Role</th>
                    <th class="px-8 py-6 text-[11px] font-bold text-slate-400 uppercase tracking-wider">Kontak</th>
                    <th class="px-8 py-6 text-[11px] font-bold text-slate-400 uppercase tracking-wider text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-50">
                @forelse($members as $member)
                <tr class="hover:bg-slate-50/50 transition-colors group">
                    <td class="px-8 py-6">
                        <span class="text-sm font-bold text-slate-400">{{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}</span>
                    </td>
                    <td class="px-8 py-6">
                        <div>
                            <p class="text-sm font-bold text-slate-700 group-hover:text-potads-blue transition-colors">{{ $member->name }}</p>
                            <p class="text-[10px] text-slate-400 font-medium lowercase">{{ $member->username }}</p>
                        </div>
                    </td>
                    <td class="px-8 py-6">
                        <span class="text-xs font-bold text-slate-500 capitalize">{{ $member->role }}</span>
                    </td>
                    <td class="px-8 py-6">
                        <div class="text-[11px] font-medium">
                            <p class="text-slate-600">{{ $member->phone ?? 'No Phone' }}</p>
                            <p class="text-slate-400 mt-0.5">{{ $member->email }}</p>
                        </div>
                    </td>
                    <td class="px-8 py-6 text-right">
                        <div class="flex items-center justify-end gap-4">
                            <a href="{{ route('admin.members.edit', $member) }}" class="text-slate-400 hover:text-potads-blue transition-colors">
                                <i data-lucide="edit-3" class="w-5 h-5"></i>
                            </a>
                            <form action="{{ route('admin.members.destroy', $member) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="button" class="text-slate-400 hover:text-red-500 transition-colors btn-delete-confirm">
                                    <i data-lucide="trash-2" class="w-5 h-5"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="px-8 py-20 text-center">
                        <div class="flex flex-col items-center gap-3 text-slate-300">
                            <i data-lucide="users" class="w-16 h-16 opacity-20"></i>
                            <p class="text-sm font-medium">Belum ada member terdaftar.</p>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($members->hasPages())
    <div class="px-8 py-6 bg-slate-50/30 border-t border-slate-50">
        {{ $members->links() }}
    </div>
    @endif
</div>
@endsection
