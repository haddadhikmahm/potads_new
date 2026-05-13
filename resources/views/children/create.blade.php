@extends('layouts.frontend')

@section('title', 'Pendataan Anak Down Syndrome - POTADS')

@section('content')
<section class="pt-32 pb-20 bg-slate-50 min-h-screen">
    <div class="container mx-auto px-4">
        <div class="max-w-4xl mx-auto">
            <div class="mb-10 text-center">
                <h1 class="text-4xl font-black text-potads-blue mb-4">Form Pendataan Anak</h1>
                <p class="text-slate-500 font-medium">Silakan lengkapi data putra/putri Anda untuk mendapatkan dukungan yang lebih personal dari POTADS.</p>
            </div>

            <form action="{{ route('children.store') }}" method="POST" enctype="multipart/form-data" class="space-y-8">
                @csrf

                <!-- ===== Data Anak ===== -->
                <div class="bg-white rounded-[2.5rem] shadow-xl shadow-blue-900/5 p-8 md:p-12 border border-slate-100">
                    <div class="flex items-center gap-4 mb-10 pb-6 border-b border-slate-50">
                        <div class="w-12 h-12 bg-blue-50 text-blue-600 rounded-2xl flex items-center justify-center">
                            <i data-lucide="smile" class="w-6 h-6"></i>
                        </div>
                        <h2 class="text-2xl font-black text-slate-800 tracking-tight">Data Anak</h2>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <div class="md:col-span-2 space-y-3">
                            <label class="text-xs font-black text-slate-400 uppercase tracking-widest ml-1">Nama Lengkap Anak</label>
                            <input type="text" name="name" value="{{ old('name') }}" required
                                class="w-full px-8 py-5 bg-slate-50 border-none rounded-3xl focus:ring-4 focus:ring-potads-blue/5 transition-all text-slate-700 font-bold placeholder:text-slate-300"
                                placeholder="Masukkan nama lengkap anak...">
                        </div>

                        <div class="space-y-3">
                            <label class="text-xs font-black text-slate-400 uppercase tracking-widest ml-1">Jenis Kelamin</label>
                            <select name="gender" required
                                class="w-full px-8 py-5 bg-slate-50 border-none rounded-3xl focus:ring-4 focus:ring-potads-blue/5 transition-all text-slate-700 font-bold">
                                <option value="Laki-laki">Laki-laki</option>
                                <option value="Perempuan">Perempuan</option>
                            </select>
                        </div>

                        <div class="space-y-3">
                            <label class="text-xs font-black text-slate-400 uppercase tracking-widest ml-1">Tanggal Lahir</label>
                            <input type="date" name="birth_date" value="{{ old('birth_date') }}" required
                                class="w-full px-8 py-5 bg-slate-50 border-none rounded-3xl focus:ring-4 focus:ring-potads-blue/5 transition-all text-slate-700 font-bold">
                        </div>

                        <div class="md:col-span-2 space-y-3">
                            <label class="text-xs font-black text-slate-400 uppercase tracking-widest ml-1">Alamat Domisili Anak</label>
                            <textarea name="address" rows="2" class="w-full px-8 py-5 bg-slate-50 border-none rounded-3xl focus:ring-4 focus:ring-potads-blue/5 transition-all text-slate-700 font-bold placeholder:text-slate-300" placeholder="Masukkan alamat domisili saat ini...">{{ old('address') }}</textarea>
                        </div>

                        <div class="md:col-span-2 space-y-3">
                            <label class="text-xs font-black text-slate-400 uppercase tracking-widest ml-1">Kondisi atau Kebutuhan Khusus</label>
                            <textarea name="special_needs" rows="3" class="w-full px-8 py-5 bg-slate-50 border-none rounded-3xl focus:ring-4 focus:ring-potads-blue/5 transition-all text-slate-700 font-bold placeholder:text-slate-300" placeholder="Sebutkan jika ada kondisi medis atau kebutuhan khusus lainnya...">{{ old('special_needs') }}</textarea>
                        </div>

                        <div class="md:col-span-2 space-y-3">
                            <label class="text-xs font-black text-slate-400 uppercase tracking-widest ml-1">Foto Anak (Opsional)</label>
                            <div class="flex items-center gap-4 p-4 bg-slate-50 rounded-3xl border-2 border-dashed border-slate-200">
                                <input type="file" name="photo" class="text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-xs file:font-bold file:bg-potads-blue file:text-white hover:file:bg-blue-900 transition-all">
                            </div>
                        </div>
                    </div>
                </div>

                <!-- ===== Data Orang Tua / Wali ===== -->
                <div class="bg-white rounded-[2.5rem] shadow-xl shadow-blue-900/5 p-8 md:p-12 border border-slate-100">
                    <div class="flex items-center gap-4 mb-10 pb-6 border-b border-slate-50">
                        <div class="w-12 h-12 bg-yellow-50 text-yellow-600 rounded-2xl flex items-center justify-center">
                            <i data-lucide="users" class="w-6 h-6"></i>
                        </div>
                        <h2 class="text-2xl font-black text-slate-800 tracking-tight">Data Orang Tua / Wali</h2>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <div class="space-y-3">
                            <label class="text-xs font-black text-slate-400 uppercase tracking-widest ml-1">Nama Orang Tua/Wali</label>
                            <input type="text" name="parent_name" value="{{ old('parent_name', auth()->user()->name) }}"
                                class="w-full px-8 py-5 bg-slate-50 border-none rounded-3xl focus:ring-4 focus:ring-potads-blue/5 transition-all text-slate-700 font-bold placeholder:text-slate-300">
                        </div>

                        <div class="space-y-3">
                            <label class="text-xs font-black text-slate-400 uppercase tracking-widest ml-1">Nomor HP</label>
                            <input type="text" name="parent_phone" value="{{ old('parent_phone', auth()->user()->phone) }}"
                                class="w-full px-8 py-5 bg-slate-50 border-none rounded-3xl focus:ring-4 focus:ring-potads-blue/5 transition-all text-slate-700 font-bold placeholder:text-slate-300">
                        </div>

                        <div class="space-y-3">
                            <label class="text-xs font-black text-slate-400 uppercase tracking-widest ml-1">Pekerjaan</label>
                            <input type="text" name="parent_job" value="{{ old('parent_job', auth()->user()->profession) }}"
                                class="w-full px-8 py-5 bg-slate-50 border-none rounded-3xl focus:ring-4 focus:ring-potads-blue/5 transition-all text-slate-700 font-bold placeholder:text-slate-300">
                        </div>

                        <div class="md:col-span-2 space-y-3">
                            <label class="text-xs font-black text-slate-400 uppercase tracking-widest ml-1">Alamat Lengkap Orang Tua</label>
                            <textarea name="parent_address" rows="2" class="w-full px-8 py-5 bg-slate-50 border-none rounded-3xl focus:ring-4 focus:ring-potads-blue/5 transition-all text-slate-700 font-bold placeholder:text-slate-300">{{ old('parent_address', auth()->user()->address) }}</textarea>
                        </div>
                    </div>
                </div>

                <!-- ===== Data Pendidikan dan Terapi ===== -->
                <div class="bg-white rounded-[2.5rem] shadow-xl shadow-blue-900/5 p-8 md:p-12 border border-slate-100">
                    <div class="flex items-center gap-4 mb-10 pb-6 border-b border-slate-50">
                        <div class="w-12 h-12 bg-emerald-50 text-emerald-600 rounded-2xl flex items-center justify-center">
                            <i data-lucide="graduation-cap" class="w-6 h-6"></i>
                        </div>
                        <h2 class="text-2xl font-black text-slate-800 tracking-tight">Data Pendidikan dan Terapi</h2>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <div class="space-y-3">
                            <label class="text-xs font-black text-slate-400 uppercase tracking-widest ml-1">Status Sekolah</label>
                            <input type="text" name="school_status" value="{{ old('school_status') }}" placeholder="Contoh: Sekolah / Tidak Sekolah"
                                class="w-full px-8 py-5 bg-slate-50 border-none rounded-3xl focus:ring-4 focus:ring-potads-blue/5 transition-all text-slate-700 font-bold placeholder:text-slate-300">
                        </div>

                        <div class="space-y-3">
                            <label class="text-xs font-black text-slate-400 uppercase tracking-widest ml-1">Jenis Sekolah</label>
                            <input type="text" name="school_type" value="{{ old('school_type') }}" placeholder="Contoh: SLB / Umum / Inklusi"
                                class="w-full px-8 py-5 bg-slate-50 border-none rounded-3xl focus:ring-4 focus:ring-potads-blue/5 transition-all text-slate-700 font-bold placeholder:text-slate-300">
                        </div>

                        <div class="md:col-span-2 space-y-3">
                            <label class="text-xs font-black text-slate-400 uppercase tracking-widest ml-1">Terapi yang Diikuti</label>
                            <textarea name="therapies" rows="2" class="w-full px-8 py-5 bg-slate-50 border-none rounded-3xl focus:ring-4 focus:ring-potads-blue/5 transition-all text-slate-700 font-bold placeholder:text-slate-300" placeholder="Sebutkan terapi yang rutin diikuti (misal: Terapi Wicara, Okupasi, dll)...">{{ old('therapies') }}</textarea>
                        </div>

                        <div class="md:col-span-2 space-y-3">
                            <label class="text-xs font-black text-slate-400 uppercase tracking-widest ml-1">Perkembangan atau Catatan Penting Anak</label>
                            <textarea name="development_notes" rows="5" class="w-full px-8 py-5 bg-slate-50 border-none rounded-3xl focus:ring-4 focus:ring-potads-blue/5 transition-all text-slate-700 font-bold placeholder:text-slate-300" placeholder="Tuliskan catatan perkembangan penting atau hal lain yang ingin Anda sampaikan...">{{ old('development_notes') }}</textarea>
                        </div>
                    </div>
                </div>

                <div class="flex items-center gap-6 pt-10">
                    <button type="submit" class="flex-1 bg-potads-blue text-white py-6 rounded-3xl font-black text-lg shadow-2xl shadow-blue-900/30 hover:scale-[1.02] active:scale-[0.98] transition-all flex items-center justify-center gap-4">
                        <i data-lucide="check-circle" class="w-6 h-6"></i> Simpan Data Anak
                    </button>
                    <a href="{{ route('profile') }}" class="px-10 py-6 bg-white border-4 border-slate-100 text-slate-400 rounded-3xl font-black text-lg hover:bg-slate-50 transition-all">
                        Batal
                    </a>
                </div>
            </form>
        </div>
    </div>
</section>
@endsection
