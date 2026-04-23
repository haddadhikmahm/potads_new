@extends('layouts.admin')

@section('title', 'Profil Saya')

@section('content')
<div class="max-w-4xl mx-auto">
    <!-- Profile Header -->
    <div class="flex flex-col md:flex-row items-center gap-8 mb-12">
        <div class="relative">
            <div class="w-32 h-32 md:w-40 md:h-40 rounded-full bg-potads-yellow flex items-center justify-center overflow-hidden border-4 border-white shadow-xl">
                @if($user->avatar)
                    <img src="{{ asset('storage/' . $user->avatar) }}" class="w-full h-full object-cover" id="avatar-preview">
                @else
                    <div class="w-full h-full flex items-center justify-center text-potads-blue text-4xl font-bold" id="avatar-placeholder">
                        {{ substr($user->name, 0, 2) }}
                    </div>
                    <img src="" class="w-full h-full object-cover hidden" id="avatar-preview">
                @endif
            </div>
            <button type="button" onclick="document.getElementById('avatar-input').click()" class="absolute bottom-2 right-2 w-10 h-10 bg-potads-blue text-white rounded-full flex items-center justify-center shadow-lg hover:scale-110 transition-transform border-2 border-white">
                <i data-lucide="edit-3" class="w-5 h-5"></i>
            </button>
        </div>

        <div class="text-center md:text-left">
            <h1 class="text-4xl font-extrabold text-[#0f407a] mb-2">{{ $user->name }}</h1>
            <p class="text-lg text-slate-500 font-medium">{{ $user->profession ?? 'Admin POTADS' }}</p>
        </div>
    </div>

    <!-- Edit Profile Card -->
    <div class="bg-white rounded-[2.5rem] shadow-sm border border-slate-100 p-8 md:p-12 mb-8">
        <div class="flex items-center gap-3 mb-10 text-potads-blue">
            <i data-lucide="settings" class="w-6 h-6"></i>
            <h2 class="text-xl font-bold">Pengaturan Akun</h2>
        </div>

        <form action="{{ route('admin.profile.update') }}" method="POST" enctype="multipart/form-data" class="space-y-8">
            @csrf
            @method('PUT')

            <input type="file" name="avatar" id="avatar-input" class="hidden" accept="image/*" onchange="previewAvatar(this)">

            <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-6">
                <!-- Name -->
                <div class="space-y-2">
                    <label class="text-[10px] font-bold text-potads-blue uppercase tracking-wider ml-1">Nama Tampilan</label>
                    <input type="text" name="name" value="{{ old('name', $user->name) }}" required
                        class="w-full px-6 py-4 bg-slate-50 border-none rounded-2xl focus:ring-2 focus:ring-potads-blue/10 transition-all text-slate-700 font-medium @error('name') ring-2 ring-red-500/20 @enderror">
                    @error('name') <p class="text-red-500 text-xs mt-1 ml-1">{{ $message }}</p> @enderror
                </div>

                <!-- Email -->
                <div class="space-y-2">
                    <label class="text-[10px] font-bold text-potads-blue uppercase tracking-wider ml-1">Alamat Email</label>
                    <input type="email" name="email" value="{{ old('email', $user->email) }}" required
                        class="w-full px-6 py-4 bg-slate-50 border-none rounded-2xl focus:ring-2 focus:ring-potads-blue/10 transition-all text-slate-700 font-medium @error('email') ring-2 ring-red-500/20 @enderror">
                    @error('email') <p class="text-red-500 text-xs mt-1 ml-1">{{ $message }}</p> @enderror
                </div>

                <!-- Profession -->
                <div class="md:col-span-2 space-y-2">
                    <label class="text-[10px] font-bold text-potads-blue uppercase tracking-wider ml-1">Profesi / Jabatan</label>
                    <input type="text" name="profession" value="{{ old('profession', $user->profession) }}"
                        class="w-full px-6 py-4 bg-slate-50 border-none rounded-2xl focus:ring-2 focus:ring-potads-blue/10 transition-all text-slate-700 font-medium @error('profession') ring-2 ring-red-500/20 @enderror">
                    @error('profession') <p class="text-red-500 text-xs mt-1 ml-1">{{ $message }}</p> @enderror
                </div>
            </div>

            <div class="pt-4 border-t border-slate-50">
                <p class="text-[10px] font-bold text-slate-400 uppercase tracking-[0.2em] mb-6">Keamanan Akun</p>
                
                <div class="space-y-6">
                    <!-- Username -->
                    <div class="space-y-2">
                        <label class="text-[10px] font-bold text-potads-blue uppercase tracking-wider ml-1">Username</label>
                        <input type="text" name="username" value="{{ old('username', $user->username) }}" required
                            class="w-full px-6 py-4 bg-slate-50 border-none rounded-2xl focus:ring-2 focus:ring-potads-blue/10 transition-all text-slate-700 font-medium @error('username') ring-2 ring-red-500/20 @enderror">
                        @error('username') <p class="text-red-500 text-xs mt-1 ml-1">{{ $message }}</p> @enderror
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-6">
                        <!-- Current Password -->
                        <div class="space-y-2">
                            <label class="text-[10px] font-bold text-potads-blue uppercase tracking-wider ml-1">Kata Sandi Saat Ini</label>
                            <input type="password" name="current_password" placeholder="••••••••"
                                class="w-full px-6 py-4 bg-slate-50 border-none rounded-2xl focus:ring-2 focus:ring-potads-blue/10 transition-all text-slate-700 font-medium @error('current_password') ring-2 ring-red-500/20 @enderror">
                            @error('current_password') <p class="text-red-500 text-xs mt-1 ml-1">{{ $message }}</p> @enderror
                        </div>

                        <!-- New Password -->
                        <div class="space-y-2">
                            <label class="text-[10px] font-bold text-potads-blue uppercase tracking-wider ml-1">Kata Sandi Baru</label>
                            <input type="password" name="password" placeholder="••••••••"
                                class="w-full px-6 py-4 bg-slate-50 border-none rounded-2xl focus:ring-2 focus:ring-potads-blue/10 transition-all text-slate-700 font-medium @error('password') ring-2 ring-red-500/20 @enderror">
                            @error('password') <p class="text-red-500 text-xs mt-1 ml-1">{{ $message }}</p> @enderror
                        </div>

                        <!-- Confirm Password -->
                        <div class="md:col-span-2 space-y-2">
                            <label class="text-[10px] font-bold text-potads-blue uppercase tracking-wider ml-1">Konfirmasi Kata Sandi Baru</label>
                            <input type="password" name="password_confirmation" placeholder="••••••••"
                                class="w-full px-6 py-4 bg-slate-50 border-none rounded-2xl focus:ring-2 focus:ring-potads-blue/10 transition-all text-slate-700 font-medium">
                        </div>
                    </div>
                </div>
            </div>

            <div class="flex flex-col sm:flex-row items-center gap-4 pt-6">
                <button type="submit" class="w-full sm:w-auto px-10 py-4 bg-potads-blue text-white rounded-2xl font-bold shadow-lg shadow-blue-900/20 hover:scale-[1.02] active:scale-[0.98] transition-all">
                    Edit Profile
                </button>
                
                <button type="button" onclick="document.getElementById('logout-form').submit()" class="w-full sm:w-auto px-10 py-4 bg-white border-2 border-potads-blue text-potads-blue rounded-2xl font-bold hover:bg-slate-50 transition-all flex items-center justify-center gap-2">
                    Keluar 
                    <i data-lucide="log-out" class="w-5 h-5"></i>
                </button>
            </div>
        </form>
    </div>
</div>

<form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
    @csrf
</form>

@endsection

@push('scripts')
<script>
    function previewAvatar(input) {
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                const preview = document.getElementById('avatar-preview');
                const placeholder = document.getElementById('avatar-placeholder');
                
                preview.src = e.target.result;
                preview.classList.remove('hidden');
                if (placeholder) placeholder.classList.add('hidden');
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
@endpush
