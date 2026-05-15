@extends('layouts.admin')

@section('title', 'Detail Event & Peserta')

@section('header_title', 'Detail Event')
@section('header_breadcrumb', 'Peserta Event: ' . $event->title)

@section('content')
<div class="space-y-8">
    <!-- Event Overview Card -->
    <div class="bg-white rounded-[2.5rem] shadow-sm border border-slate-100 overflow-hidden">
        <div class="p-8 md:p-12 flex flex-col md:flex-row gap-10">
            <div class="w-full md:w-1/3">
                <div class="aspect-video rounded-[2rem] overflow-hidden bg-slate-100 shadow-inner">
                    @if($event->image)
                        <img src="{{ asset('storage/' . $event->image) }}" class="w-full h-full object-cover">
                    @else
                        <div class="w-full h-full flex items-center justify-center text-slate-300">
                            <i data-lucide="image" class="w-12 h-12"></i>
                        </div>
                    @endif
                </div>
            </div>
            <div class="flex-1 space-y-6">
                <div>
                    <span class="px-4 py-1.5 rounded-full text-[9px] font-extrabold tracking-widest bg-potads-blue/10 text-potads-blue uppercase mb-4 inline-block">
                        {{ $event->status }}
                    </span>
                    <h2 class="text-3xl font-black text-slate-800">{{ $event->title }}</h2>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 rounded-2xl bg-slate-50 flex items-center justify-center text-potads-blue shadow-sm">
                            <i data-lucide="calendar" class="w-6 h-6"></i>
                        </div>
                        <div>
                            <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Tanggal Event</p>
                            <p class="text-sm font-bold text-slate-700">{{ \Carbon\Carbon::parse($event->event_date)->format('d F Y') }}</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 rounded-2xl bg-slate-50 flex items-center justify-center text-potads-blue shadow-sm">
                            <i data-lucide="map-pin" class="w-6 h-6"></i>
                        </div>
                        <div>
                            <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Lokasi</p>
                            <p class="text-sm font-bold text-slate-700">{{ $event->location ?: 'Online / Tidak Ditentukan' }}</p>
                        </div>
                    </div>
                </div>

                <div class="pt-6 border-t border-slate-50">
                    <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-2">Deskripsi</p>
                    <p class="text-sm text-slate-600 leading-relaxed">{{ $event->description ?: 'Tidak ada deskripsi.' }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Participants Table -->
    <div class="space-y-4">
        <div class="flex items-center justify-between px-4">
            <h3 class="text-xl font-black text-slate-800">Daftar Peserta <span class="text-potads-blue">({{ $event->attendees->count() }})</span></h3>
            @if($event->attendees->count() > 0)
                <button class="text-sm font-bold text-potads-blue hover:underline flex items-center gap-2">
                    <i data-lucide="download" class="w-4 h-4"></i> Export Data (Coming Soon)
                </button>
            @endif
        </div>

        <div class="bg-white rounded-[2.5rem] shadow-sm border border-slate-50 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead>
                        <tr class="text-slate-400 text-[10px] uppercase tracking-[0.2em] border-b border-slate-50 bg-slate-50/30">
                            <th class="px-8 py-5 font-bold">No</th>
                            <th class="px-8 py-5 font-bold">Nama Lengkap</th>
                            <th class="px-8 py-5 font-bold">Email / Username</th>
                            <th class="px-8 py-5 font-bold">No. WhatsApp</th>
                            <th class="px-8 py-5 font-bold">Tgl Daftar</th>
                            <th class="px-8 py-5 font-bold text-right">Status</th>
                        </tr>
                    </thead>
                    <tbody class="text-sm divide-y divide-slate-50">
                        @forelse($event->attendees as $index => $user)
                        <tr class="hover:bg-slate-50/50 transition-colors group">
                            <td class="px-8 py-6 text-slate-400 font-medium">
                                {{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}
                            </td>
                            <td class="px-8 py-6">
                                <div class="flex items-center gap-3">
                                    <div class="w-8 h-8 rounded-full bg-potads-blue/10 flex items-center justify-center text-potads-blue text-[10px] font-bold">
                                        {{ substr($user->name, 0, 2) }}
                                    </div>
                                    <span class="font-bold text-slate-700">{{ $user->name }}</span>
                                </div>
                            </td>
                            <td class="px-8 py-6">
                                <div class="flex flex-col">
                                    <span class="text-slate-600">{{ $user->email }}</span>
                                    <span class="text-[10px] text-slate-400">@ {{ $user->username }}</span>
                                </div>
                            </td>
                            <td class="px-8 py-6 text-slate-500 font-medium">
                                {{ $user->phone ?: '-' }}
                            </td>
                            <td class="px-8 py-6 text-slate-400 text-xs">
                                {{ $user->pivot->created_at->format('d/m/Y H:i') }}
                            </td>
                            <td class="px-8 py-6 text-right">
                                <span class="px-3 py-1 rounded-full text-[9px] font-extrabold bg-emerald-50 text-emerald-600 uppercase tracking-widest">
                                    {{ $user->pivot->status }}
                                </span>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="px-8 py-20 text-center">
                                <div class="flex flex-col items-center gap-3 text-slate-300">
                                    <i data-lucide="users" class="w-16 h-16 opacity-20"></i>
                                    <p class="text-sm font-medium">Belum ada peserta yang mendaftar.</p>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="flex justify-start">
        <a href="{{ route('admin.events.index') }}" class="px-8 py-4 bg-white border-2 border-slate-100 text-slate-500 rounded-2xl font-bold hover:bg-slate-50 transition-all flex items-center gap-2">
            <i data-lucide="arrow-left" class="w-5 h-5"></i> Kembali ke Daftar
        </a>
    </div>
</div>
@endsection
