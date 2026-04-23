@extends('layouts.admin')

@section('title', 'Ubah Artikel')

@section('header_title', 'Ubah Artikel')
@section('header_breadcrumb', 'DASHBOARD > ARTIKEL > UBAH DATA')

@section('content')
<div class="mb-8 flex justify-end">
    <a href="{{ route('admin.articles.index') }}" class="flex items-center gap-2 text-slate-400 hover:text-potads-blue font-bold text-sm transition-colors">
        <i data-lucide="arrow-left" class="w-4 h-4"></i>
        Kembali ke Daftar
    </a>
</div>

<form action="{{ route('admin.articles.update', $article) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 items-start">
        
        <!-- Left Column: Content Area -->
        <div class="lg:col-span-2 space-y-6">
            <div class="bg-white rounded-[2.5rem] p-10 shadow-sm border border-slate-50">
                <div class="space-y-8">
                    <div>
                        <label for="title" class="block text-xs font-bold text-slate-700 mb-2 ml-1">Judul Artikel</label>
                        <input type="text" name="title" id="title" placeholder="Ketikkan judul artikel..." 
                               class="w-full px-6 py-5 bg-slate-50 border border-slate-100 rounded-2xl focus:outline-none focus:ring-2 focus:ring-potads-blue/5 text-lg font-bold text-slate-800 @error('title') border-red-500 @enderror" 
                               value="{{ old('title', $article->title) }}" required>
                        @error('title') <p class="text-red-500 text-[10px] mt-1 ml-1 font-bold">{{ $message }}</p> @enderror
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="category" class="block text-xs font-bold text-slate-700 mb-2 ml-1">Kategori</label>
                            <input type="text" name="category" id="category" placeholder="Edukasi, Cerita, dll..." 
                                   class="w-full px-6 py-4 bg-slate-50 border border-slate-100 rounded-2xl focus:outline-none focus:ring-2 focus:ring-potads-blue/5 text-sm" 
                                   value="{{ old('category', $article->category) }}">
                        </div>
                        <div>
                            <label for="status" class="block text-xs font-bold text-slate-700 mb-2 ml-1">Status Publikasi</label>
                            <select name="status" id="status" class="w-full px-6 py-4 bg-slate-50 border border-slate-100 rounded-2xl focus:outline-none focus:ring-2 focus:ring-potads-blue/5 text-sm appearance-none cursor-pointer font-bold text-blue-600">
                                <option value="draft" {{ old('status', $article->status) == 'draft' ? 'selected' : '' }}>SIMPAN SEBAGAI DRAF</option>
                                <option value="published" {{ old('status', $article->status) == 'published' ? 'selected' : '' }}>TERBITKAN SEKARANG</option>
                            </select>
                        </div>
                    </div>

                    <div>
                        <label for="content" class="block text-xs font-bold text-slate-700 mb-2 ml-1">Isi Artikel</label>
                        <textarea name="content" id="content" rows="18" placeholder="Tuliskan isi artikel..." 
                                  class="w-full px-8 py-8 bg-slate-50 border border-slate-100 rounded-[2.5rem] focus:outline-none focus:ring-2 focus:ring-potads-blue/5 text-sm leading-relaxed text-slate-600 resize-none @error('content') border-red-500 @enderror">{{ old('content', $article->content) }}</textarea>
                        @error('content') <p class="text-red-500 text-[10px] mt-2 ml-1 font-bold">{{ $message }}</p> @enderror
                    </div>
                </div>
            </div>
        </div>

        <!-- Right Column: Sidebar -->
        <div class="space-y-6">
            <div class="bg-white rounded-[2.5rem] p-8 shadow-sm border border-slate-50 sticky top-8">
                <h3 class="text-[10px] font-extrabold text-slate-400 uppercase tracking-widest mb-6 text-center">Featured Image</h3>
                
                <div class="mb-6">
                    <p class="text-[10px] font-bold text-slate-400 mb-2 uppercase tracking-wide">Gambar Saat Ini</p>
                    <div class="w-full aspect-video rounded-2xl bg-slate-100 overflow-hidden border border-slate-100 shadow-inner">
                        @if($article->image)
                            <img src="{{ asset('storage/' . $article->image) }}" class="w-full h-full object-cover">
                        @else
                            <div class="w-full h-full flex items-center justify-center text-slate-300">
                                <i data-lucide="image" class="w-10 h-10"></i>
                            </div>
                        @endif
                    </div>
                </div>

                <div class="relative group">
                    <p class="text-[10px] font-bold text-slate-400 mb-2 uppercase tracking-wide">Ganti Gambar</p>
                    <input type="file" name="image" id="image-upload" class="hidden" accept="image/*">
                    <label for="image-upload" class="flex flex-col items-center justify-center py-8 px-4 border-2 border-dashed border-slate-200 rounded-[2rem] cursor-pointer group-hover:border-potads-blue group-hover:bg-blue-50/30 transition-all duration-300">
                        <div id="preview-container" class="contents">
                            <div class="w-10 h-10 bg-slate-50 rounded-xl flex items-center justify-center text-slate-300 mb-2">
                                <i data-lucide="upload-cloud" class="w-5 h-5"></i>
                            </div>
                            <p class="text-[9px] font-bold text-slate-500 text-center uppercase">Klik untuk ganti</p>
                        </div>
                        <img id="image-preview" src="#" class="hidden w-full h-auto rounded-xl object-cover shadow-sm">
                    </label>
                </div>
                @error('image') <p class="text-red-500 text-[10px] mt-4 text-center font-bold">{{ $message }}</p> @enderror

                <hr class="my-8 border-slate-100">

                <div class="mb-8 space-y-4">
                    <div class="flex justify-between items-center text-[10px] font-bold">
                        <span class="text-slate-400 uppercase tracking-wide">Penulis</span>
                        <span class="text-potads-blue uppercase">{{ $article->author->name }}</span>
                    </div>
                </div>

                <button type="submit" class="w-full bg-potads-blue text-white py-4 rounded-full font-bold hover:bg-slate-900 transition-all shadow-xl shadow-blue-500/10 transform hover:-translate-y-1">
                    PERBARUI ARTIKEL
                </button>
            </div>
        </div>
    </div>
</form>
@endsection

@push('scripts')
<script>
    lucide.createIcons();
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
