@extends('layouts.frontend')

@section('title', 'PIK POTADS - ' . $info->title)

@section('content')
<div class="bg-white min-h-screen pt-24 md:pt-32 pb-20">
    <div class="max-w-[95%] xl:max-w-screen-2xl mx-auto px-6 md:px-12">
        
        <!-- Breadcrumb -->
        <div class="text-xs text-gray-500 mb-8 flex items-center gap-2">
            <a href="{{ route('medical_infos.index') }}" class="hover:text-potads-blue transition-colors">Akademis & Medis</a>
            <i data-lucide="chevron-right" class="w-3 h-3"></i>
            <span class="text-gray-400">Detail</span>
        </div>

        <!-- Full Width Image -->
        <div class="rounded-[2.5rem] overflow-hidden mb-12 shadow-md">
            @php
                $imgSrc = $info->image 
                    ? (Str::startsWith($info->image, 'http') ? $info->image : asset('storage/' . $info->image)) 
                    : 'https://images.unsplash.com/photo-1541829070764-84a7d30dd3f3?q=80&w=2069&auto=format&fit=crop';
            @endphp
            <img src="{{ $imgSrc }}" alt="{{ $info->title }}" class="w-full aspect-[21/9] md:aspect-[24/9] object-cover">
        </div>

        <!-- Title -->
        <h1 class="text-4xl md:text-5xl lg:text-6xl font-extrabold text-potads-blue mb-16 text-center leading-tight mx-auto max-w-5xl">
            {{ strtoupper($info->title) }}
        </h1>

        <!-- Content Layout -->
        <div class="flex flex-col lg:flex-row gap-12 lg:gap-16 items-start">
            
            <!-- Left Content: Tentang Tempat Ini -->
            <div class="w-full lg:w-[65%]">
                <h3 class="text-2xl font-bold text-potads-blue mb-6">Tentang Tempat Ini</h3>
                <div class="prose max-w-none text-gray-600 text-lg leading-relaxed">
                    {!! $info->content !!}
                </div>
            </div>

            <!-- Right Sidebar: Info Card with Map -->
            <div class="w-full lg:w-[35%]">
                <div class="bg-gray-50 rounded-[2rem] overflow-hidden border border-gray-100 shadow-sm">
                    <!-- Map Placeholder Image -->
                    <div class="h-48 w-full bg-gray-200 relative overflow-hidden group">
                        <img src="https://images.unsplash.com/photo-1524661135-423995f22d0b?q=80&w=2074&auto=format&fit=crop" alt="Map" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500 opacity-80">
                        <div class="absolute inset-0 bg-gradient-to-t from-gray-100/50 to-transparent"></div>
                        <!-- Marker Icon concept -->
                        <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 text-red-500 drop-shadow-md">
                            <i data-lucide="map-pin" class="w-10 h-10 fill-white"></i>
                        </div>
                    </div>
                    
                    <!-- Contact Details -->
                    <div class="p-8 pb-10 space-y-8">
                        
                        <!-- Address -->
                        <div class="flex items-start gap-5">
                            <div class="text-potads-blue pt-1">
                                <i data-lucide="map-pin" class="w-6 h-6"></i>
                            </div>
                            <div>
                                <h4 class="font-bold text-potads-blue text-base">Alamat Lokasi</h4>
                                <p class="text-gray-500 text-sm mt-1">{{ $info->address ?? 'Silakan hubungi untuk alamat spesifik.' }}</p>
                            </div>
                        </div>

                        <!-- Phone -->
                        <div class="flex items-start gap-5">
                            <div class="text-potads-blue pt-1">
                                <i data-lucide="phone" class="w-6 h-6"></i>
                            </div>
                            <div>
                                <h4 class="font-bold text-potads-blue text-base">Nomor Telepon</h4>
                                <p class="text-gray-500 text-sm mt-1">{{ $info->phone ?? 'Belum ada kontak tersedia.' }}</p>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

        </div>

    </div>
</div>
@endsection
