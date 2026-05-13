@extends('layouts.frontend')

@section('title', 'Edit Artikel - PIK POTADS')

@section('content')
    <!-- Content Section -->
    <main class="max-w-7xl mx-auto px-6 md:px-12 py-8">
        <!-- Breadcrumbs -->
        <nav class="flex text-xs font-medium text-gray-400 mb-8" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1">
                <li><a href="{{ route('profile') }}" class="hover:text-potads-blue transition">Profil</a></li>
                <li><i data-lucide="chevron-right" class="w-3 h-3 mx-1"></i></li>
                <li class="text-gray-600">Edit Artikel</li>
            </ol>
        </nav>

        <!-- Page Title -->
        <div class="text-center mb-12">
            <h1 class="text-4xl font-extrabold text-potads-blue mb-3">Formulir Edit Artikel</h1>
            <p class="text-gray-500 max-w-lg mx-auto leading-relaxed">
                Ubah informasi artikel Anda. Pastikan konten mematuhi panduan komunitas kami.
            </p>
        </div>

        @if($errors->any())
            <div class="max-w-4xl mx-auto mb-8 bg-red-50 border-l-4 border-red-500 p-4 rounded-xl">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <i data-lucide="alert-circle" class="h-5 w-5 text-red-500"></i>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm text-red-700 font-bold">Terjadi kesalahan:</p>
                        <ul class="mt-2 text-sm text-red-700 list-disc list-inside">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        @endif

        <!-- Form Grid -->
        <form action="{{ route('articles.update', $article) }}" method="POST" enctype="multipart/form-data" class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            @csrf
            @method('PUT')
            <!-- Left Side: Inputs -->
            <div class="lg:col-span-2 space-y-8">
                <!-- Section: Informasi Umum -->
                <div class="bg-blue-50/30 rounded-[2rem] p-8 border border-blue-50">
                    <div class="flex items-center gap-3 text-potads-blue mb-8">
                        <i data-lucide="info" class="w-6 h-6"></i>
                        <h2 class="text-xl font-bold">Informasi Umum</h2>
                    </div>

                    <div class="space-y-6">
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Judul Artikel <span class="text-red-500">*</span></label>
                            <input type="text" name="title" value="{{ old('title', $article->title) }}" required placeholder="Masukkan judul menarik..." class="w-full bg-white border border-gray-200 rounded-xl py-3 px-6 text-sm focus:outline-none focus:ring-2 focus:ring-potads-blue/20 transition">
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Nama Penulis</label>
                            <input type="text" value="{{ auth()->user()->name }}" disabled class="w-full bg-gray-100 border border-gray-200 rounded-xl py-3 px-6 text-sm text-gray-500 cursor-not-allowed">
                            <p class="text-[10px] text-gray-400 mt-1">Artikel akan diterbitkan atas nama akun Anda.</p>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-bold text-gray-700 mb-2">Kategori Artikel</label>
                                <input type="text" name="category" value="{{ old('category', $article->category) }}" placeholder="Edukasi, Cerita, dll..." class="w-full bg-white border border-gray-200 rounded-xl py-3 px-6 text-sm focus:outline-none focus:ring-2 focus:ring-potads-blue/20 transition">
                            </div>
                            <div>
                                <label class="block text-sm font-bold text-gray-700 mb-2">Status Publikasi</label>
                                <select name="status" class="w-full bg-white border border-gray-200 rounded-xl py-3 px-6 text-sm focus:outline-none focus:ring-2 focus:ring-potads-blue/20 transition appearance-none cursor-pointer">
                                    <option value="draft" {{ old('status', $article->status) == 'draft' ? 'selected' : '' }}>Simpan sebagai Draf</option>
                                    <option value="published" {{ old('status', $article->status) == 'published' ? 'selected' : '' }}>Terbitkan Sekarang</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Section: Isi Artikel -->
                <div class="bg-blue-50/30 rounded-[2rem] p-8 border border-blue-50">
                    <div class="flex items-center gap-3 text-potads-blue mb-8">
                        <i data-lucide="file-text" class="w-6 h-6"></i>
                        <h2 class="text-xl font-bold">Isi Artikel <span class="text-red-500">*</span></h2>
                    </div>
                    <div>
                        <textarea name="content" required placeholder="Tuliskan isi artikel yang ingin Anda bagikan..." class="w-full bg-white border border-gray-200 rounded-[2rem] py-6 px-8 text-sm focus:outline-none focus:ring-2 focus:ring-potads-blue/20 transition min-h-[300px]">{{ old('content', $article->content) }}</textarea>
                    </div>
                </div>
            </div>

            <!-- Right Side: Poster & Actions -->
            <div class="lg:col-span-1 space-y-6">
                <!-- Section: Poster Artikel -->
                <div class="bg-blue-50/30 rounded-[2rem] p-8 border border-blue-50">
                    <h3 class="text-xs font-bold text-potads-blue uppercase tracking-widest mb-6">Gambar Sampul</h3>
                    <div class="border-2 border-dashed border-gray-300 rounded-[1.5rem] bg-white p-8 text-center cursor-pointer hover:border-potads-blue transition group relative" onclick="document.getElementById('image-upload').click()">
                        <div class="flex flex-col items-center">
                            <div class="bg-gray-100 p-4 rounded-xl mb-4 group-hover:bg-blue-100 transition">
                                <i data-lucide="image" class="w-8 h-8 text-gray-400 group-hover:text-potads-blue"></i>
                            </div>
                            <p class="text-sm font-bold text-gray-700 mb-1">Klik untuk unggah gambar</p>
                            <p class="text-[10px] text-gray-400 uppercase font-medium">PNG, JPG up to 2MB</p>
                        </div>
                        <input type="file" id="image-upload" name="image" class="hidden" accept="image/*" onchange="previewImage(this)">
                        
                        <!-- Show existing image if available -->
                        <div id="image-preview" class="{{ $article->image ? '' : 'hidden' }} absolute inset-0 bg-white rounded-[1.5rem] overflow-hidden">
                            <img src="{{ $article->image ? (Str::startsWith($article->image, 'http') ? $article->image : asset('storage/' . $article->image)) : '' }}" alt="Preview" class="w-full h-full object-cover">
                            <div class="absolute inset-0 bg-black/40 flex items-center justify-center opacity-0 hover:opacity-100 transition">
                                <span class="text-white text-xs font-bold">Ganti Gambar</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="flex flex-col gap-4">
                    <button type="submit" class="w-full bg-potads-yellow text-potads-blue font-extrabold py-4 rounded-full shadow-lg hover:shadow-xl hover:bg-yellow-400 transition transform hover:-translate-y-1">
                        Simpan Perubahan
                    </button>
                    <a href="{{ route('profile') }}" class="w-full bg-blue-50 text-potads-blue font-bold py-4 rounded-full text-center hover:bg-blue-100 transition">
                        Batal
                    </a>
                </div>

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
        </form>
    </main>

    <script>
        function previewImage(input) {
            const preview = document.getElementById('image-preview');
            const previewImg = preview.querySelector('img');
            
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    previewImg.src = e.target.result;
                    preview.classList.remove('hidden');
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
@endsection
