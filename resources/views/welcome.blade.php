@extends('layouts.frontend')

@section('title', 'PIK POTADS - Selamat Datang')

@section('content')
    <!-- Hero Section -->
    <section class="px-6 md:px-12 py-8">
        <div class="relative rounded-[2.5rem] overflow-hidden bg-gray-900 h-[550px] md:h-auto md:aspect-[21/9] flex items-center"
             x-data="{ 
                activeSlide: 1, 
                slides: [
                    'https://images.unsplash.com/photo-1488521787991-ed7bbaae773c?q=80&w=2070&auto=format&fit=crop',
                    'https://images.unsplash.com/photo-1542810634-71277d95dcbb?q=80&w=2070&auto=format&fit=crop',
                    'https://images.unsplash.com/photo-1509062522246-3755977927d7?q=80&w=2070&auto=format&fit=crop'
                ],
                init() {
                    setInterval(() => {
                        this.activeSlide = this.activeSlide === this.slides.length ? 1 : this.activeSlide + 1;
                    }, 5000);
                }
             }">
             
            <template x-for="(slide, index) in slides" :key="index">
                <img :src="slide" 
                     class="absolute inset-0 w-full h-full object-cover transition-opacity duration-1000"
                     :class="activeSlide === index + 1 ? 'opacity-60 z-0' : 'opacity-0 -z-10'"
                     alt="Hero Image">
            </template>

            <div class="relative z-10 px-8 md:px-20 max-w-4xl text-white py-12 md:py-0 text-center md:text-left">
                <h1 class="text-3xl md:text-7xl font-extrabold mb-6 leading-tight">
                    Selamat Datang <br class="hidden md:block"> di <span class="text-potads-yellow">PIK POTADS</span>
                </h1>
                <p class="text-base md:text-2xl mb-10 text-gray-100 leading-relaxed max-w-xl mx-auto md:mx-0">
                    Menyediakan sumber daya, komunitas, dan advokasi yang dibutuhkan untuk membantu individu dengan Down Syndrome berkembang di setiap tahap kehidupan.
                </p>
                <a href="{{ route('donations.index') }}" class="bg-potads-yellow text-potads-blue px-10 py-5 rounded-full font-extrabold inline-flex items-center gap-3 btn-playful">
                    Donasi Sekarang <i data-lucide="heart" class="w-6 h-6 fill-current"></i>
                </a>
            </div>

            <!-- Pagination indicator dots -->
            <div class="absolute bottom-8 left-1/2 -translate-x-1/2 flex gap-2 z-10">
                <template x-for="(slide, index) in slides" :key="index">
                    <button @click="activeSlide = index + 1"
                            class="h-2 rounded-full transition-all duration-300"
                            :class="activeSlide === index + 1 ? 'w-8 bg-potads-yellow' : 'w-4 bg-white/40 hover:bg-white/60'">
                    </button>
                </template>
            </div>
        </div>
    </section>

    <!-- Stats Cards -->
    <section class="px-6 md:px-12 py-12 grid grid-cols-1 md:grid-cols-3 gap-8" data-aos="fade-up">
        <div class="bg-pastel-blue p-8 rounded-[2.5rem] border-4 border-white shadow-xl text-center flex flex-col items-center hover:-translate-y-2 transition-transform duration-300">
            <div class="bg-white p-4 rounded-full mb-4 shadow-sm">
                <i data-lucide="users" class="text-potads-blue w-10 h-10"></i>
            </div>
            <h3 class="text-5xl font-extrabold text-potads-blue mb-1">500+</h3>
            <p class="text-potads-blue/70 uppercase text-sm font-extrabold tracking-widest mt-2">Anak Hebat</p>
        </div>
        <div class="bg-pastel-yellow p-8 rounded-[2.5rem] border-4 border-white shadow-xl text-center flex flex-col items-center hover:-translate-y-2 transition-transform duration-300">
            <div class="bg-white p-4 rounded-full mb-4 shadow-sm">
                <i data-lucide="heart-handshake" class="text-yellow-600 w-10 h-10"></i>
            </div>
            <h3 class="text-5xl font-extrabold text-potads-blue mb-1">20+</h3>
            <p class="text-potads-blue/70 uppercase text-sm font-extrabold tracking-widest mt-2">Program Seru</p>
        </div>
        <div class="bg-pastel-pink p-8 rounded-[2.5rem] border-4 border-white shadow-xl text-center flex flex-col items-center hover:-translate-y-2 transition-transform duration-300">
            <div class="bg-white p-4 rounded-full mb-4 shadow-sm">
                <i data-lucide="plus-square" class="text-pink-500 w-10 h-10"></i>
            </div>
            <h3 class="text-5xl font-extrabold text-potads-blue mb-1">15</h3>
            <p class="text-potads-blue/70 uppercase text-sm font-extrabold tracking-widest mt-2">Rumah Sakit</p>
        </div>
    </section>

    <!-- About Section -->
    <section class="px-6 md:px-12 py-24 bg-transparent" data-aos="fade-up">
        <div class="bg-white rounded-[3rem] overflow-hidden shadow-2xl border-4 border-potads-blue/10 flex flex-col lg:flex-row items-center p-8 md:p-16 gap-16 md:gap-24">
            <!-- Left side: Image and decorations -->
            <div class="w-full lg:w-5/12 relative">
                <!-- Decorative yellow box behind -->
                <div class="absolute -bottom-6 -right-6 w-48 h-48 bg-potads-yellow rounded-[2.5rem] z-0"></div>
                <!-- Sage green image container -->
                <div class="relative z-10 bg-[#98AC82] rounded-[2.5rem] p-6 shadow-xl aspect-square flex items-center justify-center">
                    <img src="{{ asset('assets/images/about-illustration.png') }}" 
                         alt="Beda Tapi Keren" 
                         class="w-full h-full object-contain">
                </div>
            </div>
            
            <!-- Right side: Content -->
            <div class="w-full lg:w-7/12">
                <h2 class="text-5xl font-extrabold text-potads-blue mb-8">BEDA TAPI <span class="text-potads-yellow">KEREN</span></h2>
                <p class="text-gray-600 mb-10 leading-relaxed text-lg">
                    Walaupun berbeda, tetapi anak-anak dengan Down Syndrome di Jawa Barat tetap mampu berkarya, berprestasi, dan menunjukkan keistimewaan dalam berbagai bidang.
                </p>
                
                <div class="space-y-10">
                    <!-- Visi -->
                    <div class="relative pl-10 border-l-4 border-potads-yellow">
                        <div class="flex items-center gap-3 mb-3 text-potads-blue">
                            <i data-lucide="eye" class="w-6 h-6"></i>
                            <h4 class="font-bold text-2xl">Visi Kami</h4>
                        </div>
                        <p class="text-gray-500 text-lg">Menjadi pusat informasi dan konsultasi terlengkap tentang Down Syndrome di Indonesia.</p>
                    </div>
                    
                    <!-- Misi -->
                    <div class="relative pl-10 border-l-4 border-potads-blue">
                        <div class="flex items-center gap-3 mb-3 text-potads-blue">
                            <i data-lucide="target" class="w-6 h-6"></i>
                            <h4 class="font-bold text-2xl">Misi Kami</h4>
                        </div>
                        <ul class="text-gray-500 space-y-2 text-lg">
                            <li>- Memiliki pusat informasi terlengkap</li>
                            <li>- Menyediakan informasi terkini</li>
                            <li>- Menyebarluaskan informasi mengenai Down Syndrome</li>
                            <li>- Memberikan konsultasi berkelanjutan</li>
                            <li>- Menyelenggarakan kegiatan-kegiatan</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Video Section -->
    <section class="px-6 md:px-12 py-20 bg-transparent" data-aos="fade-up">
        <div class="text-center max-w-3xl mx-auto mb-12 bg-white p-8 rounded-[2rem] shadow-sm border-4 border-white inline-block">
            <h2 class="text-4xl font-bold text-potads-blue mb-4">Sekilas Mengenai Dunia Kami</h2>
            <p class="text-gray-600">Saksikan bagaimana Bright Horizons membuat perbedaan setiap harinya melalui inisiatif berbasis komunitas kami.</p>
        </div>
        <div class="max-w-5xl mx-auto relative group cursor-pointer bg-white rounded-[2.5rem]">
            @if($latestVideo)
                @php
                    $videoId = '';
                    if (preg_match('/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/ ]{11})/i', $latestVideo->url, $matches)) {
                        $videoId = $matches[1];
                    }
                @endphp
                @if($videoId)
                    <img src="https://img.youtube.com/vi/{{ $videoId }}/maxresdefault.jpg" alt="{{ $latestVideo->title }}" class="w-full aspect-video object-cover rounded-[2.5rem] shadow-xl">
                @else
                    <img src="https://images.unsplash.com/photo-1511632765486-a01980e01a18?q=80&w=2070&auto=format&fit=crop" alt="Thumbnail Video" class="w-full aspect-video object-cover rounded-[2.5rem] shadow-xl">
                @endif
                <a href="{{ $latestVideo->url }}" target="_blank" class="absolute inset-0 bg-black/20 rounded-[2.5rem] flex items-center justify-center group-hover:bg-black/30 transition border-4 border-white shadow-xl">
                    <div class="w-24 h-24 bg-potads-yellow rounded-full flex items-center justify-center shadow-lg group-hover:scale-110 transition btn-playful">
                        <i data-lucide="play" class="w-12 h-12 text-potads-blue fill-current ml-2"></i>
                    </div>
                    <div class="absolute bottom-6 left-6 right-6 text-center text-white opacity-0 group-hover:opacity-100 transition-opacity">
                        <h4 class="font-bold text-lg">{{ $latestVideo->title }}</h4>
                    </div>
                </a>
            @else
                <img src="https://images.unsplash.com/photo-1511632765486-a01980e01a18?q=80&w=2070&auto=format&fit=crop" alt="Thumbnail Video" class="w-full aspect-video object-cover rounded-[2.5rem] shadow-xl">
                <div class="absolute inset-0 bg-black/20 rounded-[2.5rem] flex items-center justify-center group-hover:bg-black/30 transition">
                    <div class="w-20 h-20 bg-potads-yellow rounded-full flex items-center justify-center shadow-lg group-hover:scale-110 transition">
                        <i data-lucide="play" class="w-10 h-10 text-potads-blue fill-current"></i>
                    </div>
                </div>
            @endif
        </div>
    </section>

    <!-- Current Events -->
    <section class="px-6 md:px-12 py-20" data-aos="fade-up">
        <div class="flex justify-between items-end mb-12">
            <h2 class="text-3xl font-bold text-potads-blue">Event Saat Ini</h2>
            <a href="{{ route('events.index') }}" class="text-potads-blue font-bold flex items-center gap-2 hover:gap-3 transition-all">
                Lihat Semua Event <i data-lucide="arrow-right" class="w-5 h-5"></i>
            </a>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @foreach($events as $event)
                <div class="relative h-[400px] rounded-3xl overflow-hidden group bg-white border-4 border-white shadow-xl hover:-translate-y-2 transition duration-300">
                    <img src="{{ Str::startsWith($event->image, 'http') ? $event->image : asset('storage/' . $event->image) }}" alt="{{ $event->title }}" class="absolute inset-0 w-full h-full object-cover z-0">
                    <div class="absolute inset-0 bg-gradient-to-t from-gray-900 via-gray-900/40 to-transparent p-10 flex flex-col justify-end z-10">
                        <h3 class="text-2xl font-bold text-white mb-4 relative z-20 shadow-sm">{{ $event->title }}</h3>
                        <div class="flex gap-6 text-white text-sm relative z-20">
                            <span class="flex items-center gap-2 drop-shadow-md"><i data-lucide="calendar" class="w-4 h-4"></i> {{ \Carbon\Carbon::parse($event->date)->format('d M Y') }}</span>
                            <span class="flex items-center gap-2 drop-shadow-md"><i data-lucide="map-pin" class="w-4 h-4"></i> {{ $event->location }}</span>
                        </div>
                    </div>
                    <a href="{{ route('events.show', $event) }}" class="absolute bottom-10 right-10">
                        <div class="bg-white/20 p-3 rounded-full backdrop-blur-sm group-hover:bg-potads-yellow group-hover:text-potads-blue text-white transition">
                            <i data-lucide="arrow-up-right" class="w-6 h-6"></i>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </section>

    <!-- Create Event Section -->
    <section class="px-6 md:px-12 py-12" data-aos="fade-up">
        <div class="bg-pastel-pink rounded-[3rem] overflow-hidden shadow-xl border-4 border-white flex flex-col md:flex-row items-center p-8 md:p-8">
            <div class="w-full md:w-1/2 p-4 bg-white rounded-[2.5rem] shadow-sm border-4 border-white">
                <img src="https://images.unsplash.com/photo-1522071823990-b99787a07a3c?q=80&w=2070&auto=format&fit=crop" alt="Adakan Acara" class="rounded-2xl w-full h-80 object-cover">
            </div>
            <div class="w-full md:w-1/2 p-12">
                <h2 class="text-4xl font-bold text-potads-blue mb-4 leading-tight">Adakan <span class="text-blue-900 underline decoration-potads-yellow">Acara</span> Anda Sendiri</h2>
                <p class="text-potads-blue/80 font-medium mb-8 leading-relaxed text-lg">
                    Apakah Anda memiliki ide untuk acara yang mendukung misi kami? Kami menawarkan sumber daya, ruang, dan dukungan organisasi untuk inisiatif yang dipimpin komunitas.
                </p>
                <button class="bg-potads-blue text-white font-extrabold px-10 py-4 rounded-full btn-playful text-lg">Hubungi Kami</button>
            </div>
        </div>
    </section>

    <!-- Articles -->
    <section class="px-6 md:px-12 py-20" data-aos="fade-up">
        <div class="flex justify-between items-end mb-12">
            <h2 class="text-4xl font-bold text-potads-blue leading-tight">Artikel Terkini</h2>
            <a href="{{ route('articles.index') }}" class="text-potads-blue font-bold flex items-center gap-2 hover:gap-3 transition-all">
                Lihat Semua Artikel <i data-lucide="arrow-right" class="w-5 h-5"></i>
            </a>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            @foreach($articles as $article)
                <div class="bg-white rounded-3xl overflow-hidden shadow-xl border-4 border-white group hover:-translate-y-2 transition duration-300">
                    <div class="overflow-hidden h-56 bg-white">
                        <img src="{{ Str::startsWith($article->image, 'http') ? $article->image : asset('storage/' . $article->image) }}" alt="{{ $article->title }}" class="w-full h-full object-cover group-hover:scale-110 transition duration-500">
                    </div>
                    <div class="p-8 text-center">
                        <h3 class="text-xl font-bold text-potads-blue mb-4 line-clamp-2">{{ $article->title }}</h3>
                        <p class="text-gray-400 text-sm mb-8 line-clamp-2">{{ Str::limit(strip_tags($article->content), 100) }}</p>
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-4 text-xs text-blue-400 font-bold">
                                <span class="flex items-center gap-1"><i data-lucide="calendar" class="w-3 h-3"></i> {{ $article->created_at->format('d M Y') }}</span>
                                <span class="flex items-center gap-1"><i data-lucide="edit-3" class="w-3 h-3"></i> {{ $article->author->name }}</span>
                            </div>
                            <a href="{{ route('articles.show', $article->slug) }}" class="bg-blue-50 text-potads-blue font-bold px-4 py-2 rounded-lg text-sm hover:bg-potads-blue hover:text-white transition">Lihat Detail</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </section>

    <!-- Achievement Section -->
    <section class="px-6 md:px-12 py-24 bg-transparent" data-aos="fade-up">
        <div class="bg-pastel-green rounded-[3rem] border-4 border-white shadow-xl p-12 md:p-20">
            <h2 class="text-4xl md:text-6xl font-extrabold text-potads-blue mb-16 border-l-[12px] border-potads-yellow pl-10 leading-tight">
                Achievement <span class="text-potads-yellow">POTADS</span>
            </h2>
            
            <div class="flex flex-col lg:flex-row items-center gap-16 md:gap-32">
                <!-- Left: Image -->
                <div class="w-full lg:w-1/2 bg-white rounded-[3.5rem] p-2 border-4 border-white shadow-xl">
                    <img src="https://images.unsplash.com/photo-1484665754804-74b091211472?q=80&w=2070&auto=format&fit=crop" 
                         alt="Achievement" 
                         class="w-full rounded-[3rem] object-cover aspect-[16/10]">
                </div>
                
                <!-- Right: Content -->
                <div class="w-full lg:w-1/2 text-left">
                    <h3 class="text-4xl md:text-6xl font-bold text-gray-800 mb-8 leading-tight">
                        Sentuhan Kasih: <br class="hidden xl:block"> Charity Day
                    </h3>
                    <p class="text-gray-500 text-xl md:text-2xl mb-12 leading-relaxed">
                        merupakan kegiatan sosial yang bertujuan untuk menumbuhkan kepedulian dan semangat berbagi melalui aksi nyata ...
                    </p>
                    <a href="{{ route('articles.index') }}" class="bg-potads-blue text-white px-12 py-5 rounded-full font-extrabold inline-flex items-center gap-3 btn-playful text-lg">
                        Baca Artikel <i data-lucide="arrow-right" class="w-6 h-6"></i>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Donation CTA -->
    <section class="px-6 md:px-12 py-20" data-aos="fade-up" data-aos-delay="100">
        <div class="bg-potads-blue rounded-[3rem] p-16 text-center text-white relative overflow-hidden">
            <!-- Decorative circle -->
            <div class="absolute -top-20 -right-20 w-80 h-80 bg-white/10 rounded-full blur-3xl"></div>
            
            <div class="relative z-10 max-w-4xl mx-auto">
                <h2 class="text-4xl md:text-6xl font-extrabold mb-8">Maukah Anda Mendukung Perjalanan Kami?</h2>
                <p class="text-lg md:text-xl text-white/80 mb-12">
                    Donasi Anda secara langsung membiayai terapi intervensi dini dan paket pendidikan untuk keluarga yang membutuhkan. Setiap pemberian membuka pintu baru.
                </p>
                <a href="{{ route('donations.index') }}" class="bg-potads-yellow text-potads-blue text-xl font-extrabold px-12 py-5 rounded-full btn-playful inline-block">
                    Lakukan Donasi
                </a>
            </div>
        </div>
    </section>
@endsection