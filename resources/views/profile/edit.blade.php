@extends('layouts.frontend')

@section('title', 'Pengaturan Akun - PIK POTADS')

@section('content')
<div class="bg-[#F8F9FB] min-h-screen py-16 px-6 md:px-12 lg:px-16 pt-24 md:pt-32">
    <div class="max-w-4xl mx-auto">
        
        <div class="mb-12" data-aos="fade-down">
            <h1 class="text-4xl font-black text-potads-blue mb-2">Pengaturan Akun</h1>
            <p class="text-gray-500">Kelola informasi profil dan keamanan akun Anda.</p>
        </div>

        <div class="space-y-12">
            <!-- Profile Information Card -->
            <div class="bg-white rounded-[3rem] shadow-xl border-4 border-white p-8 md:p-12 relative overflow-hidden" data-aos="fade-up">
                <div class="absolute -right-16 -top-16 w-64 h-64 bg-potads-blue opacity-5 rounded-full"></div>
                
                <h2 class="text-2xl font-black text-potads-blue mb-8 relative z-10 flex items-center gap-3">
                    <i data-lucide="user" class="w-8 h-8 text-potads-yellow"></i>
                    Informasi Profil
                </h2>

                <form method="post" action="{{ route('profile.update') }}" enctype="multipart/form-data" class="space-y-8 relative z-10">
                    @csrf
                    @method('patch')

                    <!-- Avatar Upload -->
                    <div class="flex flex-col md:flex-row items-center gap-8 pb-8 border-b border-gray-50">
                        <div class="relative group">
                            <div class="w-32 h-32 bg-slate-100 rounded-[2.5rem] flex items-center justify-center overflow-hidden border-4 border-white shadow-lg shadow-blue-100">
                                @if($user->avatar)
                                    <img id="avatar-preview" src="{{ asset('storage/' . $user->avatar) }}" class="w-full h-full object-cover">
                                @else
                                    <div id="avatar-placeholder" class="text-slate-300">
                                        <i data-lucide="user" class="w-16 h-16"></i>
                                    </div>
                                    <img id="avatar-preview" class="w-full h-full object-cover hidden">
                                @endif
                            </div>
                            <label for="avatar" class="absolute -bottom-2 -right-2 w-10 h-10 bg-potads-yellow text-potads-blue rounded-full flex items-center justify-center shadow-lg cursor-pointer hover:scale-110 transition-transform">
                                <i data-lucide="camera" class="w-5 h-5"></i>
                                <input type="file" id="avatar" name="avatar" class="hidden" accept="image/*" onchange="previewImage(event)">
                            </label>
                        </div>
                        <div class="flex-1 text-center md:text-left">
                            <h4 class="font-black text-potads-blue mb-1">Foto Profil</h4>
                            <p class="text-xs text-gray-400">Gunakan foto formal atau santai yang sopan. Maks 1MB.</p>
                            @error('avatar') <p class="text-red-500 text-[10px] mt-1 font-bold">{{ $message }}</p> @enderror
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <!-- Name -->
                        <div class="space-y-2">
                            <label class="text-[10px] font-black text-gray-400 uppercase tracking-widest ml-2">Nama Lengkap</label>
                            <input type="text" name="name" value="{{ old('name', $user->name) }}" required
                                class="w-full px-6 py-4 bg-[#F8F9FB] border-2 border-transparent focus:border-potads-blue/10 rounded-2xl focus:ring-0 transition-all text-slate-700 font-bold @error('name') border-red-500/20 @enderror">
                            @error('name') <p class="text-red-500 text-[10px] mt-1 font-bold">{{ $message }}</p> @enderror
                        </div>

                        <!-- Email -->
                        <div class="space-y-2">
                            <label class="text-[10px] font-black text-gray-400 uppercase tracking-widest ml-2">Alamat Email</label>
                            <input type="email" name="email" value="{{ old('email', $user->email) }}" required
                                class="w-full px-6 py-4 bg-[#F8F9FB] border-2 border-transparent focus:border-potads-blue/10 rounded-2xl focus:ring-0 transition-all text-slate-700 font-bold @error('email') border-red-500/20 @enderror">
                            @error('email') <p class="text-red-500 text-[10px] mt-1 font-bold">{{ $message }}</p> @enderror
                        </div>

                        <!-- Phone -->
                        <div class="space-y-2">
                            <label class="text-[10px] font-black text-gray-400 uppercase tracking-widest ml-2">Nomor Telepon</label>
                            <input type="text" name="phone" value="{{ old('phone', $user->phone) }}"
                                class="w-full px-6 py-4 bg-[#F8F9FB] border-2 border-transparent focus:border-potads-blue/10 rounded-2xl focus:ring-0 transition-all text-slate-700 font-bold">
                        </div>

                        <!-- Address -->
                        <div class="space-y-2">
                            <label class="text-[10px] font-black text-gray-400 uppercase tracking-widest ml-2">Alamat Domisili</label>
                            <input type="text" name="address" value="{{ old('address', $user->address) }}"
                                class="w-full px-6 py-4 bg-[#F8F9FB] border-2 border-transparent focus:border-potads-blue/10 rounded-2xl focus:ring-0 transition-all text-slate-700 font-bold">
                        </div>
                    </div>

                    <div class="flex items-center gap-4 pt-6">
                        <button type="submit" class="px-10 py-4 bg-potads-blue text-white font-black rounded-2xl shadow-lg shadow-blue-200 hover:scale-105 active:scale-95 transition-all text-sm">
                            Simpan Perubahan
                        </button>
                        @if (session('status') === 'profile-updated')
                            <p class="text-emerald-500 text-sm font-bold flex items-center gap-2 animate-bounce">
                                <i data-lucide="check-circle" class="w-4 h-4"></i> Berhasil disimpan!
                            </p>
                        @endif
                    </div>
                </form>
            </div>

            <!-- Password Update Card -->
            <div class="bg-white rounded-[3rem] shadow-xl border-4 border-white p-8 md:p-12 relative overflow-hidden" data-aos="fade-up">
                <div class="absolute -right-16 -top-16 w-64 h-64 bg-potads-yellow opacity-5 rounded-full"></div>
                
                <h2 class="text-2xl font-black text-potads-blue mb-8 relative z-10 flex items-center gap-3">
                    <i data-lucide="lock" class="w-8 h-8 text-potads-yellow"></i>
                    Keamanan Password
                </h2>

                <form method="post" action="{{ route('password.update') }}" class="space-y-8 relative z-10">
                    @csrf
                    @method('put')

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <!-- Current Password -->
                        <div class="space-y-2 md:col-span-2">
                            <label class="text-[10px] font-black text-gray-400 uppercase tracking-widest ml-2">Password Saat Ini</label>
                            <input type="password" name="current_password" required
                                class="w-full px-6 py-4 bg-[#F8F9FB] border-2 border-transparent focus:border-potads-blue/10 rounded-2xl focus:ring-0 transition-all text-slate-700 font-bold">
                            @error('current_password', 'updatePassword') <p class="text-red-500 text-[10px] mt-1 font-bold">{{ $message }}</p> @enderror
                        </div>

                        <!-- New Password -->
                        <div class="space-y-2">
                            <label class="text-[10px] font-black text-gray-400 uppercase tracking-widest ml-2">Password Baru</label>
                            <input type="password" name="password" required
                                class="w-full px-6 py-4 bg-[#F8F9FB] border-2 border-transparent focus:border-potads-blue/10 rounded-2xl focus:ring-0 transition-all text-slate-700 font-bold">
                            @error('password', 'updatePassword') <p class="text-red-500 text-[10px] mt-1 font-bold">{{ $message }}</p> @enderror
                        </div>

                        <!-- Confirm Password -->
                        <div class="space-y-2">
                            <label class="text-[10px] font-black text-gray-400 uppercase tracking-widest ml-2">Konfirmasi Password</label>
                            <input type="password" name="password_confirmation" required
                                class="w-full px-6 py-4 bg-[#F8F9FB] border-2 border-transparent focus:border-potads-blue/10 rounded-2xl focus:ring-0 transition-all text-slate-700 font-bold">
                            @error('password_confirmation', 'updatePassword') <p class="text-red-500 text-[10px] mt-1 font-bold">{{ $message }}</p> @enderror
                        </div>
                    </div>

                    <div class="flex items-center gap-4 pt-6">
                        <button type="submit" class="px-10 py-4 bg-potads-blue text-white font-black rounded-2xl shadow-lg shadow-blue-200 hover:scale-105 active:scale-95 transition-all text-sm">
                            Ganti Password
                        </button>
                        @if (session('status') === 'password-updated')
                            <p class="text-emerald-500 text-sm font-bold flex items-center gap-2 animate-bounce">
                                <i data-lucide="check-circle" class="w-4 h-4"></i> Password diperbarui!
                            </p>
                        @endif
                    </div>
                </form>
            </div>

        <div class="mt-12 flex justify-center">
            <a href="{{ route('profile') }}" class="text-gray-400 font-bold hover:text-potads-blue transition-colors flex items-center gap-2">
                <i data-lucide="arrow-left" class="w-4 h-4"></i> Kembali ke Dashboard
            </a>
        </div>
    </div>
</div>

<script>
    function previewImage(event) {
        const reader = new FileReader();
        reader.onload = function(){
            const output = document.getElementById('avatar-preview');
            const placeholder = document.getElementById('avatar-placeholder');
            output.src = reader.result;
            output.classList.remove('hidden');
            if(placeholder) placeholder.classList.add('hidden');
        };
        reader.readAsDataURL(event.target.files[0]);
    }
</script>
@endsection
