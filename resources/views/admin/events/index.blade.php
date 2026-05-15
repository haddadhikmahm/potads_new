@extends('layouts.admin')

@section('title', 'Daftar Event')

@section('header_title', 'Daftar Event Yayasan')
@section('header_breadcrumb', 'MANAGEMENT PORTAL')

@section('content')
<div class="mb-10 flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
    <form action="{{ route('admin.events.index') }}" method="GET" class="flex gap-2 w-full md:w-auto">
        <div class="relative w-full md:w-80">
            <span class="absolute left-4 top-1/2 -translate-y-1/2 text-slate-400">
                <i data-lucide="search" class="w-4 h-4"></i>
            </span>
            <input type="text" name="search" value="{{ request('search') }}" 
                placeholder="Cari Judul, Lokasi..." 
                class="w-full pl-10 pr-4 py-2.5 bg-white border border-slate-100 rounded-xl focus:outline-none focus:ring-2 focus:ring-potads-blue/5 text-sm shadow-sm">
        </div>
        <button type="submit" class="p-2.5 bg-potads-blue text-white rounded-xl hover:bg-blue-800 transition-all flex items-center gap-2">
            <i data-lucide="filter" class="w-5 h-5"></i>
            <span class="text-xs font-bold md:hidden">Filter</span>
        </button>
        @if(request('search'))
            <a href="{{ route('admin.events.index') }}" class="p-2.5 bg-red-50 text-red-500 rounded-xl hover:bg-red-100 transition-all" title="Reset">
                <i data-lucide="rotate-ccw" class="w-5 h-5"></i>
            </a>
        @endif
    </form>

    <a href="{{ route('admin.events.create') }}" class="bg-potads-yellow text-potads-blue px-8 py-4 rounded-full font-bold hover:bg-white transition-all shadow-lg shadow-yellow-500/20 flex items-center gap-2 transform hover:-translate-y-1">
        <i data-lucide="plus-circle" class="w-5 h-5"></i>
        Tambah Event
    </a>
</div>


<div class="bg-white rounded-[2.5rem] shadow-sm border border-slate-50 overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-left">
            <thead>
                <tr class="text-slate-400 text-[10px] uppercase tracking-[0.2em] border-b border-slate-50 bg-slate-50/30">
                    <th class="px-8 py-5 font-bold">No</th>
                    <th class="px-8 py-5 font-bold">Judul Event</th>
                    <th class="px-8 py-5 font-bold">Tanggal</th>
                    <th class="px-8 py-5 font-bold">Peserta</th>
                    <th class="px-8 py-5 font-bold">Status</th>
                    <th class="px-8 py-5 font-bold text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="text-sm divide-y divide-slate-50">
                @forelse($events as $index => $event)
                <tr class="hover:bg-slate-50/50 transition-colors group">
                    <td class="px-8 py-6 text-slate-400 font-medium">
                        {{ str_pad($index + 1 + ($events->currentPage() - 1) * $events->perPage(), 2, '0', STR_PAD_LEFT) }}
                    </td>
                    <td class="px-8 py-6">
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 rounded-xl bg-slate-100 overflow-hidden flex-shrink-0">
                                @if($event->image)
                                    <img src="{{ asset('storage/' . $event->image) }}" class="w-full h-full object-cover">
                                @else
                                    <div class="w-full h-full flex items-center justify-center text-slate-300">
                                        <i data-lucide="image" class="w-5 h-5"></i>
                                    </div>
                                @endif
                            </div>
                            <span class="font-bold text-slate-700">{{ $event->title }}</span>
                        </div>
                    </td>
                    <td class="px-8 py-6 text-slate-500 font-medium">
                        {{ \Carbon\Carbon::parse($event->event_date)->format('d M Y') }}
                    </td>
                    <td class="px-8 py-6 text-slate-500 font-bold">
                        {{ $event->attendees()->count() }} Peserta
                    </td>
                    <td class="px-8 py-6">
                        @php
                            $statusMap = [
                                'upcoming' => ['label' => 'MENDATANG', 'class' => 'bg-blue-50 text-blue-600'],
                                'ongoing' => ['label' => 'AKTIF', 'class' => 'bg-potads-yellow/20 text-orange-600'],
                                'completed' => ['label' => 'SELESAI', 'class' => 'bg-slate-100 text-slate-500'],
                                'draft' => ['label' => 'DRAFT', 'class' => 'bg-slate-50 text-slate-400'],
                            ];
                            $stat = $statusMap[$event->status] ?? $statusMap['draft'];
                        @endphp
                        <span class="px-4 py-1.5 rounded-full text-[9px] font-extrabold tracking-widest {{ $stat['class'] }}">
                            {{ $stat['label'] }}
                        </span>
                    </td>
                    <td class="px-8 py-6">
                        <div class="flex items-center justify-end gap-2">
                            <a href="{{ route('admin.events.edit', $event) }}" class="p-2.5 bg-white rounded-xl text-slate-400 hover:text-potads-blue hover:shadow-md transition-all border border-slate-100">
                                <i data-lucide="edit-3" class="w-4 h-4"></i>
                            </a>
                            <form action="{{ route('admin.events.destroy', $event) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="p-2.5 bg-white rounded-xl text-slate-400 hover:text-red-500 hover:shadow-md transition-all border border-slate-100 btn-delete-confirm">
                                    <i data-lucide="trash-2" class="w-4 h-4"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="px-8 py-20 text-center">
                        <div class="flex flex-col items-center gap-3">
                            <div class="w-16 h-16 bg-slate-50 rounded-full flex items-center justify-center text-slate-200">
                                <i data-lucide="calendar-x" class="w-8 h-8"></i>
                            </div>
                            <p class="text-slate-400 italic text-sm">Belum ada event yang ditambahkan.</p>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    
    @if($events->hasPages())
    <div class="px-8 py-6 bg-slate-50/50 border-t border-slate-50">
        {{ $events->links() }}
    </div>
    @endif
</div>
@endsection
