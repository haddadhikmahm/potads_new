@extends('layouts.admin')

@section('title', 'Info Akademis & Medis')

@section('header_title', 'Manajemen Info')
@section('header_breadcrumb', 'Academic & Medical Information')

@section('content')
<div class="mb-8 flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
    <form action="{{ route('admin.medical-infos.index') }}" method="GET" class="flex gap-2 w-full md:w-auto">
        <div class="relative w-full md:w-80">
            <span class="absolute left-4 top-1/2 -translate-y-1/2 text-slate-400">
                <i data-lucide="search" class="w-4 h-4"></i>
            </span>
            <input type="text" name="search" value="{{ request('search') }}" 
                placeholder="Cari Judul, Kategori, Alamat..." 
                class="w-full pl-10 pr-4 py-2.5 bg-white border border-slate-100 rounded-xl focus:outline-none focus:ring-2 focus:ring-potads-blue/5 text-sm shadow-sm">
        </div>
        <button type="submit" class="p-2.5 bg-potads-blue text-white rounded-xl hover:bg-blue-800 transition-all flex items-center gap-2">
            <i data-lucide="filter" class="w-5 h-5"></i>
            <span class="text-xs font-bold md:hidden">Filter</span>
        </button>
        @if(request('search'))
            <a href="{{ route('admin.medical-infos.index') }}" class="p-2.5 bg-red-50 text-red-500 rounded-xl hover:bg-red-100 transition-all" title="Reset">
                <i data-lucide="rotate-ccw" class="w-5 h-5"></i>
            </a>
        @endif
    </form>

    <a href="{{ route('admin.medical-infos.create') }}" class="px-6 py-3 bg-potads-blue text-white rounded-xl font-bold shadow-lg shadow-blue-900/10 hover:scale-[1.02] active:scale-[0.98] transition-all flex items-center gap-2">
        <i data-lucide="plus" class="w-5 h-5"></i>
        Tambah Info
    </a>
</div>

<div class="bg-white rounded-[2.5rem] shadow-sm border border-slate-100 overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-left">
            <thead>
                <tr class="bg-slate-50/50">
                    <th class="px-8 py-4 text-[10px] font-bold text-potads-blue uppercase tracking-wider">Judul Info</th>
                    <th class="px-8 py-4 text-[10px] font-bold text-potads-blue uppercase tracking-wider">Kategori</th>
                    <th class="px-8 py-4 text-[10px] font-bold text-potads-blue uppercase tracking-wider">Alamat & Kontak</th>
                    <th class="px-8 py-4 text-[10px] font-bold text-potads-blue uppercase tracking-wider">Status</th>
                    <th class="px-8 py-4 text-[10px] font-bold text-potads-blue uppercase tracking-wider">Terakhir Diperbarui</th>
                    <th class="px-8 py-4 text-[10px] font-bold text-potads-blue uppercase tracking-wider text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-50">
                @forelse($infos as $info)
                <tr class="hover:bg-slate-50/50 transition-colors group">
                    <td class="px-8 py-5">
                        <div class="flex items-center gap-4">
                            @if($info->image)
                                <div class="w-12 h-12 rounded-xl border border-slate-100 overflow-hidden flex-shrink-0">
                                    <img src="{{ asset('storage/' . $info->image) }}" class="w-full h-full object-cover">
                                </div>
                            @endif
                            <div>
                                <p class="text-sm font-bold text-slate-900 group-hover:text-potads-blue transition-colors">{{ $info->title }}</p>
                                <p class="text-xs text-slate-400">/{{ $info->slug }}</p>
                            </div>
                        </div>
                    </td>
                    <td class="px-8 py-5">
                        @if($info->category === 'akademis')
                            <span class="px-3 py-1 bg-blue-50 text-blue-600 rounded-full text-[10px] font-bold uppercase tracking-wider">Akademis</span>
                        @else
                            <span class="px-3 py-1 bg-red-50 text-red-600 rounded-full text-[10px] font-bold uppercase tracking-wider">Medis</span>
                        @endif
                    </td>
                    <td class="px-8 py-5">
                        <div class="flex flex-col gap-1">
                            <span class="text-xs text-slate-600 flex items-center gap-1.5 font-medium">
                                <i data-lucide="map-pin" class="w-3.5 h-3.5 text-slate-400"></i>
                                {{ $info->address ?: '-' }}
                            </span>
                            <span class="text-[10px] text-slate-400 flex items-center gap-1.5">
                                <i data-lucide="phone" class="w-3 h-3"></i>
                                {{ $info->phone ?: '-' }}
                            </span>
                        </div>
                    </td>
                    <td class="px-8 py-5">
                        @if($info->status === 'published')
                            <span class="px-3 py-1 bg-green-50 text-green-600 rounded-full text-[10px] font-bold uppercase tracking-wider">Published</span>
                        @else
                            <span class="px-3 py-1 bg-slate-100 text-slate-400 rounded-full text-[10px] font-bold uppercase tracking-wider">Draft</span>
                        @endif
                    </td>
                    <td class="px-8 py-5">
                        <span class="text-sm text-slate-500">{{ $info->updated_at->format('d M Y') }}</span>
                    </td>
                    <td class="px-8 py-5 text-right">
                        <div class="flex items-center justify-end gap-2 text-slate-400">
                            <a href="{{ route('admin.medical-infos.edit', $info) }}" class="p-2 hover:bg-potads-blue/5 hover:text-potads-blue rounded-lg transition-all">
                                <i data-lucide="edit-2" class="w-5 h-5"></i>
                            </a>
                            <form action="{{ route('admin.medical-infos.destroy', $info) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="button" class="p-2 hover:bg-red-50 hover:text-red-500 rounded-lg transition-all btn-delete-confirm">
                                    <i data-lucide="trash-2" class="w-5 h-5"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="px-8 py-12 text-center">
                        <div class="flex flex-col items-center gap-3 text-slate-400">
                            <i data-lucide="activity" class="w-12 h-12 opacity-20"></i>
                            <p class="text-sm font-medium">Belum ada info yang ditambahkan.</p>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($infos->hasPages())
    <div class="px-8 py-6 bg-slate-50/30 border-t border-slate-50">
        {{ $infos->links() }}
    </div>
    @endif
</div>
@endsection
