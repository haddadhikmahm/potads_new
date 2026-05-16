@extends('layouts.frontend')

@section('title', 'PIK POTADS - Akademis & Medis')

@section('content')
<div class="bg-transparent min-h-screen py-12 px-6 md:px-12 lg:px-16 pt-16 md:pt-24">
    <div class="max-w-[1850px] mx-auto">
        <!-- Header, Filters & Search -->
        <div class="flex flex-col xl:flex-row justify-between items-start xl:items-center mb-10 gap-6" data-aos="fade-up">
            
            <!-- Filters -->
            @php
                $categories = [
                    '' => 'Semua Sumber Daya',
                    'sekolah' => 'Sekolah',
                    'rumah sakit' => 'Rumah Sakit',
                    'pusat tumbuh kembang' => 'Pusat Tumbuh Kembang'
                ];
                $currentCategory = request('category', '');
            @endphp
            
            <div class="flex flex-wrap gap-3">
                @foreach($categories as $value => $label)
                    <a href="{{ route('medical_infos.index', array_merge(request()->query(), ['category' => $value])) }}" 
                       class="px-5 py-2.5 rounded-full text-sm font-semibold transition-colors duration-200 border-2 {{ $currentCategory == $value ? 'bg-potads-yellow text-potads-blue border-potads-yellow shadow-md' : 'bg-white text-gray-600 border-gray-200 hover:border-potads-blue hover:text-potads-blue btn-playful' }}">
                        {{ $label }}
                    </a>
                @endforeach
            </div>

            <!-- Search Bar & Location Filter -->
            <form action="{{ route('medical_infos.index') }}" method="GET" class="w-full xl:w-auto flex flex-col md:flex-row gap-4 items-center">
                @if(request('category'))
                    <input type="hidden" name="category" value="{{ request('category') }}">
                @endif
                <div class="relative w-full md:w-64">
                    <i data-lucide="search" class="absolute left-4 top-1/2 -translate-y-1/2 w-4 h-4 text-gray-400"></i>
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari info..." class="pl-11 pr-4 py-2.5 rounded-full border-2 border-gray-200 focus:outline-none focus:border-potads-blue w-full shadow-sm text-sm">
                </div>
                <div class="relative w-full md:w-64">
                    <i data-lucide="map-pin" class="absolute left-4 top-1/2 -translate-y-1/2 w-4 h-4 text-gray-400"></i>
                    <input type="text" name="regency" value="{{ request('regency') }}" placeholder="Lokasi (Kota/Kab)..." class="pl-11 pr-4 py-2.5 rounded-full border-2 border-gray-200 focus:outline-none focus:border-potads-blue w-full shadow-sm text-sm">
                </div>
                <button type="submit" class="bg-potads-blue text-white px-8 py-2.5 rounded-full text-sm font-semibold hover:bg-blue-900 transition-colors btn-playful">
                    Filter
                </button>
            </form>
        </div>

        <!-- Cards Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mb-12" id="medicalGrid" data-aos="fade-up">
            @forelse($infos as $index => $info)
                <div class="bg-white rounded-3xl overflow-hidden shadow-xl border-4 border-white hover:shadow-2xl hover:-translate-y-2 transition-all duration-300 flex flex-col h-full info-card {{ $index >= 6 ? 'hidden' : '' }}">
                    
                    <!-- Image with Badge -->
                    <div class="relative h-56">
                        @php
                            $imgSrc = $info->image 
                                ? (Str::startsWith($info->image, 'http') ? $info->image : asset('storage/' . $info->image)) 
                                : 'https://images.unsplash.com/photo-1541829070764-84a7d30dd3f3?q=80&w=2069&auto=format&fit=crop';
                        @endphp
                        <img src="{{ $imgSrc }}" alt="{{ $info->title }}" class="w-full h-full object-cover">
                        
                        <div class="absolute top-4 right-4 bg-potads-yellow text-potads-blue font-bold px-4 py-1.5 rounded-full text-xs shadow-sm">
                            {{ $info->category ?: 'Akademis' }}
                        </div>
                    </div>

                    <!-- Card Body -->
                    <div class="p-8 flex flex-col flex-grow">
                        <h3 class="text-xl font-bold text-potads-blue mb-3 leading-tight line-clamp-2">
                            {{ $info->title }}
                        </h3>
                        <p class="text-gray-500 text-sm mb-6 line-clamp-3">
                            {{ strip_tags($info->content) }}
                        </p>
                        
                        <!-- Contact / Address -->
                        <div class="space-y-2 mb-8 mt-auto">
                            <div class="flex items-start gap-3 text-sm text-gray-500">
                                <i data-lucide="map-pin" class="w-4 h-4 text-potads-blue flex-shrink-0 mt-0.5"></i>
                                <span>
                                    @if($info->regency || $info->district)
                                        {{ $info->district ? 'Kec. ' . $info->district . ', ' : '' }}{{ $info->regency }}
                                    @else
                                        {{ $info->address ?? 'Alamat: Hubungi detail' }}
                                    @endif
                                </span>
                            </div>
                            @if($info->phone)
                                <div class="flex items-start gap-3 text-sm text-gray-500">
                                    <i data-lucide="phone" class="w-4 h-4 text-potads-blue flex-shrink-0 mt-0.5"></i>
                                    <span>{{ $info->phone }}</span>
                                </div>
                            @endif
                        </div>

                        <a href="{{ route('medical_infos.show', $info->slug) }}" class="block w-full text-center bg-pastel-blue text-potads-blue px-6 py-3 rounded-full font-bold text-sm btn-playful">
                            Lihat Detail
                        </a>
                    </div>
                </div>
            @empty
                <div class="col-span-full py-20 text-center text-gray-500 bg-white rounded-3xl border border-gray-100 shadow-sm">
                    <i data-lucide="folder-search" class="w-16 h-16 mx-auto mb-4 text-gray-300"></i>
                    <p class="text-lg">Informasi Akademis & Medis belum tersedia.</p>
                </div>
            @endforelse
        </div>

        <!-- Load More -->
        @if($infos->count() > 6)
            <div class="flex justify-center mt-12" id="loadMoreContainer">
                <button type="button" onclick="showAllInfos()" class="border-4 border-potads-yellow text-potads-blue bg-white font-bold px-24 py-3.5 rounded-full hover:bg-potads-yellow transition-colors flex items-center gap-3 shadow-sm btn-playful">
                    Muat Lebih Banyak <i data-lucide="chevron-down" class="w-5 h-5 text-potads-blue"></i>
                </button>
            </div>
        @endif
        
        <script>
            function showAllInfos() {
                const cards = document.querySelectorAll('.info-card.hidden');
                cards.forEach(card => {
                    card.classList.remove('hidden');
                });
                document.getElementById('loadMoreContainer').style.display = 'none';
            }
        </script>
    </div>
</div>
@endsection
