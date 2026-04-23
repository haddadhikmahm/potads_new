@extends('layouts.admin')

@section('title', 'Daftar Artikel')

@section('header_title', 'Daftar Artikel')
@section('header_breadcrumb', 'MANAGEMENT PORTAL')

@section('content')
<div class="mb-10 flex justify-end">
    <a href="{{ route('admin.articles.create') }}" class="bg-potads-yellow text-potads-blue px-8 py-4 rounded-full font-bold hover:bg-white transition-all shadow-lg shadow-yellow-500/20 flex items-center gap-2 transform hover:-translate-y-1">
        <i data-lucide="plus-circle" class="w-5 h-5"></i>
        Tambah Artikel
    </a>
</div>


<!-- Section 1: Approval Artikel User -->
<div class="mb-12">
    <div class="flex items-center gap-2 mb-6 ml-2">
        <div class="w-2 h-6 bg-blue-600 rounded-full"></div>
        <h3 class="text-sm font-extrabold text-slate-800 uppercase tracking-widest">Approval Artikel User</h3>
    </div>
    
    <div class="bg-white rounded-[2.5rem] shadow-sm border border-slate-50 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead>
                    <tr class="text-slate-400 text-[10px] uppercase tracking-[0.2em] border-b border-slate-50 bg-slate-50/30">
                        <th class="px-8 py-5 font-bold">No</th>
                        <th class="px-8 py-5 font-bold">Judul Artikel</th>
                        <th class="px-8 py-5 font-bold">Tanggal Upload</th>
                        <th class="px-8 py-5 font-bold">Status</th>
                        <th class="px-8 py-5 font-bold text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="text-sm divide-y divide-slate-50">
                    @php 
                        $approvalArticles = $articles->filter(function($a) { return $a->author->role === 'user'; }); 
                    @endphp
                    @forelse($approvalArticles as $index => $article)
                    <tr class="hover:bg-slate-50/50 transition-colors group">
                        <td class="px-8 py-6 text-slate-400 font-medium">{{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}</td>
                        <td class="px-8 py-6">
                            <div class="flex items-center gap-4">
                                <div class="w-10 h-10 rounded-xl bg-slate-100 overflow-hidden flex-shrink-0">
                                    @if($article->image)
                                        <img src="{{ asset('storage/' . $article->image) }}" class="w-full h-full object-cover">
                                    @else
                                        <div class="w-full h-full flex items-center justify-center text-slate-300">
                                            <i data-lucide="file-text" class="w-4 h-4"></i>
                                        </div>
                                    @endif
                                </div>
                                <span class="font-bold text-slate-700">{{ $article->title }}</span>
                            </div>
                        </td>
                        <td class="px-8 py-6 text-slate-500 font-medium">
                            {{ $article->created_at->format('d M Y') }}
                        </td>
                        <td class="px-8 py-6">
                            @php
                                $statusClass = [
                                    'published' => 'bg-emerald-50 text-emerald-600',
                                    'draft' => 'bg-amber-50 text-amber-600',
                                    'pending' => 'bg-blue-50 text-blue-600', // hypothetical
                                ][$article->status] ?? 'bg-slate-50 text-slate-400';
                            @endphp
                            <span class="px-4 py-1.5 rounded-full text-[9px] font-extrabold tracking-widest {{ $statusClass }} uppercase">
                                {{ $article->status }}
                            </span>
                        </td>
                        <td class="px-8 py-6">
                            <div class="flex items-center justify-end gap-2">
                                <a href="{{ route('admin.articles.edit', $article) }}" class="p-2.5 bg-white rounded-xl text-slate-400 hover:text-potads-blue hover:shadow-md transition-all border border-slate-100">
                                    <i data-lucide="edit-3" class="w-4 h-4"></i>
                                </a>
                                <form action="{{ route('admin.articles.destroy', $article) }}" method="POST">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="p-2.5 bg-white rounded-xl text-slate-400 hover:text-red-500 hover:shadow-md transition-all border border-slate-100 btn-delete-confirm">
                                        <i data-lucide="trash-2" class="w-4 h-4"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-8 py-10 text-center text-slate-400 italic text-xs">Tidak ada antrian persetujuan.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Section 2: Daftar Artikel -->
<div>
    <div class="flex items-center gap-2 mb-6 ml-2">
        <div class="w-2 h-6 bg-potads-yellow rounded-full"></div>
        <h3 class="text-sm font-extrabold text-slate-800 uppercase tracking-widest">Daftar Artikel</h3>
    </div>
    
    <div class="bg-white rounded-[2.5rem] shadow-sm border border-slate-50 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead>
                    <tr class="text-slate-400 text-[10px] uppercase tracking-[0.2em] border-b border-slate-50 bg-slate-50/30">
                        <th class="px-8 py-5 font-bold">No</th>
                        <th class="px-8 py-5 font-bold">Judul Artikel</th>
                        <th class="px-8 py-5 font-bold">Tanggal</th>
                        <th class="px-8 py-5 font-bold">Status</th>
                        <th class="px-8 py-5 font-bold text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="text-sm divide-y divide-slate-50">
                    @forelse($articles as $index => $article)
                    <tr class="hover:bg-slate-50/50 transition-colors group">
                        <td class="px-8 py-6 text-slate-400 font-medium">
                            {{ str_pad($index + 1 + ($articles->currentPage() - 1) * $articles->perPage(), 2, '0', STR_PAD_LEFT) }}
                        </td>
                        <td class="px-8 py-6">
                            <div class="flex items-center gap-4">
                                <div class="w-10 h-10 rounded-xl bg-slate-100 overflow-hidden flex-shrink-0">
                                    @if($article->image)
                                        <img src="{{ asset('storage/' . $article->image) }}" class="w-full h-full object-cover">
                                    @else
                                        <div class="w-full h-full flex items-center justify-center text-slate-300">
                                            <i data-lucide="file-text" class="w-4 h-4"></i>
                                        </div>
                                    @endif
                                </div>
                                <span class="font-bold text-slate-700">{{ $article->title }}</span>
                            </div>
                        </td>
                        <td class="px-8 py-6 text-slate-500 font-medium">
                            {{ $article->created_at->format('d M Y') }}
                        </td>
                        <td class="px-8 py-6">
                            <span class="px-4 py-1.5 rounded-full text-[9px] font-extrabold tracking-widest {{ $article->status === 'published' ? 'bg-emerald-50 text-emerald-600' : 'bg-slate-50 text-slate-400' }} uppercase">
                                {{ $article->status }}
                            </span>
                        </td>
                        <td class="px-8 py-6 text-right">
                            <div class="flex items-center justify-end gap-2">
                                <a href="{{ route('admin.articles.edit', $article) }}" class="p-2.5 bg-white rounded-xl text-slate-400 hover:text-potads-blue hover:shadow-md transition-all border border-slate-100">
                                    <i data-lucide="edit-3" class="w-4 h-4"></i>
                                </a>
                                <form action="{{ route('admin.articles.destroy', $article) }}" method="POST" onsubmit="return confirm('Hapus artikel ini?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="p-2.5 bg-white rounded-xl text-slate-400 hover:text-red-500 hover:shadow-md transition-all border border-slate-100">
                                        <i data-lucide="trash-2" class="w-4 h-4"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-8 py-10 text-center text-slate-400 italic text-xs">Belum ada artikel.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($articles->hasPages())
        <div class="px-8 py-6 bg-slate-50/50 border-t border-slate-50">
            {{ $articles->links() }}
        </div>
        @endif
    </div>
</div>
@endsection
