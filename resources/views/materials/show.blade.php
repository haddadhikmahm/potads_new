@extends('layouts.frontend')

@section('title', 'PIK POTADS - ' . $material->title)

@section('content')
<div class="bg-white min-h-screen pt-24 md:pt-32 pb-12">
    <div class="max-w-[95%] xl:max-w-screen-2xl mx-auto px-6 md:px-12 flex flex-col md:flex-row gap-8 lg:gap-12 items-start">
        
        <!-- Main Content -->
        <div class="w-full md:w-[65%]">
            <!-- Breadcrumb -->
            <div class="text-xs text-gray-500 mb-6 flex items-center gap-2">
                <a href="{{ route('materials.index') }}" class="hover:text-potads-blue transition-colors">File Materi Orang Tua</a>
                <i data-lucide="chevron-right" class="w-3 h-3"></i>
                <span class="text-gray-400">Detail Materi</span>
            </div>

            <!-- Material Image -->
            <div class="rounded-3xl overflow-hidden mb-8 shadow-sm border border-gray-100">
                @php
                    $imgSrc = $material->image ? asset('storage/' . $material->image) : 'https://images.unsplash.com/photo-1529390079861-591de354faf5?q=80&w=2070&auto=format&fit=crop';
                @endphp
                <img src="{{ $imgSrc }}" alt="{{ $material->title }}" class="w-full aspect-video object-cover">
            </div>

            <!-- Date -->
            <div class="text-right text-gray-800 font-bold text-sm mb-6">
                {{ $material->created_at->translatedFormat('d F Y') }}
            </div>

            <!-- Title -->
            <h1 class="text-3xl md:text-4xl lg:text-5xl font-extrabold text-potads-blue mb-10 text-center leading-tight max-w-5xl mx-auto">
                {{ $material->title }}
            </h1>

            <div class="prose max-w-none text-gray-700">
                <p class="font-bold text-lg mb-2 text-gray-900">Deskripsi :</p>
                <div class="text-base leading-relaxed mb-6">
                    {!! nl2br(e($material->description)) !!}
                </div>

                <div class="flex items-center gap-2 mt-4 text-lg mb-12">
                    <span class="font-bold text-gray-900">Materi:</span>
                    @if($material->url)
                        <a href="{{ $material->url }}" target="_blank" class="text-blue-500 font-semibold hover:underline">Yuk Baca Materinya!</a>
                    @elseif($material->file_path)
                        <a href="{{ asset('storage/' . $material->file_path) }}" target="_blank" class="text-blue-500 font-semibold hover:underline">Yuk Baca Materinya!</a>
                    @else
                        <span class="text-gray-500 italic">Materi belum tersedia</span>
                    @endif
                </div>

                @if(auth()->check())
                    <div class="mt-16 pt-12 border-t border-gray-100" x-data="{ 
                        quizStarted: false,
                        quizFinished: false,
                        score: 0,
                        currentQuestion: 0,
                        questions: {{ 
                            $material->quizzes->count() > 0 
                            ? json_encode($material->quizzes->map(function($q) {
                                return [
                                    'question' => $q->question,
                                    'options' => [
                                        'a' => $q->option_a,
                                        'b' => $q->option_b,
                                        'c' => $q->option_c,
                                        'd' => $q->option_d,
                                    ],
                                    'answer' => $q->correct_answer
                                ];
                            })) 
                            : json_encode([
                                [
                                    'question' => 'Apa tujuan utama dari materi pembelajaran ini?',
                                    'options' => [
                                        'a' => 'Menambah wawasan orang tua',
                                        'b' => 'Hanya untuk hiburan',
                                        'c' => 'Tidak ada tujuan',
                                        'd' => 'Mengisi waktu luang'
                                    ],
                                    'answer' => 'a'
                                ]
                            ]) 
                        }},
                        userAnswers: [],
                        
                        get canComplete() {
                            return !this.questions || this.questions.length === 0 || this.quizFinished;
                        },

                        checkAnswer(index, key) {
                            if (this.userAnswers[index]) return;
                            this.userAnswers[index] = key;
                            if (key === this.questions[index].answer) {
                                this.score++;
                            }
                            if (this.userAnswers.length === this.questions.length && !this.userAnswers.includes(undefined)) {
                                this.quizFinished = true;
                            }
                        }
                    }">
                        @if(auth()->user()->completedMaterials->contains($material->id))
                            <div class="flex flex-col items-center gap-4 text-center">
                                <div class="w-16 h-16 bg-emerald-100 text-emerald-600 rounded-full flex items-center justify-center">
                                    <i data-lucide="check-circle" class="w-8 h-8"></i>
                                </div>
                                <h4 class="text-xl font-black text-slate-800">Materi Selesai!</h4>
                                <p class="text-gray-500 text-sm">Anda telah menyelesaikan materi ini. Silakan lanjut ke materi berikutnya.</p>
                                <a href="{{ route('materials.index') }}" class="mt-4 text-potads-blue font-bold hover:underline">Kembali ke Roadmap</a>
                            </div>
                        @else
                            <!-- Quiz Section -->
                            <template x-if="questions && questions.length > 0 && !quizFinished">
                                <div class="bg-blue-50/50 p-8 rounded-[2.5rem] border-2 border-dashed border-blue-200 mb-12">
                                    <h4 class="text-xl font-black text-potads-blue mb-2 flex items-center justify-center gap-2">
                                        <i data-lucide="brain-circuit" class="w-6 h-6"></i> Kuis Pemahaman
                                    </h4>
                                    <p class="text-gray-500 text-sm text-center mb-8">Jawab kuis berikut untuk dapat menyelesaikan materi</p>
                                    
                                    <div class="space-y-10">
                                        <template x-for="(q, idx) in questions" :key="idx">
                                            <div class="text-left bg-white p-6 rounded-3xl shadow-sm">
                                                <p class="font-bold text-gray-900 mb-4 flex gap-3">
                                                    <span class="w-7 h-7 bg-potads-blue text-white rounded-full flex items-center justify-center text-xs flex-shrink-0" x-text="idx + 1"></span>
                                                    <span x-text="q.question"></span>
                                                </p>
                                                <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                                                    <template x-for="(opt, key) in q.options" :key="key">
                                                        <button 
                                                            @click="checkAnswer(idx, key)"
                                                            :disabled="userAnswers[idx]"
                                                            :class="{
                                                                'border-blue-600 bg-blue-50': userAnswers[idx] === key && key !== q.answer,
                                                                'border-emerald-600 bg-emerald-50 text-emerald-700': userAnswers[idx] && key === q.answer,
                                                                'border-gray-200 bg-gray-50 opacity-50': userAnswers[idx] && userAnswers[idx] !== key && key !== q.answer,
                                                                'border-gray-200 hover:border-potads-blue hover:bg-blue-50': !userAnswers[idx]
                                                            }"
                                                            class="p-4 rounded-2xl border-2 text-left transition-all flex items-center justify-between group">
                                                            <span class="flex items-center gap-3">
                                                                <span class="font-black uppercase text-xs text-gray-400 group-hover:text-potads-blue" x-text="key + '.'"></span>
                                                                <span class="text-sm font-bold" x-text="opt"></span>
                                                            </span>
                                                            <template x-if="userAnswers[idx] && key === q.answer">
                                                                <i data-lucide="check" class="w-4 h-4"></i>
                                                            </template>
                                                            <template x-if="userAnswers[idx] === key && key !== q.answer">
                                                                <i data-lucide="x" class="w-4 h-4"></i>
                                                            </template>
                                                        </button>
                                                    </template>
                                                </div>
                                            </div>
                                        </template>
                                    </div>
                                </div>
                            </template>

                            <!-- Quiz Results -->
                            <template x-if="quizFinished">
                                <div class="bg-white p-10 rounded-[3rem] border-4 border-emerald-100 mb-12 text-center shadow-2xl shadow-emerald-100/50 relative overflow-hidden group">
                                    <div class="absolute top-0 left-0 w-full h-2 bg-emerald-500"></div>
                                    <div class="w-24 h-24 bg-emerald-500 text-white rounded-full flex items-center justify-center mx-auto mb-6 shadow-xl shadow-emerald-200 animate-bounce">
                                        <i data-lucide="trophy" class="w-12 h-12"></i>
                                    </div>
                                    <h4 class="text-3xl font-black text-emerald-800 mb-2">Hore! Kuis Selesai</h4>
                                    
                                    <div class="flex items-center justify-center gap-8 my-8">
                                        <div class="text-center">
                                            <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-1">Benar</p>
                                            <p class="text-3xl font-black text-emerald-600" x-text="score"></p>
                                        </div>
                                        <div class="w-px h-10 bg-slate-100"></div>
                                        <div class="text-center">
                                            <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-1">Salah</p>
                                            <p class="text-3xl font-black text-red-500" x-text="questions.length - score"></p>
                                        </div>
                                        <div class="w-px h-10 bg-slate-100"></div>
                                        <div class="text-center">
                                            <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-1">Skor Akhir</p>
                                            <p class="text-3xl font-black text-potads-blue" x-text="Math.round((score / questions.length) * 100)"></p>
                                        </div>
                                    </div>

                                    <div class="flex flex-col md:flex-row items-center justify-center gap-4">
                                        <button @click="quizFinished = false; score = 0; userAnswers = [];" 
                                                class="px-8 py-4 text-slate-500 font-bold hover:text-potads-blue transition-colors flex items-center gap-2">
                                            <i data-lucide="refresh-cw" class="w-4 h-4"></i> Ulang Lagi
                                        </button>
                                        <form action="{{ route('materials.complete', $material) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="bg-potads-yellow text-potads-blue font-black px-12 py-5 rounded-full text-lg hover:bg-yellow-400 transition-all shadow-xl shadow-yellow-200 btn-playful flex items-center gap-3">
                                                Selesaikan Materi <i data-lucide="award" class="w-6 h-6"></i>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </template>

                            <div class="text-center" x-show="!quizFinished">
                                <h4 class="text-xl font-black text-slate-800 mb-6" x-show="!questions || questions.length === 0">Sudah selesai mempelajari materi ini?</h4>
                                <form action="{{ route('materials.complete', $material) }}" method="POST" x-show="!questions || questions.length === 0">
                                    @csrf
                                    <button type="submit" 
                                            class="bg-potads-yellow text-potads-blue font-black px-12 py-5 rounded-full text-lg hover:bg-yellow-400 transition-all shadow-xl shadow-yellow-200 btn-playful flex items-center gap-3 mx-auto">
                                        Selesaikan Materi <i data-lucide="award" class="w-6 h-6"></i>
                                    </button>
                                </form>
                                
                                <div x-show="questions && questions.length > 0 && !quizFinished" class="bg-gray-100 text-gray-400 font-black px-12 py-5 rounded-full text-lg inline-flex items-center gap-3 cursor-not-allowed opacity-60">
                                    Selesaikan Materi <i data-lucide="lock" class="w-5 h-5"></i>
                                </div>
                            </div>
                        @endif
                    </div>
                @else
                    <div class="mt-16 p-8 bg-blue-50 rounded-[2rem] text-center border-2 border-blue-100">
                        <p class="text-potads-blue font-bold mb-4">Ingin mencatat progres belajar Anda?</p>
                        <a href="{{ route('login') }}" class="text-blue-600 font-black hover:underline">Masuk atau Daftar</a>
                    </div>
                @endif
            </div>
        </div>

        <!-- Sidebar / 'Materi Lainnya' -->
        <div class="w-full md:w-[35%] bg-blue-50/50 p-8 rounded-3xl mt-12 md:mt-0 sticky top-32 border border-blue-100">
            <h3 class="text-xl font-bold text-gray-900 mb-8">Materi Lainnya</h3>
            
            <div class="space-y-6">
                @forelse($otherMaterials as $other)
                    <div class="flex gap-4 items-center justify-between group">
                        <a href="{{ route('materials.show', $other->id) }}" class="flex-grow pr-4">
                            <p class="text-blue-600 text-sm font-medium hover:underline leading-relaxed line-clamp-3">
                                {{ $other->title }}
                            </p>
                        </a>
                        <a href="{{ route('materials.show', $other->id) }}" class="flex-shrink-0 w-20 h-12 bg-potads-yellow rounded-lg block hover:opacity-80 transition-opacity">
                            <!-- This empty yellow block matches the design mockup -->
                        </a>
                    </div>
                @empty
                    <p class="text-gray-500 text-sm">Belum ada materi lainnya.</p>
                @endforelse
            </div>
        </div>

    </div>
</div>
@endsection
