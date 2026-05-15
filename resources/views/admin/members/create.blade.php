@extends('layouts.admin')

@section('title', 'Tambah Member Baru')

@section('header_title', 'Tambah Member')
@section('header_breadcrumb', 'DASHBOARD > MEMBER > TAMBAH BARU')

@section('content')
<div class="max-w-5xl mx-auto pb-20">
    <form action="{{ route('admin.members.store') }}" method="POST" class="space-y-10">
        @csrf

        <!-- INFORMASI PRIBADI -->
        <div class="bg-white rounded-[2.5rem] shadow-sm border border-slate-100 p-8 md:p-12 overflow-hidden relative">
            <h3 class="text-xs font-black text-potads-blue uppercase tracking-[0.2em] mb-10 border-l-4 border-potads-yellow pl-4">Informasi Pribadi</h3>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div class="space-y-4">
                    <label class="text-sm font-bold text-potads-blue ml-1">Nama Lengkap</label>
                    <input type="text" name="name" value="{{ old('name') }}" required
                        class="w-full px-8 py-5 bg-slate-50 border-none rounded-2xl focus:ring-2 focus:ring-potads-blue/10 transition-all text-slate-700 font-medium placeholder:text-slate-300 @error('name') ring-2 ring-red-500/20 @enderror"
                        placeholder="Contoh: Budi Santoso">
                    @error('name') <p class="text-red-500 text-xs mt-1 ml-1">{{ $message }}</p> @enderror
                </div>
                <div class="space-y-4">
                    <label class="text-sm font-bold text-potads-blue ml-1">Email Aktif</label>
                    <input type="email" name="email" value="{{ old('email') }}" required
                        class="w-full px-8 py-5 bg-slate-50 border-none rounded-2xl focus:ring-2 focus:ring-potads-blue/10 transition-all text-slate-700 font-medium placeholder:text-slate-300 @error('email') ring-2 ring-red-500/20 @enderror"
                        placeholder="nama@email.com">
                    @error('email') <p class="text-red-500 text-xs mt-1 ml-1">{{ $message }}</p> @enderror
                </div>
                <div class="space-y-4">
                    <label class="text-sm font-bold text-potads-blue ml-1">No. HP (WhatsApp)</label>
                    <input type="text" name="phone" value="{{ old('phone') }}"
                        class="w-full px-8 py-5 bg-slate-50 border-none rounded-2xl focus:ring-2 focus:ring-potads-blue/10 transition-all text-slate-700 font-medium placeholder:text-slate-300"
                        placeholder="0812 xxxx">
                    @error('phone') <p class="text-red-500 text-xs mt-1 ml-1">{{ $message }}</p> @enderror
                </div>
                <div class="space-y-4">
                    <label class="text-sm font-bold text-potads-blue ml-1">Pekerjaan</label>
                    <input type="text" name="profession" value="{{ old('profession') }}"
                        class="w-full px-8 py-5 bg-slate-50 border-none rounded-2xl focus:ring-2 focus:ring-potads-blue/10 transition-all text-slate-700 font-medium placeholder:text-slate-300"
                        placeholder="Guru, Wirausaha, dll">
                    @error('profession') <p class="text-red-500 text-xs mt-1 ml-1">{{ $message }}</p> @enderror
                </div>
            </div>
        </div>

        <!-- DOMISILI -->
        <div class="bg-white rounded-[2.5rem] shadow-sm border border-slate-100 p-8 md:p-12 overflow-hidden">
            <h3 class="text-xs font-black text-potads-blue uppercase tracking-[0.2em] mb-10 border-l-4 border-potads-yellow pl-4">Domisili</h3>
            
            <div class="space-y-8">
                <div class="space-y-4">
                    <label class="text-sm font-bold text-potads-blue ml-1">Alamat Lengkap</label>
                    <textarea name="address" rows="4"
                        class="w-full px-8 py-5 bg-slate-50 border-none rounded-2xl focus:ring-2 focus:ring-potads-blue/10 transition-all text-slate-700 font-medium placeholder:text-slate-300"
                        placeholder="Nama jalan, nomor rumah, RT/RW">{{ old('address') }}</textarea>
                </div>
                <div class="space-y-4">
                    <label class="text-sm font-bold text-potads-blue ml-1">Kabupaten / Kota</label>
                    <input type="text" name="city" value="{{ old('city') }}"
                        class="w-full px-8 py-5 bg-slate-50 border-none rounded-2xl focus:ring-2 focus:ring-potads-blue/10 transition-all text-slate-700 font-medium placeholder:text-slate-300"
                        placeholder="Masukkan nama kota">
                </div>
            </div>
        </div>

        <!-- PERTANYAAN KHUSUS -->
        <div class="bg-yellow-50/50 rounded-[2.5rem] border border-yellow-100 p-10">
            <p class="text-sm font-bold text-potads-blue mb-6">Apakah Anda orangtua dari ADS (Anak dengan Down Syndrome)?</p>
            <div class="flex gap-10">
                <label class="flex items-center gap-3 cursor-pointer group">
                    <input type="radio" name="is_parent" value="1" {{ old('is_parent', '1') == '1' ? 'checked' : '' }} class="w-5 h-5 border-yellow-300 text-potads-blue focus:ring-potads-blue">
                    <span class="text-sm font-bold text-slate-600 group-hover:text-potads-blue transition-colors">Ya, Benar</span>
                </label>
                <label class="flex items-center gap-3 cursor-pointer group">
                    <input type="radio" name="is_parent" value="0" {{ old('is_parent') == '0' ? 'checked' : '' }} class="w-5 h-5 border-yellow-300 text-potads-blue focus:ring-potads-blue">
                    <span class="text-sm font-bold text-slate-600 group-hover:text-potads-blue transition-colors">Bukan / Pendamping</span>
                </label>
            </div>
            @error('is_parent') <p class="text-red-500 text-xs mt-1 ml-1">{{ $message }}</p> @enderror
        </div>

        <!-- KONTAK / CREDENTIALS -->
        <div class="bg-white rounded-[2.5rem] shadow-sm border border-slate-100 p-8 md:p-12 overflow-hidden">
            <h3 class="text-xs font-black text-potads-blue uppercase tracking-[0.2em] mb-10 border-l-4 border-potads-yellow pl-4">Akses Akun</h3>
            
            <div class="space-y-8">
                <div class="space-y-4">
                    <label class="text-sm font-bold text-potads-blue ml-1">Username</label>
                    <input type="text" name="username" value="{{ old('username') }}" required
                        class="w-full px-8 py-5 bg-slate-50 border-none rounded-2xl focus:ring-2 focus:ring-potads-blue/10 transition-all text-slate-700 font-medium placeholder:text-slate-300 @error('username') ring-2 ring-red-500/20 @enderror"
                        placeholder="Pilih nama pengguna unik">
                    @error('username') <p class="text-red-500 text-xs mt-1 ml-1">{{ $message }}</p> @enderror
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div class="space-y-4">
                        <label class="text-sm font-bold text-potads-blue ml-1">Kata Sandi</label>
                        <input type="password" name="password" required
                            class="w-full px-8 py-5 bg-slate-50 border-none rounded-2xl focus:ring-2 focus:ring-potads-blue/10 transition-all text-slate-700 font-medium placeholder:text-slate-300 @error('password') ring-2 ring-red-500/20 @enderror"
                            placeholder="Min. 8 karakter">
                        @error('password') <p class="text-red-500 text-xs mt-1 ml-1">{{ $message }}</p> @enderror
                    </div>
                    <div class="space-y-4">
                        <label class="text-sm font-bold text-potads-blue ml-1">Konfirmasi Kata Sandi</label>
                        <input type="password" name="password_confirmation" required
                            class="w-full px-8 py-5 bg-slate-50 border-none rounded-2xl focus:ring-2 focus:ring-potads-blue/10 transition-all text-slate-700 font-medium placeholder:text-slate-300"
                            placeholder="Ulangi kata sandi">
                    </div>
                </div>
            </div>
        </div>

        <!-- ROLE -->
        <div class="bg-blue-50/50 rounded-[2.5rem] border border-blue-100 p-10">
            <h4 class="text-sm font-bold text-potads-blue mb-6">Role / Hak Akses</h4>
            <div class="flex gap-10">
                <label class="flex items-center gap-3 cursor-pointer group">
                    <input type="radio" name="role" value="user" {{ old('role', 'user') === 'user' ? 'checked' : '' }} class="w-5 h-5 border-blue-300 text-potads-blue focus:ring-potads-blue">
                    <span class="text-sm font-bold text-slate-600 group-hover:text-potads-blue transition-colors">User</span>
                </label>
                <label class="flex items-center gap-3 cursor-pointer group">
                    <input type="radio" name="role" value="admin" {{ old('role') === 'admin' ? 'checked' : '' }} class="w-5 h-5 border-blue-300 text-potads-blue focus:ring-potads-blue">
                    <span class="text-sm font-bold text-slate-600 group-hover:text-potads-blue transition-colors">Admin</span>
                </label>
            </div>
            @error('role') <p class="text-red-500 text-xs mt-1 ml-1">{{ $message }}</p> @enderror
        </div>

        <!-- BUTTONS -->
        <div class="flex items-center justify-center gap-4 pt-6">
            <a href="{{ route('admin.members.index') }}" class="px-12 py-4 bg-slate-50 text-potads-blue rounded-full font-bold hover:bg-slate-100 transition-all border border-slate-100">
                Batal
            </a>
            <button type="submit" class="px-12 py-4 bg-potads-yellow text-slate-900 rounded-full font-bold shadow-lg shadow-yellow-400/20 hover:scale-[1.02] active:scale-[0.98] transition-all">
                Tambah Member
            </button>
        </div>
    </form>
</div>
@endsection
