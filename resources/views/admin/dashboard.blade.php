@extends('layouts.admin')

@section('title', 'Dashboard Overview')

@section('header_title', 'Dashboard Overview')
@section('header_breadcrumb', 'GENERAL OVERVIEW')

@section('content')
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-10">
    @php
        $cards = [
            ['label' => 'Total Pengguna', 'value' => $stats['users_count'], 'icon' => 'users', 'color' => 'blue'],
            ['label' => 'Total Event', 'value' => $stats['events_count'], 'icon' => 'calendar', 'color' => 'yellow'],
            ['label' => 'Total Artikel', 'value' => $stats['articles_count'], 'icon' => 'file-text', 'color' => 'green'],
            ['label' => 'Donasi Terkumpul', 'value' => 'Rp ' . number_format($stats['donations_total'], 0, ',', '.'), 'icon' => 'heart', 'color' => 'red'],
        ];
    @endphp

    @foreach($cards as $card)
    <div class="bg-white p-6 rounded-[2rem] shadow-sm border border-slate-50 flex items-center gap-5">
        <div class="w-14 h-14 rounded-2xl flex items-center justify-center 
            {{ $card['color'] === 'blue' ? 'bg-blue-50 text-blue-600' : '' }}
            {{ $card['color'] === 'yellow' ? 'bg-yellow-50 text-yellow-600' : '' }}
            {{ $card['color'] === 'green' ? 'bg-emerald-50 text-emerald-600' : '' }}
            {{ $card['color'] === 'red' ? 'bg-rose-50 text-rose-600' : '' }}">
            <i data-lucide="{{ $card['icon'] }}" class="w-7 h-7"></i>
        </div>
        <div>
            <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-1">{{ $card['label'] }}</p>
            <p class="text-2xl font-bold text-slate-900">{{ $card['value'] }}</p>
        </div>
    </div>
    @endforeach
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
    <div class="lg:col-span-2 bg-white rounded-[2.5rem] p-8 shadow-sm border border-slate-50">
        <div class="flex items-center justify-between mb-8">
            <h3 class="text-lg font-bold text-slate-900">Konten Terkini</h3>
            <a href="{{ route('admin.events.index') }}" class="text-xs font-bold text-blue-600 hover:underline">Lihat Semua</a>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="text-left border-b border-slate-50">
                        <th class="pb-4 text-[10px] font-bold text-slate-400 uppercase tracking-widest">Modul</th>
                        <th class="pb-4 text-[10px] font-bold text-slate-400 uppercase tracking-widest">Status</th>
                        <th class="pb-4 text-[10px] font-bold text-slate-400 uppercase tracking-widest text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="group hover:bg-slate-50/50 transition-colors">
                        <td class="py-4 font-semibold text-sm text-slate-700">Manajemen Event</td>
                        <td class="py-4">
                            <span class="px-3 py-1 bg-emerald-50 text-emerald-600 rounded-full text-[10px] font-bold uppercase tracking-wider">Aktif</span>
                        </td>
                        <td class="py-4 text-right pr-2">
                            <a href="{{ route('admin.events.index') }}" class="p-2 hover:bg-white rounded-lg inline-block transition-shadow shadow-sm hover:shadow text-slate-400 hover:text-blue-600">
                                <i data-lucide="external-link" class="w-4 h-4"></i>
                            </a>
                        </td>
                    </tr>
                    <tr class="group hover:bg-slate-50/50 transition-colors">
                        <td class="py-4 font-semibold text-sm text-slate-700">Berita & Artikel</td>
                        <td class="py-4">
                            <span class="px-3 py-1 bg-emerald-50 text-emerald-600 rounded-full text-[10px] font-bold uppercase tracking-wider">Aktif</span>
                        </td>
                        <td class="py-4 text-right pr-2">
                            <a href="{{ route('admin.articles.index') }}" class="p-2 hover:bg-white rounded-lg inline-block transition-shadow shadow-sm hover:shadow text-slate-400 hover:text-blue-600">
                                <i data-lucide="external-link" class="w-4 h-4"></i>
                            </a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Quick Actions / Info -->
    <div class="bg-potads-blue rounded-[2.5rem] p-8 text-white relative overflow-hidden shadow-xl shadow-blue-900/20">
        <div class="relative z-10 h-full flex flex-col justify-between">
            <div>
                <h3 class="text-xl font-bold mb-4">Butuh Bantuan?</h3>
                <p class="text-white/60 text-sm leading-relaxed mb-8">Hubungi tim pengembang jika Anda memiliki kendala atau memerlukan fitur tambahan.</p>
            </div>
            <a href="#" class="inline-flex items-center justify-center gap-2 bg-potads-yellow text-potads-blue font-bold px-6 py-4 rounded-xl hover:bg-white transition-colors">
                <i data-lucide="mail" class="w-5 h-5"></i>
                Kontak Support
            </a>
        </div>
        <!-- Decorative SVG -->
        <div class="absolute -right-10 -bottom-10 opacity-10">
            <i data-lucide="life-buoy" class="w-40 h-40"></i>
        </div>
    </div>
</div>
@endsection
