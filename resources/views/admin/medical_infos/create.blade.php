@extends('layouts.admin')

@section('title', 'Tambah Info Baru')

@section('header_title', 'Info Baru')
@section('header_breadcrumb', 'Add New Academic/Medical Info')

@section('content')
<div class="w-full">
    <div class="bg-white rounded-[2.5rem] shadow-sm border border-slate-100 p-8 md:p-12">
        <form action="{{ route('admin.medical-infos.store') }}" method="POST" enctype="multipart/form-data" class="space-y-8">
            @csrf

            <div class="space-y-6">
                <!-- Title -->
                <div class="space-y-2">
                    <label class="text-[10px] font-bold text-potads-blue uppercase tracking-wider ml-1">Judul Informasi</label>
                    <input type="text" name="title" value="{{ old('title') }}" required
                        class="w-full px-6 py-4 bg-slate-50 border-none rounded-2xl focus:ring-2 focus:ring-potads-blue/10 transition-all text-slate-700 font-medium @error('title') ring-2 ring-red-500/20 @enderror"
                        placeholder="Masukkan judul informasi...">
                    @error('title') <p class="text-red-500 text-xs mt-1 ml-1">{{ $message }}</p> @enderror
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <!-- Category -->
                    <div class="space-y-2">
                        <label class="text-[10px] font-bold text-potads-blue uppercase tracking-wider ml-1">Kategori</label>
                        <select name="category" required
                            class="w-full px-6 py-4 bg-slate-50 border-none rounded-2xl focus:ring-2 focus:ring-potads-blue/10 transition-all text-slate-700 font-medium @error('category') ring-2 ring-red-500/20 @enderror">
                            <option value="sekolah" {{ old('category') === 'sekolah' ? 'selected' : '' }}>Sekolah</option>
                            <option value="rumah sakit" {{ old('category') === 'rumah sakit' ? 'selected' : '' }}>Rumah Sakit</option>
                            <option value="pusat tumbuh kembang" {{ old('category') === 'pusat tumbuh kembang' ? 'selected' : '' }}>Pusat Tumbuh Kembang</option>
                        </select>
                        @error('category') <p class="text-red-500 text-xs mt-1 ml-1">{{ $message }}</p> @enderror
                    </div>

                    <!-- Status -->
                    <div class="space-y-2">
                        <label class="text-[10px] font-bold text-potads-blue uppercase tracking-wider ml-1">Status Publikasi</label>
                        <select name="status" required
                            class="w-full px-6 py-4 bg-slate-50 border-none rounded-2xl focus:ring-2 focus:ring-potads-blue/10 transition-all text-slate-700 font-medium @error('status') ring-2 ring-red-500/20 @enderror">
                            <option value="draft" {{ old('status') === 'draft' ? 'selected' : '' }}>Simpan sebagai Draft</option>
                            <option value="published" {{ old('status') === 'published' ? 'selected' : '' }}>Langsung Publish</option>
                        </select>
                        @error('status') <p class="text-red-500 text-xs mt-1 ml-1">{{ $message }}</p> @enderror
                    </div>
                </div>

                <!-- Image -->
                <div class="space-y-2">
                    <label class="text-[10px] font-bold text-potads-blue uppercase tracking-wider ml-1">Gambar Sampul (Opsional)</label>
                    <input type="file" name="image"
                        class="w-full px-6 py-4 bg-slate-50 border-none rounded-2xl focus:ring-2 focus:ring-potads-blue/10 transition-all text-slate-700 font-medium file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-xs file:font-bold file:bg-potads-blue/10 file:text-potads-blue hover:file:bg-potads-blue/20">
                    @error('image') <p class="text-red-500 text-xs mt-1 ml-1">{{ $message }}</p> @enderror
                </div>

                <!-- Content -->
                <div class="space-y-2">
                    <label class="text-[10px] font-bold text-potads-blue uppercase tracking-wider ml-1">Konten Informasi</label>
                    <textarea name="content" rows="10" required
                        class="w-full px-6 py-4 bg-slate-50 border-none rounded-2xl focus:ring-2 focus:ring-potads-blue/10 transition-all text-slate-700 font-medium @error('content') ring-2 ring-red-500/20 @enderror"
                        placeholder="Tuliskan isi informasi di sini...">{{ old('content') }}</textarea>
                    @error('content') <p class="text-red-500 text-xs mt-1 ml-1">{{ $message }}</p> @enderror
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                    <!-- Address -->
                    <div class="space-y-2 lg:col-span-1">
                        <label class="text-[10px] font-bold text-potads-blue uppercase tracking-wider ml-1">Alamat Lengkap</label>
                        <input type="text" name="address" value="{{ old('address') }}"
                            class="w-full px-6 py-4 bg-slate-50 border-none rounded-2xl focus:ring-2 focus:ring-potads-blue/10 transition-all text-slate-700 font-medium @error('address') ring-2 ring-red-500/20 @enderror"
                            placeholder="Jl. Contoh No. 123">
                        @error('address') <p class="text-red-500 text-xs mt-1 ml-1">{{ $message }}</p> @enderror
                    </div>

                    <!-- Regency -->
                    <div class="space-y-2 lg:col-span-1">
                        <label class="text-[10px] font-bold text-potads-blue uppercase tracking-wider ml-1">Kabupaten/Kota</label>
                        <input type="text" name="regency" value="{{ old('regency') }}"
                            class="w-full px-6 py-4 bg-slate-50 border-none rounded-2xl focus:ring-2 focus:ring-potads-blue/10 transition-all text-slate-700 font-medium"
                            placeholder="Contoh: Bandung">
                    </div>

                    <!-- District -->
                    <div class="space-y-2 lg:col-span-1">
                        <label class="text-[10px] font-bold text-potads-blue uppercase tracking-wider ml-1">Kecamatan</label>
                        <input type="text" name="district" value="{{ old('district') }}"
                            class="w-full px-6 py-4 bg-slate-50 border-none rounded-2xl focus:ring-2 focus:ring-potads-blue/10 transition-all text-slate-700 font-medium"
                            placeholder="Contoh: Coblong">
                    </div>

                    <!-- Phone -->
                    <div class="space-y-2 lg:col-span-1">
                        <label class="text-[10px] font-bold text-potads-blue uppercase tracking-wider ml-1">Nomor Kontak</label>
                        <input type="text" name="phone" value="{{ old('phone') }}"
                            class="w-full px-6 py-4 bg-slate-50 border-none rounded-2xl focus:ring-2 focus:ring-potads-blue/10 transition-all text-slate-700 font-medium"
                            placeholder="08123456789">
                    </div>
                </div>
            </div>

            <div class="flex items-center gap-4 pt-6">
                <button type="submit" class="px-10 py-4 bg-potads-blue text-white rounded-2xl font-bold shadow-lg shadow-blue-900/20 hover:scale-[1.02] active:scale-[0.98] transition-all">
                    Simpan Informasi
                </button>
                <a href="{{ route('admin.medical-infos.index') }}" class="px-10 py-4 bg-white border-2 border-slate-100 text-slate-500 rounded-2xl font-bold hover:bg-slate-50 transition-all">
                    Batal
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
