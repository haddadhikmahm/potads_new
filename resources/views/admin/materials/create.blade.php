@extends('layouts.admin')

@section('title', 'Tambah Materi Baru')

@section('header_title', 'Materi Baru')
@section('header_breadcrumb', 'Add New Material')

@section('content')
<div class="w-full">
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
                                        class="w-full px-6 py-4 bg-slate-50 border-none rounded-2xl focus:ring-2 focus:ring-potads-blue/10 transition-all text-slate-700 font-medium @error('url') ring-2 ring-red-500/20 @enderror"
                                        placeholder="https://youtube.com/watch?v=...">
                                    @error('url') <p class="text-red-500 text-xs mt-1 ml-1">{{ $message }}</p> @enderror
                                </div>
                            </template>
                            <template x-if="type === 'file'">
                                <div class="space-y-2">
                                    <label class="text-[10px] font-bold text-slate-400 uppercase tracking-wider ml-1">Upload File (PDF/Doc/Zip)</label>
                                    <input type="file" name="file"
                                        class="w-full px-6 py-4 bg-slate-50 border-none rounded-2xl focus:ring-2 focus:ring-potads-blue/10 transition-all text-slate-700 font-medium file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-xs file:font-bold file:bg-potads-blue/10 file:text-potads-blue hover:file:bg-potads-blue/20 @error('file') ring-2 ring-red-500/20 @enderror">
                                    @error('file') <p class="text-red-500 text-xs mt-1 ml-1">{{ $message }}</p> @enderror
                                </div>
                            </template>
                        </div>
                    </div>

                    <!-- Category & Audience -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="space-y-2">
                            <label class="text-[10px] font-bold text-potads-blue uppercase tracking-wider ml-1">Kategori</label>
                            <input type="text" name="category" value="{{ old('category') }}"
                                class="w-full px-6 py-4 bg-slate-50 border-none rounded-2xl focus:ring-2 focus:ring-potads-blue/10 transition-all text-slate-700 font-medium"
                                placeholder="Contoh: Seminar, Latihan, Artikel">
                        </div>
                        <div class="space-y-2">
                            <label class="text-[10px] font-bold text-potads-blue uppercase tracking-wider ml-1">Target Audiens</label>
                            <select name="audience" required
                                class="w-full px-6 py-4 bg-slate-50 border-none rounded-2xl focus:ring-2 focus:ring-potads-blue/10 transition-all text-slate-700 font-medium">
                                <option value="parent" {{ old('audience') == 'parent' ? 'selected' : '' }}>Materi Orang Tua</option>
                                <option value="child" {{ old('audience') == 'child' ? 'selected' : '' }}>Materi Anak</option>
                            </select>
                        </div>
                    </div>

                    <!-- Sort Order & Level -->
                    <div class="grid grid-cols-2 gap-4">
                        <div class="space-y-2">
                            <label class="text-[10px] font-bold text-potads-blue uppercase tracking-wider ml-1">Urutan (Step)</label>
                            <input type="number" name="sort_order" value="{{ old('sort_order', 1) }}" required
                                class="w-full px-6 py-4 bg-slate-50 border-none rounded-2xl focus:ring-2 focus:ring-potads-blue/10 transition-all text-slate-700 font-medium @error('sort_order') ring-2 ring-red-500/20 @enderror"
                                placeholder="1, 2...">
                            @error('sort_order') <p class="text-red-500 text-xs mt-1 ml-1">{{ $message }}</p> @enderror
                        </div>
                        <div class="space-y-2">
                            <label class="text-[10px] font-bold text-potads-blue uppercase tracking-wider ml-1">Level</label>
                            <input type="number" name="level" value="{{ old('level', 1) }}" required
                                class="w-full px-6 py-4 bg-slate-50 border-none rounded-2xl focus:ring-2 focus:ring-potads-blue/10 transition-all text-slate-700 font-medium @error('level') ring-2 ring-red-500/20 @enderror"
                                placeholder="Level 1, 2...">
                            @error('level') <p class="text-red-500 text-xs mt-1 ml-1">{{ $message }}</p> @enderror
                        </div>
                    </div>
                </div>

                <!-- Quiz Manager -->
                <div class="pt-8 border-t border-slate-100" x-data="{ 
                    questions: {{ json_encode(old('quiz_data', [])) }} || [],
                    addQuestion() {
                        this.questions.push({
                            question: '',
                            options: { a: '', b: '', c: '', d: '' },
                            answer: 'a'
                        });
                    },
                    removeQuestion(index) {
                        this.questions.splice(index, 1);
                    }
                }">
                    <div class="flex items-center justify-between mb-8">
                        <div>
                            <h4 class="text-lg font-black text-slate-800">Kuis Pemahaman</h4>
                            <p class="text-xs text-slate-400">Tambahkan soal pilihan ganda untuk materi ini</p>
                        </div>
                        <button type="button" @click="addQuestion()" class="px-4 py-2 bg-potads-blue/10 text-potads-blue rounded-xl font-bold text-xs hover:bg-potads-blue/20 transition-all flex items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-plus"><path d="M5 12h14"/><path d="M12 5v14"/></svg>
                            Tambah Soal
                        </button>
                    </div>

                    <div class="space-y-6">
                        <template x-for="(q, index) in questions" :key="index">
                            <div class="p-6 bg-slate-50 rounded-3xl space-y-6 relative group">
                                <button type="button" @click="removeQuestion(index)" class="absolute top-4 right-4 text-red-400 hover:text-red-600 transition-colors opacity-0 group-hover:opacity-100">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-trash-2"><path d="M3 6h18"/><path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"/><path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"/><line x1="10" x2="10" y1="11" y2="17"/><line x1="14" x2="14" y1="11" y2="17"/></svg>
                                </button>
                                
                                <div class="space-y-2">
                                    <label class="text-[10px] font-bold text-slate-400 uppercase tracking-wider ml-1" x-text="'Pertanyaan #' + (index + 1)"></label>
                                    <input type="text" :name="'quiz_data['+index+'][question]'" x-model="q.question" required
                                        class="w-full px-6 py-4 bg-white border-none rounded-2xl focus:ring-2 focus:ring-potads-blue/10 transition-all text-slate-700 font-medium"
                                        placeholder="Masukkan pertanyaan kuis...">
                                </div>

                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <template x-for="opt in ['a', 'b', 'c', 'd']" :key="opt">
                                        <div class="flex items-center gap-3">
                                            <input type="radio" :name="'quiz_data['+index+'][answer]'" :value="opt" x-model="q.answer" 
                                                class="w-6 h-6 text-potads-blue border-2 border-slate-300 focus:ring-potads-blue/20 transition-all cursor-pointer">
                                            <div class="flex-grow flex items-center bg-white rounded-2xl px-4 py-3 shadow-sm border border-slate-100">
                                                <span class="text-[10px] font-black text-slate-400 mr-2 uppercase" x-text="opt"></span>
                                                <input type="text" :name="'quiz_data['+index+'][options]['+opt+']'" x-model="q.options[opt]" required
                                                    class="w-full border-none p-0 focus:ring-0 text-sm font-bold text-slate-700"
                                                    :placeholder="'Opsi ' + opt.toUpperCase()">
                                            </div>
                                        </div>
                                    </template>
                                </div>
                                <p class="text-[9px] text-slate-400 ml-1 mt-2">*Pilih bulatan di samping opsi untuk menentukan jawaban yang benar.</p>
                            </div>
                        </template>

                        <div x-show="questions.length === 0" class="py-12 text-center bg-slate-50 rounded-[2.5rem] border-2 border-dashed border-slate-100">
                            <div class="w-16 h-16 bg-white rounded-2xl flex items-center justify-center mx-auto mb-4 text-slate-200 shadow-sm">
                                <i data-lucide="help-circle" class="w-8 h-8"></i>
                            </div>
                            <p class="text-slate-400 text-sm font-medium">Belum ada soal ditambahkan.</p>
                        </div>
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
