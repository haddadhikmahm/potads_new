@extends('layouts.frontend')

@section('title', 'Tentang Kami - PIK POTADS')

@section('content')
    <!-- Hero Section -->
    <section class="px-6 md:px-12 lg:px-20 py-16 md:py-24 bg-transparent overflow-hidden">
        <div class="max-w-[1600px] mx-auto flex flex-col lg:flex-row items-center gap-12 lg:gap-20">
            <div class="w-full lg:w-1/2 text-center lg:text-left">
                <span class="bg-yellow-100 text-yellow-700 px-5 py-1.5 rounded-full text-xs font-bold uppercase tracking-widest mb-6 md:mb-8 inline-block">PERJALANAN KAMI</span>
                <h1 class="text-4xl md:text-6xl lg:text-8xl font-extrabold text-potads-blue mb-8 md:mb-10 leading-[1.1]">Menerangi Jalan <br class="hidden md:block"> Bagi Setiap <br class="hidden md:block"> Anak.</h1>
                <p class="text-gray-500 text-lg md:text-xl leading-relaxed max-w-xl mx-auto lg:mx-0">
                    Potads Jabar dimulai dengan keyakinan sederhana: setiap cakrawala harus dapat dijangkau. Kami adalah kumpulan kisah, keberhasilan, dan kehangatan komunitas yang hidup.
                </p>
            </div>
            <div class="w-full lg:w-1/2 relative flex justify-center lg:justify-end">
                <div class="absolute -inset-10 bg-blue-50/50 rounded-full blur-3xl -z-10"></div>
                <div class="relative bg-[#1A4D43] rounded-[2.5rem] md:rounded-[3.5rem] overflow-hidden shadow-2xl w-full max-w-[550px]">
                    <img src="{{ asset('assets/images/founder.png') }}" alt="Founder" class="w-full h-[450px] lg:h-[650px] object-cover">
                </div>
            </div>
        </div>
    </section>

    <!-- Kisah Pendirian -->
    <section class="px-6 md:px-12 py-20 md:py-32 bg-pastel-blue rounded-[3rem] mx-4 md:mx-12 my-12 border-4 border-white shadow-xl" data-aos="fade-up">
        <div class="max-w-7xl mx-auto">
            <h2 class="text-3xl md:text-5xl font-extrabold text-potads-blue mb-16 tracking-tight text-center">
                <span class="text-potads-yellow opacity-40">——</span> Kisah Pendirian <span class="text-potads-yellow opacity-40">——</span>
            </h2>
            <div class="text-gray-600 text-base md:text-xl space-y-12 leading-relaxed text-left">
                <p>
                    <strong>POTADS</strong> berawal dari sebuah komunitas sederhana para orang tua yang saling bertemu dan berbagi cerita di Klinik Tumbuh Kembang RS Harapan Kita sejak tahun 1997. Dari pertemuan yang penuh kehangatan dan kepedulian tersebut, lahirlah sebuah inisiatif untuk membangun wadah yang lebih terstruktur, hingga akhirnya POTADS resmi berdiri sebagai yayasan pada tahun 2003.
                </p>
                
                <div class="bg-white p-8 md:p-16 rounded-[2rem] md:rounded-[3rem] border-l-[8px] md:border-l-[12px] border-potads-yellow shadow-xl text-left relative overflow-hidden">
                    <div class="absolute top-0 right-0 p-8 opacity-5">
                        <i data-lucide="quote" class="w-16 h-16 md:w-24 md:h-24 text-potads-blue"></i>
                    </div>
                    <p class="text-potads-blue font-bold text-xl md:text-3xl leading-snug relative z-10">
                        POTADS hadir sebagai simbol bahwa setiap orang tua tidak berjalan sendiri, melainkan memiliki ruang untuk saling menguatkan, berbagi, dan tumbuh bersama dalam mendampingi anak-anak istimewa.
                    </p>
                </div>

                <p>
                    Anak merupakan anugerah Tuhan dengan keunikan masing-masing, termasuk anak dengan Down Syndrome. Kondisi ini seringkali menimbulkan berbagai tantangan emosional bagi orang tua, seperti kesedihan, stres, hingga sulit menerima kenyataan. Namun, anak dengan Down Syndrome tetap membutuhkan perhatian, kasih sayang, serta penanganan yang tepat sejak dini agar dapat berkembang secara optimal.
                </p>
                <p>
                    Berangkat dari hal tersebut, <strong>POTADS</strong> hadir sebagai wadah dukungan bagi para orang tua untuk saling berbagi pengalaman, memberikan semangat, serta meningkatkan kepercayaan diri dalam mendampingi anak. Selain itu, <strong>POTADS</strong> juga berperan dalam mengedukasi masyarakat bahwa Down Syndrome bukanlah sesuatu yang perlu ditakuti, karena dengan bimbingan yang tepat, anak-anak tersebut mampu berkembang dan berprestasi.
                </p>
            </div>
        </div>
    </section>

    <!-- Profil Yayasan (Cards) -->
    <section class="px-6 md:px-12 py-20 md:py-32 bg-transparent" data-aos="fade-up">
        <div class="max-w-[1400px] mx-auto grid grid-cols-1 lg:grid-cols-3 gap-8 md:gap-10">
            <!-- Visi Card -->
            <div class="bg-potads-blue text-white p-8 md:p-16 rounded-[2rem] md:rounded-[3rem] shadow-2xl flex flex-col justify-between min-h-[400px] md:min-h-[500px]">
                <div>
                    <h2 class="text-3xl md:text-5xl font-extrabold mb-8 md:mb-12">Profil Yayasan</h2>
                    <div class="mb-6">
                        <span class="text-potads-yellow text-xs font-black uppercase tracking-[0.3em] mb-4 block">VISI KAMI</span>
                        <p class="text-2xl md:text-3xl font-bold leading-tight">Menjadi pusat informasi dan konsultasi terlengkap tentang Down Syndrome di Indonesia.</p>
                    </div>
                </div>
            </div>
            
            <!-- Misi Card -->
            <div class="bg-[#F0F7FF] p-8 md:p-16 rounded-[2rem] md:rounded-[3rem] border-b-[8px] md:border-b-[12px] border-potads-yellow flex flex-col shadow-lg">
                <div class="bg-white w-12 h-12 md:w-16 md:h-16 rounded-2xl flex items-center justify-center mb-8 md:mb-10 shadow-sm border border-blue-50">
                    <i data-lucide="flag" class="text-potads-blue w-6 h-6 md:w-8 md:h-8"></i>
                </div>
                <h3 class="text-2xl md:text-3xl font-bold text-potads-blue mb-6 md:mb-8">Misi Kami</h3>
                <ul class="text-gray-600 space-y-4 md:space-y-6 text-base md:text-lg">
                    <li class="flex gap-4 items-start">
                        <span class="text-potads-yellow font-black text-xl md:text-2xl mt-[-4px]">•</span>
                        <span>Mengimplementasikan model pembelajaran adaptif untuk pelajar yang beragam.</span>
                    </li>
                    <li class="flex gap-4 items-start">
                        <span class="text-potads-yellow font-black text-xl md:text-2xl mt-[-4px]">•</span>
                        <span>Mengembangkan program penjangkauan yang dipimpin oleh komunitas.</span>
                    </li>
                    <li class="flex gap-4 items-start">
                        <span class="text-potads-yellow font-black text-xl md:text-2xl mt-[-4px]">•</span>
                        <span>Mengadvokasi perubahan kebijakan pendidikan yang sistemik.</span>
                    </li>
                </ul>
            </div>

            <!-- Tujuan Card -->
            <div class="bg-[#F0F7FF] p-8 md:p-16 rounded-[2rem] md:rounded-[3rem] border-b-[8px] md:border-b-[12px] border-potads-blue flex flex-col shadow-lg">
                <div class="bg-white w-12 h-12 md:w-16 md:h-16 rounded-2xl flex items-center justify-center mb-8 md:mb-10 shadow-sm border border-blue-50">
                    <i data-lucide="rocket" class="text-potads-blue w-6 h-6 md:w-8 md:h-8"></i>
                </div>
                <h3 class="text-2xl md:text-3xl font-bold text-potads-blue mb-6 md:mb-8">Tujuan Utama</h3>
                <ul class="text-gray-600 space-y-4 md:space-y-6 text-base md:text-lg">
                    <li class="flex gap-4 items-start">
                        <span class="text-potads-blue font-black text-xl md:text-2xl mt-[-4px]">•</span>
                        <span>100% Literasi di komunitas target.</span>
                    </li>
                    <li class="flex gap-4 items-start">
                        <span class="text-potads-blue font-black text-xl md:text-2xl mt-[-4px]">•</span>
                        <span>Dukungan kesehatan mental di setiap sekolah mitra.</span>
                    </li>
                    <li class="flex gap-4 items-start">
                        <span class="text-potads-blue font-black text-xl md:text-2xl mt-[-4px]">•</span>
                        <span>Pendanaan berkelanjutan untuk infrastruktur pedesaan.</span>
                    </li>
                </ul>
            </div>
        </div>
    </section>

    <!-- Arti Logo Kami -->
    <section class="px-6 md:px-12 py-20 md:py-32 bg-pastel-yellow rounded-[3rem] mx-4 md:mx-12 my-12 border-4 border-white shadow-xl overflow-hidden" data-aos="fade-up">
        <div class="max-w-7xl mx-auto flex flex-col lg:flex-row items-center gap-16 lg:gap-24">
            <div class="w-full lg:w-1/2 relative flex justify-center">
                <div class="relative w-full max-w-[550px] aspect-square bg-white rounded-full shadow-2xl flex items-center justify-center p-12 md:p-20 border-4 md:border-8 border-white group">
                    <img src="{{ asset('assets/images/logo.png') }}" alt="Logo Arti" class="w-full object-contain group-hover:scale-105 transition duration-500">
                    <div class="absolute -bottom-6 md:-bottom-8 left-1/2 -translate-x-1/2 bg-potads-blue text-white px-6 md:px-8 py-3 md:py-4 rounded-xl md:rounded-2xl shadow-2xl text-center min-w-[180px] md:min-w-[200px] z-20">
                        <span class="text-xs md:text-sm font-black block mb-1">Matahari</span>
                        <span class="text-[8px] md:text-[10px] opacity-70 uppercase font-black tracking-[0.2em]">SIMBOL HARAPAN & PEMBARUAN</span>
                    </div>
                </div>
            </div>
            <div class="w-full lg:w-1/2">
                <h2 class="text-3xl md:text-5xl font-extrabold text-potads-blue mb-10 md:mb-16 leading-tight text-center lg:text-left">Arti Logo Kami</h2>
                <div class="space-y-8 md:space-y-12">
                    <div class="flex gap-6 md:gap-8 group">
                        <div class="w-12 h-12 md:w-16 md:h-16 rounded-full bg-potads-yellow flex items-center justify-center shrink-0 shadow-xl">
                            <i data-lucide="sun" class="text-white w-6 h-6 md:w-8 md:h-8"></i>
                        </div>
                        <div>
                            <h4 class="font-black text-potads-blue text-xl md:text-2xl mb-2 md:mb-3">EMAS AMBER</h4>
                            <p class="text-gray-500 text-base md:text-lg leading-relaxed">Mewakili kehangatan rumah dan cahaya pengetahuan yang mengusir ketidaktahuan.</p>
                        </div>
                    </div>
                    <div class="flex gap-6 md:gap-8 group">
                        <div class="w-12 h-12 md:w-16 md:h-16 rounded-full bg-potads-blue flex items-center justify-center shrink-0 shadow-xl">
                            <i data-lucide="droplets" class="text-white w-6 h-6 md:w-8 md:h-8"></i>
                        </div>
                        <div>
                            <h4 class="font-black text-potads-blue text-xl md:text-2xl mb-2 md:mb-3">BIRU LANGIT</h4>
                            <p class="text-gray-500 text-base md:text-lg leading-relaxed">Mewakili kemungkinan yang luas dan fondasi tenang yang kami berikan untuk pertumbuhan.</p>
                        </div>
                    </div>
                    <div class="flex gap-6 md:gap-8 group">
                        <div class="w-12 h-12 md:w-16 md:h-16 rounded-full border-2 md:border-4 border-potads-blue flex items-center justify-center shrink-0">
                            <i data-lucide="loader" class="text-potads-blue w-6 h-6 md:w-8 md:h-8"></i>
                        </div>
                        <div>
                            <h4 class="font-black text-potads-blue text-xl md:text-2xl mb-2 md:mb-3">LINGKARAN TERBUKA</h4>
                            <p class="text-gray-500 text-base md:text-lg leading-relaxed">Bentuk lingkaran logo kami sengaja diputus, menandakan bahwa kami selalu terbuka bagi anggota dan ide-ide baru.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Jantung dari Yayasan -->
    <section class="px-6 md:px-12 py-20 md:py-32 bg-transparent" data-aos="fade-up">
        <div class="max-w-7xl mx-auto text-center mb-16 md:mb-24">
            <h2 class="text-3xl md:text-5xl font-black text-potads-blue mb-6">Jantung dari Yayasan</h2>
            <p class="text-gray-500 max-w-2xl mx-auto text-lg md:text-xl font-medium">Kenali para visioner, pendidik, dan aktivis yang bekerja tanpa lelah di balik layar.</p>
        </div>
        <div class="max-w-7xl mx-auto grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
            @forelse($teams as $index => $team)
                @php
                    $borderColors = ['border-potads-yellow', 'border-potads-blue'];
                    $borderColor = $borderColors[$index % 2];
                @endphp
                <div class="bg-[#F0F7FF] rounded-[2rem] overflow-hidden shadow-lg flex flex-col h-full border-b-[8px] {{ $borderColor }}">
                    <div class="h-[350px] md:h-[400px] grayscale overflow-hidden bg-white">
                        @if($team->image)
                            <img src="{{ asset('storage/' . $team->image) }}" alt="{{ $team->name }}" class="w-full h-full object-cover">
                        @else
                            <div class="w-full h-full bg-slate-200 flex items-center justify-center">
                                <i data-lucide="user" class="w-24 h-24 text-slate-400"></i>
                            </div>
                        @endif
                    </div>
                    <div class="p-8 flex-grow">
                        <h4 class="font-bold text-potads-blue text-xl md:text-2xl mb-1">{{ $team->name }}</h4>
                        <p class="text-potads-blue/80 text-[10px] font-black uppercase tracking-widest mb-4">{{ $team->role }}</p>
                        <p class="text-gray-500 text-sm leading-relaxed">{{ $team->description }}</p>
                    </div>
                </div>
            @empty
                <div class="col-span-1 md:col-span-2 lg:col-span-4 text-center py-12">
                    <p class="text-gray-500 font-medium text-lg">Belum ada data anggota tim yayasan.</p>
                </div>
            @endforelse
        </div>
    </section>

    <!-- Program Yayasan -->
    <section class="px-6 md:px-12 py-20 md:py-32 bg-pastel-pink rounded-[3rem] mx-4 md:mx-12 my-12 border-4 border-white shadow-xl" data-aos="fade-up">
        <div class="max-w-7xl mx-auto text-center mb-16 md:mb-20">
            <h2 class="text-3xl md:text-5xl font-extrabold text-potads-blue mb-6">Program Yayasan</h2>
            <p class="text-gray-500 text-lg md:text-xl">Inisiatif nyata kami dalam mendukung kemajuan anak-anak istimewa.</p>
        </div>
        <div class="max-w-[1400px] mx-auto grid grid-cols-2 lg:grid-cols-4 gap-4 md:gap-8">
            @forelse($programs as $program)
                <a href="{{ route('programs.show', $program->slug) }}" class="aspect-[4/5] rounded-[1.5rem] md:rounded-[2.5rem] overflow-hidden relative group cursor-pointer shadow-xl bg-white border-4 border-white transition-transform hover:-translate-y-2">
                    <img src="{{ Str::startsWith($program->image, 'http') ? $program->image : asset('storage/' . $program->image) }}" class="w-full h-full object-cover group-hover:scale-110 transition duration-700">
                    <div class="absolute inset-0 bg-gradient-to-t from-potads-blue/90 via-potads-blue/20 to-transparent opacity-0 group-hover:opacity-100 transition duration-500 flex flex-col justify-end p-6 md:p-10">
                        <h4 class="text-white font-black text-lg md:text-2xl mb-2 leading-tight">{{ $program->title }}</h4>
                        <span class="text-potads-yellow font-black text-[10px] uppercase tracking-widest flex items-center gap-2">
                            Lihat Program <i data-lucide="arrow-right" class="w-3 h-3"></i>
                        </span>
                    </div>
                </a>
            @empty
                <div class="col-span-2 lg:col-span-4 text-center py-20 bg-white/30 rounded-[2.5rem] border-2 border-dashed border-white/50">
                    <i data-lucide="layout-grid" class="w-12 h-12 text-white mx-auto mb-4 opacity-50"></i>
                    <p class="text-white font-bold">Belum ada program yang terdaftar.</p>
                </div>
            @endforelse
        </div>
    </section>

    <!-- Motto Yayasan -->
    <section class="px-6 md:px-12 py-20 md:py-32 bg-transparent" data-aos="fade-up">
        <div class="max-w-7xl mx-auto text-center mb-16 md:mb-20">
            <h2 class="text-3xl md:text-5xl font-black text-potads-blue">Motto Yayasan</h2>
        </div>
        <div class="max-w-5xl mx-auto space-y-8 md:space-y-12">
            <!-- Motto 1 -->
            <div class="flex flex-col md:flex-row rounded-[2rem] overflow-hidden shadow-lg">
                <div class="w-full md:w-2/5 bg-potads-blue p-8 md:p-12 text-white flex flex-col justify-center text-center md:text-left">
                    <h3 class="text-2xl md:text-3xl font-bold mb-6">Yayasan <span class="text-potads-yellow">POTADS</span></h3>
                    <p class="text-white text-sm leading-relaxed">kalimat pembangkit semangat orang tua dan anak sehingga akan selalu berusaha mencapai yang terbaik</p>
                </div>
                <div class="w-full md:w-3/5 bg-[#F4F6FB] p-12 md:p-16 flex flex-col justify-center text-center">
                    <h4 class="text-4xl md:text-5xl font-black text-potads-blue leading-none mb-2">AKU ADA</h4>
                    <h4 class="text-4xl md:text-5xl font-black text-potads-yellow leading-none">AKU BISA</h4>
                </div>
            </div>

            <!-- Motto 2 -->
            <div class="flex flex-col md:flex-row rounded-[2rem] overflow-hidden shadow-lg">
                <div class="w-full md:w-3/5 bg-[#FFFDE7] p-12 md:p-16 flex flex-col justify-center text-center order-2 md:order-1">
                    <h4 class="text-4xl md:text-5xl font-black text-potads-yellow leading-none mb-2">BEDA</h4>
                    <h4 class="text-4xl md:text-5xl font-black text-potads-blue leading-none">TAPI KEREN</h4>
                </div>
                <div class="w-full md:w-2/5 bg-potads-yellow p-8 md:p-12 text-potads-blue flex flex-col justify-center text-center md:text-left order-1 md:order-2">
                    <div class="text-center md:text-left">
                        <h3 class="text-2xl md:text-3xl font-bold mb-6">Yayasan POTADS <br> Jawa Barat</h3>
                    </div>
                    <p class="text-white text-sm leading-relaxed">Ekspresi anak-anak dengan Down Syndrome di Jawa Barat yang, meski berbeda, tetap mampu berkarya, beraktivitas, dan berprestasi sehingga tampak keren dan istimewa.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- FAQ Section -->
    <section class="px-6 md:px-12 py-20 md:py-32 bg-pastel-purple rounded-[3rem] mx-4 md:mx-12 my-12 border-4 border-white shadow-xl" data-aos="fade-up">
        <div class="max-w-4xl mx-auto text-center mb-16 md:mb-24">
            <h2 class="text-3xl md:text-5xl font-extrabold text-potads-blue leading-tight">Tanya Jawab</h2>
        </div>
        <div class="max-w-4xl mx-auto space-y-4 md:space-y-6" x-data="{ active: null }">
            @forelse($faqs as $faq)
                <div class="bg-white rounded-[1.5rem] md:rounded-[2rem] overflow-hidden shadow-sm hover:shadow-md transition duration-300">
                    <button @click="active = active === {{ $faq->id }} ? null : {{ $faq->id }}" class="w-full px-6 md:px-10 py-6 md:py-8 flex justify-between items-center bg-white group focus:outline-none">
                        <span class="font-black text-potads-blue text-left uppercase text-xs md:text-sm tracking-[0.2em] group-hover:text-potads-yellow transition">{{ $faq->question }}</span>
                        <i data-lucide="chevron-down" class="w-5 h-5 md:w-6 md:h-6 text-potads-yellow transition-transform duration-300" :class="active === {{ $faq->id }} ? 'rotate-180' : ''"></i>
                    </button>
                    <div x-show="active === {{ $faq->id }}" x-cloak x-collapse class="px-6 md:px-10 pb-6 md:pb-10 text-gray-500 text-base md:text-lg leading-relaxed">
                        {!! nl2br(e($faq->answer)) !!}
                    </div>
                </div>
            @empty
                <div class="text-center py-10">
                    <p class="text-gray-400 font-medium">Belum ada pertanyaan terdaftar saat ini.</p>
                </div>
            @endforelse
        </div>
    </section>

    <!-- Hubungi Kami (Contact Section) -->
    <section class="px-6 md:px-12 py-20 md:py-32 bg-transparent" id="contact" data-aos="fade-up">
        <div class="max-w-7xl mx-auto">
            <div class="bg-white rounded-[3rem] shadow-2xl overflow-hidden flex flex-col lg:flex-row border-4 border-white">
                <!-- Contact Info & Map -->
                <div class="w-full lg:w-1/2 bg-potads-blue p-8 md:p-16 text-white relative">
                    <div class="relative z-10">
                        <h2 class="text-3xl md:text-5xl font-black mb-8 leading-tight">Hubungi Kami</h2>
                        <p class="text-white/70 text-lg mb-12">Kami senang mendengar dari Anda. Silakan hubungi kami melalui saluran berikut atau kirimkan pesan langsung.</p>

                        <div class="space-y-8 mb-12">
                            <div class="flex gap-6 items-start">
                                <div class="w-12 h-12 bg-white/10 rounded-2xl flex items-center justify-center shrink-0">
                                    <i data-lucide="map-pin" class="w-6 h-6"></i>
                                </div>
                                <div>
                                    <h4 class="font-black text-potads-yellow uppercase text-xs tracking-widest mb-2">ALAMAT</h4>
                                    <p class="text-base md:text-lg">{{ $siteSettings['contact_address'] ?? 'Bandung, Jawa Barat' }}</p>
                                </div>
                            </div>
                            <div class="flex gap-6 items-start">
                                <div class="w-12 h-12 bg-white/10 rounded-2xl flex items-center justify-center shrink-0">
                                    <i data-lucide="phone" class="w-6 h-6"></i>
                                </div>
                                <div>
                                    <h4 class="font-black text-potads-yellow uppercase text-xs tracking-widest mb-2">TELEPON</h4>
                                    <p class="text-base md:text-lg">{{ $siteSettings['contact_phone'] ?? '+62 812-3456-7890' }}</p>
                                </div>
                            </div>
                            <div class="flex gap-6 items-start">
                                <div class="w-12 h-12 bg-white/10 rounded-2xl flex items-center justify-center shrink-0">
                                    <i data-lucide="mail" class="w-6 h-6"></i>
                                </div>
                                <div>
                                    <h4 class="font-black text-potads-yellow uppercase text-xs tracking-widest mb-2">EMAIL</h4>
                                    <p class="text-base md:text-lg">{{ $siteSettings['contact_email'] ?? 'info@potads-jabar.or.id' }}</p>
                                </div>
                            </div>
                        </div>

                        <!-- Map Placeholder/Embed -->
                        <div class="rounded-3xl overflow-hidden h-64 md:h-80 shadow-2xl bg-white/5 border border-white/10">
                            <iframe 
                                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d126748.56347862248!2d107.5731164!3d-6.9034443!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e68e6398252477f%3A0x146a9440548d5a71!2sBandung%2C%20Bandung%20City%2C%20West%20Java!5e0!3m2!1sen!2sid!4v1700000000000!5m2!1sen!2sid" 
                                class="w-full h-full border-0 grayscale opacity-80 hover:grayscale-0 transition-all duration-500" 
                                allowfullscreen="" 
                                loading="lazy">
                            </iframe>
                        </div>
                    </div>
                    <!-- Decorative circle -->
                    <div class="absolute -bottom-24 -left-24 w-64 h-64 bg-white/5 rounded-full blur-3xl"></div>
                </div>

                <!-- Contact Form -->
                <div class="w-full lg:w-1/2 p-8 md:p-16 bg-white">
                    <h3 class="text-2xl md:text-3xl font-black text-potads-blue mb-10">Kirim Pesan</h3>

                    @if(session('success'))
                        <div class="bg-emerald-50 border-2 border-emerald-100 p-6 rounded-3xl mb-8 flex items-center gap-4 animate-bounce">
                            <div class="w-10 h-10 bg-emerald-500 rounded-full flex items-center justify-center text-white shrink-0">
                                <i data-lucide="check" class="w-6 h-6"></i>
                            </div>
                            <p class="text-emerald-800 font-bold text-sm">{{ session('success') }}</p>
                        </div>
                    @endif

                    <form action="{{ route('contact.store') }}" method="POST" class="space-y-6">
                        @csrf
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="space-y-2">
                                <label class="text-[10px] font-black text-potads-blue uppercase tracking-widest ml-1">Nama Lengkap</label>
                                <input type="text" name="name" value="{{ old('name') }}" required class="w-full px-6 py-4 bg-slate-50 border-none rounded-2xl focus:ring-4 focus:ring-potads-blue/5 transition-all text-slate-700 font-bold" placeholder="Nama Anda...">
                                @error('name') <p class="text-red-500 text-[10px] mt-1 ml-1">{{ $message }}</p> @enderror
                            </div>
                            <div class="space-y-2">
                                <label class="text-[10px] font-black text-potads-blue uppercase tracking-widest ml-1">Email</label>
                                <input type="email" name="email" value="{{ old('email') }}" required class="w-full px-6 py-4 bg-slate-50 border-none rounded-2xl focus:ring-4 focus:ring-potads-blue/5 transition-all text-slate-700 font-bold" placeholder="email@contoh.com">
                                @error('email') <p class="text-red-500 text-[10px] mt-1 ml-1">{{ $message }}</p> @enderror
                            </div>
                        </div>
                        <div class="space-y-2">
                            <label class="text-[10px] font-black text-potads-blue uppercase tracking-widest ml-1">Subjek</label>
                            <input type="text" name="subject" value="{{ old('subject') }}" required class="w-full px-6 py-4 bg-slate-50 border-none rounded-2xl focus:ring-4 focus:ring-potads-blue/5 transition-all text-slate-700 font-bold" placeholder="Ada yang bisa kami bantu?">
                            @error('subject') <p class="text-red-500 text-[10px] mt-1 ml-1">{{ $message }}</p> @enderror
                        </div>
                        <div class="space-y-2">
                            <label class="text-[10px] font-black text-potads-blue uppercase tracking-widest ml-1">Pesan</label>
                            <textarea name="message" rows="5" required class="w-full px-6 py-4 bg-slate-50 border-none rounded-2xl focus:ring-4 focus:ring-potads-blue/5 transition-all text-slate-700 font-bold" placeholder="Tuliskan pesan Anda di sini...">{{ old('message') }}</textarea>
                            @error('message') <p class="text-red-500 text-[10px] mt-1 ml-1">{{ $message }}</p> @enderror
                        </div>
                        <button type="submit" class="w-full bg-potads-yellow text-potads-blue font-black py-5 rounded-3xl text-lg hover:bg-yellow-400 transition-all btn-playful shadow-xl shadow-yellow-200 flex items-center justify-center gap-3">
                            Kirim Pesan <i data-lucide="send" class="w-6 h-6"></i>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection