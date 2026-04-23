@extends('layouts.admin')

@section('title', 'Tambah Materi Baru')

@section('header_title', 'Materi Baru')
@section('header_breadcrumb', 'Add New Material')

@section('content')
<div class="max-w-4xl">
    <div class="bg-white rounded-[2.5rem] shadow-sm border border-slate-100 p-8 md:p-12">
        <form action="{{ route('admin.materials.store') }}" method="POST" enctype="multipart/form-data" class="space-y-8">
            @csrf

            <div class="space-y-6">
                <!-- Title -->
                <div class="space-y-2">
                    <label class="text-[10px] font-bold text-potads-blue uppercase tracking-wider ml-1">Judul Materi</label>
                    <input type="text" name="title" value="{{ old('title') }}" required
                        class="w-full px-6 py-4 bg-slate-50 border-none rounded-2xl focus:ring-2 focus:ring-potads-blue/10 transition-all text-slate-700 font-medium @error('title') ring-2 ring-red-500/20 @enderror"
                        placeholder="Masukkan judul materi...">
                    @error('title') <p class="text-red-500 text-xs mt-1 ml-1">{{ $message }}</p> @enderror
                </div>

                <!-- Description -->
                <div class="space-y-2">
                    <label class="text-[10px] font-bold text-potads-blue uppercase tracking-wider ml-1">Deskripsi</label>
                    <textarea name="description" rows="4"
                        class="w-full px-6 py-4 bg-slate-50 border-none rounded-2xl focus:ring-2 focus:ring-potads-blue/10 transition-all text-slate-700 font-medium @error('description') ring-2 ring-red-500/20 @enderror"
                        placeholder="Tuliskan deskripsi singkat materi...">{{ old('description') }}</textarea>
                    @error('description') <p class="text-red-500 text-xs mt-1 ml-1">{{ $message }}</p> @enderror
                </div>

                <!-- Image (Thumbnail) -->
                <div class="space-y-2">
                    <label class="text-[10px] font-bold text-potads-blue uppercase tracking-wider ml-1">Gambar Sampul (Opsional)</label>
                    <input type="file" name="image"
                        class="w-full px-6 py-4 bg-slate-50 border-none rounded-2xl focus:ring-2 focus:ring-potads-blue/10 transition-all text-slate-700 font-medium file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-xs file:font-bold file:bg-potads-blue/10 file:text-potads-blue hover:file:bg-potads-blue/20">
                    @error('image') <p class="text-red-500 text-xs mt-1 ml-1">{{ $message }}</p> @enderror
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <!-- Type Selection -->
                    <div class="space-y-2" x-data="{ type: '{{ old('type', 'video') }}' }">
                        <label class="text-[10px] font-bold text-potads-blue uppercase tracking-wider ml-1">Tipe Materi</label>
                        <select name="type" x-model="type" required
                            class="w-full px-6 py-4 bg-slate-50 border-none rounded-2xl focus:ring-2 focus:ring-potads-blue/10 transition-all text-slate-700 font-medium @error('type') ring-2 ring-red-500/20 @enderror">
                            <option value="video">Video (URL)</option>
                            <option value="file">File (Upload)</option>
                        </select>
                        @error('type') <p class="text-red-500 text-xs mt-1 ml-1">{{ $message }}</p> @enderror

                        <!-- Conditional Input -->
                        <div class="mt-6">
                            <template x-if="type === 'video'">
                                <div class="space-y-2">
                                    <label class="text-[10px] font-bold text-slate-400 uppercase tracking-wider ml-1">URL Video (YouTube/Vimeo)</label>
                                    <input type="url" name="url" value="{{ old('url') }}"
                                        class="w-full px-6 py-4 bg-slate-50 border-none rounded-2xl focus:ring-2 focus:ring-potads-blue/10 transition-all text-slate-700 font-medium"
                                        placeholder="https://youtube.com/watch?v=...">
                                </div>
                            </template>
                            <template x-if="type === 'file'">
                                <div class="space-y-2">
                                    <label class="text-[10px] font-bold text-slate-400 uppercase tracking-wider ml-1">Upload File (PDF/Doc/Zip)</label>
                                    <input type="file" name="file"
                                        class="w-full px-6 py-4 bg-slate-50 border-none rounded-2xl focus:ring-2 focus:ring-potads-blue/10 transition-all text-slate-700 font-medium file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-xs file:font-bold file:bg-potads-blue/10 file:text-potads-blue hover:file:bg-potads-blue/20">
                                </div>
                            </template>
                        </div>
                    </div>

                    <!-- Category -->
                    <div class="space-y-2">
                        <label class="text-[10px] font-bold text-potads-blue uppercase tracking-wider ml-1">Kategori</label>
                        <input type="text" name="category" value="{{ old('category') }}"
                            class="w-full px-6 py-4 bg-slate-50 border-none rounded-2xl focus:ring-2 focus:ring-potads-blue/10 transition-all text-slate-700 font-medium"
                            placeholder="Contoh: Seminar, Latihan, Artikel">
                    </div>
                </div>
            </div>

            <div class="flex items-center gap-4 pt-6">
                <button type="submit" class="px-10 py-4 bg-potads-blue text-white rounded-2xl font-bold shadow-lg shadow-blue-900/20 hover:scale-[1.02] active:scale-[0.98] transition-all">
                    Simpan Materi
                </button>
                <a href="{{ route('admin.materials.index') }}" class="px-10 py-4 bg-white border-2 border-slate-100 text-slate-500 rounded-2xl font-bold hover:bg-slate-50 transition-all">
                    Batal
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
