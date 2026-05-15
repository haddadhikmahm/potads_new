@extends('layouts.admin')

@section('title', 'Daftar Donasi')

@section('header_title', 'Daftar Donasi')
@section('header_breadcrumb', 'FINANCE & DONATIONS')

@section('content')
<div class="mb-8">
    <form action="{{ route('admin.donations.index') }}" method="GET" class="flex gap-2 w-full md:w-auto">
        <div class="relative w-full md:w-80">
            <span class="absolute left-4 top-1/2 -translate-y-1/2 text-slate-400">
                <i data-lucide="search" class="w-4 h-4"></i>
            </span>
            <input type="text" name="search" value="{{ request('search') }}" 
                placeholder="Cari Donatur, Catatan, Status..." 
                class="w-full pl-10 pr-4 py-2.5 bg-white border border-slate-100 rounded-xl focus:outline-none focus:ring-2 focus:ring-potads-blue/5 text-sm shadow-sm">
        </div>
        <button type="submit" class="p-2.5 bg-potads-blue text-white rounded-xl hover:bg-blue-800 transition-all flex items-center gap-2">
            <i data-lucide="filter" class="w-5 h-5"></i>
            <span class="text-xs font-bold md:hidden">Filter</span>
        </button>
        @if(request('search'))
            <a href="{{ route('admin.donations.index') }}" class="p-2.5 bg-red-50 text-red-500 rounded-xl hover:bg-red-100 transition-all" title="Reset">
                <i data-lucide="rotate-ccw" class="w-5 h-5"></i>
            </a>
        @endif
    </form>
</div>
<div class="bg-white rounded-[2.5rem] shadow-sm border border-slate-50 overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-left">
            <thead>
                <tr class="text-slate-400 text-[10px] uppercase tracking-[0.2em] border-b border-slate-50 bg-slate-50/30">
                    <th class="px-8 py-5 font-bold">No</th>
                    <th class="px-8 py-5 font-bold">Donatur</th>
                    <th class="px-8 py-5 font-bold">Nominal</th>
                    <th class="px-8 py-5 font-bold">Metode</th>
                    <th class="px-8 py-5 font-bold">Status</th>
                    <th class="px-8 py-5 font-bold">Tanggal</th>
                    <th class="px-8 py-5 font-bold text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="text-sm divide-y divide-slate-50">
                @forelse($donations as $index => $donation)
                <tr class="hover:bg-slate-50/50 transition-colors group">
                    <td class="px-8 py-6 text-slate-400 font-medium">
                        {{ str_pad($index + 1 + ($donations->currentPage() - 1) * $donations->perPage(), 2, '0', STR_PAD_LEFT) }}
                    </td>
                    <td class="px-8 py-6">
                        <div class="flex flex-col">
                            <span class="font-bold text-slate-700">{{ $donation->is_anonymous ? 'Hamba Allah' : $donation->donor_name }}</span>
                            <span class="text-[11px] text-slate-400">{{ $donation->email }}</span>
                        </div>
                    </td>
                    <td class="px-8 py-6 font-extrabold text-potads-blue">
                        Rp {{ number_format($donation->amount, 0, ',', '.') }}
                    </td>
                    <td class="px-8 py-6 text-slate-500 font-medium">
                        {{ $donation->payment_method }}
                    </td>
                    <td class="px-8 py-6">
                        @php
                            $statusClasses = [
                                'pending' => 'bg-amber-50 text-amber-600',
                                'success' => 'bg-emerald-50 text-emerald-600',
                                'failed' => 'bg-red-50 text-red-600',
                            ];
                            $statusClass = $statusClasses[$donation->payment_status] ?? 'bg-slate-50 text-slate-400';
                        @endphp
                        <span class="px-4 py-1.5 rounded-full text-[9px] font-extrabold tracking-widest {{ $statusClass }} uppercase">
                            {{ $donation->payment_status }}
                        </span>
                    </td>
                    <td class="px-8 py-6 text-slate-500 font-medium">
                        {{ $donation->created_at->format('d M Y') }}
                    </td>
                    <td class="px-8 py-6 text-right">
                        <div class="flex items-center justify-end gap-2">
                            <a href="{{ route('admin.donations.show', $donation) }}" class="p-2.5 bg-white rounded-xl text-slate-400 hover:text-potads-blue hover:shadow-md transition-all border border-slate-100" title="Lihat Detail">
                                <i data-lucide="eye" class="w-4 h-4"></i>
                            </a>
                            <form action="{{ route('admin.donations.destroy', $donation) }}" method="POST" onsubmit="return confirm('Hapus data donasi ini?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="p-2.5 bg-white rounded-xl text-slate-400 hover:text-red-500 hover:shadow-md transition-all border border-slate-100" title="Hapus">
                                    <i data-lucide="trash-2" class="w-4 h-4"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="px-8 py-10 text-center text-slate-400 italic text-xs">Belum ada donasi yang masuk.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($donations->hasPages())
    <div class="px-8 py-6 bg-slate-50/50 border-t border-slate-50">
        {{ $donations->links() }}
    </div>
    @endif
</div>
@endsection
