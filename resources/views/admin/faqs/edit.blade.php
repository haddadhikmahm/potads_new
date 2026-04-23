@extends('layouts.admin')

@section('title', 'Ubah FAQ')

@section('header_title', 'Ubah FAQ')
@section('header_breadcrumb', 'DASHBOARD > FAQ > UBAH DATA')

@section('content')
<div class="max-w-5xl">
    <div class="mb-6 flex justify-between items-center">
        <div></div> <!-- Empty div for space -->
        <a href="{{ route('admin.faqs.index') }}" class="flex items-center gap-2 text-slate-400 font-bold hover:text-potads-blue transition-colors text-sm">
            <i data-lucide="arrow-left" class="w-4 h-4"></i>
            Kembali ke Daftar
        </a>
    </div>

    <div class="bg-white rounded-[2.5rem] shadow-sm border border-slate-100 p-8 md:p-12">
        <form action="{{ route('admin.faqs.update', $faq) }}" method="POST" class="space-y-10">
            @csrf
            @method('PUT')

            <div class="space-y-8">
                <!-- Question -->
                <div class="space-y-4">
                    <label class="text-sm font-bold text-potads-blue ml-1">Pertanyaan</label>
                    <input type="text" name="question" value="{{ old('question', $faq->question) }}" required
                        class="w-full px-8 py-5 bg-slate-50 border-none rounded-2xl focus:ring-2 focus:ring-potads-blue/10 transition-all text-slate-700 font-medium @error('question') ring-2 ring-red-500/20 @enderror"
                        placeholder="Masukkan pertanyaan FAQ...">
                    @error('question') <p class="text-red-500 text-xs mt-1 ml-1">{{ $message }}</p> @enderror
                </div>

                <!-- Answer -->
                <div class="space-y-4">
                    <label class="text-sm font-bold text-potads-blue ml-1">Jawaban</label>
                    <textarea name="answer" rows="8" required
                        class="w-full px-8 py-5 bg-slate-50 border-none rounded-2xl focus:ring-2 focus:ring-potads-blue/10 transition-all text-slate-700 font-medium @error('answer') ring-2 ring-red-500/20 @enderror"
                        placeholder="Tuliskan jawaban lengkap...">{{ old('answer', $faq->answer) }}</textarea>
                    @error('answer') <p class="text-red-500 text-xs mt-1 ml-1">{{ $message }}</p> @enderror
                </div>

                <!-- Order Priority -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div class="space-y-4">
                        <label class="text-sm font-bold text-potads-blue ml-1">Urutan Priority</label>
                        <input type="number" name="order" value="{{ old('order', $faq->order) }}"
                            class="w-full px-8 py-5 bg-slate-50 border-none rounded-2xl focus:ring-2 focus:ring-potads-blue/10 transition-all text-slate-700 font-medium"
                            placeholder="Contoh: 1">
                    </div>
                    <div class="space-y-4 flex flex-col justify-end">
                        <div class="flex items-center gap-4 px-8 py-5 bg-slate-50 rounded-2xl">
                            <label class="flex items-center cursor-pointer gap-3">
                                <input type="checkbox" name="is_active" value="1" {{ $faq->is_active ? 'checked' : '' }} class="w-5 h-5 rounded border-slate-300 text-potads-blue focus:ring-potads-blue">
                                <span class="text-xs font-bold text-potads-blue uppercase tracking-wider">Aktifkan Sekarang</span>
                            </label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="flex items-center justify-center gap-4 pt-6">
                <a href="{{ route('admin.faqs.index') }}" class="px-12 py-4 bg-slate-50 text-potads-blue rounded-full font-bold hover:bg-slate-100 transition-all border border-slate-100">
                    Batal
                </a>
                <button type="submit" class="px-12 py-4 bg-potads-yellow text-slate-900 rounded-full font-bold shadow-lg shadow-yellow-400/20 hover:scale-[1.02] active:scale-[0.98] transition-all">
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
