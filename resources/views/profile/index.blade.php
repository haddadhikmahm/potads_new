@extends('layouts.frontend')

@section('title', 'Profil Member - PIK POTADS')

@section('content')
<div class="bg-[#F8F9FB] min-h-screen py-16 px-6 md:px-12 lg:px-16 pt-24 md:pt-32">
    <div class="max-w-6xl mx-auto">
        
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">
            <!-- Sidebar Info -->
            <div class="lg:col-span-1 space-y-8">
                <div class="bg-white rounded-[2.5rem] shadow-xl border-4 border-white p-8 text-center" data-aos="fade-up">
                    <div class="w-32 h-32 bg-potads-blue rounded-[2.5rem] flex items-center justify-center mx-auto mb-6 shadow-lg shadow-blue-100 overflow-hidden">
                        @if(auth()->user()->avatar)
                            <img src="{{ asset('storage/' . auth()->user()->avatar) }}" class="w-full h-full object-cover">
                        @else
                            <i data-lucide="user" class="w-16 h-16 text-white"></i>
                        @endif
                    </div>
                    <h2 class="text-2xl font-black text-potads-blue mb-2">{{ auth()->user()->name }}</h2>
                    <p class="text-gray-400 font-bold text-sm uppercase tracking-widest mb-6">MEMBER POTADS</p>
                    
                    <div class="pt-6 border-t border-gray-50 flex flex-col gap-3">
                        <a href="{{ route('profile.edit') }}" class="w-full py-4 bg-slate-50 text-slate-600 font-black rounded-2xl text-sm hover:bg-slate-100 transition-all flex items-center justify-center gap-2">
                            <i data-lucide="settings" class="w-4 h-4"></i> Pengaturan Akun
                        </a>
                    </div>
                </div>

                <!-- Stats/Badges -->
                <div class="bg-white rounded-[2.5rem] shadow-xl border-4 border-white p-8" data-aos="fade-up" data-aos-delay="100">
                    <h3 class="text-lg font-black text-potads-blue mb-6 flex items-center gap-2">
                        <i data-lucide="award" class="w-5 h-5 text-potads-yellow"></i> Pencapaian
                    </h3>
                    <div class="space-y-4">
                        <div class="flex items-center gap-4 bg-emerald-50 p-4 rounded-2xl border border-emerald-100">
                            <div class="w-10 h-10 bg-emerald-500 rounded-full flex items-center justify-center text-white">
                                <i data-lucide="book-open" class="w-5 h-5"></i>
                            </div>
                            <div>
                                <p class="text-xs font-black text-emerald-600 uppercase">MATERI SELESAI</p>
                                <p class="text-lg font-black text-potads-blue">{{ auth()->user()->completedMaterials->count() }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Main Content -->
            <div class="lg:col-span-2 space-y-12">
                <!-- Data Anak Section -->
                <div class="bg-white rounded-[3rem] shadow-xl border-4 border-white p-8 md:p-12 relative overflow-hidden" data-aos="fade-up">
                    <!-- Decorative background -->
                    <div class="absolute -right-16 -top-16 w-64 h-64 bg-potads-yellow opacity-5 rounded-full"></div>
                    
                    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-6 mb-12 relative z-10">
                        <div>
                            <h2 class="text-3xl font-black text-potads-blue mb-2">Data Anak</h2>
                            <p class="text-gray-500">Informasi putra/putri Anda yang terdaftar.</p>
                        </div>
                        <a href="{{ route('children.create') }}" class="bg-potads-yellow text-potads-blue font-black px-8 py-4 rounded-2xl text-sm hover:bg-yellow-400 transition-all btn-playful flex items-center gap-2">
                            <i data-lucide="plus" class="w-5 h-5"></i> Tambah Data Anak
                        </a>
                    </div>

                    @if(auth()->user()->children->count() > 0)
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 relative z-10">
                            @foreach(auth()->user()->children as $child)
                                <div class="bg-[#F8F9FB] rounded-[2rem] p-6 border-2 border-transparent hover:border-potads-blue/10 transition-all group">
                                    <div class="flex gap-4 items-center">
                                        <div class="w-20 h-20 rounded-2xl overflow-hidden bg-white shadow-sm border-2 border-white">
                                            @if($child->photo)
                                                <img src="{{ asset('storage/' . $child->photo) }}" class="w-full h-full object-cover">
                                            @else
                                                <div class="w-full h-full flex items-center justify-center bg-blue-50 text-blue-200">
                                                    <i data-lucide="baby" class="w-10 h-10"></i>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="flex-grow">
                                            <h4 class="text-lg font-black text-potads-blue">{{ $child->name }}</h4>
                                            <p class="text-xs text-gray-400 font-bold">{{ \Carbon\Carbon::parse($child->birth_date)->age }} Tahun • {{ $child->gender == 'L' ? 'Laki-laki' : 'Perempuan' }}</p>
                                        </div>
                                        <div class="flex flex-col gap-2 opacity-0 group-hover:opacity-100 transition-opacity">
                                            <a href="{{ route('children.edit', $child) }}" class="p-2 bg-white rounded-lg text-blue-500 hover:bg-blue-50 transition-colors shadow-sm">
                                                <i data-lucide="edit-2" class="w-4 h-4"></i>
                                            </a>
                                            <form action="{{ route('children.destroy', $child) }}" method="POST" onsubmit="return confirm('Hapus data anak ini?')">
                                                @csrf @method('DELETE')
                                                <button type="submit" class="p-2 bg-white rounded-lg text-red-500 hover:bg-red-50 transition-colors shadow-sm w-full">
                                                    <i data-lucide="trash-2" class="w-4 h-4"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                    <div class="mt-4 pt-4 border-t border-gray-100 flex items-center gap-2 text-[10px] font-bold text-gray-400 uppercase tracking-widest">
                                        <i data-lucide="graduation-cap" class="w-3.5 h-3.5"></i> {{ $child->school ?? 'Belum ada data sekolah' }}
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <!-- Empty State -->
                        <div class="text-center py-20 bg-[#F8F9FB] rounded-[2.5rem] border-4 border-dashed border-gray-100">
                            <div class="w-20 h-20 bg-white rounded-full flex items-center justify-center mx-auto mb-6 shadow-sm">
                                <i data-lucide="heart" class="w-10 h-10 text-gray-200"></i>
                            </div>
                            <p class="text-gray-400 font-bold">Belum ada data anak yang ditambahkan.</p>
                            <p class="text-xs text-gray-400 mt-2">Klik tombol "Tambah Data Anak" untuk mulai mendata.</p>
                        </div>
                    @endif
                </div>

                <!-- Account Information -->
                <div class="bg-white rounded-[3rem] shadow-xl border-4 border-white p-8 md:p-12" data-aos="fade-up" data-aos-delay="200">
                    <h3 class="text-2xl font-black text-potads-blue mb-8">Informasi Akun</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <div class="space-y-1">
                            <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest">EMAIL</p>
                            <p class="font-bold text-slate-700">{{ auth()->user()->email }}</p>
                        </div>
                        <div class="space-y-1">
                            <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest">NOMOR TELEPON</p>
                            <p class="font-bold text-slate-700">{{ auth()->user()->phone ?? '-' }}</p>
                        </div>
                        <div class="space-y-1 md:col-span-2">
                            <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest">ALAMAT</p>
                            <p class="font-bold text-slate-700">{{ auth()->user()->address ?? '-' }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
