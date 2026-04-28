@extends('layouts.frontend')

@section('title', 'Event - PIK POTADS')

@section('content')
    <!-- Header Section -->
    <header class="px-6 md:px-12 lg:px-16 py-16 max-w-[1850px] mx-auto text-left" data-aos="fade-up">
        <h1 class="text-6xl md:text-8xl font-black text-potads-blue mb-8 leading-[1.1]">
            Koneksi <br>
            <span class="ml-12 lg:ml-24 inline-block bg-potads-yellow px-8 py-2 rounded-[1.5rem] text-potads-blue">Komunitas</span>
        </h1>
        <p class="text-gray-500 max-w-3xl text-xl leading-relaxed mb-12">
            Bergabunglah dengan kami untuk lokakarya, gala, dan jalan santai komunitas. Setiap acara adalah langkah menuju masa depan yang lebih cerah bagi semua.
        </p>

        <!-- Filters -->
        <div class="flex flex-wrap gap-4 mb-20">
            <button class="bg-potads-yellow text-potads-blue font-extrabold px-10 py-2.5 rounded-full btn-playful shadow-lg transition">Upcoming</button>
            <button class="bg-white text-potads-blue/60 font-bold px-10 py-2.5 rounded-full border-2 border-potads-blue/10 hover:bg-gray-50 transition btn-playful">Recent</button>
            <button class="bg-white text-potads-blue/60 font-bold px-10 py-2.5 rounded-full border-2 border-potads-blue/10 hover:bg-gray-50 transition btn-playful">Passed</button>
        </div>
    </header>

    <!-- Events Layout -->
    <section class="px-6 md:px-12 lg:px-16 pb-32 max-w-[1850px] mx-auto" data-aos="fade-up">
        @if($events->count() > 0)
            @php $events_list = $events->all(); @endphp
            
            <!-- Top Asymmetrical Grid -->
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 mb-10">
                <!-- Large Featured Card -->
                @if(isset($events_list[0]))
                    @php $event = $events_list[0]; @endphp
                    <div class="lg:col-span-7 relative h-[600px] md:h-[750px] rounded-[3rem] overflow-hidden group shadow-2xl border-4 border-white bg-white">
                        <img src="{{ Str::startsWith($event->image, 'http') ? $event->image : asset('storage/' . $event->image) }}" alt="{{ $event->title }}" class="absolute inset-0 w-full h-full object-cover group-hover:scale-105 transition duration-1000">
                        <div class="absolute inset-0 bg-gradient-to-t from-potads-blue/90 via-potads-blue/20 to-transparent p-12 flex flex-col justify-end">
                            <h3 class="text-4xl md:text-5xl font-black text-white mb-8 leading-tight max-w-2xl">{{ $event->title }}</h3>
                            <div class="flex flex-wrap gap-8 text-white/90 text-base font-medium">
                                <span class="flex items-center gap-3"><i data-lucide="calendar" class="w-5 h-5 text-potads-yellow"></i> {{ \Carbon\Carbon::parse($event->date)->format('d Agusus Y') }}</span>
                                <span class="flex items-center gap-3"><i data-lucide="map-pin" class="w-5 h-5 text-potads-yellow"></i> {{ $event->location }}</span>
                            </div>
                        </div>
                        <a href="{{ route('events.show', $event) }}" class="absolute bottom-12 right-12">
                            <div class="bg-white/20 backdrop-blur-md p-4 rounded-full text-white hover:bg-potads-yellow hover:text-potads-blue transition-all duration-300">
                                <i data-lucide="arrow-up-right" class="w-8 h-8"></i>
                            </div>
                        </a>
                    </div>
                @endif

                <!-- Secondary Card -->
                @if(isset($events_list[1]))
                    @php $event = $events_list[1]; @endphp
                    <div class="lg:col-span-5 relative h-[450px] md:h-[550px] rounded-[3rem] overflow-hidden group shadow-2xl self-start border-4 border-white bg-white">
                        <img src="{{ Str::startsWith($event->image, 'http') ? $event->image : asset('storage/' . $event->image) }}" alt="{{ $event->title }}" class="absolute inset-0 w-full h-full object-cover group-hover:scale-105 transition duration-1000">
                        <div class="absolute inset-0 bg-gradient-to-t from-potads-blue/90 via-transparent to-transparent p-10 flex flex-col justify-end">
                            <h3 class="text-3xl font-black text-white mb-6 leading-tight">{{ $event->title }}</h3>
                            <div class="flex flex-col gap-3 text-white/90 text-sm font-medium">
                                <span class="flex items-center gap-2"><i data-lucide="calendar" class="w-4 h-4 text-potads-yellow"></i> {{ \Carbon\Carbon::parse($event->date)->format('d Agusus Y') }}</span>
                                <span class="flex items-center gap-2"><i data-lucide="map-pin" class="w-4 h-4 text-potads-yellow"></i> {{ $event->location }}</span>
                            </div>
                        </div>
                        <a href="{{ route('events.show', $event) }}" class="absolute bottom-10 right-10">
                            <div class="bg-white/20 backdrop-blur-md p-3 rounded-full text-white hover:bg-potads-yellow hover:text-potads-blue transition-all">
                                <i data-lucide="arrow-up-right" class="w-6 h-6"></i>
                            </div>
                        </a>
                    </div>
                @endif
            </div>

            <!-- Bottom Row Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10">
                @foreach(array_slice($events_list, 2) as $event)
                    <div class="relative h-[400px] rounded-[2.5rem] overflow-hidden group shadow-xl border-4 border-white bg-white">
                        <!-- Date Badge -->
                        <div class="absolute top-0 left-0 z-20">
                            <div class="bg-potads-yellow text-potads-blue font-black px-6 py-2 rounded-br-2xl text-sm">
                                {{ \Carbon\Carbon::parse($event->date)->format('d F Y') }}
                            </div>
                        </div>
                        
                        <img src="{{ Str::startsWith($event->image, 'http') ? $event->image : asset('storage/' . $event->image) }}" alt="{{ $event->title }}" class="absolute inset-0 w-full h-full object-cover group-hover:scale-105 transition duration-700">
                        <div class="absolute inset-0 bg-gradient-to-t from-potads-blue/95 via-transparent to-transparent p-8 flex flex-col justify-end">
                            <h3 class="text-2xl font-black text-white leading-tight mb-4">{{ $event->title }}</h3>
                            <div class="flex flex-col gap-2 text-white/70 text-xs font-medium">
                                <span class="flex items-center gap-2"><i data-lucide="calendar" class="w-3.5 h-3.5 text-potads-yellow"></i> {{ \Carbon\Carbon::parse($event->date)->format('d M Y') }}</span>
                                <span class="flex items-center gap-2"><i data-lucide="map-pin" class="w-3.5 h-3.5 text-potads-yellow"></i> {{ $event->location }}</span>
                            </div>
                        </div>
                        <a href="{{ route('events.show', $event) }}" class="absolute bottom-10 right-10">
                            <div class="bg-white/10 backdrop-blur-md p-3 rounded-full text-white hover:bg-potads-yellow hover:text-potads-blue transition-all">
                                <i data-lucide="arrow-up-right" class="w-5 h-5"></i>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="mt-24 flex justify-center">
                {{ $events->links() }}
            </div>
        @else
            <div class="text-center py-32 bg-gray-50 rounded-[4rem] border-2 border-dashed border-gray-200">
                <i data-lucide="calendar-x" class="w-16 h-16 text-gray-300 mx-auto mb-6"></i>
                <p class="text-gray-400 text-xl font-medium">Belum ada event yang tersedia saat ini.</p>
            </div>
        @endif
    </section>

    <!-- Create Event CTA -->
    <section class="px-6 md:px-12 lg:px-16 py-32 bg-pastel-green rounded-[3rem] mx-4 md:mx-12 my-12 border-4 border-white shadow-xl" data-aos="fade-up">
        <div class="max-w-[1600px] mx-auto flex flex-col lg:flex-row items-center gap-20">
            <div class="w-full lg:w-1/2 relative">
                <!-- Floating decorative element -->
                <div class="absolute -top-10 -left-10 w-40 h-40 bg-potads-yellow/20 rounded-full blur-3xl"></div>
                <div class="relative rounded-[3rem] overflow-hidden shadow-[0_40px_80px_-15px_rgba(0,0,0,0.2)] bg-white border-4 border-white">
                    <img src="https://images.unsplash.com/photo-1522202176988-66273c2fd55f?q=80&w=2071&auto=format&fit=crop" alt="Adakan Acara" class="w-full h-[550px] object-cover">
                </div>
            </div>
            <div class="w-full lg:w-1/2">
                <h2 class="text-5xl md:text-6xl font-black text-potads-blue mb-10 leading-tight">
                    Adakan <span class="text-blue-900">Acara</span> <br> Anda Sendiri
                </h2>
                <p class="text-gray-500 text-xl mb-12 leading-relaxed">
                    Apakah Anda memiliki ide untuk acara yang mendukung misi kami? Kami menawarkan sumber daya, ruang, dan dukungan organisasi untuk inisiatif yang dipimpin komunitas.
                </p>
                <button class="bg-potads-yellow text-potads-blue font-black px-12 py-5 rounded-full btn-playful text-lg">
                    Hubungi Kami
                </button>
            </div>
        </div>
    </section>
@endsection