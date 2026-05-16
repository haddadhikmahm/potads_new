@extends('layouts.frontend')

@section('title', $event->title . ' - PIK POTADS')

@section('content')
    <main class="max-w-7xl mx-auto px-6 md:px-12 py-12">
        <!-- Breadcrumb -->
        <nav class="flex text-sm text-gray-400 mb-8" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1">
                <li><a href="{{ route('events.index') }}" class="hover:text-potads-blue transition">Event</a></li>
                <li class="flex items-center">
                    <i data-lucide="chevron-right" class="w-4 h-4 mx-1"></i>
                    <span class="text-gray-600 line-clamp-1">{{ $event->title }}</span>
                </li>
            </ol>
        </nav>

        <div class="flex flex-col lg:flex-row gap-16">
            <!-- Left: Hero Image & Description -->
            <div class="lg:w-7/12">
                <div class="rounded-[3rem] overflow-hidden shadow-2xl mb-12">
                    <img src="{{ Str::startsWith($event->image, 'http') ? $event->image : asset('storage/' . $event->image) }}" alt="{{ $event->title }}" class="w-full h-auto object-cover aspect-[16/10]">
                </div>

                <div class="prose prose-lg max-w-none text-gray-600 leading-relaxed">
                    <h2 class="text-3xl font-bold text-potads-blue mb-6">Tentang Event</h2>
                    {!! nl2br(e($event->description)) !!}
                </div>
            </div>

            <!-- Right: Event Details Card -->
            <div class="lg:w-5/12">
                <div class="bg-white rounded-[3rem] p-10 shadow-xl border border-gray-100 sticky top-24">
                    <h1 class="text-3xl font-extrabold text-potads-blue mb-8 leading-tight">{{ $event->title }}</h1>
                    
                    <div class="space-y-8 mb-10">
                        <div class="flex items-start gap-4">
                            <div class="bg-blue-50 p-3 rounded-2xl">
                                <i data-lucide="calendar" class="w-6 h-6 text-potads-blue"></i>
                            </div>
                            <div>
                                <p class="text-xs font-bold text-gray-400 uppercase tracking-widest">Tanggal</p>
                                <p class="text-lg font-bold text-gray-800">{{ \Carbon\Carbon::parse($event->event_date)->format('d F Y') }}</p>
                            </div>
                        </div>

                        <div class="flex items-start gap-4">
                            <div class="bg-yellow-50 p-3 rounded-2xl">
                                <i data-lucide="map-pin" class="w-6 h-6 text-yellow-600"></i>
                            </div>
                            <div>
                                <p class="text-xs font-bold text-gray-400 uppercase tracking-widest">Lokasi</p>
                                <p class="text-lg font-bold text-gray-800">{{ $event->location }}</p>
                            </div>
                        </div>

                        <div class="flex items-start gap-4">
                            <div class="bg-blue-50 p-3 rounded-2xl">
                                <i data-lucide="info" class="w-6 h-6 text-potads-blue"></i>
                            </div>
                            <div>
                                <p class="text-xs font-bold text-gray-400 uppercase tracking-widest">Status</p>
                                <p class="text-lg font-bold text-potads-blue">{{ \Carbon\Carbon::parse($event->event_date)->isPast() ? 'Selesai' : 'Mendatang' }}</p>
                            </div>
                        </div>

                        <div class="flex items-start gap-4">
                            <div class="bg-green-50 p-3 rounded-2xl">
                                <i data-lucide="users" class="w-6 h-6 text-green-600"></i>
                            </div>
                            <div>
                                <p class="text-xs font-bold text-gray-400 uppercase tracking-widest">Total Pendaftar</p>
                                <p class="text-lg font-bold text-gray-800">{{ $event->attendees()->count() }} Orang</p>
                            </div>
                        </div>
                    </div>

                    @if(!\Carbon\Carbon::parse($event->event_date)->isPast())
                        <div class="p-8 bg-blue-50/30 rounded-[2.5rem] border-4 border-white shadow-xl mb-8">
                            <div class="flex items-center gap-3 mb-6">
                                <div class="w-10 h-10 bg-potads-blue rounded-xl flex items-center justify-center text-white shadow-lg shadow-blue-500/20">
                                    <i data-lucide="edit-3" class="w-5 h-5"></i>
                                </div>
                                <div>
                                    <h3 class="text-xl font-black text-potads-blue leading-none">Pendaftaran</h3>
                                    <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mt-1">Registrasi Peserta</p>
                                </div>
                            </div>

                            @if($event->registration_link)
                                <div class="bg-blue-50/50 rounded-[2.5rem] p-10 border-2 border-dashed border-blue-200 flex flex-col items-center text-center">
                                    <div class="w-20 h-20 bg-white rounded-3xl flex items-center justify-center text-potads-blue shadow-xl mb-6">
                                        <i data-lucide="external-link" class="w-10 h-10"></i>
                                    </div>
                                    <h4 class="text-xl font-black text-potads-blue mb-3">Formulir Eksternal</h4>
                                    <p class="text-slate-500 text-sm leading-relaxed mb-8 max-w-sm">
                                        Pendaftaran kegiatan ini dilakukan melalui formulir eksternal. Silakan klik tombol di bawah untuk mendaftar.
                                    </p>
                                    <a href="{{ $event->registration_link }}" target="_blank" class="w-full bg-potads-blue text-white font-black py-5 rounded-[2rem] shadow-xl hover:bg-blue-800 transition-all transform hover:-translate-y-1 flex items-center justify-center gap-3 group">
                                        <span>Daftar Sekarang</span>
                                        <i data-lucide="arrow-up-right" class="w-5 h-5 group-hover:translate-x-1 group-hover:-translate-y-1 transition-transform"></i>
                                    </a>
                                </div>
                            @else
                                @auth
                                    @php
                                        $children = auth()->user()->children;
                                        $registeredChildIds = auth()->user()->events()
                                            ->where('event_id', $event->id)
                                            ->pluck('child_id')
                                            ->filter()
                                            ->map(fn($id) => (string)$id)
                                            ->toArray();
                                        $isUserRegistered = auth()->user()->events()
                                            ->where('event_id', $event->id)
                                            ->whereNull('child_id')
                                            ->exists();
                                    @endphp

                                    <form action="{{ route('events.register', $event) }}" method="POST" class="space-y-4"
                                          x-data="{ 
                                              self: {{ $isUserRegistered ? 'true' : 'false' }},
                                              kids: {{ json_encode(array_fill_keys($registeredChildIds, true)) }},
                                              toggleKid(id) {
                                                  if (this.kids[id]) {
                                                      delete this.kids[id];
                                                  } else {
                                                      this.kids[id] = true;
                                                  }
                                                  this.kids = { ...this.kids }; // Force reactivity
                                              }
                                          }">
                                        @csrf
                                        <div class="space-y-3">
                                            <!-- Self Registration Option -->
                                            <label class="relative flex items-center p-5 bg-white rounded-3xl border-2 cursor-pointer transition-all duration-300 group"
                                                   :class="self ? 'border-potads-blue bg-blue-50/50 shadow-md scale-[1.02]' : 'border-transparent hover:border-blue-100 hover:shadow-sm'">
                                                <input type="checkbox" name="register_self" value="1" 
                                                       x-model="self"
                                                       class="sr-only">
                                                <div class="w-12 h-12 rounded-2xl flex items-center justify-center transition-all"
                                                     :class="self ? 'bg-potads-blue text-white scale-110 shadow-lg' : 'bg-blue-100 text-potads-blue'">
                                                    <i data-lucide="user" class="w-6 h-6"></i>
                                                </div>
                                                <div class="ml-4 flex-1">
                                                    <span class="block font-black text-sm" :class="self ? 'text-potads-blue' : 'text-slate-600'">Daftarkan Saya</span>
                                                    <span class="block text-[10px] text-slate-400 font-bold uppercase tracking-wider">Sebagai Orang Tua / Pendamping</span>
                                                </div>
                                                <div class="w-6 h-6 rounded-full border-2 flex items-center justify-center transition-all"
                                                     :class="self ? 'bg-potads-blue border-potads-blue' : 'border-slate-200'">
                                                    <i data-lucide="check" class="w-3.5 h-3.5 text-white transition-opacity" :class="self ? 'opacity-100' : 'opacity-0'"></i>
                                                </div>
                                            </label>

                                            @if($children->count() > 0)
                                                <div class="pt-4 pb-2">
                                                    <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-1">Pilih Anak yang Ikut</p>
                                                </div>
                                                @foreach($children as $child)
                                                    @php $cid = (string)$child->id; @endphp
                                                    <label class="relative flex items-center p-5 bg-white rounded-3xl border-2 cursor-pointer transition-all duration-300 group"
                                                           :class="kids['{{ $cid }}'] ? 'border-potads-yellow bg-yellow-50/50 shadow-md scale-[1.02]' : 'border-transparent hover:border-yellow-100 hover:shadow-sm'">
                                                        <input type="checkbox" name="child_ids[]" value="{{ $cid }}" 
                                                               :checked="kids['{{ $cid }}']"
                                                               @change="toggleKid('{{ $cid }}')"
                                                               class="sr-only">
                                                        <div class="w-12 h-12 rounded-2xl flex items-center justify-center transition-all"
                                                             :class="kids['{{ $cid }}'] ? 'bg-potads-yellow text-white scale-110 shadow-lg' : 'bg-yellow-100 text-yellow-600'">
                                                            <i data-lucide="smile" class="w-6 h-6"></i>
                                                        </div>
                                                        <div class="ml-4 flex-1">
                                                            <span class="block font-black text-sm" :class="kids['{{ $cid }}'] ? 'text-potads-blue' : 'text-slate-700'">{{ $child->name }}</span>
                                                            <span class="block text-[10px] text-slate-400 font-bold uppercase tracking-wider">Anak Hebat</span>
                                                        </div>
                                                        <div class="w-6 h-6 rounded-full border-2 flex items-center justify-center transition-all"
                                                             :class="kids['{{ $cid }}'] ? 'bg-potads-yellow border-potads-yellow' : 'border-slate-200'">
                                                            <i data-lucide="check" class="w-3.5 h-3.5 text-white transition-opacity" :class="kids['{{ $cid }}'] ? 'opacity-100' : 'opacity-0'"></i>
                                                        </div>
                                                    </label>
                                                @endforeach
                                                
                                                <!-- Add New Child Quick Link -->
                                                <a href="{{ route('children.create') }}" class="flex items-center p-5 bg-white/40 rounded-3xl border-2 border-dashed border-slate-200 hover:border-potads-blue/30 hover:bg-white transition-all group">
                                                    <div class="w-12 h-12 rounded-2xl bg-slate-50 flex items-center justify-center text-slate-300 group-hover:bg-blue-50 group-hover:text-potads-blue transition-all">
                                                        <i data-lucide="plus" class="w-6 h-6"></i>
                                                    </div>
                                                    <div class="ml-4">
                                                        <span class="block font-bold text-slate-400 group-hover:text-potads-blue text-xs uppercase tracking-widest">Tambah Anak Lainnya</span>
                                                    </div>
                                                </a>
                                            @else
                                                <div class="p-8 bg-white/50 rounded-[2rem] border-2 border-dashed border-slate-200 flex flex-col items-center text-center gap-4">
                                                    <div class="w-16 h-16 bg-white rounded-full flex items-center justify-center text-slate-200 shadow-sm">
                                                        <i data-lucide="baby" class="w-8 h-8"></i>
                                                    </div>
                                                    <div>
                                                        <p class="text-sm font-bold text-slate-400">Belum ada data anak</p>
                                                        <p class="text-[10px] text-slate-400 mt-1 uppercase tracking-widest">Tambahkan data anak Anda untuk mendaftarkan mereka ke event ini</p>
                                                    </div>
                                                    <a href="{{ route('children.create') }}" class="bg-potads-blue text-white px-6 py-3 rounded-xl text-[10px] font-black uppercase tracking-widest hover:bg-blue-800 transition-all shadow-lg shadow-blue-200">
                                                        Tambah Anak Sekarang
                                                    </a>
                                                </div>
                                            @endif
                                        </div>

                                        <button type="submit" class="relative z-50 w-full mt-8 bg-potads-blue text-white font-black py-5 rounded-[2rem] shadow-xl hover:bg-blue-900 transition-all transform active:scale-95 flex items-center justify-center gap-3 group">
                                            <span>Simpan Pendaftaran</span>
                                            <i data-lucide="arrow-right" class="w-5 h-5 group-hover:translate-x-1 transition-transform"></i>
                                        </button>
                                    </form>
                                @else
                                    <div class="text-center py-6">
                                        <p class="text-sm font-bold text-slate-500 mb-6 leading-relaxed px-4">Silakan login terlebih dahulu untuk mendaftar ke event ini.</p>
                                        <a href="{{ route('login') }}" class="inline-flex items-center gap-3 bg-white border-2 border-potads-blue text-potads-blue font-black px-10 py-4 rounded-full hover:bg-blue-50 transition-all shadow-sm">
                                            Login Sekarang <i data-lucide="log-in" class="w-5 h-5"></i>
                                        </a>
                                    </div>
                                @endauth
                            @endif
                        </div>
                    @endif

                    <a href="{{ route('donations.index') }}" class="block w-full text-center bg-potads-yellow text-potads-blue font-extrabold py-5 rounded-2xl shadow-lg hover:shadow-xl transition-all transform active:scale-95">
                        Dukung Event Ini (Donasi)
                    </a>
                </div>
            </div>
        </div>
    </main>
@endsection
