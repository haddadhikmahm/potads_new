@extends('layouts.admin')

@section('title', 'Site Settings')

@section('header_title', 'Pengaturan Situs')
@section('header_breadcrumb', 'Website Configuration')

@section('content')
<div class="max-w-4xl">
    <form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data" class="space-y-8">
        @csrf
        @method('PUT')

        @foreach($settings as $group => $items)
        <div class="bg-white rounded-[2.5rem] shadow-sm border border-slate-100 p-8 md:p-12 mb-8">
            <div class="flex items-center gap-3 mb-10 text-potads-blue">
                <i data-lucide="{{ $group === 'general' ? 'settings' : ($group === 'contact' ? 'phone' : 'share-2') }}" class="w-6 h-6"></i>
                <h2 class="text-xl font-bold capitalize">{{ $group }} Settings</h2>
            </div>

            <div class="space-y-8">
                @foreach($items as $setting)
                <div class="space-y-2">
                    <label class="text-[10px] font-bold text-potads-blue uppercase tracking-wider ml-1">{{ $setting->label }}</label>
                    
                    @if($setting->type === 'textarea')
                        <textarea name="{{ $setting->key }}" rows="3"
                            class="w-full px-6 py-4 bg-slate-50 border-none rounded-2xl focus:ring-2 focus:ring-potads-blue/10 transition-all text-slate-700 font-medium">{{ $setting->value }}</textarea>
                    @elseif($setting->type === 'image')
                        <div class="flex items-center gap-6 p-4 bg-slate-50 rounded-2xl">
                            <div class="w-16 h-16 bg-white rounded-xl border border-slate-100 overflow-hidden flex-shrink-0">
                                @if($setting->value)
                                    <img src="{{ asset('storage/' . $setting->value) }}" class="w-full h-full object-cover">
                                @else
                                    <div class="w-full h-full flex items-center justify-center text-slate-300">
                                        <i data-lucide="image" class="w-6 h-6"></i>
                                    </div>
                                @endif
                            </div>
                            <input type="file" name="{{ $setting->key }}" 
                                class="text-xs text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-xs file:font-bold file:bg-potads-blue/10 file:text-potads-blue hover:file:bg-potads-blue/20 transition-all">
                        </div>
                    @else
                        <input type="text" name="{{ $setting->key }}" value="{{ $setting->value }}"
                            class="w-full px-6 py-4 bg-slate-50 border-none rounded-2xl focus:ring-2 focus:ring-potads-blue/10 transition-all text-slate-700 font-medium">
                    @endif
                </div>
                @endforeach
            </div>
        </div>
        @endforeach

        <div class="flex items-center gap-4 fixed bottom-8 right-8 z-40 bg-white/80 backdrop-blur-lg p-2 rounded-3xl border border-slate-100 shadow-2xl">
            <button type="submit" class="px-10 py-4 bg-potads-blue text-white rounded-2xl font-bold shadow-lg shadow-blue-900/20 hover:scale-[1.02] active:scale-[0.98] transition-all flex items-center gap-2">
                <i data-lucide="save" class="w-5 h-5"></i>
                Simpan Semua Perubahan
            </button>
        </div>
    </form>
</div>
@endsection
