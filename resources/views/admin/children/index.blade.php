@extends('layouts.admin')

@section('title', 'Data Anak Down Syndrome')

@section('header_title', 'Data Anak')
@section('header_breadcrumb', 'Children Data Management')

@section('content')
<div class="bg-white rounded-[2.5rem] shadow-sm border border-slate-100 overflow-hidden">
    <div class="p-8 border-b border-slate-50 flex items-center justify-between bg-slate-50/50">
        <div>
            <h3 class="text-xl font-bold text-slate-800">Daftar Anak</h3>
            <p class="text-xs text-slate-500 mt-1">Total data anak yang terdaftar di sistem</p>
        </div>
        <a href="{{ route('admin.children.create') }}" class="px-6 py-3 bg-potads-blue text-white rounded-xl font-bold text-sm shadow-lg shadow-blue-900/20 hover:scale-[1.05] transition-all flex items-center gap-2">
            <i data-lucide="plus" class="w-4 h-4"></i> Tambah Anak
        </a>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-slate-50">
                    <th class="px-8 py-5 text-[10px] font-bold text-slate-400 uppercase tracking-widest border-b border-slate-100">Foto</th>
                    <th class="px-8 py-5 text-[10px] font-bold text-slate-400 uppercase tracking-widest border-b border-slate-100">Nama Lengkap</th>
                    <th class="px-8 py-5 text-[10px] font-bold text-slate-400 uppercase tracking-widest border-b border-slate-100">Orang Tua (User)</th>
                    <th class="px-8 py-5 text-[10px] font-bold text-slate-400 uppercase tracking-widest border-b border-slate-100">Tgl Lahir / Gender</th>
                    <th class="px-8 py-5 text-[10px] font-bold text-slate-400 uppercase tracking-widest border-b border-slate-100">Sekolah</th>
                    <th class="px-8 py-5 text-[10px] font-bold text-slate-400 uppercase tracking-widest border-b border-slate-100 text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-50">
                @forelse($children as $child)
                    <tr class="hover:bg-slate-50/50 transition-colors group">
                        <td class="px-8 py-5">
                            <div class="w-12 h-12 rounded-xl overflow-hidden bg-slate-100 border-2 border-white shadow-sm ring-1 ring-slate-100">
                                @if($child->photo)
                                    <img src="{{ asset('storage/' . $child->photo) }}" class="w-full h-full object-cover">
                                @else
                                    <div class="w-full h-full flex items-center justify-center text-slate-300">
                                        <i data-lucide="user" class="w-6 h-6"></i>
                                    </div>
                                @endif
                            </div>
                        </td>
                        <td class="px-8 py-5">
                            <p class="font-bold text-slate-700">{{ $child->name }}</p>
                        </td>
                        <td class="px-8 py-5">
                            <div class="flex items-center gap-3">
                                <div class="w-8 h-8 rounded-full bg-potads-blue/10 flex items-center justify-center text-potads-blue text-[10px] font-bold">
                                    {{ substr($child->user->name ?? '?', 0, 2) }}
                                </div>
                                <p class="text-sm font-medium text-slate-600">{{ $child->user->name ?? 'Tidak diketahui' }}</p>
                            </div>
                        </td>
                        <td class="px-8 py-5">
                            <p class="text-sm font-semibold text-slate-600">{{ \Carbon\Carbon::parse($child->birth_date)->format('d M Y') }}</p>
                            <p class="text-[10px] font-bold text-slate-400 uppercase tracking-wider">{{ $child->gender }}</p>
                        </td>
                        <td class="px-8 py-5">
                            <p class="text-sm font-medium text-slate-600">{{ $child->school ?? '-' }}</p>
                        </td>
                        <td class="px-8 py-5 text-right">
                            <div class="flex items-center justify-end gap-2 opacity-0 group-hover:opacity-100 transition-all">
                                <a href="{{ route('admin.children.show', $child) }}" class="p-2 bg-blue-50 text-blue-600 rounded-lg hover:bg-blue-100 transition-colors" title="Lihat Detail">
                                    <i data-lucide="eye" class="w-4 h-4"></i>
                                </a>
                                <a href="{{ route('admin.children.edit', $child) }}" class="p-2 bg-potads-yellow/10 text-potads-blue rounded-lg hover:bg-potads-yellow/30 transition-colors" title="Edit">
                                    <i data-lucide="edit-3" class="w-4 h-4"></i>
                                </a>
                                <form action="{{ route('admin.children.destroy', $child) }}" method="POST" class="inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="p-2 bg-red-50 text-red-600 rounded-lg hover:bg-red-100 transition-colors btn-delete-confirm" title="Hapus">
                                        <i data-lucide="trash-2" class="w-4 h-4"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-8 py-20 text-center">
                            <div class="w-20 h-20 bg-slate-50 rounded-3xl flex items-center justify-center mx-auto mb-4 text-slate-200">
                                <i data-lucide="user-minus" class="w-10 h-10"></i>
                            </div>
                            <p class="text-slate-400 font-medium">Belum ada data anak terdaftar.</p>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="px-8 py-6 bg-slate-50/50 border-t border-slate-50">
        {{ $children->links() }}
    </div>
</div>
@endsection
