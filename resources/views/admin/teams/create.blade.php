@extends('layouts.admin')

@section('title', 'Tambah Tim Baru')

@section('header_title', 'Anggota Baru')
@section('header_breadcrumb', 'Manajemen Tim')

@section('content')
<div class="max-w-4xl">
    <div class="bg-white rounded-[2.5rem] shadow-sm border border-slate-100 p-8 md:p-12">
        <form action="{{ route('admin.teams.store') }}" method="POST" enctype="multipart/form-data" class="space-y-8">
            @csrf

            <div class="space-y-6">
                <!-- Name -->
                <div class="space-y-2">
                    <label class="text-[10px] font-bold text-potads-blue uppercase tracking-wider ml-1">Nama Lengkap</label>
                    <input type="text" name="name" value="{{ old('name') }}" required
                        class="w-full px-6 py-4 bg-slate-50 border-none rounded-2xl focus:ring-2 focus:ring-potads-blue/10 transition-all text-slate-700 font-medium @error('name') ring-2 ring-red-500/20 @enderror"
                        placeholder="Contoh: Dr. Sarah Widjaja">
                    @error('name') <p class="text-red-500 text-xs mt-1 ml-1">{{ $message }}</p> @enderror
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <!-- Role -->
                    <div class="space-y-2">
                        <label class="text-[10px] font-bold text-potads-blue uppercase tracking-wider ml-1">Jabatan / Peran</label>
                        <input type="text" name="role" value="{{ old('role') }}" required
                            class="w-full px-6 py-4 bg-slate-50 border-none rounded-2xl focus:ring-2 focus:ring-potads-blue/10 transition-all text-slate-700 font-medium @error('role') ring-2 ring-red-500/20 @enderror"
                            placeholder="Contoh: PENDIRI & DIREKTUR EKSEKUTIF">
                        @error('role') <p class="text-red-500 text-xs mt-1 ml-1">{{ $message }}</p> @enderror
                    </div>

                    <!-- Order -->
                    <div class="space-y-2">
                        <label class="text-[10px] font-bold text-potads-blue uppercase tracking-wider ml-1">Urutan (Order)</label>
                        <input type="number" name="order" value="{{ old('order', 0) }}" required
                            class="w-full px-6 py-4 bg-slate-50 border-none rounded-2xl focus:ring-2 focus:ring-potads-blue/10 transition-all text-slate-700 font-medium @error('order') ring-2 ring-red-500/20 @enderror"
                            placeholder="0">
                        <p class="text-xs text-slate-400 mt-1 ml-1">Angka lebih kecil akan tampil lebih dulu.</p>
                        @error('order') <p class="text-red-500 text-xs mt-1 ml-1">{{ $message }}</p> @enderror
                    </div>
                </div>

                <!-- Description -->
                <div class="space-y-2">
                    <label class="text-[10px] font-bold text-potads-blue uppercase tracking-wider ml-1">Deskripsi Singkat</label>
                    <textarea name="description" rows="3"
                        class="w-full px-6 py-4 bg-slate-50 border-none rounded-2xl focus:ring-2 focus:ring-potads-blue/10 transition-all text-slate-700 font-medium @error('description') ring-2 ring-red-500/20 @enderror"
                        placeholder="Contoh: Memimpin dengan empati dan pengalaman riset pendidikan selama 15 tahun.">{{ old('description') }}</textarea>
                    @error('description') <p class="text-red-500 text-xs mt-1 ml-1">{{ $message }}</p> @enderror
                </div>

                <!-- Image -->
                <div class="space-y-2">
                    <label class="text-[10px] font-bold text-potads-blue uppercase tracking-wider ml-1">Foto Profil</label>
                    <input type="file" name="image" accept="image/*"
                        class="w-full px-6 py-4 bg-slate-50 border-none rounded-2xl focus:ring-2 focus:ring-potads-blue/10 transition-all text-slate-700 font-medium file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-xs file:font-bold file:bg-potads-blue/10 file:text-potads-blue hover:file:bg-potads-blue/20">
                    @error('image') <p class="text-red-500 text-xs mt-1 ml-1">{{ $message }}</p> @enderror
                </div>

                <!-- Status -->
                <div class="flex items-center gap-3 bg-slate-50 p-4 rounded-2xl">
                    <input type="checkbox" name="is_active" id="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }}
                        class="w-5 h-5 text-potads-blue bg-white border-slate-300 rounded focus:ring-potads-blue focus:ring-2">
                    <label for="is_active" class="text-sm font-bold text-slate-700 cursor-pointer">
                        Aktifkan Anggota Tim
                    </label>
                </div>
            </div>

            <div class="flex items-center gap-4 pt-6">
                <button type="submit" class="px-10 py-4 bg-potads-blue text-white rounded-2xl font-bold shadow-lg shadow-blue-900/20 hover:scale-[1.02] active:scale-[0.98] transition-all">
                    Simpan Anggota
                </button>
                <a href="{{ route('admin.teams.index') }}" class="px-10 py-4 bg-white border-2 border-slate-100 text-slate-500 rounded-2xl font-bold hover:bg-slate-50 transition-all">
                    Batal
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
