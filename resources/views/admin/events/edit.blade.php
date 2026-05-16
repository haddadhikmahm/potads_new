@extends('layouts.admin')

@section('title', 'Ubah Data Event')

@section('header_title', 'Ubah Data Event')
@section('header_breadcrumb', 'DASHBOARD > EVENT > UBAH DATA')

@section('content')
<div class="mb-8 flex justify-end">
    <a href="{{ route('admin.events.index') }}" class="flex items-center gap-2 text-slate-400 hover:text-potads-blue font-bold text-sm transition-colors">
        <i data-lucide="arrow-left" class="w-4 h-4"></i>
        Kembali ke Daftar
    </a>
</div>

<form action="{{ route('admin.events.update', $event) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 items-start">
        
        <!-- Left Column: Form Fields -->
        <div class="lg:col-span-2 space-y-6">
            <div class="bg-white rounded-[2.5rem] p-10 shadow-sm border border-slate-50">
                <div class="space-y-6">
                    <div>
                        <label for="title" class="block text-xs font-bold text-slate-700 mb-2 ml-1">Judul Event</label>
                        <input type="text" name="title" id="title" placeholder="Masukkan judul kegiatan..." 
                               class="w-full px-6 py-4 bg-slate-50 border border-slate-100 rounded-2xl focus:outline-none focus:ring-2 focus:ring-potads-blue/5 text-sm @error('title') border-red-500 @enderror" 
                               value="{{ old('title', $event->title) }}" required>
                        @error('title') <p class="text-red-500 text-[10px] mt-1 ml-1">{{ $message }}</p> @enderror
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="event_date" class="block text-xs font-bold text-slate-700 mb-2 ml-1">Tanggal Pelaksanaan</label>
                            <input type="datetime-local" name="event_date" id="event_date" 
                                   class="w-full px-6 py-4 bg-slate-50 border border-slate-100 rounded-2xl focus:outline-none focus:ring-2 focus:ring-potads-blue/5 text-sm @error('event_date') border-red-500 @enderror" 
                                   value="{{ old('event_date', \Carbon\Carbon::parse($event->event_date)->format('Y-m-d\TH:i')) }}" required>
                            @error('event_date') <p class="text-red-500 text-[10px] mt-1 ml-1">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label for="location" class="block text-xs font-bold text-slate-700 mb-2 ml-1">Lokasi / Venue</label>
                            <div class="relative">
                                <span class="absolute left-6 top-1/2 -translate-y-1/2 text-slate-400">
                                    <i data-lucide="map-pin" class="w-4 h-4"></i>
                                </span>
                                <input type="text" name="location" id="location" placeholder="Lokasi kegiatan..." 
                                       class="w-full pl-14 pr-6 py-4 bg-slate-50 border border-slate-100 rounded-2xl focus:outline-none focus:ring-2 focus:ring-potads-blue/5 text-sm" 
                                       value="{{ old('location', $event->location) }}">
                            </div>
                        </div>
                    </div>

                    <div>
                        <label for="registration_link" class="block text-xs font-bold text-slate-700 mb-2 ml-1">Link Pendaftaran Eksternal (Opsional)</label>
                        <div class="relative">
                            <span class="absolute left-6 top-1/2 -translate-y-1/2 text-slate-400">
                                <i data-lucide="external-link" class="w-4 h-4"></i>
                            </span>
                            <input type="url" name="registration_link" id="registration_link" placeholder="https://forms.gle/..." 
                                   class="w-full pl-14 pr-6 py-4 bg-slate-50 border border-slate-100 rounded-2xl focus:outline-none focus:ring-2 focus:ring-potads-blue/5 text-sm @error('registration_link') border-red-500 @enderror" 
                                   value="{{ old('registration_link', $event->registration_link) }}">
                        </div>
                        <p class="text-[9px] text-slate-400 mt-2 ml-2 italic">* Jika diisi, pendaftaran di website ini akan dinonaktifkan dan dialihkan ke link tersebut.</p>
                        @error('registration_link') <p class="text-red-500 text-[10px] mt-1 ml-1">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label for="description" class="block text-xs font-bold text-slate-700 mb-2 ml-1">Deskripsi Lengkap</label>
                        <textarea name="description" id="description" rows="10" placeholder="Tuliskan detail kegiatan secara lengkap..." 
                                  class="w-full px-8 py-6 bg-slate-50 border border-slate-100 rounded-[2rem] focus:outline-none focus:ring-2 focus:ring-potads-blue/5 text-sm resize-none @error('description') border-red-500 @enderror">{{ old('description', $event->description) }}</textarea>
                        @error('description') <p class="text-red-500 text-[10px] mt-2 ml-1">{{ $message }}</p> @enderror
                    </div>
                </div>
            </div>
        </div>

        <!-- Right Column: Sidebar Actions & Media -->
        <div class="space-y-6">
            <div class="bg-white rounded-[2.5rem] p-8 shadow-sm border border-slate-50 sticky top-8">
                <h3 class="text-[10px] font-extrabold text-slate-400 uppercase tracking-widest mb-6 text-center">Media Event</h3>
                
                <div class="mb-6">
                    <p class="text-[10px] font-bold text-slate-400 mb-2 uppercase tracking-wide">Gambar Saat Ini</p>
                    <div class="w-full aspect-video rounded-2xl bg-slate-100 overflow-hidden border border-slate-100 shadow-inner">
                        @if($event->image)
                            <img src="{{ asset('storage/' . $event->image) }}" class="w-full h-full object-cover">
                        @else
                            <div class="w-full h-full flex items-center justify-center text-slate-300">
                                <i data-lucide="image" class="w-10 h-10"></i>
                            </div>
                        @endif
                    </div>
                </div>

                <div class="relative group">
                    <p class="text-[10px] font-bold text-slate-400 mb-2 uppercase tracking-wide">Unggah Gambar Baru</p>
                    <input type="file" name="image" id="image-upload" class="hidden" accept="image/*">
                    <label for="image-upload" class="flex flex-col items-center justify-center py-6 px-4 border-2 border-dashed border-slate-200 rounded-[2rem] cursor-pointer group-hover:border-potads-blue group-hover:bg-blue-50/30 transition-all duration-300">
                        <div id="preview-container" class="contents">
                            <div class="w-10 h-10 bg-slate-50 rounded-xl flex items-center justify-center text-slate-300 mb-2 group-hover:scale-110 transition-transform">
                                <i data-lucide="upload-cloud" class="w-5 h-5"></i>
                            </div>
                            <p class="text-[9px] font-bold text-slate-500 mb-1">Klik untuk ganti gambar</p>
                            <p class="text-[8px] text-slate-400 uppercase">PNG, JPG up to 5MB</p>
                        </div>
                        <img id="image-preview" src="#" class="hidden w-full h-auto rounded-xl object-cover shadow-sm">
                    </label>
                </div>
                @error('image') <p class="text-red-500 text-[10px] mt-4 text-center">{{ $message }}</p> @enderror

                <hr class="my-8 border-slate-100">

                <div class="space-y-4 mb-8">
                    <div class="flex justify-between items-center text-[10px] font-bold">
                        <span class="text-slate-400 uppercase tracking-wide">Status</span>
                        <div class="w-1/2">
                            <select name="status" class="w-full bg-slate-50 border-none rounded-lg text-[10px] font-bold text-emerald-600 focus:ring-0 cursor-pointer text-right">
                                <option value="upcoming" {{ old('status', $event->status) == 'upcoming' ? 'selected' : '' }}>MENDATANG</option>
                                <option value="ongoing" {{ old('status', $event->status) == 'ongoing' ? 'selected' : '' }}>AKTIF</option>
                                <option value="completed" {{ old('status', $event->status) == 'completed' ? 'selected' : '' }}>SELESAI</option>
                            </select>
                        </div>
                    </div>
                    <div class="flex justify-between items-center text-[10px] font-bold">
                        <span class="text-slate-400 uppercase tracking-wide">Terakhir Diubah</span>
                        <span class="text-slate-700 uppercase">{{ $event->updated_at->format('d M, H:i') }}</span>
                    </div>
                </div>

                <button type="submit" class="w-full bg-potads-yellow text-potads-blue py-4 rounded-full font-bold hover:bg-potads-blue hover:text-white transition-all shadow-lg shadow-yellow-500/20 transform hover:-translate-y-1">
                    UBAH DATA
                </button>
            </div>
        </div>
    </div>
</form>
@endsection

@push('scripts')
<script>
    document.getElementById('image-upload').onchange = function (evt) {
        const [file] = this.files;
        if (file) {
            const preview = document.getElementById('image-preview');
            const container = document.getElementById('preview-container');
            preview.src = URL.createObjectURL(file);
            preview.classList.remove('hidden');
            container.classList.add('hidden');
        }
    }
</script>
@endpush
