@extends('layouts.frontend')

@section('title', 'Artikel - PIK POTADS')

@section('content')
    <!-- Header Section -->
    <header class="px-6 md:px-12 lg:px-16 py-16 max-w-[1850px] mx-auto flex flex-col lg:flex-row justify-between items-start lg:items-center gap-12" data-aos="fade-up">
        <div class="w-full lg:w-1/2">
            <h1 class="text-6xl md:text-8xl font-black text-potads-blue mb-6 leading-[1.1]">
                Koneksi <br>
                <span class="ml-12 lg:ml-24 inline-block bg-potads-yellow px-8 py-2 rounded-[1.5rem] text-potads-blue">Komunitas</span>
            </h1>
        </div>
        <div class="w-full lg:w-1/2 flex flex-col items-start lg:items-end gap-8 text-left lg:text-right">
            <p class="text-gray-500 text-xl leading-relaxed max-w-2xl">
                Bergabunglah dengan kami untuk lokakarya, gala, dan jalan santai komunitas. Setiap acara adalah langkah menuju masa depan yang lebih cerah bagi semua.
            </p>
        </div>
    </header>

    <!-- Search & Filter Section -->
    <section class="px-6 md:px-12 lg:px-16 py-8 max-w-[1850px] mx-auto" data-aos="fade-up">
        <div class="flex flex-col md:flex-row justify-between items-center gap-8 border-t border-gray-100 pt-16">
            <h2 class="text-4xl font-black text-potads-blue">Artikel</h2>
            <form action="{{ route('articles.index') }}" method="GET" class="flex items-center gap-3 w-full md:w-auto">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Search......" class="w-full md:w-80 bg-white border-2 border-potads-blue/10 rounded-full py-3 px-8 text-sm focus:outline-none focus:border-potads-blue">
                <button type="submit" class="bg-potads-blue text-white px-10 py-3 rounded-full text-sm font-bold hover:bg-blue-900 transition btn-playful">Cari</button>
            </form>
        </div>
    </section>

    <!-- Articles Grid -->
    <section class="px-6 md:px-12 lg:px-16 pb-24 max-w-[1850px] mx-auto" data-aos="fade-up">
        @if($articles->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10">
                @foreach($articles as $article)
                    <div class="bg-white rounded-[2.5rem] overflow-hidden shadow-xl border-4 border-white flex flex-col group hover:shadow-2xl transition duration-500 hover:-translate-y-2">
                        <div class="p-5">
                            <div class="overflow-hidden rounded-[2rem] h-64">
                                <img src="{{ Str::startsWith($article->image, 'http') ? $article->image : asset('storage/' . $article->image) }}" alt="{{ $article->title }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-700">
                            </div>
                        </div>
                        <div class="px-10 pb-10 flex-1 flex flex-col">
                            <h3 class="text-2xl font-black text-potads-blue mb-4 leading-tight group-hover:text-blue-600 transition line-clamp-2 h-16">{{ $article->title }}</h3>
                            <p class="text-gray-400 text-base mb-10 line-clamp-2 leading-relaxed">
                                {{ Str::limit(strip_tags($article->content), 120) }}
                            </p>
                            <div class="mt-auto flex items-center justify-between">
                                <div class="flex flex-col md:flex-row md:items-center gap-2 md:gap-4 text-[10px] text-blue-400 font-black uppercase tracking-widest">
                                    <span class="flex items-center gap-2"><i data-lucide="calendar" class="w-3.5 h-3.5"></i> {{ $article->created_at->format('d F Y') }}</span>
                                    <span class="flex items-center gap-2"><i data-lucide="user" class="w-3.5 h-3.5"></i> {{ $article->author->name }}</span>
                                </div>
                                <a href="{{ route('articles.show', $article->slug) }}" class="bg-pastel-blue text-potads-blue font-black px-6 py-2.5 rounded-full text-sm btn-playful">Lihat Detail</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Load More Button -->
            @if($articles->hasMorePages())
                <div class="mt-24 flex justify-center">
                    <a href="{{ $articles->nextPageUrl() }}" class="w-full max-w-2xl bg-white border-4 border-potads-yellow py-6 rounded-full flex items-center justify-center gap-4 text-potads-blue font-black text-lg hover:bg-potads-yellow transition-all duration-300 group btn-playful">
                        Muat Lebih Banyak
                        <i data-lucide="chevron-down" class="w-6 h-6"></i>
                    </a>
                </div>
            @endif
        @else
            <div class="text-center py-32 bg-gray-50 rounded-[4rem] border-2 border-dashed border-gray-200">
                <i data-lucide="newspaper" class="w-16 h-16 text-gray-300 mx-auto mb-6"></i>
                <p class="text-gray-400 text-xl font-medium">Belum ada artikel yang tersedia saat ini.</p>
            </div>
        @endif
    </section>
@endsection