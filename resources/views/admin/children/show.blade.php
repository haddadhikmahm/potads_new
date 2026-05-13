@extends('layouts.admin')

@section('title', 'Detail Data Anak: ' . $child->name)

@section('header_title', 'Detail Anak')
@section('header_breadcrumb', 'Detailed Children Information')

@section('content')
<div class="max-w-5xl">
    <div class="mb-6 flex items-center justify-between">
        <a href="{{ route('admin.children.index') }}" class="inline-flex items-center gap-2 text-sm font-bold text-slate-400 hover:text-potads-blue transition-colors">
            <i data-lucide="arrow-left" class="w-4 h-4"></i> Kembali ke Daftar
        </a>
        <div class="flex items-center gap-2">
            <a href="{{ route('admin.children.edit', $child) }}" class="px-6 py-2.5 bg-potads-blue text-white rounded-xl text-xs font-bold hover:bg-blue-900 transition-all flex items-center gap-2">
                <i data-lucide="edit-3" class="w-4 h-4"></i> Edit Data
            </a>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Sidebar Info -->
        <div class="space-y-6">
            <div class="bg-white rounded-[2.5rem] p-8 shadow-sm border border-slate-100 text-center">
                <div class="w-40 h-40 rounded-[2.5rem] overflow-hidden mx-auto mb-6 border-4 border-slate-50 shadow-md">
                    @if($child->photo)
                        <img src="{{ asset('storage/' . $child->photo) }}" class="w-full h-full object-cover">
                    @else
                        <div class="w-full h-full flex items-center justify-center bg-slate-50 text-slate-200">
                            <i data-lucide="user" class="w-16 h-16"></i>
                        </div>
                    @endif
                </div>
                <h3 class="text-2xl font-black text-slate-800">{{ $child->name }}</h3>
                <p class="text-xs font-bold text-potads-blue uppercase tracking-widest mt-2 px-4 py-1.5 bg-blue-50 rounded-full inline-block">{{ $child->gender }}</p>
                
                <div class="mt-8 pt-8 border-t border-slate-50 text-left space-y-4">
                    <div>
                        <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-1">Didaftarkan Oleh</p>
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 rounded-full bg-slate-100 flex items-center justify-center text-[10px] font-bold text-slate-500">
                                {{ substr($child->user->name ?? '?', 0, 2) }}
                            </div>
                            <p class="text-sm font-bold text-slate-700">{{ $child->user->name ?? 'Tidak diketahui' }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Parent Quick Info -->
            <div class="bg-white rounded-[2.5rem] p-8 shadow-sm border border-slate-100">
                <h4 class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-6">Orang Tua / Wali</h4>
                <div class="space-y-5">
                    <div>
                        <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-1">Nama Wali</p>
                        <p class="text-sm font-bold text-slate-700">{{ $child->parent_name ?? '-' }}</p>
                    </div>
                    <div>
                        <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-1">Nomor HP</p>
                        <p class="text-sm font-bold text-slate-700">{{ $child->parent_phone ?? '-' }}</p>
                    </div>
                    <div>
                        <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-1">Pekerjaan</p>
                        <p class="text-sm font-bold text-slate-700">{{ $child->parent_job ?? '-' }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Info -->
        <div class="lg:col-span-2 space-y-6">
            <!-- Data Anak Detailed -->
            <div class="bg-white rounded-[2.5rem] p-10 shadow-sm border border-slate-100">
                <h4 class="text-[10px] font-black text-potads-blue uppercase tracking-widest mb-8 flex items-center gap-2">
                    <span class="w-8 h-px bg-potads-blue/20"></span> Informasi Detail Anak
                </h4>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-x-12 gap-y-8">
                    <div>
                        <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-1">Tanggal Lahir</p>
                        <p class="text-base font-bold text-slate-700">{{ \Carbon\Carbon::parse($child->birth_date)->format('d F Y') }}</p>
                        <p class="text-[10px] text-slate-400 mt-1 font-medium">Usia: {{ \Carbon\Carbon::parse($child->birth_date)->age }} Tahun</p>
                    </div>
                    <div>
                        <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-1">Alamat Domisili</p>
                        <p class="text-sm font-medium text-slate-600 leading-relaxed">{{ $child->address ?? '-' }}</p>
                    </div>
                    <div class="md:col-span-2">
                        <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-2">Kondisi / Kebutuhan Khusus</p>
                        <div class="bg-slate-50 rounded-2xl p-5 border border-slate-100">
                            <p class="text-sm text-slate-600 font-medium leading-relaxed">{{ $child->special_needs ?? '-' }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Pendidikan & Terapi -->
            <div class="bg-white rounded-[2.5rem] p-10 shadow-sm border border-slate-100">
                <h4 class="text-[10px] font-black text-emerald-600 uppercase tracking-widest mb-8 flex items-center gap-2">
                    <span class="w-8 h-px bg-emerald-600/20"></span> Pendidikan & Terapi
                </h4>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-x-12 gap-y-8">
                    <div>
                        <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-1">Status & Jenis Sekolah</p>
                        <p class="text-sm font-bold text-slate-700">{{ $child->school_status ?? '-' }}</p>
                        <p class="text-xs font-medium text-slate-500 mt-0.5">{{ $child->school_type ?? '-' }}</p>
                    </div>
                    <div>
                        <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-1">Terapi yang Diikuti</p>
                        <p class="text-sm font-medium text-slate-600 leading-relaxed">{{ $child->therapies ?? '-' }}</p>
                    </div>
                    <div class="md:col-span-2">
                        <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-2">Catatan Perkembangan</p>
                        <div class="bg-emerald-50/30 rounded-2xl p-6 border border-emerald-50">
                            <p class="text-sm text-slate-600 font-medium leading-relaxed">
                                {!! nl2br(e($child->development_notes ?? 'Tidak ada catatan perkembangan khusus.')) !!}
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Guardian Address -->
            <div class="bg-white rounded-[2.5rem] p-10 shadow-sm border border-slate-100">
                <h4 class="text-[10px] font-black text-yellow-600 uppercase tracking-widest mb-6 flex items-center gap-2">
                    <span class="w-8 h-px bg-yellow-600/20"></span> Alamat Orang Tua/Wali
                </h4>
                <p class="text-sm font-medium text-slate-600 leading-relaxed">
                    {{ $child->parent_address ?? '-' }}
                </p>
            </div>
        </div>
    </div>
</div>
@endsection
