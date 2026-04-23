@extends('layouts.frontend')

@section('title', 'PIK POTADS - File Materi Orang Tua')

@section('content')
<div class="bg-white min-h-screen py-16 px-6 md:px-12 lg:px-16 pt-24 md:pt-32">
    <div class="max-w-[1850px] mx-auto">
        <!-- Header & Search -->
        <div class="flex flex-col lg:flex-row justify-between items-center mb-16 gap-8 border-b border-gray-100 pb-12">
            <h1 class="text-4xl font-black text-potads-blue">File Materi Orang Tua</h1>
            
            <form action="{{ route('materials.index') }}" method="GET" class="w-full lg:w-auto relative flex items-center gap-3">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Search......." class="pl-8 pr-12 py-4 rounded-full border border-gray-100 bg-[#F8FAFC] focus:outline-none focus:ring-2 focus:ring-potads-blue/10 w-full lg:w-96 shadow-sm text-base">
                <button type="submit" class="bg-potads-blue text-white px-10 py-4 rounded-full text-sm font-black hover:bg-blue-900 transition-all shadow-lg">
                    Cari
                </button>
            </form>
        </div>

        <!-- Materials Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10 mb-20" id="materialsGrid">
            @forelse($materials as $index => $material)
                <div class="bg-white rounded-[2.5rem] overflow-hidden shadow-lg hover:shadow-2xl border border-gray-50 transition-all duration-500 flex flex-col h-full material-card {{ $index >= 6 ? 'hidden' : '' }}">
                    @php
                        $imgSrc = $material->image ? asset('storage/' . $material->image) : 'https://images.unsplash.com/photo-1529390079861-591de354faf5?q=80&w=2070&auto=format&fit=crop';
                    @endphp
                    <div class="p-5">
                        <div class="rounded-[2rem] overflow-hidden h-64">
                            <img src="{{ $imgSrc }}" alt="{{ $material->title }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-700">
                        </div>
                    </div>
                    <div class="px-10 pb-10 flex flex-col flex-grow">
                        <h3 class="text-2xl font-black text-potads-blue mb-4 line-clamp-2 leading-tight">
                            {{ $material->title }}
                        </h3>
                        <p class="text-gray-400 text-base mb-8 line-clamp-3 leading-relaxed">
                            {{ $material->description }}
                        </p>
                        <div class="mt-auto flex justify-between items-center border-t border-gray-50 pt-8">
                            <span class="text-[10px] text-blue-400 font-black uppercase tracking-widest flex items-center gap-2">
                                <i data-lucide="book-open" class="w-3.5 h-3.5"></i> MATERI EDUKASI
                            </span>
                            <a href="{{ route('materials.show', $material->id) }}" class="bg-[#F0F7FF] text-potads-blue font-black px-6 py-2.5 rounded-xl text-sm hover:bg-potads-blue hover:text-white transition-all duration-300">
                                Lihat Detail
                            </a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-full py-32 text-center bg-gray-50 rounded-[4rem] border-2 border-dashed border-gray-200">
                    <i data-lucide="folder-open" class="w-16 h-16 mx-auto mb-6 text-gray-300"></i>
                    <p class="text-gray-400 text-xl font-medium">Materi belum tersedia saat ini.</p>
                </div>
            @endforelse
        </div>

        <!-- Load More -->
        @if($materials->count() > 6)
            <div class="flex justify-center mt-20" id="loadMoreContainer">
                <button type="button" onclick="showAllCards()" class="w-full max-w-2xl bg-[#F8FBFF] border-2 border-potads-blue/10 py-6 rounded-[2rem] flex items-center justify-center gap-4 text-potads-blue font-black text-lg hover:bg-white hover:shadow-xl hover:border-potads-blue/20 transition-all duration-300 group shadow-sm">
                    Muat Lebih Banyak <i data-lucide="chevron-down" class="w-6 h-6 group-hover:translate-y-1 transition text-potads-blue"></i>
                </button>
            </div>
        @endif
        
        <script>
            function showAllCards() {
                const cards = document.querySelectorAll('.material-card.hidden');
                cards.forEach(card => {
                    card.classList.remove('hidden');
                    // Add some animation
                    card.style.opacity = '0';
                    setTimeout(() => {
                        card.style.transition = 'opacity 0.5s ease-in-out';
                        card.style.opacity = '1';
                    }, 10);
                });
                // Sembunyikan tombol setelah diklik
                document.getElementById('loadMoreContainer').style.display = 'none';
            }
        </script>
    </div>
</div>
@endsection
