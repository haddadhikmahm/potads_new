<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'PIK POTADS')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Fredoka:wght@400;500;600;700&family=Nunito:wght@400;600;700;800;900&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/lucide@latest"></script>
    <style>
        body { 
            font-family: 'Nunito', sans-serif; 
            background-color: #DDF3FF;
            background-image: 
                radial-gradient(circle at 10% 20%, rgba(255, 255, 255, 0.9) 0%, transparent 40%),
                radial-gradient(circle at 90% 80%, rgba(255, 255, 255, 0.9) 0%, transparent 40%),
                radial-gradient(circle at 50% 50%, #FFFFFF 0%, #DDF3FF 60%, #9BD8FF 100%);
            background-attachment: fixed;
        }
        h1, h2, h3, h4, h5, h6, .font-black, .font-extrabold { font-family: 'Fredoka', sans-serif; letter-spacing: 0.5px; }
        
        .bg-potads-blue { background-color: #1E88E5; } /* Vibrant Royal Blue */
        .text-potads-blue { color: #0D47A1; } /* Darker blue for readable text */
        .bg-potads-yellow { background-color: #FFC107; } /* Pure vivid Yellow */
        .text-potads-yellow { color: #FFC107; }
        .border-potads-blue { border-color: #1E88E5; }
        .border-potads-yellow { border-color: #FFC107; }

        /* Playful Candy Colors (Soft & Harmonious for Sections) */
        .bg-pastel-blue { background-color: #E0F2FE; color: #0D47A1; } /* Soft Sky */
        .bg-pastel-pink { background-color: #FCE7F3; color: #0D47A1; } /* Soft Pink */
        .bg-pastel-yellow { background-color: #FEF9C3; color: #0D47A1; } /* Soft Sunshine */
        .bg-pastel-green { background-color: #DCFCE7; color: #0D47A1; } /* Soft Mint */
        .bg-pastel-purple { background-color: #F3E8FF; color: #0D47A1; } /* Soft Lavender */
        
        /* Bouncy Button */
        .btn-playful {
            border-radius: 9999px;
            box-shadow: 0 6px 0 0 rgba(0,0,0,0.25);
            border: 3px solid #FFFFFF;
            transition: all 0.1s;
        }
        .btn-playful:active {
            transform: translateY(6px);
            box-shadow: none;
        }
        .btn-playful:hover {
            transform: scale(1.05) translateY(-2px);
        }

        /* Preloader */
        #preloader {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: #003D73;
            z-index: 9999;
            display: flex;
            justify-content: center;
            align-items: center;
            transition: opacity 0.5s ease, visibility 0.5s ease;
        }
        .spinner {
            width: 60px;
            height: 60px;
            border: 5px solid rgba(255, 215, 0, 0.3);
            border-radius: 50%;
            border-top-color: #FFD700;
            animation: spin 1s ease-in-out infinite;
        }
        @keyframes spin {
            to { transform: rotate(360deg); }
        }
        body.loading {
            overflow: hidden;
        }
    </style>
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    @stack('styles')
</head>
<body class="text-gray-800 loading">

    <!-- Preloader -->
    <div id="preloader">
        <div class="spinner"></div>
    </div>

    <!-- Navbar -->
    <nav class="bg-potads-blue py-4 px-6 md:px-12 flex items-center justify-between sticky top-0 z-50 relative">
        <div class="flex items-center gap-2 z-50">
            <a href="{{ route('home') }}" class="bg-white p-2 rounded">
                <img src="{{ asset('assets/images/logo.png') }}" alt="Logo" class="h-10 w-auto object-contain">
            </a>
        </div>
        
        <div class="hidden md:flex items-center gap-8 text-white font-medium">
            <a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'border-b-2 border-potads-yellow pb-1 text-potads-yellow' : 'hover:text-potads-yellow transition' }}">Beranda</a>
            <a href="{{ route('about') }}" class="{{ request()->routeIs('about') ? 'border-b-2 border-potads-yellow pb-1 text-potads-yellow' : 'hover:text-potads-yellow transition' }}">Tentang Kami</a>
            <a href="{{ route('events.index') }}" class="{{ request()->routeIs('events.*') ? 'border-b-2 border-potads-yellow pb-1 text-potads-yellow' : 'hover:text-potads-yellow transition' }}">Event</a>
            <a href="{{ route('articles.index') }}" class="{{ request()->routeIs('articles.*') ? 'border-b-2 border-potads-yellow pb-1 text-potads-yellow' : 'hover:text-potads-yellow transition' }}">Artikel</a>
            <a href="{{ route('materials.index') }}" class="flex items-center gap-1 {{ request()->routeIs('materials.*') ? 'border-b-2 border-potads-yellow pb-1 text-potads-yellow' : 'hover:text-potads-yellow transition' }}">
                Materi <i data-lucide="chevron-down" class="w-4 h-4"></i>
            </a>
            <a href="{{ route('medical_infos.index') }}" class="{{ request()->routeIs('medical_infos.*') ? 'border-b-2 border-potads-yellow pb-1 text-potads-yellow' : 'hover:text-potads-yellow transition' }}">Akademis & Medis</a>
        </div>

        <div class="hidden md:flex items-center gap-4">
            @auth
                <div class="flex items-center gap-4">
                    @if(auth()->user()->role === 'admin')
                        <a href="{{ route('admin.dashboard') }}" class="text-white hover:text-potads-yellow transition flex items-center gap-2">
                            <i data-lucide="layout-dashboard" class="w-5 h-5"></i>
                            <span class="inline font-medium">{{ auth()->user()->name }}</span>
                        </a>
                    @else
                        <a href="{{ route('profile') }}" class="text-white hover:text-potads-yellow transition flex items-center gap-2">
                            <i data-lucide="user" class="w-5 h-5"></i>
                            <span class="inline font-medium">{{ auth()->user()->name }}</span>
                        </a>
                    @endif

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded-lg font-bold hover:bg-red-600 transition text-sm flex items-center gap-2">
                            <i data-lucide="log-out" class="w-4 h-4"></i>
                            <span class="inline">Logout</span>
                        </button>
                    </form>
                </div>
            @else
                <a href="{{ route('login') }}" class="bg-potads-yellow text-potads-blue px-6 py-2 rounded-lg font-bold hover:bg-yellow-400 transition text-sm">Login</a>
                <div class="text-white cursor-pointer">
                    <i data-lucide="user-circle" class="w-8 h-8"></i>
                </div>
            @endauth
        </div>

        <!-- Mobile Menu Button -->
        <button id="mobile-menu-btn" class="md:hidden flex items-center text-white focus:outline-none z-50">
            <i data-lucide="menu" class="w-6 h-6" id="menu-icon"></i>
            <i data-lucide="x" class="w-6 h-6 hidden" id="close-icon"></i>
        </button>
    </nav>

    <!-- Mobile Menu -->
    <div id="mobile-menu" class="fixed inset-0 z-40 bg-potads-blue flex-col items-center justify-center gap-6 hidden opacity-0 transition-opacity duration-300">
        <div class="flex flex-col items-center gap-6 text-white font-medium text-lg w-full px-6 text-center">
            <a href="{{ route('home') }}" class="w-full py-2 border-b border-white/10 {{ request()->routeIs('home') ? 'text-potads-yellow' : 'hover:text-white transition' }}">Beranda</a>
            <a href="{{ route('about') }}" class="w-full py-2 border-b border-white/10 {{ request()->routeIs('about') ? 'text-potads-yellow' : 'hover:text-white transition' }}">Tentang Kami</a>
            <a href="{{ route('events.index') }}" class="w-full py-2 border-b border-white/10 {{ request()->routeIs('events.*') ? 'text-potads-yellow' : 'hover:text-white transition' }}">Event</a>
            <a href="{{ route('articles.index') }}" class="w-full py-2 border-b border-white/10 {{ request()->routeIs('articles.*') ? 'text-potads-yellow' : 'hover:text-white transition' }}">Artikel</a>
            <a href="{{ route('materials.index') }}" class="w-full py-2 border-b border-white/10 {{ request()->routeIs('materials.*') ? 'text-potads-yellow' : 'hover:text-white transition' }}">Materi</a>
            <a href="{{ route('medical_infos.index') }}" class="w-full py-2 border-b border-white/10 {{ request()->routeIs('medical_infos.*') ? 'text-potads-yellow' : 'hover:text-white transition' }}">Akademis & Medis</a>

            @auth
                <div class="w-full py-2 flex flex-col items-center gap-4 mt-4">
                    @if(auth()->user()->role === 'admin')
                        <a href="{{ route('admin.dashboard') }}" class="text-potads-yellow hover:text-white transition flex items-center gap-2">
                            <i data-lucide="layout-dashboard" class="w-5 h-5"></i>
                            <span class="font-medium">{{ auth()->user()->name }}</span>
                        </a>
                    @else
                        <a href="{{ route('profile') }}" class="text-white hover:text-potads-yellow transition flex items-center gap-2">
                            <i data-lucide="user" class="w-5 h-5"></i>
                            <span class="font-medium">{{ auth()->user()->name }}</span>
                        </a>
                    @endif

                    <form method="POST" action="{{ route('logout') }}" class="w-full flex justify-center">
                        @csrf
                        <button type="submit" class="bg-red-500 text-white px-6 py-2 rounded-lg font-bold hover:bg-red-600 transition text-sm flex items-center gap-2">
                            <i data-lucide="log-out" class="w-4 h-4"></i>
                            <span>Logout</span>
                        </button>
                    </form>
                </div>
            @else
                <div class="w-full py-2 flex flex-col items-center gap-4 mt-4">
                    <a href="{{ route('login') }}" class="bg-potads-yellow text-potads-blue px-8 py-3 rounded-lg font-bold hover:bg-yellow-400 transition w-full max-w-[200px]">Login</a>
                </div>
            @endauth
        </div>
    </div>

    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-potads-blue text-white pt-20 pb-10 px-6 md:px-12 mt-20">
        <div class="max-w-7xl mx-auto grid grid-cols-1 md:grid-cols-4 gap-12 mb-16">
            <div class="md:col-span-1">
                <div class="bg-white p-2 rounded inline-block mb-6">
                    <img src="{{ asset('assets/images/logo.png') }}" alt="Logo" class="h-10 w-auto">
                </div>
                <p class="text-white/70 text-sm leading-relaxed">
                    {{ $siteSettings['site_description'] ?? 'Mendukung setiap perjalanan melalui aksi komunitas yang inklusif.' }}
                </p>
                <div class="flex gap-4 mt-8">
                    @if($siteSettings['social_instagram'] ?? false)
                        <a href="{{ $siteSettings['social_instagram'] }}" target="_blank" class="text-white/40 hover:text-potads-yellow transition"><i data-lucide="instagram" class="w-5 h-5"></i></a>
                    @endif
                    @if($siteSettings['social_facebook'] ?? false)
                        <a href="{{ $siteSettings['social_facebook'] }}" target="_blank" class="text-white/40 hover:text-potads-yellow transition"><i data-lucide="facebook" class="w-5 h-5"></i></a>
                    @endif
                    @if($siteSettings['social_youtube'] ?? false)
                        <a href="{{ $siteSettings['social_youtube'] }}" target="_blank" class="text-white/40 hover:text-potads-yellow transition"><i data-lucide="youtube" class="w-5 h-5"></i></a>
                    @endif
                </div>
            </div>
            
            <div>
                <h4 class="text-potads-yellow font-bold uppercase tracking-wider mb-6 text-xs">Organisasi</h4>
                <ul class="space-y-4 text-white/70 text-sm">
                    <li><a href="{{ route('about') }}" class="hover:text-white">Misi Kami</a></li>
                    <li><a href="{{ route('articles.index') }}" class="hover:text-white">Artikel</a></li>
                    <li><a href="{{ route('faqs.index') }}" class="hover:text-white">FAQ</a></li>
                </ul>
            </div>

            <div>
                <h4 class="text-potads-yellow font-bold uppercase tracking-wider mb-6 text-xs">Akses Publik</h4>
                <ul class="space-y-4 text-white/70 text-sm">
                    <li><a href="{{ route('materials.index') }}" class="hover:text-white">Materi Edukasi</a></li>
                    <li><a href="{{ route('medical_infos.index') }}" class="hover:text-white">Info Akademis & Medis</a></li>
                    <li><a href="{{ route('events.index') }}" class="hover:text-white">Explore Event</a></li>
                </ul>
            </div>

            <div>
                <h4 class="text-potads-yellow font-bold uppercase tracking-wider mb-6 text-xs">Hubungkan</h4>
                <p class="text-white/70 text-sm mb-6">{{ $siteSettings['contact_address'] ?? 'Hubungi Kami' }}</p>
                <div class="flex gap-4">
                    <a href="mailto:{{ $siteSettings['contact_email'] ?? '' }}" class="p-2 bg-white/10 rounded-full hover:bg-white/20 transition"><i data-lucide="mail" class="w-5 h-5"></i></a>
                    <a href="tel:{{ $siteSettings['contact_phone'] ?? '' }}" class="p-2 bg-white/10 rounded-full hover:bg-white/20 transition"><i data-lucide="phone" class="w-5 h-5"></i></a>
                </div>
            </div>
        </div>
        
        <div class="border-t border-white/10 pt-8 text-center">
            <p class="text-white/50 text-[10px] uppercase tracking-[0.2em] font-bold">
                © {{ date('Y') }} {{ $siteSettings['site_name'] ?? 'POTADS' }}. SELURUH HAK CIPTA DILINDUNGI UNDANG-UNDANG.
            </p>
        </div>
    </footer>

    <!-- Floating Accessibility Widget -->
    <div x-data="{ 
            open: false, 
            fontSize: localStorage.getItem('acc_fontSize') || 100, 
            textSpacing: localStorage.getItem('acc_textSpacing') || 0,
            lineHeight: localStorage.getItem('acc_lineHeight') || 1.5,
            highContrast: localStorage.getItem('acc_highContrast') === 'true', 
            nightMode: localStorage.getItem('acc_nightMode') === 'true',
            grayscale: localStorage.getItem('acc_grayscale') === 'true', 
            lowSaturation: localStorage.getItem('acc_lowSaturation') === 'true',
            dyslexic: localStorage.getItem('acc_dyslexic') === 'true', 
            highlightLinks: localStorage.getItem('acc_highlightLinks') === 'true',
            bigCursor: localStorage.getItem('acc_bigCursor') === 'true',
            readingGuide: localStorage.getItem('acc_readingGuide') === 'true',
            hideImages: localStorage.getItem('acc_hideImages') === 'true',
            stopAnimations: localStorage.getItem('acc_stopAnimations') === 'true',
            keyboardNav: localStorage.getItem('acc_keyboardNav') === 'true',
            readAloud: false,
            speech: null,
            
            init() {
                this.applyAll();
                this.speech = window.speechSynthesis;
            },
            
            applyAll() {
                document.documentElement.style.fontSize = this.fontSize + '%';
                document.documentElement.style.letterSpacing = this.textSpacing + 'px';
                document.documentElement.style.lineHeight = this.lineHeight;
                
                document.body.classList.toggle('high-contrast', this.highContrast);
                document.body.classList.toggle('night-mode', this.nightMode);
                document.body.classList.toggle('grayscale', this.grayscale);
                document.body.classList.toggle('low-saturation', this.lowSaturation);
                document.body.classList.toggle('dyslexic-font', this.dyslexic);
                document.body.classList.toggle('highlight-links', this.highlightLinks);
                document.body.classList.toggle('big-cursor', this.bigCursor);
                document.body.classList.toggle('reading-guide-active', this.readingGuide);
                document.body.classList.toggle('hide-images-active', this.hideImages);
                document.body.classList.toggle('stop-animations-active', this.stopAnimations);
                document.body.classList.toggle('keyboard-nav-active', this.keyboardNav);
            },
            
            toggleReadAloud() {
                this.readAloud = !this.readAloud;
                if (!this.readAloud) {
                    this.speech.cancel();
                } else {
                    this.speakText('Mode suara aktif. Klik pada teks untuk membaca.');
                }
            },

            speakText(text) {
                if (!this.speech) return;
                this.speech.cancel();
                const utterance = new SpeechSynthesisUtterance(text);
                utterance.lang = 'id-ID';
                this.speech.speak(utterance);
            },
            
            save(key, val) {
                localStorage.setItem('acc_' + key, val);
                this.applyAll();
            },

            reset() {
                this.fontSize = 100; this.textSpacing = 0; this.lineHeight = 1.5;
                this.highContrast = false; this.nightMode = false; this.grayscale = false; 
                this.lowSaturation = false; this.dyslexic = false; this.highlightLinks = false; 
                this.bigCursor = false; this.readingGuide = false; this.hideImages = false;
                this.stopAnimations = false; this.keyboardNav = false;
                this.readAloud = false;
                if(this.speech) this.speech.cancel();
                
                Object.keys(localStorage).forEach(key => { if(key.startsWith('acc_')) localStorage.removeItem(key); });
                this.applyAll();
            },

            get activeCount() {
                let count = 0;
                if(this.fontSize != 100) count++;
                if(this.textSpacing != 0) count++;
                if(this.lineHeight != 1.5) count++;
                if(this.highContrast) count++;
                if(this.nightMode) count++;
                if(this.grayscale) count++;
                if(this.lowSaturation) count++;
                if(this.dyslexic) count++;
                if(this.highlightLinks) count++;
                if(this.bigCursor) count++;
                if(this.readingGuide) count++;
                if(this.hideImages) count++;
                if(this.stopAnimations) count++;
                if(this.keyboardNav) count++;
                return count;
            }
        }" @mousedown="if(readAloud) { speakText($event.target.innerText || $event.target.alt || 'Elemen tanpa teks') }">
        <!-- Main Button -->
        <button @click="open = !open" 
                class="fixed bottom-8 left-8 z-[100] bg-potads-blue text-white w-16 h-16 rounded-2xl shadow-2xl hover:scale-110 transition-all flex items-center justify-center btn-playful group"
                style="box-shadow: 0 6px 0 0 #0D47A1;">
            <i data-lucide="accessibility" class="w-10 h-10"></i>
            <template x-if="activeCount > 0">
                <span class="absolute -top-2 -right-2 bg-potads-yellow text-potads-blue w-7 h-7 rounded-full flex items-center justify-center font-black text-xs border-4 border-white shadow-lg animate-bounce" x-text="activeCount"></span>
            </template>
        </button>

        <!-- Accessibility Menu -->        
        <div x-show="open" 
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0 translate-y-10 scale-95"
             x-transition:enter-end="opacity-100 translate-y-0 scale-100"
             @click.away="open = false"
             class="fixed bottom-28 left-8 z-[100] bg-white rounded-[2.5rem] shadow-[0_30px_100px_rgba(0,0,0,0.2)] border-4 border-white w-[340px] max-h-[70vh] overflow-y-auto custom-scrollbar p-8">
            
            <div class="flex items-center justify-between mb-8">
                <h3 class="text-potads-blue font-black text-xl flex items-center gap-3">
                    <div class="w-10 h-10 bg-blue-100 rounded-xl flex items-center justify-center text-potads-blue">
                        <i data-lucide="eye" class="w-6 h-6"></i>
                    </div>
                    Asisten Aksesibilitas
                </h3>
                <button @click="open = false" class="text-slate-400 hover:text-red-500 transition-colors">
                    <i data-lucide="x" class="w-6 h-6"></i>
                </button>
            </div>

            <div class="space-y-6">
                <!-- Group 0: Screen Reader -->
                <div class="space-y-4">
                    <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Pembaca Layar</p>
                    <button @click="toggleReadAloud()" 
                            :class="readAloud ? 'bg-potads-blue text-white shadow-lg' : 'bg-slate-50 text-slate-600'"
                            class="w-full p-4 rounded-2xl text-left transition-all flex items-center justify-between">
                        <div class="flex items-center gap-4">
                            <i data-lucide="volume-2" class="w-6 h-6" :class="readAloud ? 'text-potads-yellow' : 'text-slate-400'"></i>
                            <span class="text-[10px] font-black uppercase">Baca Bersuara (Audio)</span>
                        </div>
                        <div class="w-10 h-6 rounded-full p-1 transition-colors" :class="readAloud ? 'bg-potads-yellow' : 'bg-slate-200'">
                            <div class="bg-white w-4 h-4 rounded-full transition-transform" :class="readAloud ? 'translate-x-4' : 'translate-x-0'"></div>
                        </div>
                    </button>
                </div>

                <!-- Group 1: Text Adjustments -->
                <div class="space-y-4">
                    <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Penyesuaian Teks</p>
                    <div class="p-4 bg-slate-50 rounded-2xl flex items-center justify-between">
                        <span class="text-xs font-bold text-slate-600">Ukuran Teks</span>
                        <div class="flex items-center gap-3">
                            <button @click="fontSize = Math.max(80, parseInt(fontSize) - 10); save('fontSize', fontSize)" class="w-8 h-8 bg-white rounded-lg shadow-sm flex items-center justify-center font-black text-slate-500">-</button>
                            <span class="text-sm font-black text-potads-blue w-10 text-center" x-text="fontSize + '%'"></span>
                            <button @click="fontSize = Math.min(150, parseInt(fontSize) + 10); save('fontSize', fontSize)" class="w-8 h-8 bg-white rounded-lg shadow-sm flex items-center justify-center font-black text-slate-500">+</button>
                        </div>
                    </div>
                    <div class="grid grid-cols-2 gap-3">
                        <button @click="textSpacing = textSpacing == 0 ? 2 : 0; save('textSpacing', textSpacing)" 
                                :class="textSpacing > 0 ? 'bg-potads-blue text-white shadow-lg' : 'bg-slate-50 text-slate-600'"
                                class="p-4 rounded-2xl text-center transition-all flex flex-col items-center">
                            <i data-lucide="stretch-horizontal" class="w-6 h-6 mb-2" :class="textSpacing > 0 ? 'text-potads-yellow' : 'text-slate-400'"></i>
                            <span class="text-[9px] font-black uppercase">Spasi Huruf</span>
                        </button>
                        <button @click="lineHeight = lineHeight == 1.5 ? 2 : 1.5; save('lineHeight', lineHeight)" 
                                :class="lineHeight > 1.5 ? 'bg-potads-blue text-white shadow-lg' : 'bg-slate-50 text-slate-600'"
                                class="p-4 rounded-2xl text-center transition-all flex flex-col items-center">
                            <i data-lucide="align-justify" class="w-6 h-6 mb-2" :class="lineHeight > 1.5 ? 'text-potads-yellow' : 'text-slate-400'"></i>
                            <span class="text-[9px] font-black uppercase">Jarak Baris</span>
                        </button>
                    </div>
                </div>

                <!-- Group 2: Color & Vision -->
                <div class="space-y-4">
                    <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Warna & Penglihatan</p>
                    <div class="grid grid-cols-2 gap-3">
                        <button @click="highContrast = !highContrast; save('highContrast', highContrast)" 
                                :class="highContrast ? 'bg-potads-blue text-white shadow-lg' : 'bg-slate-50 text-slate-600'"
                                class="p-4 rounded-2xl text-center transition-all flex flex-col items-center">
                            <i data-lucide="contrast" class="w-6 h-6 mb-2" :class="highContrast ? 'text-potads-yellow' : 'text-slate-400'"></i>
                            <span class="text-[9px] font-black uppercase">Kontras</span>
                        </button>
                        <button @click="nightMode = !nightMode; save('nightMode', nightMode)" 
                                :class="nightMode ? 'bg-potads-blue text-white shadow-lg' : 'bg-slate-50 text-slate-600'"
                                class="p-4 rounded-2xl text-center transition-all flex flex-col items-center">
                            <i data-lucide="moon" class="w-6 h-6 mb-2" :class="nightMode ? 'text-potads-yellow' : 'text-slate-400'"></i>
                            <span class="text-[9px] font-black uppercase">Mode Malam</span>
                        </button>
                        <button @click="grayscale = !grayscale; save('grayscale', grayscale)" 
                                :class="grayscale ? 'bg-potads-blue text-white shadow-lg' : 'bg-slate-50 text-slate-600'"
                                class="p-4 rounded-2xl text-center transition-all flex flex-col items-center">
                            <i data-lucide="palette" class="w-6 h-6 mb-2" :class="grayscale ? 'text-potads-yellow' : 'text-slate-400'"></i>
                            <span class="text-[9px] font-black uppercase">Monokrom</span>
                        </button>
                        <button @click="lowSaturation = !lowSaturation; save('lowSaturation', lowSaturation)" 
                                :class="lowSaturation ? 'bg-potads-blue text-white shadow-lg' : 'bg-slate-50 text-slate-600'"
                                class="p-4 rounded-2xl text-center transition-all flex flex-col items-center">
                            <i data-lucide="sun-dim" class="w-6 h-6 mb-2" :class="lowSaturation ? 'text-potads-yellow' : 'text-slate-400'"></i>
                            <span class="text-[9px] font-black uppercase">Saturasi</span>
                        </button>
                    </div>
                </div>

                <!-- Group 3: Focus & Tools -->
                <div class="space-y-4">
                    <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Fokus & Alat Bantu</p>
                    <div class="grid grid-cols-2 gap-3">
                        <button @click="readingGuide = !readingGuide; save('readingGuide', readingGuide)" 
                                :class="readingGuide ? 'bg-potads-blue text-white shadow-lg' : 'bg-slate-50 text-slate-600'"
                                class="p-4 rounded-2xl text-center transition-all flex flex-col items-center">
                            <i data-lucide="navigation" class="w-6 h-6 mb-2" :class="readingGuide ? 'text-potads-yellow' : 'text-slate-400'"></i>
                            <span class="text-[9px] font-black uppercase">Garis Bantu</span>
                        </button>
                        <button @click="highlightLinks = !highlightLinks; save('highlightLinks', highlightLinks)" 
                                :class="highlightLinks ? 'bg-potads-blue text-white shadow-lg' : 'bg-slate-50 text-slate-600'"
                                class="p-4 rounded-2xl text-center transition-all flex flex-col items-center">
                            <i data-lucide="link" class="w-6 h-6 mb-2" :class="highlightLinks ? 'text-potads-yellow' : 'text-slate-400'"></i>
                            <span class="text-[9px] font-black uppercase">Link Highlight</span>
                        </button>
                        <button @click="hideImages = !hideImages; save('hideImages', hideImages)" 
                                :class="hideImages ? 'bg-potads-blue text-white shadow-lg' : 'bg-slate-50 text-slate-600'"
                                class="p-4 rounded-2xl text-center transition-all flex flex-col items-center">
                            <i data-lucide="image-off" class="w-6 h-6 mb-2" :class="hideImages ? 'text-potads-yellow' : 'text-slate-400'"></i>
                            <span class="text-[9px] font-black uppercase">Sembunyi Foto</span>
                        </button>
                        <button @click="stopAnimations = !stopAnimations; save('stopAnimations', stopAnimations)" 
                                :class="stopAnimations ? 'bg-potads-blue text-white shadow-lg' : 'bg-slate-50 text-slate-600'"
                                class="p-4 rounded-2xl text-center transition-all flex flex-col items-center">
                            <i data-lucide="video-off" class="w-6 h-6 mb-2" :class="stopAnimations ? 'text-potads-yellow' : 'text-slate-400'"></i>
                            <span class="text-[9px] font-black uppercase">Stop Animasi</span>
                        </button>
                    </div>
                </div>

                <!-- Group 4: Specialized -->
                <div class="space-y-4">
                    <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Kebutuhan Khusus</p>
                    <div class="space-y-3">
                        <button @click="dyslexic = !dyslexic; save('dyslexic', dyslexic)" 
                                :class="dyslexic ? 'bg-potads-blue text-white shadow-lg' : 'bg-slate-50 text-slate-600'"
                                class="w-full p-4 rounded-2xl text-left transition-all flex items-center gap-4">
                            <i data-lucide="type" class="w-6 h-6" :class="dyslexic ? 'text-potads-yellow' : 'text-slate-400'"></i>
                            <span class="text-[10px] font-black uppercase block">Font Disleksia</span>
                        </button>
                        <button @click="bigCursor = !bigCursor; save('bigCursor', bigCursor)" 
                                :class="bigCursor ? 'bg-potads-blue text-white shadow-lg' : 'bg-slate-50 text-slate-600'"
                                class="w-full p-4 rounded-2xl text-left transition-all flex items-center gap-4">
                            <i data-lucide="mouse-pointer-2" class="w-6 h-6" :class="bigCursor ? 'text-potads-yellow' : 'text-slate-400'"></i>
                            <span class="text-[10px] font-black uppercase block">Kursor Besar</span>
                        </button>
                        <button @click="keyboardNav = !keyboardNav; save('keyboardNav', keyboardNav)" 
                                :class="keyboardNav ? 'bg-potads-blue text-white shadow-lg' : 'bg-slate-50 text-slate-600'"
                                class="w-full p-4 rounded-2xl text-left transition-all flex items-center gap-4">
                            <i data-lucide="keyboard" class="w-6 h-6" :class="keyboardNav ? 'text-potads-yellow' : 'text-slate-400'"></i>
                            <span class="text-[10px] font-black uppercase block">Navigasi Keyboard</span>
                        </button>
                    </div>
                </div>

                <!-- Reset -->
                <button @click="reset()"
                        class="w-full py-5 text-red-500 font-black text-xs uppercase tracking-widest hover:bg-red-50 rounded-2xl transition-all border-2 border-dashed border-red-100 flex items-center justify-center gap-2">
                    <i data-lucide="refresh-cw" class="w-4 h-4"></i> Reset Pengaturan
                </button>
            </div>
        </div>
        
        <!-- Reading Guide Line Element -->
        <div x-show="readingGuide" 
             id="reading-guide-line" 
             class="fixed left-0 right-0 h-1 bg-potads-yellow z-[9999] pointer-events-none shadow-[0_0_15px_rgba(255,193,7,0.5)]"
             style="display: none;"></div>
    </div>

    <!-- Floating Social Media Sidebar (Left) -->
    <div class="fixed left-0 top-1/2 -translate-y-1/2 z-[90] flex flex-col items-start">
        @if($siteSettings['social_youtube'] ?? false)
            <a href="{{ $siteSettings['social_youtube'] }}" target="_blank" 
               class="w-14 h-14 bg-[#FF0000] text-white flex items-center justify-center hover:w-20 transition-all duration-300 group rounded-r-xl shadow-lg mb-0.5"
               title="YouTube POTADS">
                <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="group-hover:scale-125 transition-transform"><path d="M22.54 6.42a2.78 2.78 0 0 0-1.94-2C18.88 4 12 4 12 4s-6.88 0-8.6.42a2.78 2.78 0 0 0-1.94 2A29 29 0 0 0 1 11.75a29 29 0 0 0 .46 5.33A2.78 2.78 0 0 0 3.4 19c1.72.42 8.6.42 8.6.42s6.88 0 8.6-.42a2.78 2.78 0 0 0 1.94-2 29 29 0 0 0 .46-5.33 29 29 0 0 0-.46-5.33z"></path><polygon points="9.75 15.02 15.5 11.75 9.75 8.48 9.75 15.02"></polygon></svg>
            </a>
        @endif
        @if($siteSettings['social_instagram'] ?? false)
            <a href="{{ $siteSettings['social_instagram'] }}" target="_blank" 
               class="w-14 h-14 bg-[#E1306C] text-white flex items-center justify-center hover:w-20 transition-all duration-300 group rounded-r-xl shadow-lg mb-0.5"
               title="Instagram POTADS">
                <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="group-hover:scale-125 transition-transform"><rect x="2" y="2" width="20" height="20" rx="5" ry="5"></rect><path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"></path><line x1="17.5" y1="6.5" x2="17.51" y2="6.5"></line></svg>
            </a>
        @endif
        @if($siteSettings['contact_phone'] ?? false)
            <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $siteSettings['contact_phone']) }}" target="_blank" 
               class="w-14 h-14 bg-[#25D366] text-white flex items-center justify-center hover:w-20 transition-all duration-300 group rounded-r-xl shadow-lg"
               title="WhatsApp POTADS">
                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="currentColor" class="group-hover:scale-125 transition-transform"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.445 0 .01 5.437 0 12.045c0 2.112.552 4.171 1.597 5.978L0 24l6.152-1.613a11.82 11.82 0 005.895 1.565h.006c6.604 0 12.039-5.437 12.043-12.048a11.82 11.82 0 00-3.483-8.504z"/></svg>
            </a>
        @endif
    </div>



    <style>
        /* Accessibility Styles */
        .high-contrast { background-color: #000 !important; color: #fff !important; }
        .high-contrast section, .high-contrast div:not(.bg-white):not([class*='fixed']), .high-contrast nav, .high-contrast footer { background-color: #000 !important; border-color: #fff !important; color: #fff !important; }
        .high-contrast a, .high-contrast h1, .high-contrast h2, .high-contrast h3, .high-contrast p { color: #ffff00 !important; }
        .grayscale { filter: grayscale(100%) !important; }
        .low-saturation { filter: saturate(0.3) !important; }
        .dyslexic-font { font-family: 'OpenDyslexic', sans-serif !important; }
        .highlight-links a { background-color: #ffff00 !important; color: #000 !important; outline: 2px solid #000 !important; text-decoration: underline !important; }
        .big-cursor * { cursor: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='64' height='64' viewBox='0 0 24 24' fill='none' stroke='black' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpath d='M3 3l7.07 16.97 2.51-7.39 7.39-2.51L3 3z'%3E%3C/path%3E%3Cpath d='M13 13l6 6'%3E%3C/path%3E%3C/svg%3E"), auto !important; }
        .reading-guide-active { cursor: crosshair; }
        
        .night-mode { background-color: #121212 !important; color: #e0e0e0 !important; }
        .night-mode section, .night-mode div:not(.bg-white):not([class*='fixed']) { background-color: #1a1a1a !important; color: #e0e0e0 !important; }
        .night-mode h1, .night-mode h2, .night-mode h3, .night-mode p { color: #ffffff !important; }
        
        .hide-images-active img { visibility: hidden !important; }
        
        .stop-animations-active * { 
            animation: none !important; 
            transition: none !important; 
            scroll-behavior: auto !important; 
        }

        .keyboard-nav-active *:focus {
            outline: 4px solid #FACC15 !important;
            outline-offset: 4px !important;
            box-shadow: 0 0 0 8px rgba(250, 204, 21, 0.3) !important;
        }

        @font-face {
            font-family: 'OpenDyslexic';
            src: url('https://cdn.jsdelivr.net/npm/open-dyslexic@1.0.3/OpenDyslexic-Regular.otf');
        }

        .custom-scrollbar::-webkit-scrollbar { width: 6px; }
        .custom-scrollbar::-webkit-scrollbar-track { background: #f1f1f1; border-radius: 10px; }
        .custom-scrollbar::-webkit-scrollbar-thumb { background: #ddd; border-radius: 10px; }
        .custom-scrollbar::-webkit-scrollbar-thumb:hover { background: #ccc; }
    </style>

    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        // Reading Guide Movement
        document.addEventListener('mousemove', (e) => {
            const line = document.getElementById('reading-guide-line');
            if (line && line.style.display !== 'none') {
                line.style.top = e.clientY + 'px';
            }
        });

        // Preloader
        window.addEventListener('load', function() {
            const preloader = document.getElementById('preloader');
            document.body.classList.remove('loading');
            if(preloader) {
                preloader.style.opacity = '0';
                preloader.style.visibility = 'hidden';
                setTimeout(() => { preloader.style.display = 'none'; }, 500);
            }
        });

        // Initialize AOS
        AOS.init({
            duration: 800,
            once: true,
            offset: 100,
        });

        lucide.createIcons();

        // Mobile Menu Toggle
        const mobileBtn = document.getElementById('mobile-menu-btn');
        const mobileMenu = document.getElementById('mobile-menu');
        const menuIcon = document.getElementById('menu-icon');
        const closeIcon = document.getElementById('close-icon');

        if (mobileBtn && mobileMenu) {
            mobileBtn.addEventListener('click', () => {
                if (mobileMenu.classList.contains('hidden')) {
                    mobileMenu.classList.remove('hidden');
                    mobileMenu.classList.add('flex');
                    setTimeout(() => mobileMenu.classList.remove('opacity-0'), 10);
                    menuIcon.classList.add('hidden');
                    closeIcon.classList.remove('hidden');
                    document.body.style.overflow = 'hidden'; // Prevent scrolling when menu is open
                } else {
                    mobileMenu.classList.add('opacity-0');
                    setTimeout(() => {
                        mobileMenu.classList.add('hidden');
                        mobileMenu.classList.remove('flex');
                    }, 300);
                    menuIcon.classList.remove('hidden');
                    closeIcon.classList.add('hidden');
                    document.body.style.overflow = '';
                }
            });
        }
    </script>
    @stack('scripts')
</body>
</html>
