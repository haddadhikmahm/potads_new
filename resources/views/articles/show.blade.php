@extends('layouts.frontend')

@section('title', $article->title . ' - PIK POTADS')

@section('content')
    <!-- Content Section -->
    <main class="max-w-7xl mx-auto px-6 md:px-12 py-8">
        <!-- Breadcrumb -->
        <nav class="flex text-sm text-gray-400 mb-8" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-3">
                <li><a href="{{ route('articles.index') }}" class="hover:text-potads-blue transition">Artikel</a></li>
                <li class="flex items-center">
                    <i data-lucide="chevron-right" class="w-4 h-4 mx-1"></i>
                    <span class="text-gray-600 line-clamp-1">{{ $article->title }}</span>
                </li>
            </ol>
        </nav>

        <div class="flex flex-col lg:flex-row gap-12">
            <!-- Left Column: Main Article -->
            <div class="lg:w-2/3">
                <div class="rounded-3xl overflow-hidden mb-8 shadow-sm">
                    <img src="{{ Str::startsWith($article->image, 'http') ? $article->image : asset('storage/' . $article->image) }}" alt="{{ $article->title }}" class="w-full h-auto object-cover">
                </div>
                
                <div class="text-right text-potads-blue font-bold text-sm mb-4">
                    {{ $article->created_at->format('d F Y') }}
                </div>

                <div class="text-center mb-10">
                    <h1 class="text-4xl md:text-5xl font-extrabold text-potads-blue mb-2 leading-tight">
                        {{ $article->title }}
                    </h1>
                    <p class="text-potads-blue font-semibold">By: {{ $article->author->name }}</p>
                </div>

                <div class="prose prose-lg max-w-none text-gray-700 leading-relaxed">
                    {!! nl2br(e($article->content)) !!}
                </div>
            </div>

            <!-- Right Column: Sidebar -->
            <div class="lg:w-1/3">
                <div class="bg-blue-50/50 rounded-[2rem] p-8 border border-blue-100 sticky top-24">
                    <h2 class="text-xl font-extrabold text-potads-blue mb-8 border-b border-blue-100 pb-4">Artikel Lainnya</h2>
                    
                    <div class="space-y-8">
                        @foreach($latestArticles as $latest)
                            <div class="flex gap-4 group">
                                <div class="w-2/3">
                                    <a href="{{ route('articles.show', $latest->slug) }}" class="text-blue-500 font-bold text-sm leading-snug group-hover:text-potads-blue transition line-clamp-3">
                                        {{ $latest->title }}
                                    </a>
                                </div>
                                <div class="w-1/3 aspect-square bg-potads-yellow rounded-xl overflow-hidden shrink-0">
                                    <img src="{{ Str::startsWith($latest->image, 'http') ? $latest->image : asset('storage/' . $latest->image) }}" alt="{{ $latest->title }}" class="w-full h-full object-cover">
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="mt-10">
                        <a href="{{ route('articles.index') }}" class="block text-center bg-potads-blue text-white py-3 rounded-xl font-bold hover:bg-blue-800 transition">Lihat Semua</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Section: Create Your Own Article -->
        <section class="mt-24 mb-12 flex flex-col md:flex-row items-center gap-12 p-8 bg-blue-50/20 rounded-[3rem] border border-blue-50">
            <div class="w-full md:w-5/12">
                <img src="https://images.unsplash.com/photo-1484665754804-74b091211472?q=80&w=2070&auto=format&fit=crop" alt="Family" class="rounded-3xl shadow-xl w-full h-72 object-cover">
            </div>
            <div class="w-full md:w-7/12">
                <h2 class="text-4xl font-extrabold text-potads-blue mb-6 leading-tight">Berbagi Cerita <br> Bersama Kami</h2>
                <p class="text-gray-500 mb-8 leading-relaxed text-lg">
                    Apakah Anda memiliki pengalaman atau informasi menarik untuk dibagikan kepada para pembaca? Kami menawarkan wadah bagi Anda untuk menyebarkan inspirasi.
                </p>
                <a href="{{ route('articles.create') }}" class="bg-potads-yellow text-potads-blue font-extrabold px-10 py-4 rounded-full shadow-lg hover:shadow-xl transition-all inline-block">
                    Tulis Artikel
                </a>
            </div>
        </section>
    </main>
@endsection