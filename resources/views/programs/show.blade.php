@extends('layouts.frontend')

@section('title', $program->title . ' - Program Yayasan PIK POTADS')

@section('content')
    <!-- Content Section -->
    <main class="max-w-7xl mx-auto px-6 md:px-12 py-8">
        <!-- Breadcrumb -->
        <nav class="flex text-sm text-gray-400 mb-8" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-3">
                <li><a href="{{ route('about') }}" class="hover:text-potads-blue transition">Tentang Kami</a></li>
                <li class="flex items-center">
                    <i data-lucide="chevron-right" class="w-4 h-4 mx-1"></i>
                    <span class="text-gray-600 line-clamp-1">{{ $program->title }}</span>
                </li>
            </ol>
        </nav>

        <div class="flex flex-col lg:flex-row gap-12">
            <!-- Left Column: Main Content -->
            <div class="lg:w-2/3">
                <div class="rounded-[2.5rem] overflow-hidden mb-8 shadow-sm bg-white border-4 border-white">
                    <img src="{{ Str::startsWith($program->image, 'http') ? $program->image : asset('storage/' . $program->image) }}" alt="{{ $program->title }}" class="w-full h-auto object-cover max-h-[500px]">
                </div>
                
                <div class="mb-10">
                    <h1 class="text-4xl md:text-5xl font-black text-potads-blue mb-6 leading-tight">
                        {{ $program->title }}
                    </h1>
                    <div class="w-20 h-2 bg-potads-yellow rounded-full"></div>
                </div>

                <div class="prose prose-lg max-w-none text-gray-700 leading-relaxed font-medium">
                    @if($program->content)
                        {!! nl2br(e($program->content)) !!}
                    @else
                        {{ $program->description }}
                    @endif
                </div>
                
                <div class="mt-16 p-8 bg-pastel-yellow rounded-[2.5rem] border-4 border-white shadow-xl flex items-center gap-8">
                    <div class="w-20 h-20 bg-white rounded-2xl flex items-center justify-center text-yellow-600 shadow-sm shrink-0">
                        <i data-lucide="help-circle" class="w-10 h-10"></i>
                    </div>
                    <div>
                        <h4 class="text-xl font-bold text-potads-blue mb-2 text-left">Tertarik dengan Program ini?</h4>
                        <p class="text-gray-600 mb-0 text-left">Hubungi admin kami untuk informasi lebih lanjut mengenai pelaksanaan dan pendaftaran program.</p>
                    </div>
                    <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $siteSettings['contact_phone'] ?? '') }}?text=Halo%20Admin%20POTADS,%20saya%20ingin%20bertanya%20mengenai%20program%20{{ urlencode($program->title) }}..." target="_blank" class="bg-potads-blue text-white px-8 py-4 rounded-full font-bold hover:bg-blue-900 transition shrink-0">
                        Tanya Admin
                    </a>
                </div>
            </div>

            <!-- Right Column: Sidebar (Other Programs) -->
            <div class="lg:w-1/3">
                <div class="bg-blue-50/50 rounded-[2.5rem] p-8 border border-blue-100 sticky top-24">
                    <h2 class="text-xl font-extrabold text-potads-blue mb-8 border-b border-blue-100 pb-4">Program Lainnya</h2>
                    
                    @php 
                        $otherPrograms = \App\Models\Program::where('id', '!=', $program->id)->latest()->take(5)->get();
                    @endphp

                    <div class="space-y-8">
                        @forelse($otherPrograms as $other)
                            <div class="flex gap-4 group">
                                <div class="flex-grow">
                                    <a href="{{ route('programs.show', $other->slug) }}" class="text-blue-500 font-bold text-sm leading-snug group-hover:text-potads-blue transition line-clamp-3">
                                        {{ $other->title }}
                                    </a>
                                </div>
                                <div class="w-20 h-20 bg-potads-yellow rounded-2xl overflow-hidden shrink-0 border-2 border-white shadow-sm">
                                    <img src="{{ Str::startsWith($other->image, 'http') ? $other->image : asset('storage/' . $other->image) }}" alt="{{ $other->title }}" class="w-full h-full object-cover">
                                </div>
                            </div>
                        @empty
                            <p class="text-gray-400 italic text-sm">Tidak ada program lainnya.</p>
                        @endforelse
                    </div>

                    <div class="mt-10">
                        <a href="{{ route('about') }}" class="block text-center bg-white text-potads-blue border-2 border-potads-blue/10 py-4 rounded-2xl font-bold hover:bg-gray-50 transition">Kembali ke Tentang Kami</a>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
