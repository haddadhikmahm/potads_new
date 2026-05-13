@extends('layouts.admin')

@section('title', 'Form Pendataan Anak Down Syndrome')

@section('header_title', 'Form Pendataan Anak')
@section('header_breadcrumb', 'Add Detailed Child Data')

@section('content')
<div class="max-w-4xl">
    <div class="mb-6">
        <a href="{{ route('admin.children.index') }}" class="inline-flex items-center gap-2 text-sm font-bold text-slate-400 hover:text-potads-blue transition-colors">
            <i data-lucide="arrow-left" class="w-4 h-4"></i> Kembali ke Daftar
        </a>
    </div>

    <form action="{{ route('admin.children.store') }}" method="POST" enctype="multipart/form-data" class="space-y-8">
        @csrf

        <!-- Member Connection -->
        <div class="bg-white rounded-[2rem] shadow-sm border border-slate-100 p-8">
            <div class="flex items-center gap-4 mb-6">
                <div class="w-10 h-10 bg-blue-50 text-blue-600 rounded-xl flex items-center justify-center">
                    <i data-lucide="user-check" class="w-5 h-5"></i>
                </div>
                <h3 class="text-lg font-bold text-slate-800">Hubungkan ke Member</h3>
            </div>
            <div class="space-y-2">
                <label class="text-[10px] font-bold text-potads-blue uppercase tracking-wider ml-1">Pilih Member (Orang Tua)</label>
                <select name="user_id" required
                    class="w-full px-6 py-4 bg-slate-50 border-none rounded-2xl focus:ring-2 focus:ring-potads-blue/10 transition-all text-slate-700 font-medium">
                    <option value="">-- Pilih Member --</option>
                    @foreach($users as $user)
                        <option value="{{ $user->id }}" {{ old('user_id') == $user->id ? 'selected' : '' }}>{{ $user->name }} ({{ $user->email }})</option>
                    @endforeach
                </select>
                @error('user_id') <p class="text-red-500 text-xs mt-1 ml-1">{{ $message }}</p> @enderror
            </div>
        </div>

        <!-- Data Anak -->
        <div class="bg-white rounded-[2rem] shadow-sm border border-slate-100 p-8">
            <div class="flex items-center gap-4 mb-6">
                <div class="w-10 h-10 bg-potads-blue text-white rounded-xl flex items-center justify-center">
                    <i data-lucide="smile" class="w-5 h-5"></i>
                </div>
                <h3 class="text-lg font-bold text-slate-800">Data Anak</h3>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="space-y-2 col-span-2">
                    <label class="text-[10px] font-bold text-slate-400 uppercase tracking-wider ml-1">Nama Anak</label>
                    <input type="text" name="name" value="{{ old('name') }}" required
                        class="w-full px-6 py-4 bg-slate-50 border-none rounded-2xl focus:ring-2 focus:ring-potads-blue/10 transition-all text-slate-700 font-medium">
                </div>

                <div class="space-y-2">
                    <label class="text-[10px] font-bold text-slate-400 uppercase tracking-wider ml-1">Jenis Kelamin</label>
                    <select name="gender" required
                        class="w-full px-6 py-4 bg-slate-50 border-none rounded-2xl focus:ring-2 focus:ring-potads-blue/10 transition-all text-slate-700 font-medium">
                        <option value="Laki-laki">Laki-laki</option>
                        <option value="Perempuan">Perempuan</option>
                    </select>
                </div>

                <div class="space-y-2">
                    <label class="text-[10px] font-bold text-slate-400 uppercase tracking-wider ml-1">Tanggal Lahir</label>
                    <input type="date" name="birth_date" value="{{ old('birth_date') }}" required
                        class="w-full px-6 py-4 bg-slate-50 border-none rounded-2xl focus:ring-2 focus:ring-potads-blue/10 transition-all text-slate-700 font-medium">
                </div>

                <div class="space-y-2 col-span-2">
                    <label class="text-[10px] font-bold text-slate-400 uppercase tracking-wider ml-1">Alamat Domisili Anak</label>
                    <textarea name="address" rows="2" class="w-full px-6 py-4 bg-slate-50 border-none rounded-2xl focus:ring-2 focus:ring-potads-blue/10 transition-all text-slate-700 font-medium">{{ old('address') }}</textarea>
                </div>

                <div class="space-y-2 col-span-2">
                    <label class="text-[10px] font-bold text-slate-400 uppercase tracking-wider ml-1">Kondisi atau Kebutuhan Khusus</label>
                    <textarea name="special_needs" rows="3" class="w-full px-6 py-4 bg-slate-50 border-none rounded-2xl focus:ring-2 focus:ring-potads-blue/10 transition-all text-slate-700 font-medium">{{ old('special_needs') }}</textarea>
                </div>

                <div class="space-y-2 col-span-2">
                    <label class="text-[10px] font-bold text-slate-400 uppercase tracking-wider ml-1">Foto Anak (Opsional)</label>
                    <input type="file" name="photo" class="w-full px-6 py-4 bg-slate-50 border-none rounded-2xl text-slate-500 text-sm file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-xs file:font-bold file:bg-potads-blue/10 file:text-potads-blue">
                </div>
            </div>
        </div>

        <!-- Data Orang Tua / Wali -->
        <div class="bg-white rounded-[2rem] shadow-sm border border-slate-100 p-8">
            <div class="flex items-center gap-4 mb-6">
                <div class="w-10 h-10 bg-yellow-50 text-yellow-600 rounded-xl flex items-center justify-center">
                    <i data-lucide="users" class="w-5 h-5"></i>
                </div>
                <h3 class="text-lg font-bold text-slate-800">Data Orang Tua / Wali</h3>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="space-y-2">
                    <label class="text-[10px] font-bold text-slate-400 uppercase tracking-wider ml-1">Nama Orang Tua/Wali</label>
                    <input type="text" name="parent_name" value="{{ old('parent_name') }}" class="w-full px-6 py-4 bg-slate-50 border-none rounded-2xl focus:ring-2 focus:ring-potads-blue/10 transition-all text-slate-700 font-medium">
                </div>

                <div class="space-y-2">
                    <label class="text-[10px] font-bold text-slate-400 uppercase tracking-wider ml-1">Nomor HP</label>
                    <input type="text" name="parent_phone" value="{{ old('parent_phone') }}" class="w-full px-6 py-4 bg-slate-50 border-none rounded-2xl focus:ring-2 focus:ring-potads-blue/10 transition-all text-slate-700 font-medium">
                </div>

                <div class="space-y-2">
                    <label class="text-[10px] font-bold text-slate-400 uppercase tracking-wider ml-1">Pekerjaan</label>
                    <input type="text" name="parent_job" value="{{ old('parent_job') }}" class="w-full px-6 py-4 bg-slate-50 border-none rounded-2xl focus:ring-2 focus:ring-potads-blue/10 transition-all text-slate-700 font-medium">
                </div>

                <div class="space-y-2 col-span-2">
                    <label class="text-[10px] font-bold text-slate-400 uppercase tracking-wider ml-1">Alamat Orang Tua/Wali</label>
                    <textarea name="parent_address" rows="2" class="w-full px-6 py-4 bg-slate-50 border-none rounded-2xl focus:ring-2 focus:ring-potads-blue/10 transition-all text-slate-700 font-medium">{{ old('parent_address') }}</textarea>
                </div>
            </div>
        </div>

        <!-- Data Pendidikan dan Terapi -->
        <div class="bg-white rounded-[2rem] shadow-sm border border-slate-100 p-8">
            <div class="flex items-center gap-4 mb-6">
                <div class="w-10 h-10 bg-emerald-50 text-emerald-600 rounded-xl flex items-center justify-center">
                    <i data-lucide="graduation-cap" class="w-5 h-5"></i>
                </div>
                <h3 class="text-lg font-bold text-slate-800">Data Pendidikan dan Terapi</h3>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="space-y-2">
                    <label class="text-[10px] font-bold text-slate-400 uppercase tracking-wider ml-1">Status Sekolah</label>
                    <input type="text" name="school_status" value="{{ old('school_status') }}" placeholder="Contoh: Sekolah, Tidak Sekolah" class="w-full px-6 py-4 bg-slate-50 border-none rounded-2xl focus:ring-2 focus:ring-potads-blue/10 transition-all text-slate-700 font-medium">
                </div>

                <div class="space-y-2">
                    <label class="text-[10px] font-bold text-slate-400 uppercase tracking-wider ml-1">Jenis Sekolah</label>
                    <input type="text" name="school_type" value="{{ old('school_type') }}" placeholder="Contoh: SLB, Inklusi, Umum" class="w-full px-6 py-4 bg-slate-50 border-none rounded-2xl focus:ring-2 focus:ring-potads-blue/10 transition-all text-slate-700 font-medium">
                </div>

                <div class="space-y-2 col-span-2">
                    <label class="text-[10px] font-bold text-slate-400 uppercase tracking-wider ml-1">Terapi yang diikuti</label>
                    <textarea name="therapies" rows="2" placeholder="Contoh: Terapi Wicara, Okupasi, dll" class="w-full px-6 py-4 bg-slate-50 border-none rounded-2xl focus:ring-2 focus:ring-potads-blue/10 transition-all text-slate-700 font-medium">{{ old('therapies') }}</textarea>
                </div>

                <div class="space-y-2 col-span-2">
                    <label class="text-[10px] font-bold text-slate-400 uppercase tracking-wider ml-1">Perkembangan atau Catatan Penting Anak</label>
                    <textarea name="development_notes" rows="4" class="w-full px-6 py-4 bg-slate-50 border-none rounded-2xl focus:ring-2 focus:ring-potads-blue/10 transition-all text-slate-700 font-medium">{{ old('development_notes') }}</textarea>
                </div>
            </div>
        </div>

        <div class="flex items-center gap-4 pt-4">
            <button type="submit" class="px-10 py-5 bg-potads-blue text-white rounded-2xl font-bold shadow-xl shadow-blue-900/20 hover:scale-[1.02] active:scale-[0.98] transition-all flex items-center gap-3">
                <i data-lucide="save" class="w-5 h-5"></i> Simpan Data Lengkap
            </button>
            <a href="{{ route('admin.children.index') }}" class="px-10 py-5 bg-white border-2 border-slate-100 text-slate-500 rounded-2xl font-bold hover:bg-slate-50 transition-all">
                Batal
            </a>
        </div>
    </form>
</div>
@endsection
