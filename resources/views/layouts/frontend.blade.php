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
                        <span class="text-white font-medium flex items-center gap-2">
                            <i data-lucide="user" class="w-5 h-5"></i>
                            {{ auth()->user()->name }}
                        </span>
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
                        <span class="text-white font-medium flex items-center gap-2">
                            <i data-lucide="user" class="w-5 h-5"></i>
                            {{ auth()->user()->name }}
                        </span>
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

    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        // Preloader
        window.addEventListener('load', function() {
            const preloader = document.getElementById('preloader');
            document.body.classList.remove('loading');
            preloader.style.opacity = '0';
            preloader.style.visibility = 'hidden';
            setTimeout(() => { preloader.style.display = 'none'; }, 500);
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
