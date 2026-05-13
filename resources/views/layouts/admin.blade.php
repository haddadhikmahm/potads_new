<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Admin Dashboard') - POTADS</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Lucide Icons -->
    <script src="https://unpkg.com/lucide@latest"></script>

    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Tailwind Config (if needed) & Vite -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'potads-blue': '#0f407a',
                        'potads-yellow': '#facc15',
                        'soft-bg': '#f8fafc',
                    },
                    fontFamily: {
                        sans: ['Plus Jakarta Sans', 'sans-serif'],
                    },
                }
            }
        }
    </script>
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        [x-cloak] { display: none !important; }
        .custom-scrollbar::-webkit-scrollbar { width: 5px; }
        .custom-scrollbar::-webkit-scrollbar-track { background: transparent; }
        .custom-scrollbar::-webkit-scrollbar-thumb { background: rgba(255,255,255,0.1); border-radius: 10px; }
        .custom-scrollbar::-webkit-scrollbar-thumb:hover { background: rgba(255,255,255,0.2); }

        /* SweetAlert2 Premium Customization */
        .swal2-popup {
            border-radius: 1.5rem !important;
            padding: 3.5rem 5rem !important;
            font-family: 'Plus Jakarta Sans', sans-serif !important;
            width: 750px !important;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.1) !important;
        }
        .swal2-title {
            font-size: 2.25rem !important;
            font-weight: 900 !important;
            color: #1e293b !important;
            margin-bottom: 1.25rem !important;
            padding: 0 !important;
            letter-spacing: -0.025em !important;
        }
        .swal2-html-container {
            font-size: 1.25rem !important;
            color: #475569 !important;
            line-height: 1.6 !important;
            margin: 0 0 4rem 0 !important;
            padding: 0 !important;
        }
        .swal2-actions {
            margin-top: 0 !important;
            width: 100% !important;
            gap: 1.5rem !important;
        }
        .swal2-confirm, .swal2-cancel {
            margin: 0 !important;
            height: 100px !important;
            border-radius: 9999px !important;
            font-weight: 800 !important;
            font-size: 1.35rem !important;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1) !important;
        }
        .swal2-confirm {
            background-color: #0f407a !important;
            color: white !important;
            flex: 1;
            box-shadow: 0 10px 20px -5px rgba(15, 64, 122, 0.3) !important;
        }
        .swal2-confirm.swal2-danger {
            background-color: #c22020 !important;
            box-shadow: 0 10px 20px -5px rgba(194, 32, 32, 0.3) !important;
        }
        .swal2-cancel {
            background-color: #fff !important;
            color: #475569 !important;
            border: 2px solid #cbd5e1 !important;
            flex: 1;
        }
        .swal2-confirm:hover {
            transform: translateY(-2px) !important;
            filter: brightness(1.1) !important;
        }
        .swal2-icon {
            border: none !important;
            width: 120px !important;
            height: 120px !important;
            margin: 0 auto 3rem auto !important;
        }
        .swal2-icon.swal2-success {
            background-color: #def7ed !important;
        }
        .swal2-icon.swal2-success .swal2-success-ring {
            display: none !important;
        }
        .swal2-icon.swal2-success .swal2-success-fix {
            display: none !important;
        }
        .swal2-icon.swal2-success [class^='swal2-success-line'] {
            background-color: #059669 !important;
            height: 7px !important;
            border-radius: 10px !important;
        }
        .swal2-icon.swal2-success [class^='swal2-success-line'][class$='tip'] {
            width: 32px !important;
            left: 24px !important;
            top: 66px !important;
        }
        .swal2-icon.swal2-success [class^='swal2-success-line'][class$='long'] {
            width: 58px !important;
            right: 22px !important;
            top: 58px !important;
        }
        .swal2-icon.swal2-warning {
            background-color: #fefce8 !important;
            color: #eab308 !important;
        }
        .swal2-icon.swal2-error {
            background-color: #fef2f2 !important;
            color: #ef4444 !important;
            border: none !important;
        }
        .swal2-icon.swal2-info {
            background-color: #f0f9ff !important;
            color: #0ea5e9 !important;
            border: none !important;
        }
        .swal2-icon.swal2-question {
            background-color: #f5f3ff !important;
            color: #8b5cf6 !important;
            border: none !important;
        }
        .swal2-icon.swal2-warning .swal2-icon-content,
        .swal2-icon.swal2-error .swal2-icon-content,
        .swal2-icon.swal2-info .swal2-icon-content,
        .swal2-icon.swal2-question .swal2-icon-content {
            font-size: 3rem !important;
        }
        
        /* Ensure horizontal actions */
        .swal2-actions {
            flex-direction: row !important;
            justify-content: center !important;
        }
        .swal2-confirm, .swal2-cancel {
            width: auto !important;
            min-width: 200px !important;
            padding: 0 3rem !important;
        }
    </style>
