@extends('layouts.admin')

@section('title', 'Detail Donasi')

@section('header_title', 'Detail Donasi')
@section('header_breadcrumb', 'DONATION DETAILS')

@section('content')
<div class="mb-10">
    <a href="{{ route('admin.donations.index') }}" class="inline-flex items-center gap-2 text-slate-400 hover:text-potads-blue font-bold text-xs uppercase tracking-widest transition-colors">
        <i data-lucide="arrow-left" class="w-4 h-4"></i>
        Kembali ke Daftar
    </a>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
    <!-- Donation Info -->
    <div class="lg:col-span-2 space-y-8">
        <div class="bg-white rounded-[2.5rem] shadow-sm border border-slate-50 p-10">
            <div class="flex items-center gap-4 mb-8">
                <div class="w-12 h-12 bg-blue-50 rounded-2xl flex items-center justify-center text-potads-blue">
                    <i data-lucide="info" class="w-6 h-6"></i>
                </div>
                <div>
                    <h3 class="text-xl font-extrabold text-slate-800">Informasi Donasi</h3>
                    <p class="text-slate-400 text-xs font-bold uppercase tracking-widest">ID Transaksi: {{ $donation->transaction_id }}</p>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div class="space-y-1">
                    <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Nama Donatur</p>
                    <p class="font-extrabold text-slate-700 text-lg">{{ $donation->is_anonymous ? 'Hamba Allah (' . $donation->donor_name . ')' : $donation->donor_name }}</p>
                    @if($donation->is_anonymous)
                        <span class="text-[9px] bg-slate-100 text-slate-500 px-2 py-0.5 rounded font-bold uppercase tracking-tighter">Anonymous</span>
                    @endif
                </div>

                <div class="space-y-1">
                    <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Nominal Donasi</p>
                    <p class="font-extrabold text-potads-blue text-2xl">Rp {{ number_format($donation->amount, 0, ',', '.') }}</p>
                </div>

                <div class="space-y-1">
                    <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Email</p>
                    <p class="font-bold text-slate-600">{{ $donation->email }}</p>
                </div>

                <div class="space-y-1">
                    <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">WhatsApp / Phone</p>
                    <p class="font-bold text-slate-600">{{ $donation->phone ?? '-' }}</p>
                </div>

                <div class="space-y-1">
                    <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Metode Pembayaran</p>
                    <p class="font-bold text-slate-600">{{ $donation->payment_method }}</p>
                </div>

                <div class="space-y-1">
                    <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Tanggal Donasi</p>
                    <p class="font-bold text-slate-600">{{ $donation->created_at->format('d F Y, H:i') }}</p>
                </div>
            </div>

            <div class="mt-10 pt-10 border-t border-slate-50">
                <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-3">Pesan / Doa</p>
                <div class="bg-slate-50 rounded-2xl p-6 italic text-slate-600">
                    "{{ $donation->message ?? 'Tidak ada pesan.' }}"
                </div>
            </div>
        </div>
    </div>

    <!-- Payment Status & Evidence -->
    <div class="space-y-8">
        <!-- Status Update -->
        <div class="bg-white rounded-[2.5rem] shadow-sm border border-slate-50 p-8 text-center">
            <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-6 text-left">Update Status Pembayaran</p>
            
            <form action="{{ route('admin.donations.update', $donation) }}" method="POST" class="space-y-4">
                @csrf
                @method('PUT')
                
                <select name="payment_status" class="w-full bg-slate-50 border-none rounded-2xl px-6 py-4 font-bold text-slate-700 focus:ring-2 focus:ring-potads-blue">
                    <option value="pending" {{ $donation->payment_status === 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="success" {{ $donation->payment_status === 'success' ? 'selected' : '' }}>Success / Berhasil</option>
                    <option value="failed" {{ $donation->payment_status === 'failed' ? 'selected' : '' }}>Failed / Gagal</option>
                </select>

                <button type="submit" class="w-full bg-potads-blue text-white py-4 rounded-full font-bold hover:bg-blue-700 transition-all shadow-lg shadow-blue-500/20">
                    Simpan Perubahan
                </button>
            </form>
        </div>

        <!-- Evidence Image -->
        <div class="bg-white rounded-[2.5rem] shadow-sm border border-slate-50 p-8">
            <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-6">Bukti Transfer</p>
            
            @if($donation->proof_image)
                <div class="rounded-2xl overflow-hidden border border-slate-100 mb-4 cursor-pointer hover:opacity-90 transition-opacity" onclick="window.open('{{ asset('storage/' . $donation->proof_image) }}', '_blank')">
                    <img src="{{ asset('storage/' . $donation->proof_image) }}" class="w-full h-auto object-cover">
                </div>
                <p class="text-[10px] text-center text-slate-400 font-medium italic">Klik gambar untuk memperbesar</p>
            @else
                <div class="bg-slate-50 rounded-2xl p-10 text-center flex flex-col items-center justify-center gap-3">
                    <i data-lucide="image-off" class="w-8 h-8 text-slate-300"></i>
                    <p class="text-xs text-slate-400 font-bold">Tidak ada bukti upload</p>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
