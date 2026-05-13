@extends('layouts.frontend')

@section('title', 'Edit Data Anak')

@section('content')
<div class="bg-[#F8F9FB] min-h-screen py-16 px-6 md:px-12 lg:px-16 pt-24 md:pt-32">
    <div class="max-w-3xl mx-auto">
        <div class="bg-white rounded-[2.5rem] shadow-xl border-4 border-white p-8 md:p-12" data-aos="fade-up">
            <div class="text-center mb-12">
                <div class="w-20 h-20 bg-potads-yellow rounded-3xl flex items-center justify-center mx-auto mb-6 shadow-lg shadow-yellow-200">
                    <i data-lucide="edit-3" class="w-10 h-10 text-potads-blue"></i>
                </div>
                <h1 class="text-3xl font-black text-potads-blue mb-4">Edit Data Anak</h1>
                <p class="text-gray-500">Perbarui informasi putra/putri Anda.</p>
            </div>

            <form action="{{ route('children.update', $child) }}" method="POST" enctype="multipart/form-data" class="space-y-8">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <!-- Photo -->
                    <div class="md:col-span-2 flex flex-col items-center">
                        <div class="w-32 h-32 bg-slate-50 rounded-[2rem] border-4 border-dashed border-slate-200 flex items-center justify-center relative overflow-hidden group cursor-pointer" onclick="document.getElementById('photo-input').click()">
                            @if($child->photo)
                                <img id="photo-preview" src="{{ asset('storage/' . $child->photo) }}" class="w-full h-full object-cover">
                            @else
                                <img id="photo-preview" src="#" alt="Preview" class="hidden w-full h-full object-cover">
                            @endif
                            <div id="photo-placeholder" class="{{ $child->photo ? 'hidden' : '' }} text-center flex flex-col items-center">
                                <i data-lucide="camera" class="w-8 h-8 text-slate-300 mb-1"></i>
                                <span class="text-[10px] font-bold text-slate-400">UPLOAD FOTO</span>
                            </div>
                        </div>
                        <input type="file" name="photo" id="photo-input" class="hidden" accept="image/*" onchange="previewPhoto(this)">
                        @error('photo') <p class="text-red-500 text-xs mt-2">{{ $message }}</p> @enderror
                    </div>

                    <!-- Name -->
                    <div class="space-y-2">
                        <label class="text-[10px] font-black text-potads-blue uppercase tracking-widest ml-1">Nama Lengkap</label>
                        <input type="text" name="name" value="{{ old('name', $child->name) }}" required
                            class="w-full px-6 py-4 bg-slate-50 border-none rounded-2xl focus:ring-4 focus:ring-potads-blue/5 transition-all text-slate-700 font-bold @error('name') ring-2 ring-red-500/20 @enderror"
                            placeholder="Nama putra/putri...">
                        @error('name') <p class="text-red-500 text-xs mt-1 ml-1">{{ $message }}</p> @enderror
                    </div>

                    <!-- Gender -->
                    <div class="space-y-2">
                        <label class="text-[10px] font-black text-potads-blue uppercase tracking-widest ml-1">Jenis Kelamin</label>
                        <select name="gender" required
                            class="w-full px-6 py-4 bg-slate-50 border-none rounded-2xl focus:ring-4 focus:ring-potads-blue/5 transition-all text-slate-700 font-bold @error('gender') ring-2 ring-red-500/20 @enderror">
                            <option value="">Pilih...</option>
                            <option value="L" {{ old('gender', $child->gender) == 'L' ? 'selected' : '' }}>Laki-laki</option>
                            <option value="P" {{ old('gender', $child->gender) == 'P' ? 'selected' : '' }}>Perempuan</option>
                        </select>
                        @error('gender') <p class="text-red-500 text-xs mt-1 ml-1">{{ $message }}</p> @enderror
                    </div>

                    <!-- Birth Date -->
                    <div class="space-y-2">
                        <label class="text-[10px] font-black text-potads-blue uppercase tracking-widest ml-1">Tanggal Lahir</label>
                        <input type="date" name="birth_date" value="{{ old('birth_date', $child->birth_date) }}" required
                            class="w-full px-6 py-4 bg-slate-50 border-none rounded-2xl focus:ring-4 focus:ring-potads-blue/5 transition-all text-slate-700 font-bold @error('birth_date') ring-2 ring-red-500/20 @enderror">
                        @error('birth_date') <p class="text-red-500 text-xs mt-1 ml-1">{{ $message }}</p> @enderror
                    </div>

                    <!-- School -->
                    <div class="space-y-2">
                        <label class="text-[10px] font-black text-potads-blue uppercase tracking-widest ml-1">Sekolah / Pendidikan</label>
                        <input type="text" name="school" value="{{ old('school', $child->school) }}"
                            class="w-full px-6 py-4 bg-slate-50 border-none rounded-2xl focus:ring-4 focus:ring-potads-blue/5 transition-all text-slate-700 font-bold"
                            placeholder="Contoh: SLB Negeri 1...">
                    </div>

                    <!-- Hobby -->
                    <div class="space-y-2 md:col-span-2">
                        <label class="text-[10px] font-black text-potads-blue uppercase tracking-widest ml-1">Hobi / Ketertarikan</label>
                        <input type="text" name="hobby" value="{{ old('hobby', $child->hobby) }}"
                            class="w-full px-6 py-4 bg-slate-50 border-none rounded-2xl focus:ring-4 focus:ring-potads-blue/5 transition-all text-slate-700 font-bold"
                            placeholder="Contoh: Menari, Melukis, Berenang...">
                    </div>

                    <!-- Medical Notes -->
                    <div class="space-y-2 md:col-span-2">
                        <label class="text-[10px] font-black text-potads-blue uppercase tracking-widest ml-1">Catatan Kesehatan / Kebutuhan Khusus</label>
                        <textarea name="medical_notes" rows="4"
                            class="w-full px-6 py-4 bg-slate-50 border-none rounded-2xl focus:ring-4 focus:ring-potads-blue/5 transition-all text-slate-700 font-bold"
                            placeholder="Sebutkan jika ada riwayat kesehatan atau kebutuhan khusus lainnya...">{{ old('medical_notes', $child->medical_notes) }}</textarea>
                    </div>
                </div>

                <div class="flex flex-col md:flex-row gap-4 pt-6">
                    <button type="submit" class="flex-grow bg-potads-blue text-white font-black py-5 rounded-3xl text-lg hover:bg-blue-900 transition-all btn-playful shadow-xl shadow-blue-200">
                        Update Data
                    </button>
                    <a href="{{ route('profile') }}" class="px-10 py-5 bg-white border-4 border-slate-100 text-slate-400 font-black rounded-3xl text-lg text-center hover:bg-slate-50 transition-all">
                        Batal
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function previewPhoto(input) {
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('photo-preview').src = e.target.result;
                document.getElementById('photo-preview').classList.remove('hidden');
                document.getElementById('photo-placeholder').classList.add('hidden');
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
@endsection