</head>
<body class="bg-soft-bg font-sans antialiased text-slate-800">
    <div class="flex h-screen overflow-hidden">
        
        <!-- Sidebar -->
        <aside id="admin-sidebar" class="w-72 bg-potads-blue flex-shrink-0 flex flex-col h-full overflow-hidden transition-all duration-300 absolute md:relative z-50 -translate-x-full md:translate-x-0">
            <!-- Sidebar Header -->
            <div class="px-8 py-6 flex flex-col items-center">
                <div class="w-16 h-16 bg-white rounded-lg flex items-center justify-center shadow-sm p-1.5 mb-2">
                    <img src="{{ asset('assets/images/logo.png') }}" alt="Logo" class="w-full h-full object-contain">
                </div>
                <h1 class="text-white font-bold text-lg tracking-wider">Admin POTADS</h1>
            </div>

            <!-- Sidebar Navigation -->
            <nav class="flex-1 overflow-y-auto px-4 py-4 space-y-1.5 custom-scrollbar">
                @php
                    $menuItems = [
                        ['route' => 'admin.dashboard', 'label' => 'Dashboard', 'icon' => 'layout-grid'],
                        ['route' => 'admin.events.index', 'label' => 'Event', 'icon' => 'calendar'],
                        ['route' => 'admin.articles.index', 'label' => 'Berita/Artikel', 'icon' => 'file-text'],
                        ['route' => 'admin.materials.index', 'label' => 'Video & File Materi', 'icon' => 'play-circle'],
                        ['route' => 'admin.medical-infos.index', 'label' => 'Info Akademis & Medis', 'icon' => 'activity'],
                        ['route' => 'admin.faqs.index', 'label' => 'FAQ', 'icon' => 'help-circle'],
                        ['route' => 'admin.members.index', 'label' => 'Member', 'icon' => 'users'],
                        ['route' => 'admin.children.index', 'label' => 'Data Anak', 'icon' => 'smile'],
                        ['route' => 'admin.donations.index', 'label' => 'Donasi', 'icon' => 'heart'],
                        ['route' => 'admin.settings.index', 'label' => 'Site Settings', 'icon' => 'settings'],
                    ];
                @endphp

                @foreach($menuItems as $item)
                    @php 
                        $isActive = $item['route'] !== '#' && (request()->routeIs($item['route']) || (strpos($item['route'], 'index') === false && request()->routeIs(explode('.', $item['route'])[0].'.'.explode('.', $item['route'])[1].'.*')));
                        if ($item['label'] === 'Event' && request()->routeIs('admin.events.*')) $isActive = true;
                        if ($item['label'] === 'Berita/Artikel' && request()->routeIs('admin.articles.*')) $isActive = true;
                        if ($item['label'] === 'Donasi' && request()->routeIs('admin.donations.*')) $isActive = true;
                    @endphp
                    <a href="{{ $item['route'] !== '#' ? route($item['route']) : 'javascript:void(0)' }}" 
                       class="flex items-center gap-3 px-4 py-3.5 rounded-xl transition-all duration-200 group {{ $isActive ? 'bg-potads-yellow text-potads-blue font-bold shadow-lg shadow-yellow-500/20' : 'text-white/70 hover:bg-white/10 hover:text-white' }}">
                        <i data-lucide="{{ $item['icon'] }}" class="w-5 h-5 {{ $isActive ? 'text-potads-blue' : 'text-white opacity-50' }}"></i>
                        <span class="text-sm">{{ $item['label'] }}</span>
                    </a>
                @endforeach
            </nav>

            <!-- Sidebar Footer (Optional Logout) -->
            <div class="p-4 border-t border-white/10">
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="w-full flex items-center gap-3 px-4 py-3 rounded-xl text-white/70 hover:bg-red-500/20 hover:text-red-400 transition-all">
                        <i data-lucide="log-out" class="w-5 h-5"></i>
                        <span class="text-sm font-medium">Keluar</span>
                    </button>
                </form>
            </div>
        </aside>

        <!-- Mobile Sidebar Overlay -->
        <div id="sidebar-overlay" class="fixed inset-0 bg-slate-900/50 z-40 hidden md:hidden"></div>

        <!-- Main Content Area -->
        <div class="flex-1 flex flex-col h-full overflow-hidden relative">
            <!-- Top Navbar -->
            <header class="h-20 bg-white border-b border-slate-100 flex items-center justify-between px-4 md:px-8 flex-shrink-0 gap-4">
                
                <!-- Mobile Hamburger Button -->
                <button id="mobile-sidebar-btn" class="md:hidden p-2 text-slate-500 hover:text-potads-blue focus:outline-none">
                    <i data-lucide="menu" class="w-6 h-6"></i>
                </button>

                <!-- Search Bar -->
                <div class="hidden md:block flex-1 max-w-md relative">
                    <span class="absolute left-4 top-1/2 -translate-y-1/2 text-slate-400">
                        <i data-lucide="search" class="w-5 h-5"></i>
                    </span>
                    <input type="text" placeholder="Cari data..." class="w-full pl-12 pr-4 py-2.5 bg-slate-50 border border-slate-100 rounded-xl focus:outline-none focus:ring-2 focus:ring-potads-blue/5 text-sm">
                </div>

                <!-- User Profile Dropdown -->
                <div class="relative" x-data="{ open: false }" @click.away="open = false">
                    <button @click="open = !open" class="flex items-center gap-4 text-right group focus:outline-none">
                        <div class="hidden md:block">
                            <p class="text-xs font-bold text-slate-900 group-hover:text-potads-blue transition-colors">{{ Auth::user()->name }}</p>
                            <p class="text-[10px] font-semibold text-potads-blue uppercase tracking-wider">Admin POTADS</p>
                        </div>
                        <div class="w-10 h-10 bg-slate-200 rounded-full overflow-hidden border-2 border-white shadow-sm ring-1 ring-slate-100 group-hover:ring-potads-blue/30 transition-all">
                            @if(Auth::user()->avatar)
                                <img src="{{ asset('storage/' . Auth::user()->avatar) }}" class="w-full h-full object-cover">
                            @else
                                <div class="w-full h-full flex items-center justify-center bg-potads-blue text-white text-xs font-bold">
                                    {{ substr(Auth::user()->name, 0, 2) }}
                                </div>
                            @endif
                        </div>
                        <i data-lucide="chevron-down" class="w-4 h-4 text-slate-400 group-hover:text-potads-blue transition-all" :class="{ 'rotate-180': open }"></i>
                    </button>

                    <!-- Dropdown Menu -->
                    <div x-show="open" 
                         x-cloak
                         x-transition:enter="transition ease-out duration-200"
                         x-transition:enter-start="opacity-0 scale-95 translate-y-2"
                         x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                         x-transition:leave="transition ease-in duration-75"
                         x-transition:leave-start="opacity-100 scale-100 translate-y-0"
                         x-transition:leave-end="opacity-0 scale-95 translate-y-2"
                         class="absolute right-0 mt-4 w-56 bg-white rounded-2xl shadow-xl border border-slate-100 py-2 z-50">
                        
                        <div class="px-4 py-3 border-b border-slate-50 mb-1">
                            <p class="text-xs font-bold text-slate-900">{{ Auth::user()->name }}</p>
                            <p class="text-[10px] text-slate-500 truncate">{{ Auth::user()->email }}</p>
                        </div>

                        <a href="{{ route('admin.profile.edit') }}" class="flex items-center gap-3 px-4 py-2.5 text-sm text-slate-600 hover:bg-slate-50 hover:text-potads-blue transition-all">
                            <i data-lucide="user" class="w-4 h-4"></i>
                            <span>Profil Saya</span>
                        </a>

                        <div class="border-t border-slate-50 mt-1 pt-1">
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="w-full flex items-center gap-3 px-4 py-2.5 text-sm text-red-500 hover:bg-red-50 transition-all font-medium">
                                    <i data-lucide="log-out" class="w-4 h-4"></i>
                                    <span>Keluar</span>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Scrollable Content Container -->
            <main class="flex-1 overflow-y-auto p-8 custom-scrollbar">
                <!-- Header Component for Pages -->
                @hasSection('header_title')
                    <div class="mb-8">
                        <p class="text-[10px] font-extrabold text-blue-600 uppercase tracking-[0.2em] mb-1">
                            @yield('header_breadcrumb', 'Management Portal')
                        </p>
                        <h2 class="text-2xl font-bold text-slate-900">@yield('header_title')</h2>
                    </div>
                @endif

                @yield('content')
            </main>
        </div>
    </div>

    <!-- Scripts -->
    <script>
        lucide.createIcons();

        // Global Alert Handlers
        window.showAlert = {
            success: (message) => {
                Swal.fire({
                    title: '',
                    html: `
                        <div class="flex flex-col items-center py-4 text-center">
                            <div class="w-24 h-24 bg-[#def7ed] rounded-full flex items-center justify-center mb-10">
                                <svg class="w-12 h-12 text-[#059669]" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="4">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"></path>
                                </svg>
                            </div>
                            <h2 class="text-3xl font-black text-[#1e293b] mb-4">Data Berhasil Disimpan</h2>
                            <p class="text-lg text-[#64748b] leading-relaxed px-10">
                                Perubahan Anda telah berhasil diperbarui ke sistem.
                            </p>
                        </div>
                    `,
                    confirmButtonText: 'Tutup',
                    customClass: {
                        popup: 'swal2-success-popup',
                        confirmButton: 'swal2-confirm'
                    },
                    buttonsStyling: false
                });
            },
            error: (message) => {
                Swal.fire({
                    title: 'Terjadi Kesalahan',
                    text: message || 'Gagal memproses data. Silakan coba lagi nanti.',
                    icon: 'error',
                    confirmButtonText: 'Tutup',
                    customClass: {
                        popup: 'swal2-error-popup',
                        confirmButton: 'swal2-confirm'
                    },
                    buttonsStyling: false
                });
            },
            confirmDelete: (form) => {
                Swal.fire({
                    title: '',
                    html: `
                        <div class="flex flex-col items-center py-4 text-center">
                            <div class="w-28 h-28 bg-[#fefce8] rounded-full flex items-center justify-center mb-10">
                                <svg class="w-14 h-14 text-[#eab308]" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                                </svg>
                            </div>
                            <h2 class="text-3xl font-black text-[#1e293b] mb-4">Hapus Data Ini?</h2>
                            <p class="text-lg text-[#64748b] leading-relaxed px-10">
                                Apakah Anda yakin ingin menghapus data ini? Aksi ini tidak dapat dibatalkan.
                            </p>
                        </div>
                    `,
                    showCancelButton: true,
                    confirmButtonText: 'Ya, Hapus',
                    cancelButtonText: 'Batal',
                    customClass: {
                        popup: 'swal2-delete-popup',
                        confirmButton: 'swal2-confirm swal2-danger',
                        cancelButton: 'swal2-cancel'
                    },
                    buttonsStyling: false,
                    reverseButtons: true
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            }
        };

        // Auto-trigger success alert from session
        @if(session('success'))
            showAlert.success("{{ session('success') }}");
        @endif

        // Global Delete Listener
        document.addEventListener('click', function(e) {
            if (e.target.closest('.btn-delete-confirm')) {
                e.preventDefault();
                const form = e.target.closest('form');
                if (form) showAlert.confirmDelete(form);
            }
        });
        // Mobile Sidebar Toggle
        const sidebarBtn = document.getElementById('mobile-sidebar-btn');
        const adminSidebar = document.getElementById('admin-sidebar');
        const sidebarOverlay = document.getElementById('sidebar-overlay');

        if (sidebarBtn && adminSidebar && sidebarOverlay) {
            function toggleSidebar() {
                const isOpen = !adminSidebar.classList.contains('-translate-x-full');
                if (isOpen) {
                    adminSidebar.classList.add('-translate-x-full');
                    sidebarOverlay.classList.add('hidden');
                } else {
                    adminSidebar.classList.remove('-translate-x-full');
                    sidebarOverlay.classList.remove('hidden');
                }
            }

            sidebarBtn.addEventListener('click', toggleSidebar);
            sidebarOverlay.addEventListener('click', toggleSidebar);
        }
    </script>
    @stack('scripts')
</body>
</html>
