@extends('layouts.frontend')

@section('title', 'Tanya Jawab (FAQ) - PIK POTADS')

@section('content')
<!-- Hero Section -->
<section class="bg-potads-blue py-20 px-6 md:px-12 text-center text-white relative overflow-hidden">
    <div class="absolute -bottom-20 -right-20 w-96 h-96 bg-potads-yellow/20 rounded-full blur-3xl"></div>
    <div class="relative z-10 max-w-3xl mx-auto">
        <h1 class="text-4xl md:text-5xl font-extrabold mb-6">Tanya Jawab (FAQ)</h1>
        <p class="text-lg text-white/80 leading-relaxed">
            Menemukan jawaban atas pertanyaan umum seputar Down Syndrome dan bagaimana POTADS dapat membantu perjalanan keluarga Anda.
        </p>
    </div>
</section>

<!-- FAQ Section -->
<section class="px-6 md:px-12 py-20 max-w-4xl mx-auto">
    <div class="space-y-6" x-data="{ active: null }">
        @forelse($faqs as $faq)
            <div class="bg-white rounded-3xl border border-slate-100 shadow-sm overflow-hidden transition-all duration-300" 
                 :class="{ 'border-potads-yellow ring-4 ring-potads-yellow/5 shadow-lg': active === {{ $faq->id }} }">
                <button @click="active = active === {{ $faq->id }} ? null : {{ $faq->id }}" 
                        class="w-full px-8 py-6 text-left flex items-center justify-between gap-4 group focus:outline-none">
                    <span class="text-lg font-bold text-potads-blue group-hover:text-blue-600 transition-colors">{{ $faq->question }}</span>
                    <div class="flex-shrink-0 w-8 h-8 rounded-full bg-slate-50 flex items-center justify-center group-hover:bg-potads-yellow transition-colors"
                         :class="{ 'bg-potads-yellow rotate-180': active === {{ $faq->id }} }">
                        <i data-lucide="chevron-down" class="w-5 h-5 text-slate-400 group-hover:text-potads-blue transition-colors"
                           :class="{ 'text-potads-blue': active === {{ $faq->id }} }"></i>
                    </div>
                </button>
                <div x-show="active === {{ $faq->id }}" 
                     x-cloak
                     x-collapse
                     class="px-8 pb-8">
                    <div class="pt-4 border-t border-slate-50 text-slate-600 leading-relaxed text-lg">
                        {!! nl2br(e($faq->answer)) !!}
                    </div>
                </div>
            </div>
        @empty
            <div class="py-20 text-center">
                <i data-lucide="help-circle" class="w-16 h-16 text-slate-200 mx-auto mb-4"></i>
                <p class="text-slate-400 font-medium">Belum ada pertanyaan terdaftar saat ini.</p>
            </div>
        @endforelse
    </div>

    <!-- Still have questions? -->
    <div class="mt-20 p-12 bg-blue-50 text-center rounded-[3rem]">
        <h3 class="text-2xl font-bold text-potads-blue mb-4">Masih memiliki pertanyaan?</h3>
        <p class="text-slate-500 mb-8">Hubungi kami langsung melalui email atau media sosial, kami siap membantu Anda.</p>
        <a href="#" class="bg-potads-blue text-white px-10 py-4 rounded-2xl font-bold inline-block hover:scale-105 transition-transform shadow-lg shadow-blue-900/10">
            Hubungi Kami
        </a>
    </div>
</section>
@endsection

@push('scripts')
<script src="https://unpkg.com/@alpinejs/collapse@3.x.x/dist/cdn.min.js" defer></script>
<script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
@endpush
