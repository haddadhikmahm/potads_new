@extends('layouts.admin')

@section('title', 'Edit Info')

@section('header_title', 'Edit Info')
@section('header_breadcrumb', 'Edit Academic/Medical Info')

@section('content')
<div class="w-full">
    <div class="bg-white rounded-[2.5rem] shadow-sm border border-slate-100 p-8 md:p-12">
        <form action="{{ route('admin.medical-infos.update', $medicalInfo) }}" method="POST" enctype="multipart/form-data" class="space-y-8">
            @csrf
            @method('PUT')

            <div class="space-y-6">
                <!-- Title -->
                <div class="space-y-2">
                    <label class="text-[10px] font-bold text-potads-blue uppercase tracking-wider ml-1">Judul Informasi</label>
                    <input type="text" name="title" value="{{ old('title', $medicalInfo->title) }}" required
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
                            <option value="sekolah" {{ old('category', $medicalInfo->category) === 'sekolah' ? 'selected' : '' }}>Sekolah</option>
                            <option value="rumah sakit" {{ old('category', $medicalInfo->category) === 'rumah sakit' ? 'selected' : '' }}>Rumah Sakit</option>
                            <option value="pusat tumbuh kembang" {{ old('category', $medicalInfo->category) === 'pusat tumbuh kembang' ? 'selected' : '' }}>Pusat Tumbuh Kembang</option>
                        </select>
                        @error('category') <p class="text-red-500 text-xs mt-1 ml-1">{{ $message }}</p> @enderror
                    </div>

                    <!-- Status -->
                    <div class="space-y-2">
                        <label class="text-[10px] font-bold text-potads-blue uppercase tracking-wider ml-1">Status Publikasi</label>
                        <select name="status" required
                            class="w-full px-6 py-4 bg-slate-50 border-none rounded-2xl focus:ring-2 focus:ring-potads-blue/10 transition-all text-slate-700 font-medium @error('status') ring-2 ring-red-500/20 @enderror">
                            <option value="draft" {{ old('status', $medicalInfo->status) === 'draft' ? 'selected' : '' }}>Simpan sebagai Draft</option>
                            <option value="published" {{ old('status', $medicalInfo->status) === 'published' ? 'selected' : '' }}>Langsung Publish</option>
                        </select>
                        @error('status') <p class="text-red-500 text-xs mt-1 ml-1">{{ $message }}</p> @enderror
                    </div>
                </div>

                <!-- Image -->
                <div class="space-y-2">
                    <label class="text-[10px] font-bold text-potads-blue uppercase tracking-wider ml-1">Gambar Sampul (Opsional)</label>
                    @if($medicalInfo->image)
                        <div class="mb-3">
                            <img src="{{ asset('storage/' . $medicalInfo->image) }}" class="w-32 h-32 object-cover rounded-xl border border-slate-200">
                        </div>
                    @endif
                    <input type="file" name="image"
                        class="w-full px-6 py-4 bg-slate-50 border-none rounded-2xl focus:ring-2 focus:ring-potads-blue/10 transition-all text-slate-700 font-medium file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-xs file:font-bold file:bg-potads-blue/10 file:text-potads-blue hover:file:bg-potads-blue/20">
                    <p class="text-xs text-slate-400 ml-1 mt-1">Biarkan kosong jika tidak ingin mengubah gambar.</p>
                    @error('image') <p class="text-red-500 text-xs mt-1 ml-1">{{ $message }}</p> @enderror
                </div>

                <!-- Content -->
                <div class="space-y-2">
                    <label class="text-[10px] font-bold text-potads-blue uppercase tracking-wider ml-1">Konten Informasi</label>
                    <textarea name="content" rows="10" required
                        class="w-full px-6 py-4 bg-slate-50 border-none rounded-2xl focus:ring-2 focus:ring-potads-blue/10 transition-all text-slate-700 font-medium @error('content') ring-2 ring-red-500/20 @enderror"
                        placeholder="Tuliskan isi informasi di sini...">{{ old('content', $medicalInfo->content) }}</textarea>
                    @error('content') <p class="text-red-500 text-xs mt-1 ml-1">{{ $message }}</p> @enderror
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                    <!-- Address -->
                    <div class="space-y-2 lg:col-span-1">
                        <label class="text-[10px] font-bold text-potads-blue uppercase tracking-wider ml-1">Alamat Lengkap</label>
                        <input type="text" name="address" value="{{ old('address', $medicalInfo->address) }}"
                            class="w-full px-6 py-4 bg-slate-50 border-none rounded-2xl focus:ring-2 focus:ring-potads-blue/10 transition-all text-slate-700 font-medium @error('address') ring-2 ring-red-500/20 @enderror"
                            placeholder="Jl. Contoh No. 123">
                        @error('address') <p class="text-red-500 text-xs mt-1 ml-1">{{ $message }}</p> @enderror
                    </div>

                    <!-- Regency -->
                    <div class="space-y-2 lg:col-span-1">
                        <label class="text-[10px] font-bold text-potads-blue uppercase tracking-wider ml-1">Kabupaten/Kota</label>
                        <input type="text" name="regency" value="{{ old('regency', $medicalInfo->regency) }}"
                            class="w-full px-6 py-4 bg-slate-50 border-none rounded-2xl focus:ring-2 focus:ring-potads-blue/10 transition-all text-slate-700 font-medium"
                            placeholder="Contoh: Bandung">
                    </div>

                    <!-- District -->
                    <div class="space-y-2 lg:col-span-1">
                        <label class="text-[10px] font-bold text-potads-blue uppercase tracking-wider ml-1">Kecamatan</label>
                        <input type="text" name="district" value="{{ old('district', $medicalInfo->district) }}"
                            class="w-full px-6 py-4 bg-slate-50 border-none rounded-2xl focus:ring-2 focus:ring-potads-blue/10 transition-all text-slate-700 font-medium"
                            placeholder="Contoh: Coblong">
                    </div>

                    <!-- Phone -->
                    <div class="space-y-2 lg:col-span-1">
                        <label class="text-[10px] font-bold text-potads-blue uppercase tracking-wider ml-1">Nomor Kontak</label>
                        <input type="text" name="phone" value="{{ old('phone', $medicalInfo->phone) }}"
                            class="w-full px-6 py-4 bg-slate-50 border-none rounded-2xl focus:ring-2 focus:ring-potads-blue/10 transition-all text-slate-700 font-medium"
                            placeholder="08123456789">
                    </div>
                </div>
            </div>

            <div class="flex items-center gap-4 pt-6">
                <button type="submit" class="px-10 py-4 bg-potads-blue text-white rounded-2xl font-bold shadow-lg shadow-blue-900/20 hover:scale-[1.02] active:scale-[0.98] transition-all">
                    Update Informasi
                </button>
                <a href="{{ route('admin.medical-infos.index') }}" class="px-10 py-4 bg-white border-2 border-slate-100 text-slate-500 rounded-2xl font-bold hover:bg-slate-50 transition-all">
                    Batal
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
