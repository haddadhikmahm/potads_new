@extends('layouts.frontend')

@section('title', 'Formulir Donasi - PIK POTADS')

@section('content')
<div class="bg-[#F8F9FB] min-h-screen pt-24 md:pt-32 pb-20">
    <div class="max-w-3xl mx-auto px-6 md:px-8">
        
        <!-- Header -->
        <div class="mb-10">
            <h1 class="text-3xl md:text-4xl font-extrabold text-gray-900 mb-3 tracking-tight">Formulir Donasi</h1>
            <p class="text-gray-500 text-sm md:text-base">Lengkapi data untuk menyalurkan kebaikan bagi anak-anak dengan Down Syndrome.</p>
        </div>

        @if(session('success'))
            <div class="bg-green-50 border border-green-200 text-green-700 p-6 rounded-2xl mb-8 flex items-center gap-4">
                <i data-lucide="check-circle" class="w-6 h-6 text-green-500 flex-shrink-0"></i>
                <p class="font-bold text-sm">{{ session('success') }}</p>
            </div>
        @endif

        <form action="{{ route('donations.store') }}" method="POST" class="space-y-6" enctype="multipart/form-data">
            @csrf

            <!-- Box 1: Nominal Sedekah -->
            <div class="bg-white rounded-3xl p-6 md:p-8 shadow-sm border border-gray-100">
                <div class="flex items-center gap-3 mb-6">
                    <div class="bg-blue-100 text-potads-blue p-2 rounded-lg">
                        <i data-lucide="banknote" class="w-5 h-5"></i>
                    </div>
                    <h3 class="font-bold text-gray-900">Masukan Nominal Sedekah</h3>
                </div>
                
                <div class="relative mb-5">
                    <div class="absolute inset-y-0 left-0 pl-5 flex items-center pointer-events-none">
                        <span class="text-potads-blue font-bold">Rp</span>
                    </div>
                    <input type="number" name="amount" id="amount" class="w-full bg-[#F3F4F6] rounded-xl border-none focus:ring-2 focus:ring-potads-blue pl-14 pr-5 py-4 font-bold text-gray-700 placeholder-gray-400" placeholder="0" required>
                </div>

                <div class="flex flex-wrap gap-3">
                    <button type="button" onclick="setAmount(50000)" class="border border-gray-200 text-gray-600 rounded-full px-5 py-2 text-sm font-semibold hover:border-potads-blue hover:text-potads-blue transition-colors bg-white">Rp 50.000</button>
                    <button type="button" onclick="setAmount(100000)" class="border border-gray-200 text-gray-600 rounded-full px-5 py-2 text-sm font-semibold hover:border-potads-blue hover:text-potads-blue transition-colors bg-white">Rp 100.000</button>
                    <button type="button" onclick="setAmount(250000)" class="border border-gray-200 text-gray-600 rounded-full px-5 py-2 text-sm font-semibold hover:border-potads-blue hover:text-potads-blue transition-colors bg-white">Rp 250.000</button>
                    <button type="button" onclick="setAmount(500000)" class="border border-gray-200 text-gray-600 rounded-full px-5 py-2 text-sm font-semibold hover:border-potads-blue hover:text-potads-blue transition-colors bg-white">Rp 500.000</button>
                </div>
            </div>

            <!-- Box 2: Metode Pembayaran -->
            <div class="bg-white rounded-3xl p-6 md:p-8 shadow-sm border border-gray-100">
                <div class="flex items-center gap-3 mb-6">
                    <div class="bg-blue-100 text-potads-blue p-2 rounded-lg">
                        <i data-lucide="building-2" class="w-5 h-5"></i>
                    </div>
                    <h3 class="font-bold text-gray-900">Metode Pembayaran</h3>
                </div>

                <div class="bg-white border text-potads-blue border-gray-100 rounded-2xl p-6 shadow-sm relative overflow-hidden">
                    <div class="absolute left-0 top-0 bottom-0 w-1.5 bg-potads-yellow"></div>
                    <p class="text-[10px] font-bold text-yellow-600 tracking-widest uppercase mb-1">Transfer Manual</p>
                    <h4 class="font-extrabold text-potads-blue text-lg mb-4">{{ $siteSettings['donation_bank'] ?? 'BANK RAKYAT INDONESIA (BRI)' }}</h4>
                    
                    <div class="flex flex-col md:flex-row md:items-center gap-4 md:gap-16">
                        <div>
                            <p class="text-[11px] text-gray-500 mb-0.5">Nomor Rekening:</p>
                            <p class="font-extrabold text-gray-900 tracking-wider">{{ $siteSettings['donation_account'] ?? '0005.01.002530.30.8' }}</p>
                        </div>
                        <div>
                            <p class="text-[11px] text-gray-500 mb-0.5">Atas Nama:</p>
                            <p class="font-extrabold text-gray-900">{{ $siteSettings['donation_name'] ?? 'A/N. POTADS BANDUNG' }}</p>
                        </div>
                    </div>
                </div>
                <!-- Hidden input to satisfy backend constraint for now -->
                <input type="hidden" name="payment_method" value="{{ $siteSettings['donation_bank'] ?? 'BRI' }}">
            </div>

            <!-- Box 3: Data Donatur -->
            <div class="bg-white rounded-3xl p-6 md:p-8 shadow-sm border border-gray-100">
                <div class="flex items-center gap-3 mb-6">
                    <div class="bg-blue-100 text-potads-blue p-2 rounded-lg">
                        <i data-lucide="user" class="w-5 h-5"></i>
                    </div>
                    <h3 class="font-bold text-gray-900">Data Donatur</h3>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-5 mb-5">
                    <div>
                        <label class="block text-xs font-bold text-gray-700 mb-2">Nama Lengkap</label>
                        <input type="text" name="donor_name" class="w-full bg-[#F3F4F6] rounded-xl border-none focus:ring-2 focus:ring-potads-blue px-4 py-3.5 text-sm" placeholder="Masukkan nama anda" required>
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-gray-700 mb-2">Nomor WhatsApp</label>
                        <input type="text" name="whatsapp" class="w-full bg-[#F3F4F6] rounded-xl border-none focus:ring-2 focus:ring-potads-blue px-4 py-3.5 text-sm" placeholder="0812xxxx">
                    </div>
                </div>

                <div class="mb-2">
                    <label class="block text-xs font-bold text-gray-700 mb-2">Email</label>
                    <input type="email" name="donor_email" class="w-full bg-[#F3F4F6] rounded-xl border-none focus:ring-2 focus:ring-potads-blue px-4 py-3.5 text-sm" placeholder="nama@email.com" required>
                </div>
                <p class="text-[10px] text-gray-400 mb-5">Akun akan dibuat otomatis untuk email baru agar Anda dapat melihat riwayat donasi.</p>

                <div class="mb-5">
                    <label class="block text-xs font-bold text-gray-700 mb-2">Doa / Pesan (Opsional)</label>
                    <textarea name="notes" rows="3" class="w-full bg-[#F3F4F6] rounded-xl border-none focus:ring-2 focus:ring-potads-blue px-4 py-3.5 text-sm" placeholder="Tuliskan doa atau pesan hangat Anda..."></textarea>
                </div>

                <div class="flex items-center gap-3">
                    <input type="checkbox" name="is_anonymous" id="is_anonymous" class="w-4 h-4 rounded border-gray-300 text-potads-blue focus:ring-potads-blue">
                    <label for="is_anonymous" class="text-xs text-gray-600">Sembunyikan nama saya (Hamba Allah)</label>
                </div>
            </div>

            <!-- Box 4: Bukti Tf -->
            <div class="bg-white rounded-3xl p-6 md:p-8 shadow-sm border border-gray-100">
                <div class="flex items-center gap-3 mb-6">
                    <div class="bg-blue-100 text-potads-blue p-2 rounded-lg">
                        <i data-lucide="cloud-upload" class="w-5 h-5"></i>
                    </div>
                    <h3 class="font-bold text-gray-900">Bukti Tf (screenshot)</h3>
                </div>

                <div id="image-preview-container" class="border-2 border-dashed border-gray-300 rounded-2xl p-4 text-center hover:bg-gray-50 transition-colors cursor-pointer relative overflow-hidden min-h-[200px] flex flex-col items-center justify-center">
                    <input type="file" name="proof_image" id="proof_image" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10" accept="image/*,application/pdf" onchange="previewImage(this)">
                    
                    <div id="preview-placeholder">
                        <i data-lucide="image" class="w-8 h-8 mx-auto text-gray-400 mb-3"></i>
                        <p class="text-sm text-gray-600 mb-1">Klik atau seret gambar bukti transfer di sini</p>
                        <p class="text-[10px] text-gray-400">Format JPG, PNG atau PDF (Maks. 5MB)</p>
                    </div>

                    <div id="preview-display" class="hidden w-full">
                        <img id="preview-img" src="#" alt="Preview" class="max-h-64 mx-auto rounded-lg mb-3 shadow-sm">
                        <p class="text-xs text-potads-blue font-bold">Gambar dipilih. Klik untuk mengganti.</p>
                    </div>
                </div>
            </div>

            <!-- Submit Button -->
            <button type="submit" class="w-full bg-potads-yellow text-potads-blue py-4 rounded-full font-extrabold text-sm hover:bg-yellow-400 transition-colors shadow-sm flex items-center justify-center gap-2">
                Kirim <i data-lucide="arrow-right" class="w-4 h-4"></i>
            </button>

            <!-- Terms -->
            <p class="text-center text-[10px] text-gray-500">
                Dengan mengklik tombol di atas, Anda menyetujui <a href="#" class="text-potads-blue font-semibold hover:underline">Syarat & Ketentuan</a> Bright Horizons Foundation.
            </p>

            <!-- Quote Footer Box -->
            <div class="bg-[#FFE259] rounded-3xl p-8 relative overflow-hidden mt-10 shadow-sm">
                <!-- Decorative circle -->
                <div class="absolute -bottom-16 -right-16 w-48 h-48 bg-yellow-400 rounded-full opacity-50"></div>
                
                <h3 class="text-lg md:text-xl font-extrabold text-gray-900 mb-6 relative z-10 leading-snug">
                    "Setiap rupiah yang Anda donasikan adalah cahaya harapan bagi masa depan mereka yang istimewa."
                </h3>
                
                <div class="flex items-center gap-2 relative z-10">
                    <div class="w-6 h-6 bg-potads-blue rounded-full flex items-center justify-center">
                        <i data-lucide="heart" class="w-3 h-3 text-white fill-current"></i>
                    </div>
                    <span class="text-xs font-bold text-gray-900">Tim Potads</span>
                </div>
            </div>
            
        </form>
    </div>
</div>

<script>
    function setAmount(value) {
        document.getElementById('amount').value = value;
    }

    function previewImage(input) {
        const placeholder = document.getElementById('preview-placeholder');
        const display = document.getElementById('preview-display');
        const previewImg = document.getElementById('preview-img');

        if (input.files && input.files[0]) {
            const reader = new FileReader();
            
            reader.onload = function(e) {
                if (input.files[0].type === 'application/pdf') {
                    // For PDF, we can't easily preview the content in an <img> tag
                    // but we can show a PDF icon or just the filename
                    previewImg.src = 'https://cdn-icons-png.flaticon.com/512/337/337946.png'; // Placeholder PDF icon
                } else {
                    previewImg.src = e.target.result;
                }
                
                placeholder.classList.add('hidden');
                display.classList.remove('hidden');
            }
            
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
@endsection
