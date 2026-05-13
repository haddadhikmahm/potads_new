@extends('layouts.admin')

@section('title', 'Tambah Data Anak Baru')

@section('header_title', 'Tambah Anak')
@section('header_breadcrumb', 'Add New Child Record')

@section('content')
<div class="max-w-4xl">
    <div class="bg-white rounded-[2.5rem] shadow-sm border border-slate-100 p-8 md:p-12">
        <form action="{{ route('admin.children.store') }}" method="POST" enctype="multipart/form-data" class="space-y-8">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <!-- Left Column -->
                <div class="space-y-6">
                    <div class="space-y-2">
                        <label class="text-[10px] font-bold text-potads-blue uppercase tracking-wider ml-1">Pilih Orang Tua (Member)</label>
                        <select name="user_id" required
                            class="w-full px-6 py-4 bg-slate-50 border-none rounded-2xl focus:ring-2 focus:ring-potads-blue/10 transition-all text-slate-700 font-medium">
                            <option value="">-- Pilih Orang Tua --</option>
                            @foreach($users as $user)
                                <option value="{{ $user->id }}" {{ old('user_id') == $user->id ? 'selected' : '' }}>{{ $user->name }} ({{ $user->email }})</option>
                            @endforeach
                        </select>
                        @error('user_id') <p class="text-red-500 text-xs mt-1 ml-1">{{ $message }}</p> @enderror
                    </div>

                    <div class="space-y-2">
                        <label class="text-[10px] font-bold text-potads-blue uppercase tracking-wider ml-1">Nama Lengkap Anak</label>
                        <input type="text" name="name" value="{{ old('name') }}" required
                            class="w-full px-6 py-4 bg-slate-50 border-none rounded-2xl focus:ring-2 focus:ring-potads-blue/10 transition-all text-slate-700 font-medium"
                            placeholder="Nama lengkap anak...">
                        @error('name') <p class="text-red-500 text-xs mt-1 ml-1">{{ $message }}</p> @enderror
                    </div>

                    <div class="space-y-2">
                        <label class="text-[10px] font-bold text-potads-blue uppercase tracking-wider ml-1">Tanggal Lahir</label>
                        <input type="date" name="birth_date" value="{{ old('birth_date') }}" required
                            class="w-full px-6 py-4 bg-slate-50 border-none rounded-2xl focus:ring-2 focus:ring-potads-blue/10 transition-all text-slate-700 font-medium">
                    </div>

                    <div class="space-y-2">
                        <label class="text-[10px] font-bold text-potads-blue uppercase tracking-wider ml-1">Jenis Kelamin</label>
                        <select name="gender" required
                            class="w-full px-6 py-4 bg-slate-50 border-none rounded-2xl focus:ring-2 focus:ring-potads-blue/10 transition-all text-slate-700 font-medium">
                            <option value="Laki-laki" {{ old('gender') === 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                            <option value="Perempuan" {{ old('gender') === 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                        </select>
                    </div>
                </div>

                <!-- Right Column -->
                <div class="space-y-6">
                    <div class="space-y-2">
                        <label class="text-[10px] font-bold text-potads-blue uppercase tracking-wider ml-1">Foto Anak (Opsional)</label>
                        <input type="file" name="photo"
                            class="w-full px-6 py-4 bg-slate-50 border-none rounded-2xl focus:ring-2 focus:ring-potads-blue/10 transition-all text-slate-700 font-medium file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-xs file:font-bold file:bg-potads-blue/10 file:text-potads-blue hover:file:bg-potads-blue/20">
                    </div>

                    <div class="space-y-2">
                        <label class="text-[10px] font-bold text-potads-blue uppercase tracking-wider ml-1">Sekolah / Pendidikan</label>
                        <input type="text" name="school" value="{{ old('school') }}"
                            class="w-full px-6 py-4 bg-slate-50 border-none rounded-2xl focus:ring-2 focus:ring-potads-blue/10 transition-all text-slate-700 font-medium"
                            placeholder="Nama sekolah atau tingkatan...">
                    </div>

                    <div class="space-y-2">
                        <label class="text-[10px] font-bold text-potads-blue uppercase tracking-wider ml-1">Hobi / Ketertarikan</label>
                        <input type="text" name="hobby" value="{{ old('hobby') }}"
                            class="w-full px-6 py-4 bg-slate-50 border-none rounded-2xl focus:ring-2 focus:ring-potads-blue/10 transition-all text-slate-700 font-medium"
                            placeholder="Membaca, melukis, musik, dll...">
                    </div>

                    <div class="space-y-2">
                        <label class="text-[10px] font-bold text-potads-blue uppercase tracking-wider ml-1">Catatan Medis</label>
                        <textarea name="medical_notes" rows="4"
                            class="w-full px-6 py-4 bg-slate-50 border-none rounded-2xl focus:ring-2 focus:ring-potads-blue/10 transition-all text-slate-700 font-medium"
                            placeholder="Informasi kesehatan penting...">{{ old('medical_notes') }}</textarea>
                    </div>
                </div>
            </div>

            <div class="flex items-center gap-4 pt-6">
                <button type="submit" class="px-10 py-4 bg-potads-blue text-white rounded-2xl font-bold shadow-lg shadow-blue-900/20 hover:scale-[1.02] active:scale-[0.98] transition-all">
                    Simpan Data Anak
                </button>
                <a href="{{ route('admin.children.index') }}" class="px-10 py-4 bg-white border-2 border-slate-100 text-slate-500 rounded-2xl font-bold hover:bg-slate-50 transition-all">
                    Batal
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
