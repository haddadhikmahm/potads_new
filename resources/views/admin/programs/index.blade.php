@extends('layouts.admin')

@section('title', 'Daftar Program')

@section('header_title', 'Daftar Program Yayasan')
@section('header_breadcrumb', 'MANAGEMENT PORTAL')

@section('content')
<div class="mb-10 flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
    <div class="w-full md:w-auto">
        <h2 class="text-slate-400 text-[10px] uppercase tracking-[0.2em] font-bold mb-1">Total Program</h2>
        <p class="text-2xl font-black text-potads-blue">{{ $programs->total() }} Program</p>
    </div>

    <a href="{{ route('admin.programs.create') }}" class="bg-potads-yellow text-potads-blue px-8 py-4 rounded-full font-bold hover:bg-white transition-all shadow-lg shadow-yellow-500/20 flex items-center gap-2 transform hover:-translate-y-1">
        <i data-lucide="plus-circle" class="w-5 h-5"></i>
        Tambah Program
    </a>
</div>

<div class="bg-white rounded-[2.5rem] shadow-sm border border-slate-50 overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-left">
            <thead>
                <tr class="text-slate-400 text-[10px] uppercase tracking-[0.2em] border-b border-slate-50 bg-slate-50/30">
                    <th class="px-8 py-5 font-bold">No</th>
                    <th class="px-8 py-5 font-bold">Program</th>
                    <th class="px-8 py-5 font-bold">Dibuat</th>
                    <th class="px-8 py-5 font-bold text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="text-sm divide-y divide-slate-50">
                @forelse($programs as $index => $program)
                <tr class="hover:bg-slate-50/50 transition-colors group">
                    <td class="px-8 py-6 text-slate-400 font-medium">
                        {{ str_pad($index + 1 + ($programs->currentPage() - 1) * $programs->perPage(), 2, '0', STR_PAD_LEFT) }}
                    </td>
                    <td class="px-8 py-6">
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 rounded-xl bg-slate-100 overflow-hidden flex-shrink-0">
                                @if($program->image)
                                    <img src="{{ asset('storage/' . $program->image) }}" class="w-full h-full object-cover">
                                @else
                                    <div class="w-full h-full flex items-center justify-center text-slate-300">
                                        <i data-lucide="image" class="w-5 h-5"></i>
                                    </div>
                                @endif
                            </div>
                            <div>
                                <span class="font-bold text-slate-700 block">{{ $program->title }}</span>
                                <span class="text-[10px] text-slate-400 block">{{ Str::limit($program->description, 50) }}</span>
                            </div>
                        </div>
                    </td>
                    <td class="px-8 py-6 text-slate-500 font-medium">
                        {{ $program->created_at->format('d M Y') }}
                    </td>
                    <td class="px-8 py-6">
                        <div class="flex items-center justify-end gap-2">
                            <a href="{{ route('admin.programs.edit', $program) }}" class="p-2.5 bg-white rounded-xl text-slate-400 hover:text-potads-blue hover:shadow-md transition-all border border-slate-100" title="Edit">
                                <i data-lucide="edit-3" class="w-4 h-4"></i>
                            </a>
                            <form action="{{ route('admin.programs.destroy', $program) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus program ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="p-2.5 bg-white rounded-xl text-slate-400 hover:text-red-500 hover:shadow-md transition-all border border-slate-100" title="Hapus">
                                    <i data-lucide="trash-2" class="w-4 h-4"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="px-8 py-20 text-center">
                        <div class="flex flex-col items-center gap-3">
                            <div class="w-16 h-16 bg-slate-50 rounded-full flex items-center justify-center text-slate-200">
                                <i data-lucide="layout-grid" class="w-8 h-8"></i>
                            </div>
                            <p class="text-slate-400 italic text-sm">Belum ada program yang ditambahkan.</p>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    
    @if($programs->hasPages())
    <div class="px-8 py-6 bg-slate-50/50 border-t border-slate-50">
        {{ $programs->links() }}
    </div>
    @endif
</div>
@endsection
