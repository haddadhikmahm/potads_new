<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Akun Baru - POTADS</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        .custom-scrollbar::-webkit-scrollbar { width: 4px; }
        .custom-scrollbar::-webkit-scrollbar-track { background: #f1f1f1; border-radius: 10px; }
        .custom-scrollbar::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 10px; }
        .custom-scrollbar::-webkit-scrollbar-thumb:hover { background: #94a3b8; }
    </style>
</head>
<body class="bg-slate-100 min-h-screen flex items-center justify-center p-4 md:p-8">

    <!-- Container Utama dengan Tinggi Tetap (Sama seperti Login) -->
    <div class="max-w-6xl w-full bg-white rounded-[2.5rem] shadow-2xl overflow-hidden flex flex-col md:flex-row h-auto md:h-[700px]">
        
        <!-- SISI KIRI (INFO PANEL) - Tinggi Penuh -->
        <div class="md:w-5/12 p-8 md:p-12 flex flex-col justify-between bg-[#0a315e] h-full">
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
                    Mari Bergabung dalam Perjalanan Inklusi.
                </h1>
                <p class="text-blue-100 text-sm md:text-base leading-relaxed mb-8">
                    Kami percaya setiap anak memiliki potensi luar biasa. Dengan mendaftar, Anda membantu kami menciptakan dunia yang lebih ramah bagi penyandang Down Syndrome.
                </p>
            </div>

            <!-- Testimonial Card -->
            <div class="p-6 rounded-2xl relative overflow-hidden bg-slate-800/50 text-white backdrop-blur-sm border border-white/10">
                <div class="relative z-10">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="#facc15" class="text-yellow-400 mb-3"><path d="M19 14c1.49-1.46 3-3.21 3-5.5A5.5 5.5 0 0 0 16.5 3c-1.76 0-3 .5-4.5 2-1.5-1.5-2.74-2-4.5-2A5.5 5.5 0 0 0 2 8.5c0 2.3 1.5 4.05 3 5.5l7 7Z"></path></svg>
                    <p class="italic text-sm font-medium mb-4">
                        "Setiap dukungan kecil membawa perubahan besar bagi masa depan anak-anak kami."
                    </p>
                    <div class="flex items-center gap-3">
                        <div class="w-8 h-8 rounded-full bg-yellow-400 flex items-center justify-center text-xs font-bold text-slate-900">EH</div>
                        <div>
                            <p class="text-[10px] uppercase tracking-wider font-bold opacity-80">Tim Potads</p>
                            <p class="text-[10px] opacity-60">Relawan Komunitas</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- SISI KANAN (FORM PANEL) - Scrollable Area -->
        <div class="md:w-7/12 bg-white flex flex-col h-full overflow-hidden">
            
            <!-- Header (Statis/Tidak ikut scroll) -->
            <div class="p-8 md:p-12 pb-0">
                <h2 class="text-2xl font-bold text-[#0f407a] mb-1">Buat Akun Baru</h2>
                <p class="text-slate-500 text-sm mb-6">Lengkapi formulir di bawah ini untuk menjadi bagian dari komunitas kami.</p>
            </div>

            <!-- Bagian Form (Yang bisa di-scroll) -->
            <div class="flex-1 overflow-y-auto px-8 md:px-12 custom-scrollbar">
                <form method="POST" action="{{ route('register') }}" class="space-y-8 pb-8">
                    @csrf
                    
                    <!-- Section: Informasi Pribadi -->
                    <section>
                        <h3 class="text-[10px] font-bold text-blue-600 uppercase tracking-[0.2em] mb-4 border-b pb-2">Informasi Pribadi</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-xs font-semibold text-slate-700 mb-1.5 ml-1">Nama Lengkap</label>
                                <input type="text" name="name" placeholder="Contoh: Budi Santoso" class="w-full px-4 py-3 bg-slate-50 border border-slate-100 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500/20 text-sm @error('name') border-red-500 @enderror" value="{{ old('name') }}" required>
                                @error('name') <p class="text-red-500 text-[10px] mt-1">{{ $message }}</p> @enderror
                            </div>
                            <div>
                                <label class="block text-xs font-semibold text-slate-700 mb-1.5 ml-1">Email Aktif</label>
                                <input type="email" name="email" placeholder="nama@email.com" class="w-full px-4 py-3 bg-slate-50 border border-slate-100 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500/20 text-sm @error('email') border-red-500 @enderror" value="{{ old('email') }}" required>
                                @error('email') <p class="text-red-500 text-[10px] mt-1">{{ $message }}</p> @enderror
                            </div>
                            <div>
                                <label class="block text-xs font-semibold text-slate-700 mb-1.5 ml-1">No HP (WhatsApp)</label>
                                <input type="text" name="phone" placeholder="0812xxxx" class="w-full px-4 py-3 bg-slate-50 border border-slate-100 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500/20 text-sm @error('phone') border-red-500 @enderror" value="{{ old('phone') }}">
                                @error('phone') <p class="text-red-500 text-[10px] mt-1">{{ $message }}</p> @enderror
                            </div>
                            <div>
                                <label class="block text-xs font-semibold text-slate-700 mb-1.5 ml-1">Pekerjaan</label>
                                <input type="text" name="profession" placeholder="Guru, Wirausaha, dll" class="w-full px-4 py-3 bg-slate-50 border border-slate-100 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500/20 text-sm @error('profession') border-red-500 @enderror" value="{{ old('profession') }}">
                            </div>
                        </div>
                    </section>

                    <!-- Section: Domisili -->
                    <section>
                        <h3 class="text-[10px] font-bold text-blue-600 uppercase tracking-[0.2em] mb-4 border-b pb-2">Domisili</h3>
                        <div class="space-y-4">
                            <div>
                                <label class="block text-xs font-semibold text-slate-700 mb-1.5 ml-1">Alamat Lengkap</label>
                                <textarea name="address" rows="2" placeholder="Nama jalan, nomor rumah, RT/RW" class="w-full px-4 py-3 bg-slate-50 border border-slate-100 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500/20 text-sm resize-none @error('address') border-red-500 @enderror">{{ old('address') }}</textarea>
                                @error('address') <p class="text-red-500 text-[10px] mt-1">{{ $message }}</p> @enderror
                            </div>
                            <div>
                                <label class="block text-xs font-semibold text-slate-700 mb-1.5 ml-1">Kabupaten / Kota</label>
                                <input type="text" name="city" placeholder="Masukkan nama kota" class="w-full px-4 py-3 bg-slate-50 border border-slate-100 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500/20 text-sm @error('city') border-red-500 @enderror" value="{{ old('city') }}">
                                @error('city') <p class="text-red-500 text-[10px] mt-1">{{ $message }}</p> @enderror
                            </div>
                        </div>
                    </section>

                    <!-- Question Box -->
                    <div class="bg-yellow-50 border border-yellow-100 p-5 rounded-2xl">
                        <p class="text-sm font-bold text-[#0f407a] mb-4">Apa Anda orangtua dari ADS (Anak dengan Down Syndrome)?</p>
                        <div class="flex gap-6">
                            <label class="flex items-center gap-2 cursor-pointer text-sm">
                                <input type="radio" name="is_parent" value="1" class="w-4 h-4 text-blue-600 focus:ring-blue-500">
                                Ya, Benar
                            </label>
                            <label class="flex items-center gap-2 cursor-pointer text-sm">
                                <input type="radio" name="is_parent" value="0" class="w-4 h-4 text-blue-600 focus:ring-blue-500">
                                Bukan / Pendamping
                            </label>
                        </div>
                        @error('is_parent') <p class="text-red-500 text-[10px] mt-1">{{ $message }}</p> @enderror
                    </div>

                    <!-- Section: Keamanan -->
                    <section>
                        <h3 class="text-[10px] font-bold text-blue-600 uppercase tracking-[0.2em] mb-4 border-b pb-2">Keamanan Akun</h3>
                        <div class="space-y-4">
                            <div>
                                <label class="block text-xs font-semibold text-slate-700 mb-1.5 ml-1">Username</label>
                                <input type="text" name="username" placeholder="Pilih nama pengguna unik" class="w-full px-4 py-3 bg-slate-50 border border-slate-100 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500/20 text-sm @error('username') border-red-500 @enderror" value="{{ old('username') }}" required>
                                @error('username') <p class="text-red-500 text-[10px] mt-1">{{ $message }}</p> @enderror
                            </div>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-xs font-semibold text-slate-700 mb-1.5 ml-1">Kata Sandi</label>
                                    <input type="password" name="password" placeholder="Min. 8 karakter" class="w-full px-4 py-3 bg-slate-50 border border-slate-100 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500/20 text-sm @error('password') border-red-500 @enderror" required>
                                    @error('password') <p class="text-red-500 text-[10px] mt-1">{{ $message }}</p> @enderror
                                </div>
                                <div>
                                    <label class="block text-xs font-semibold text-slate-700 mb-1.5 ml-1">Konfirmasi Kata Sandi</label>
                                    <input type="password" name="password_confirmation" placeholder="Ulangi kata sandi" class="w-full px-4 py-3 bg-slate-50 border border-slate-100 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500/20 text-sm" required>
                                </div>
                            </div>
                        </div>
                    </section>

                    <button type="submit" class="w-full bg-[#facc15] text-slate-900 py-4 rounded-full font-bold flex items-center justify-center gap-2 hover:bg-[#eab308] transition-colors shadow-lg shadow-yellow-500/20">
                        Daftar Sekarang 
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>
                    </button>

                    <p class="text-center text-sm text-slate-500 pb-4">
                        Sudah memiliki akun? <a href="{{ route('login') }}" class="text-blue-600 font-bold hover:underline">Masuk di sini</a>
                    </p>
                </form>
            </div>

            <!-- Footer Links (Statis/Tidak ikut scroll) -->
            <div class="p-8 pt-4 flex flex-wrap justify-center gap-6 text-[10px] font-bold text-slate-400 uppercase tracking-widest border-t border-slate-100">
                <a href="#" class="hover:text-blue-600">Bantuan</a>
                <a href="#" class="hover:text-blue-600">Privasi</a>
                <a href="#" class="hover:text-blue-600">Syarat & Ketentuan</a>
                <span class="md:ml-auto">© 2026 POTADS</span>
            </div>
        </div>
    </div>
</body>
</html>