@extends('layouts.admin')

@section('title', 'Tambah Program Baru')

@section('header_title', 'Tambah Program Baru')
@section('header_breadcrumb', 'DASHBOARD > PROGRAM > TAMBAH')

@section('content')
<form action="{{ route('admin.programs.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 items-start">
        
        <!-- Left Column: Form Fields -->
        <div class="lg:col-span-2 space-y-6">
            <div class="bg-white rounded-[2.5rem] p-10 shadow-sm border border-slate-50">
                <div class="flex items-center gap-3 mb-8">
                    <div class="w-10 h-10 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center">
                        <i data-lucide="info" class="w-5 h-5"></i>
                    </div>
                    <h3 class="text-lg font-bold text-slate-800">Informasi Program</h3>
                </div>

                <div class="space-y-6">
                    <div>
                        <label for="title" class="block text-xs font-bold text-slate-700 mb-2 ml-1">Judul Program</label>
                        <input type="text" name="title" id="title" placeholder="Masukkan judul program..." 
                               class="w-full px-6 py-4 bg-slate-50 border border-slate-100 rounded-2xl focus:outline-none focus:ring-2 focus:ring-potads-blue/5 text-sm @error('title') border-red-500 @enderror" 
                               value="{{ old('title') }}" required>
                        @error('title') <p class="text-red-500 text-[10px] mt-1 ml-1">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label for="description" class="block text-xs font-bold text-slate-700 mb-2 ml-1">Ringkasan Singkat</label>
                        <textarea name="description" id="description" rows="3" placeholder="Tuliskan deskripsi singkat untuk di halaman depan..." 
                                  class="w-full px-8 py-6 bg-slate-50 border border-slate-100 rounded-[2rem] focus:outline-none focus:ring-2 focus:ring-potads-blue/5 text-sm resize-none @error('description') border-red-500 @enderror">{{ old('description') }}</textarea>
                        @error('description') <p class="text-red-500 text-[10px] mt-2 ml-1">{{ $message }}</p> @enderror
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-[2.5rem] p-10 shadow-sm border border-slate-50">
                <div class="flex items-center gap-3 mb-8">
                    <div class="w-10 h-10 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center">
                        <i data-lucide="file-text" class="w-5 h-5"></i>
                    </div>
                    <h3 class="text-lg font-bold text-slate-800">Isi Program (Halaman Detail)</h3>
                </div>
                <textarea name="content" id="content" rows="12" placeholder="Tuliskan isi lengkap program..." 
                          class="w-full px-8 py-6 bg-slate-50 border border-slate-100 rounded-[2rem] focus:outline-none focus:ring-2 focus:ring-potads-blue/5 text-sm @error('content') border-red-500 @enderror">{{ old('content') }}</textarea>
                @error('content') <p class="text-red-500 text-[10px] mt-2 ml-1">{{ $message }}</p> @enderror
            </div>
        </div>

        <!-- Right Column: Poster Upload -->
        <div class="space-y-6">
            <div class="bg-white rounded-[2.5rem] p-8 shadow-sm border border-slate-50 sticky top-8">
                <h3 class="text-[10px] font-extrabold text-slate-400 uppercase tracking-widest mb-6 text-center">Gambar Program</h3>
                
                <div class="relative group">
                    <input type="file" name="image" id="image-upload" class="hidden" accept="image/*">
                    <label for="image-upload" class="flex flex-col items-center justify-center py-12 px-6 border-2 border-dashed border-slate-200 rounded-[2rem] cursor-pointer group-hover:border-potads-blue group-hover:bg-blue-50/30 transition-all duration-300">
                        <div id="preview-container" class="contents">
                            <div class="w-16 h-16 bg-slate-50 rounded-2xl flex items-center justify-center text-slate-300 mb-4 group-hover:scale-110 transition-transform">
                                <i data-lucide="image" class="w-8 h-8"></i>
                            </div>
                            <p class="text-xs font-bold text-slate-500 mb-1">Klik untuk unggah gambar</p>
                            <p class="text-[10px] text-slate-400">PNG, JPG up to 5MB</p>
                        </div>
                        <img id="image-preview" src="#" class="hidden w-full h-auto rounded-xl object-cover shadow-sm">
                    </label>
                </div>
                @error('image') <p class="text-red-500 text-[10px] mt-4 text-center">{{ $message }}</p> @enderror

                <div class="mt-10 space-y-3">
                    <button type="submit" class="w-full bg-potads-yellow text-potads-blue py-4 rounded-full font-bold hover:bg-potads-blue hover:text-white transition-all shadow-lg shadow-yellow-500/20 transform hover:-translate-y-1">
                        Simpan Program
                    </button>
                    <a href="{{ route('admin.programs.index') }}" class="block w-full text-center bg-slate-100 text-slate-500 py-4 rounded-full font-bold hover:bg-slate-200 transition-colors">
                        Batal
                    </a>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection

@push('scripts')
<script>
    document.getElementById('image-upload').onchange = function (evt) {
        const [file] = this.files;
        if (file) {
            const preview = document.getElementById('image-preview');
            const container = document.getElementById('preview-container');
            preview.src = URL.createObjectURL(file);
            preview.classList.remove('hidden');
            container.classList.add('hidden');
        }
    }
</script>
@endpush
