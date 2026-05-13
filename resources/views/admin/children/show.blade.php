@extends('layouts.admin')

@section('title', 'Detail Anak: ' . $child->name)

@section('header_title', 'Detail Anak')
@section('header_breadcrumb', 'View Children Information')

@section('content')
<div class="max-w-4xl">
    <div class="mb-6 flex items-center justify-between">
        <a href="{{ route('admin.children.index') }}" class="inline-flex items-center gap-2 text-sm font-bold text-slate-400 hover:text-potads-blue transition-colors">
            <i data-lucide="arrow-left" class="w-4 h-4"></i> Kembali ke Daftar
        </a>
        <div class="flex items-center gap-2">
            <a href="{{ route('admin.children.edit', $child) }}" class="px-4 py-2 bg-potads-blue text-white rounded-xl text-xs font-bold hover:bg-blue-900 transition-colors">
                Edit Data
            </a>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
        <!-- Sidebar Info -->
        <div class="space-y-6">
            <div class="bg-white rounded-[2rem] p-6 shadow-sm border border-slate-100 text-center">
                <div class="w-32 h-32 rounded-3xl overflow-hidden mx-auto mb-4 border-4 border-slate-50 shadow-sm">
                    @if($child->photo)
                        <img src="{{ asset('storage/' . $child->photo) }}" class="w-full h-full object-cover">
                    @else
                        <div class="w-full h-full flex items-center justify-center bg-slate-50 text-slate-200">
                            <i data-lucide="user" class="w-12 h-12"></i>
                        </div>
                    @endif
                </div>
                <h3 class="text-xl font-bold text-slate-800">{{ $child->name }}</h3>
                <p class="text-xs font-bold text-potads-blue uppercase tracking-wider mt-1">{{ $child->gender }}</p>
            </div>

            <div class="bg-white rounded-[2rem] p-6 shadow-sm border border-slate-100">
                <h4 class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-4">Orang Tua</h4>
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-potads-blue text-white rounded-full flex items-center justify-center text-xs font-bold">
                        {{ substr($child->user->name ?? '?', 0, 2) }}
                    </div>
                    <div>
                        <p class="text-sm font-bold text-slate-700">{{ $child->user->name ?? 'Tidak diketahui' }}</p>
                        <p class="text-[10px] text-slate-400 font-medium">{{ $child->user->email ?? '-' }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Info -->
        <div class="md:col-span-2 space-y-6">
            <div class="bg-white rounded-[2.5rem] p-8 md:p-10 shadow-sm border border-slate-100">
                <div class="grid grid-cols-2 gap-8">
                    <div>
                        <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-1">Tanggal Lahir</p>
                        <p class="text-sm font-bold text-slate-700">{{ \Carbon\Carbon::parse($child->birth_date)->format('d F Y') }}</p>
                        <p class="text-[10px] text-slate-400 mt-1">Usia: {{ \Carbon\Carbon::parse($child->birth_date)->age }} Tahun</p>
                    </div>
                    <div>
                        <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-1">Sekolah / Pendidikan</p>
                        <p class="text-sm font-bold text-slate-700">{{ $child->school ?? '-' }}</p>
                    </div>
                    <div class="col-span-2">
                        <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-1">Hobi & Ketertarikan</p>
                        <p class="text-sm font-medium text-slate-600 leading-relaxed">{{ $child->hobby ?? '-' }}</p>
                    </div>
                </div>

                <div class="mt-10 pt-10 border-t border-slate-50">
                    <p class="text-[10px] font-bold text-red-400 uppercase tracking-widest mb-3 flex items-center gap-2">
                        <i data-lucide="alert-circle" class="w-3 h-3"></i> Catatan Medis / Khusus
                    </p>
                    <div class="bg-red-50/30 rounded-2xl p-6 border border-red-50">
                        <p class="text-sm text-slate-600 font-medium leading-relaxed">
                            {!! nl2br(e($child->medical_notes ?? 'Tidak ada catatan medis khusus.')) !!}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
