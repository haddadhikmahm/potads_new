<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - POTADS</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
    </style>
</head>
<body class="bg-slate-100 min-h-screen flex items-center justify-center p-4 md:p-8">

    <div class="max-w-6xl w-full bg-white rounded-[2.5rem] shadow-2xl overflow-hidden flex flex-col md:flex-row min-h-[700px]">
        
        <!-- SISI KIRI (INFO PANEL) -->
        <div class="md:w-5/12 p-8 md:p-12 flex flex-col justify-between bg-[#0f407a]">
            <div>
                <!-- Logo -->
                <div class="flex flex-col items-center mb-8">
                    <div class="w-16 h-16 bg-white rounded-lg flex items-center justify-center shadow-sm p-2">
                        <svg viewBox="0 0 100 100" class="w-full h-full text-red-600">
                            <path d="M50 20 L80 80 L20 80 Z" fill="none" stroke="currentColor" stroke-width="8" />
                            <circle cx="50" cy="45" r="10" fill="currentColor" />
                            <path d="M30 70 Q50 90 70 70" fill="none" stroke="currentColor" stroke-width="5" />
                        </svg>
                    </div>
                    <span class="text-white font-bold text-xs mt-2 tracking-widest text-center">POTADS</span>
                </div>

                <h1 class="text-3xl md:text-4xl font-bold text-white leading-tight mb-6">
                    Membangun Masa Depan Penuh Senyuman.
                </h1>
                <p class="text-blue-100 text-sm md:text-base leading-relaxed mb-8">
                    Setiap langkah kecil membawa perubahan besar bagi anak-anak dengan Down Syndrome. Mari melangkah bersama.
                </p>
            </div>

            <!-- Testimonial Card -->
            <div class="p-6 rounded-2xl relative overflow-hidden bg-[#facc15] text-slate-900">
                <div class="absolute -right-4 -bottom-4 w-24 h-24 bg-yellow-400/50 rounded-full"></div>
                <div class="relative z-10">
                    <p class="italic text-sm font-medium mb-4">
                        "Fondasi ini bukan sekedar bantuan, tapi keluarga yang memahami potensi anak saya."
                    </p>
                    <div>
                        <p class="text-[10px] uppercase tracking-wider font-bold opacity-80">
                            — IBU RATNA, ORANG TUA
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- SISI KANAN (FORM PANEL) -->
        <div class="md:w-7/12 p-8 md:p-12 bg-white flex flex-col">
            <div class="max-w-md mx-auto w-full my-auto">
                <h2 class="text-3xl font-bold text-[#0f407a] mb-2">Selamat Datang</h2>
                <p class="text-slate-500 mb-8">Silakan masuk ke akun Anda untuk melanjutkan.</p>

                <form method="POST" action="{{ route('login') }}" class="space-y-6">
                    @csrf
                    <div>
                        <label class="block text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-2">Username</label>
                        <div class="relative">
                            <span class="absolute left-4 top-1/2 -translate-y-1/2 text-slate-400">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                            </span>
                            <input 
                                type="text" 
                                name="username"
                                placeholder="Masukkan username"
                                class="w-full pl-12 pr-4 py-4 bg-slate-50 border border-slate-100 rounded-2xl focus:outline-none focus:ring-2 focus:ring-blue-500/20 transition-all text-sm @error('username') border-red-500 @enderror"
                                value="{{ old('username') }}"
                                required
                            />
                        </div>
                        @error('username')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-2">Kata Sandi</label>
                        <div class="relative">
                            <span class="absolute left-4 top-1/2 -translate-y-1/2 text-slate-400">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect><path d="M7 11V7a5 5 0 0 1 10 0v4"></path></svg>
                            </span>
                            <input 
                                type="password" 
                                name="password"
                                id="password"
                                placeholder="••••••••"
                                class="w-full pl-12 pr-12 py-4 bg-slate-50 border border-slate-100 rounded-2xl focus:outline-none focus:ring-2 focus:ring-blue-500/20 transition-all text-sm"
                                required
                            />
                            <button type="button" onclick="togglePassword()" class="absolute right-4 top-1/2 -translate-y-1/2 text-slate-400 hover:text-slate-600">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>
                            </button>
                        </div>
                    </div>

                    <div class="flex items-center justify-between text-xs">
                        <label class="flex items-center gap-2 cursor-pointer text-slate-500">
                            <input type="checkbox" name="remember" class="rounded border-slate-300 text-blue-600 focus:ring-blue-500" />
                            Ingat saya
                        </label>
                        <a href="{{ route('password.request') }}" class="text-blue-600 font-semibold hover:underline">Lupa sandi?</a>
                    </div>

                    <button type="submit" class="w-full bg-[#0a315e] text-white py-4 rounded-full font-bold flex items-center justify-center gap-2 hover:bg-[#08284d] transition-colors shadow-lg shadow-blue-900/20">
                        Masuk Sekarang 
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>
                    </button>
                </form>

                <div class="mt-12 text-center">
                    <p class="text-slate-500 text-sm mb-4">Belum memiliki akun?</p>
                    <a href="{{ route('register') }}" class="block w-full bg-[#facc15] text-slate-900 py-4 rounded-full font-bold hover:bg-[#eab308] transition-colors text-center">
                        Daftar Akun Baru
                    </a>
                </div>
            </div>

            <!-- Footer Links -->
            <div class="mt-auto pt-8 flex flex-wrap justify-center gap-6 text-[10px] font-bold text-slate-400 uppercase tracking-widest border-t border-slate-100">
                <a href="#" class="hover:text-blue-600">Bantuan</a>
                <a href="#" class="hover:text-blue-600">Privasi</a>
                <a href="#" class="hover:text-blue-600">Syarat & Ketentuan</a>
                <span class="md:ml-auto">© 2026 POTADS</span>
            </div>
        </div>
    </div>

    <script>
        function togglePassword() {
            const input = document.getElementById('password');
            input.type = input.type === 'password' ? 'text' : 'password';
        }
    </script>
</body>
</html>