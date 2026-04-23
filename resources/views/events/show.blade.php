@extends('layouts.frontend')

@section('title', $event->title . ' - PIK POTADS')

@section('content')
    <main class="max-w-7xl mx-auto px-6 md:px-12 py-12">
        <!-- Breadcrumb -->
        <nav class="flex text-sm text-gray-400 mb-8" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1">
                <li><a href="{{ route('events.index') }}" class="hover:text-potads-blue transition">Event</a></li>
                <li class="flex items-center">
                    <i data-lucide="chevron-right" class="w-4 h-4 mx-1"></i>
                    <span class="text-gray-600 line-clamp-1">{{ $event->title }}</span>
                </li>
            </ol>
        </nav>

        <div class="flex flex-col lg:flex-row gap-16">
            <!-- Left: Hero Image & Description -->
            <div class="lg:w-7/12">
                <div class="rounded-[3rem] overflow-hidden shadow-2xl mb-12">
                    <img src="{{ Str::startsWith($event->image, 'http') ? $event->image : asset('storage/' . $event->image) }}" alt="{{ $event->title }}" class="w-full h-auto object-cover aspect-[16/10]">
                </div>

                <div class="prose prose-lg max-w-none text-gray-600 leading-relaxed">
                    <h2 class="text-3xl font-bold text-potads-blue mb-6">Tentang Event</h2>
                    {!! nl2br(e($event->description)) !!}
                </div>
            </div>

            <!-- Right: Event Details Card -->
            <div class="lg:w-5/12">
                <div class="bg-white rounded-[3rem] p-10 shadow-xl border border-gray-100 sticky top-24">
                    <h1 class="text-3xl font-extrabold text-potads-blue mb-8 leading-tight">{{ $event->title }}</h1>
                    
                    <div class="space-y-8 mb-10">
                        <div class="flex items-start gap-4">
                            <div class="bg-blue-50 p-3 rounded-2xl">
                                <i data-lucide="calendar" class="w-6 h-6 text-potads-blue"></i>
                            </div>
                            <div>
                                <p class="text-xs font-bold text-gray-400 uppercase tracking-widest">Tanggal</p>
                                <p class="text-lg font-bold text-gray-800">{{ \Carbon\Carbon::parse($event->date)->format('d F Y') }}</p>
                            </div>
                        </div>

                        <div class="flex items-start gap-4">
                            <div class="bg-yellow-50 p-3 rounded-2xl">
                                <i data-lucide="map-pin" class="w-6 h-6 text-yellow-600"></i>
                            </div>
                            <div>
                                <p class="text-xs font-bold text-gray-400 uppercase tracking-widest">Lokasi</p>
                                <p class="text-lg font-bold text-gray-800">{{ $event->location }}</p>
                            </div>
                        </div>

                        <div class="flex items-start gap-4">
                            <div class="bg-blue-50 p-3 rounded-2xl">
                                <i data-lucide="info" class="w-6 h-6 text-potads-blue"></i>
                            </div>
                            <div>
                                <p class="text-xs font-bold text-gray-400 uppercase tracking-widest">Status</p>
                                <p class="text-lg font-bold text-potads-blue">{{ \Carbon\Carbon::parse($event->date)->isPast() ? 'Selesai' : 'Mendatang' }}</p>
                            </div>
                        </div>
                    </div>

                    @if(!\Carbon\Carbon::parse($event->date)->isPast())
                        <div class="p-6 bg-blue-50 rounded-3xl border border-blue-100 mb-8">
                            <p class="text-sm font-semibold text-potads-blue">Tertarik bergabung?</p>
                            <p class="text-xs text-gray-500 mt-1">Silakan datang langsung ke lokasi atau hubungi kami untuk informasi pendaftaran.</p>
                        </div>
                    @endif

                    <a href="{{ route('donations.index') }}" class="block w-full text-center bg-potads-yellow text-potads-blue font-extrabold py-5 rounded-2xl shadow-lg hover:shadow-xl transition-all transform active:scale-95">
                        Dukung Event Ini (Donasi)
                    </a>
                </div>
            </div>
        </div>
    </main>
@endsection
