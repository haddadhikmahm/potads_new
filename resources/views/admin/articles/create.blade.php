@extends('layouts.admin')

@section('title', 'Tulis Artikel Baru')

@section('header_title', 'Tulis Artikel Baru')
@section('header_breadcrumb', 'DASHBOARD > ARTIKEL > TAMBAH BARU')

@section('content')
<form action="{{ route('admin.articles.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 items-start">
        
        <!-- Left Column: Content -->
        <div class="lg:col-span-2 space-y-6">
            <div class="bg-white rounded-[2.5rem] p-10 shadow-sm border border-slate-50">
                <div class="space-y-8">
                    <div>
                        <label for="title" class="block text-xs font-bold text-slate-700 mb-2 ml-1">Judul Artikel</label>
                        <input type="text" name="title" id="title" placeholder="Ketikkan judul artikel..." 
                               class="w-full px-6 py-5 bg-slate-50 border border-slate-100 rounded-2xl focus:outline-none focus:ring-2 focus:ring-potads-blue/5 text-lg font-bold text-slate-800 placeholder:text-slate-300 @error('title') border-red-500 @enderror" 
                               value="{{ old('title') }}" required>
                        @error('title') <p class="text-red-500 text-[10px] mt-1 ml-1 font-bold">{{ $message }}</p> @enderror
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="category" class="block text-xs font-bold text-slate-700 mb-2 ml-1">Kategori</label>
                            <input type="text" name="category" id="category" placeholder="Edukasi, Cerita, dll..." 
                                   class="w-full px-6 py-4 bg-slate-50 border border-slate-100 rounded-2xl focus:outline-none focus:ring-2 focus:ring-potads-blue/5 text-sm" 
                                   value="{{ old('category') }}">
                        </div>
                        <div>
                            <label for="status" class="block text-xs font-bold text-slate-700 mb-2 ml-1">Status Publikasi</label>
                            <select name="status" id="status" class="w-full px-6 py-4 bg-slate-50 border border-slate-100 rounded-2xl focus:outline-none focus:ring-2 focus:ring-potads-blue/5 text-sm appearance-none cursor-pointer font-bold text-blue-600">
                                <option value="draft" {{ old('status') == 'draft' ? 'selected' : '' }}>SIMPAN SEBAGAI DRAF</option>
                                <option value="published" {{ old('status') == 'published' ? 'selected' : '' }}>TERBITKAN SEKARANG</option>
                            </select>
                        </div>
                    </div>

                    <div>
                        <label for="content" class="block text-xs font-bold text-slate-700 mb-2 ml-1">Isi Artikel</label>
                        <textarea name="content" id="content" rows="15" placeholder="Mulailah menulis di sini..." 
                                  class="w-full px-8 py-8 bg-slate-50 border border-slate-100 rounded-[2.5rem] focus:outline-none focus:ring-2 focus:ring-potads-blue/5 text-sm leading-relaxed text-slate-600 resize-none @error('content') border-red-500 @enderror">{{ old('content') }}</textarea>
                        @error('content') <p class="text-red-500 text-[10px] mt-2 ml-1 font-bold">{{ $message }}</p> @enderror
                    </div>
                </div>
            </div>
        </div>

        <!-- Right Column: Settings & Media -->
        <div class="space-y-6">
            <div class="bg-white rounded-[2.5rem] p-8 shadow-sm border border-slate-50 sticky top-8">
                <h3 class="text-[10px] font-extrabold text-slate-400 uppercase tracking-widest mb-6 text-center">Featured Image</h3>
                
                <div class="relative group">
                    <input type="file" name="image" id="image-upload" class="hidden" accept="image/*">
                    <label for="image-upload" class="flex flex-col items-center justify-center py-12 px-6 border-2 border-dashed border-slate-200 rounded-[2rem] cursor-pointer group-hover:border-potads-blue group-hover:bg-blue-50/30 transition-all duration-300">
                        <div id="preview-container" class="contents">
                            <div class="w-16 h-16 bg-slate-50 rounded-2xl flex items-center justify-center text-slate-300 mb-4 group-hover:scale-110 transition-transform">
                                <i data-lucide="image-plus" class="w-8 h-8"></i>
                            </div>
                            <p class="text-xs font-bold text-slate-500 mb-1 text-center">Tarik atau klik untuk pilih gambar</p>
                            <p class="text-[10px] text-slate-400 uppercase">PNG, JPG, JPEG (Max 2MB)</p>
                        </div>
                        <img id="image-preview" src="#" class="hidden w-full h-auto rounded-2xl object-cover shadow-sm">
                    </label>
                </div>
                @error('image') <p class="text-red-500 text-[10px] mt-4 text-center font-bold">{{ $message }}</p> @enderror

                <div class="mt-10 space-y-3">
                    <button type="submit" class="w-full bg-potads-blue text-white py-4 rounded-full font-bold hover:bg-slate-900 transition-all shadow-xl shadow-blue-500/10 transform hover:-translate-y-1">
                        SIMPAN ARTIKEL
                    </button>
                    <a href="{{ route('admin.articles.index') }}" class="block w-full text-center bg-slate-100 text-slate-500 py-4 rounded-full font-bold hover:bg-slate-200 transition-colors text-sm uppercase tracking-wider">
                        Batal
                    </a>
                </div>

                <div class="mt-10">
                    <div class="p-6 bg-blue-50/50 rounded-3xl border border-blue-100/50">
                        <div class="flex items-start gap-4">
                            <i data-lucide="lightbulb" class="w-5 h-5 text-blue-500 flex-shrink-0 mt-0.5"></i>
                            <div>
                                <p class="text-[10px] font-bold text-blue-600 uppercase mb-2">Tips Menulis</p>
                                <p class="text-[10px] text-slate-500 leading-relaxed">Gunakan judul yang ringkas dan gambar berkualitas untuk menarik pembaca.</p>
                            </div>
                        </div>
                    </div>
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
