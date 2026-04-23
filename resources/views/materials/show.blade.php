@extends('layouts.frontend')

@section('title', 'PIK POTADS - ' . $material->title)

@section('content')
<div class="bg-white min-h-screen pt-24 md:pt-32 pb-12">
    <div class="max-w-[95%] xl:max-w-screen-2xl mx-auto px-6 md:px-12 flex flex-col md:flex-row gap-8 lg:gap-12 items-start">
        
        <!-- Main Content -->
        <div class="w-full md:w-[65%]">
            <!-- Breadcrumb -->
            <div class="text-xs text-gray-500 mb-6 flex items-center gap-2">
                <a href="{{ route('materials.index') }}" class="hover:text-potads-blue transition-colors">File Materi Orang Tua</a>
                <i data-lucide="chevron-right" class="w-3 h-3"></i>
                <span class="text-gray-400">Detail Materi</span>
            </div>

            <!-- Material Image -->
            <div class="rounded-3xl overflow-hidden mb-8 shadow-sm border border-gray-100">
                @php
                    $imgSrc = $material->image ? asset('storage/' . $material->image) : 'https://images.unsplash.com/photo-1529390079861-591de354faf5?q=80&w=2070&auto=format&fit=crop';
                @endphp
                <img src="{{ $imgSrc }}" alt="{{ $material->title }}" class="w-full aspect-video object-cover">
            </div>

            <!-- Date -->
            <div class="text-right text-gray-800 font-bold text-sm mb-6">
                {{ $material->created_at->translatedFormat('d F Y') }}
            </div>

            <!-- Title -->
            <h1 class="text-3xl md:text-4xl lg:text-5xl font-extrabold text-potads-blue mb-10 text-center leading-tight max-w-5xl mx-auto">
                {{ $material->title }}
            </h1>

            <div class="prose max-w-none text-gray-700">
                <p class="font-bold text-lg mb-2 text-gray-900">Deskripsi :</p>
                <div class="text-base leading-relaxed mb-6">
                    {!! nl2br(e($material->description)) !!}
                </div>

                <div class="flex items-center gap-2 mt-4 text-lg">
                    <span class="font-bold text-gray-900">Materi:</span>
                    @if($material->url)
                        <a href="{{ $material->url }}" target="_blank" class="text-blue-500 font-semibold hover:underline">Yuk Baca Materinya!</a>
                    @elseif($material->file_path)
                        <a href="{{ asset('storage/' . $material->file_path) }}" target="_blank" class="text-blue-500 font-semibold hover:underline">Yuk Baca Materinya!</a>
                    @else
                        <span class="text-gray-500 italic">Materi belum tersedia</span>
                    @endif
                </div>
            </div>
        </div>

        <!-- Sidebar / 'Materi Lainnya' -->
        <div class="w-full md:w-[35%] bg-blue-50/50 p-8 rounded-3xl mt-12 md:mt-0 sticky top-32 border border-blue-100">
            <h3 class="text-xl font-bold text-gray-900 mb-8">Materi Lainnya</h3>
            
            <div class="space-y-6">
                @forelse($otherMaterials as $other)
                    <div class="flex gap-4 items-center justify-between group">
                        <a href="{{ route('materials.show', $other->id) }}" class="flex-grow pr-4">
                            <p class="text-blue-600 text-sm font-medium hover:underline leading-relaxed line-clamp-3">
                                {{ $other->title }}
                            </p>
                        </a>
                        <a href="{{ route('materials.show', $other->id) }}" class="flex-shrink-0 w-20 h-12 bg-potads-yellow rounded-lg block hover:opacity-80 transition-opacity">
                            <!-- This empty yellow block matches the design mockup -->
                        </a>
                    </div>
                @empty
                    <p class="text-gray-500 text-sm">Belum ada materi lainnya.</p>
                @endforelse
            </div>
        </div>

    </div>
</div>
@endsection
