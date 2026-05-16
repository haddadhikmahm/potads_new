@extends('layouts.frontend')

@section('title', 'PIK POTADS - File Materi Orang Tua')

@section('content')
<div class="bg-[#F8F9FB] min-h-screen py-16 px-6 md:px-12 lg:px-16 pt-24 md:pt-32">
    <div class="max-w-4xl mx-auto">
        <!-- Header -->
        <div class="text-center mb-20" data-aos="fade-up">
            <span class="text-xs font-black text-blue-600 uppercase tracking-[0.3em] mb-4 block">Learning Roadmap</span>
            <h1 class="text-5xl font-black text-potads-blue mb-6">
                {{ $audience === 'child' ? 'Materi Edukasi Anak' : 'Materi Edukasi Orang Tua' }}
            </h1>
            <p class="text-gray-500 max-w-2xl mx-auto text-lg">Selesaikan setiap tahapan materi untuk membuka wawasan baru dalam mendampingi tumbuh kembang buah hati tercinta.</p>
        </div>

        <!-- Roadmap Path -->
        <div class="relative">
            <!-- Connector Line -->
            <div class="absolute left-1/2 top-0 bottom-0 w-1.5 bg-gray-200 -translate-x-1/2 hidden md:block rounded-full"></div>

            <div class="space-y-12 relative z-10">
                @forelse($materials as $index => $material)
                    @php
                        $isCompleted = in_array($material->id, $completedMaterialIds);
                        $isLocked = !auth()->check() ? ($index > 0) : (!$isCompleted && $material->id !== $nextToComplete);
                        $isInProgress = $material->id === $nextToComplete;
                        
                        // Default to unlocked for guests for the first item
                        if (!auth()->check() && $index === 0) $isLocked = false;
                        
                        $alignment = $index % 2 == 0 ? 'md:flex-row' : 'md:flex-row-reverse';
                        $textAlign = $index % 2 == 0 ? 'md:text-right' : 'md:text-left';
                    @endphp

                    <div class="flex flex-col md:flex-row items-center gap-8 md:gap-0 {{ $alignment }}" data-aos="{{ $index % 2 == 0 ? 'fade-right' : 'fade-left' }}">
                        <!-- Content Card -->
                        <div class="w-full md:w-[42%]">
                            <div class="bg-white p-8 rounded-[2.5rem] shadow-xl border-4 transition-all duration-500 
                                {{ $isCompleted ? 'border-emerald-100 opacity-90' : '' }}
                                {{ $isInProgress ? 'border-potads-yellow scale-105 shadow-yellow-200' : '' }}
                                {{ $isLocked ? 'border-gray-100 opacity-60 grayscale' : '' }}">
                                
                                <div class="flex items-center gap-3 mb-4 {{ $index % 2 == 0 ? 'md:justify-end' : '' }}">
                                    <span class="bg-blue-50 text-blue-600 text-[10px] font-black px-3 py-1 rounded-full uppercase tracking-widest">Level {{ $material->level }}</span>
                                    @if($isCompleted)
                                        <span class="bg-emerald-50 text-emerald-600 text-[10px] font-black px-3 py-1 rounded-full uppercase tracking-widest">Selesai</span>
                                    @elseif($isInProgress)
                                        <span class="bg-amber-50 text-amber-600 text-[10px] font-black px-3 py-1 rounded-full uppercase tracking-widest">Sedang Dipelajari</span>
                                    @else
                                        <span class="bg-gray-100 text-gray-500 text-[10px] font-black px-3 py-1 rounded-full uppercase tracking-widest">Terkunci</span>
                                    @endif
                                </div>

                                <h3 class="text-2xl font-black text-potads-blue mb-4 leading-tight">{{ $material->title }}</h3>
                                <p class="text-gray-400 text-sm mb-6 line-clamp-2">{{ $material->description }}</p>
                                
                                <div class="flex {{ $index % 2 == 0 ? 'md:justify-end' : '' }}">
                                    @if($isLocked)
                                        <button disabled class="bg-gray-200 text-gray-400 font-black px-8 py-3 rounded-full text-xs flex items-center gap-2 cursor-not-allowed">
                                            <i data-lucide="lock" class="w-3.5 h-3.5"></i> Terkunci
                                        </button>
                                    @else
                                        <div class="flex flex-col sm:flex-row gap-3">
                                            <a href="{{ route('materials.show', $material->id) }}" class="bg-potads-blue text-white font-black px-8 py-3 rounded-full text-xs hover:bg-blue-900 transition-all btn-playful flex items-center justify-center gap-2">
                                                Mulai Belajar <i data-lucide="play" class="w-3.5 h-3.5 fill-current"></i>
                                            </a>
                                            @if($isInProgress && auth()->check())
                                                <form action="{{ route('materials.complete', $material->id) }}" method="POST">
                                                    @csrf
                                                    <button type="submit" class="w-full bg-white border-2 border-potads-blue/10 text-potads-blue font-black px-8 py-3 rounded-full text-xs hover:bg-gray-50 transition-all flex items-center justify-center gap-2">
                                                        Skip Materi <i data-lucide="skip-forward" class="w-3.5 h-3.5"></i>
                                                    </button>
                                                </form>
                                            @endif
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <!-- Step Indicator -->
                        <div class="w-20 h-20 rounded-full border-8 border-[#F8F9FB] flex items-center justify-center z-20 relative mx-auto
                            {{ $isCompleted ? 'bg-emerald-500' : '' }}
                            {{ $isInProgress ? 'bg-potads-yellow' : '' }}
                            {{ $isLocked ? 'bg-gray-300' : '' }}">
                            
                            @if($isCompleted)
                                <i data-lucide="check" class="w-8 h-8 text-white"></i>
                            @elseif($isLocked)
                                <i data-lucide="lock" class="w-6 h-6 text-white opacity-50"></i>
                            @else
                                <span class="text-2xl font-black {{ $isInProgress ? 'text-potads-blue' : 'text-white' }}">{{ $index + 1 }}</span>
                            @endif
                        </div>

                        <!-- Spacer for Grid alignment -->
                        <div class="hidden md:block w-[42%]"></div>
                    </div>
                @empty
                    <div class="py-32 text-center bg-white rounded-[4rem] border-4 border-dashed border-gray-100">
                        <i data-lucide="folder-open" class="w-16 h-16 mx-auto mb-6 text-gray-300"></i>
                        <p class="text-gray-400 text-xl font-black">Materi belum tersedia.</p>
                    </div>
                @endforelse
            </div>
        </div>

        @if(!auth()->check())
            <div class="mt-20 bg-white p-10 rounded-[3rem] text-center shadow-xl border-4 border-potads-blue/5">
                <h4 class="text-2xl font-black text-potads-blue mb-4">Ingin menyimpan progres belajar Anda?</h4>
                <p class="text-gray-500 mb-8">Daftar atau masuk sebagai Member POTADS untuk membuka semua materi dan melacak tahapan belajar Anda.</p>
                <div class="flex flex-col md:flex-row justify-center gap-4">
                    <a href="{{ route('login') }}" class="bg-potads-blue text-white font-black px-12 py-4 rounded-full text-sm btn-playful">Masuk Sekarang</a>
                    <a href="{{ route('register') }}" class="border-4 border-potads-blue text-potads-blue font-black px-12 py-4 rounded-full text-sm btn-playful">Daftar Member</a>
                </div>
            </div>
        @endif
    </div>
</div>
@endsection
