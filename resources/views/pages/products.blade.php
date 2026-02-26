@extends('layouts.app')

@section('title', 'Products - PT Sumber Sehat Sejahtera')

@section('content')

<style>
    /* Badge icon spin on hover */
    .badge-icon {
        transition: transform 0.35s cubic-bezier(0.34, 1.56, 0.64, 1), color 0.2s ease;
    }
    .product-badge:hover .badge-icon {
        transform: rotate(20deg) scale(1.2);
    }

    /* Card image zoom */
    .product-img {
        transition: transform 0.5s cubic-bezier(0.25, 0.46, 0.45, 0.94);
    }
    .product-card:hover .product-img {
        transform: scale(1.06);
    }

    /* Zoom overlay icon bounce */
    .zoom-icon {
        transition: transform 0.3s cubic-bezier(0.34, 1.56, 0.64, 1), opacity 0.2s ease;
        transform: scale(0.7);
        opacity: 0;
    }
    .product-card:hover .zoom-icon {
        transform: scale(1);
        opacity: 1;
    }
</style>

{{-- ═══════════════════════════════════════════
     1. HEADER / SEARCH & FILTER
═══════════════════════════════════════════ --}}
<section class="bg-bone-white border-b border-deep-blue/10">
    <div class="max-w-[1280px] mx-auto px-6 lg:px-10 py-10 lg:py-12">
        <div class="flex flex-col lg:flex-row lg:items-end lg:justify-between gap-6">

            {{-- Title --}}
            <div data-aos="fade-up">
                <p class="text-magenta-accent font-bold tracking-[0.3em] uppercase text-xs mb-3">Products</p>
                <h1 class="text-3xl md:text-4xl lg:text-5xl font-extrabold text-deep-blue tracking-tight leading-tight">
                    Katalog Produk
                </h1>
                <p class="mt-3 text-deep-blue/60 text-sm max-w-2xl">
                    Cari berdasarkan nama obat, kategori, atau principal.
                </p>
            </div>

            {{-- Search & Filter Form --}}
            <form method="GET" action="{{ url()->current() }}" class="w-full lg:w-[700px]" data-aos="fade-up" data-aos-delay="120">
                <div class="flex flex-col sm:flex-row gap-3">

                    {{-- Nama Obat --}}
                    <div class="flex-1 relative">
                        <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-deep-blue/35 text-[20px]">
                            search
                        </span>
                        <input
                            name="q"
                            value="{{ request('q') }}"
                            placeholder="Cari nama obat..."
                            class="w-full bg-white border border-deep-blue/10 rounded-sm pl-11 pr-4 py-3 text-sm focus:outline-none focus:border-magenta-accent"
                            autocomplete="off">
                    </div>

                    {{-- Kategori --}}
                    <div class="relative w-full sm:w-[180px]">
                        <select name="category" onchange="this.form.submit()"
                            class="w-full bg-white border border-deep-blue/10 rounded-sm px-4 py-3 text-sm focus:outline-none focus:border-magenta-accent appearance-none cursor-pointer">
                            <option value="">Semua Kategori</option>
                            @isset($categories)
                                @foreach($categories as $cat)
                                    <option value="{{ $cat->slug }}" {{ request('category') == $cat->slug ? 'selected' : '' }}>
                                        {{ $cat->name_id }}
                                    </option>
                                @endforeach
                            @endisset
                        </select>
                        <span class="material-symbols-outlined absolute right-3 top-1/2 -translate-y-1/2 text-deep-blue/50 pointer-events-none text-[20px]">expand_more</span>
                    </div>

                    {{-- Principal --}}
                    <div class="relative w-full sm:w-[180px]">
                        <select name="manufacturer" onchange="this.form.submit()"
                            class="w-full bg-white border border-deep-blue/10 rounded-sm px-4 py-3 text-sm focus:outline-none focus:border-magenta-accent appearance-none cursor-pointer">
                            <option value="">Semua Principal</option>
                            @isset($manufacturers)
                                @foreach($manufacturers as $mfg)
                                    <option value="{{ $mfg }}" {{ request('manufacturer') == $mfg ? 'selected' : '' }}>
                                        {{ Str::limit($mfg, 15) }}
                                    </option>
                                @endforeach
                            @endisset
                        </select>
                        <span class="material-symbols-outlined absolute right-3 top-1/2 -translate-y-1/2 text-deep-blue/50 pointer-events-none text-[20px]">expand_more</span>
                    </div>

                    <button type="submit"
                        class="bg-deep-blue hover:bg-light-blue text-white rounded-sm px-6 py-3 text-sm font-extrabold shadow-md transition-all duration-200">
                        Cari
                    </button>
                </div>

                {{-- Filter Active Indicator --}}
                @if(request('q') || request('category') || request('manufacturer'))
                    <div class="mt-3 flex items-center justify-between bg-white border border-deep-blue/5 py-2 px-3 rounded-sm shadow-sm">
                        <div class="flex flex-wrap gap-2 text-xs text-deep-blue/60">
                            <span class="font-bold uppercase tracking-widest mr-2 text-deep-blue/40">Filter:</span>
                            @if(request('q'))
                                <span class="bg-bone-white px-2 py-0.5 rounded border border-deep-blue/10">"{{ request('q') }}"</span>
                            @endif
                            @if(request('category'))
                                <span class="bg-bone-white px-2 py-0.5 rounded border border-deep-blue/10">Kategori Aktif</span>
                            @endif
                            @if(request('manufacturer'))
                                <span class="bg-bone-white px-2 py-0.5 rounded border border-deep-blue/10">{{ request('manufacturer') }}</span>
                            @endif
                        </div>
                        <a href="{{ url()->current() }}"
                           class="text-xs font-extrabold uppercase tracking-widest text-magenta-accent hover:underline whitespace-nowrap ml-4">
                            Reset Filters
                        </a>
                    </div>
                @endif
            </form>

        </div>
    </div>
</section>

{{-- ═══════════════════════════════════════════
     2. GRID PRODUK + ALPINE MODAL
═══════════════════════════════════════════ --}}
<section
    x-data="{ modalOpen: false, modalImage: '', modalTitle: '' }"
    class="max-w-[1280px] mx-auto px-6 lg:px-10 py-10 lg:py-14">

    {{-- Info Bar --}}
    <div class="flex items-center justify-between mb-6" data-aos="fade-up">
        <p class="text-xs font-bold uppercase tracking-widest text-deep-blue/50">
            @if(method_exists($products, 'total'))
                Menampilkan {{ $products->firstItem() ?? 0 }}–{{ $products->lastItem() ?? 0 }}
                dari {{ $products->total() }} produk
            @else
                Hasil produk
            @endif
        </p>

        <a href="{{ route('contact') }}"
           class="hidden md:inline-flex items-center gap-2 bg-deep-blue hover:bg-light-blue text-white px-5 py-2.5 rounded-sm text-xs font-extrabold uppercase tracking-widest shadow-md transition-all duration-200">
            Request Info
            <span class="material-symbols-outlined text-[16px]">arrow_forward</span>
        </a>
    </div>

    {{-- Product Grid --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
        @forelse($products as $p)
            @php
                $img = $p->image_url ?? 'https://placehold.co/800x800?text=No+Image';
            @endphp

            <article class="product-card bg-white border border-deep-blue/10 rounded-xl overflow-hidden shadow-sm hover:shadow-xl transition-shadow duration-300 flex flex-col"
                     data-aos="fade-up">

                {{-- Image — opens modal --}}
                <div
                    @click="modalOpen = true; modalImage = '{{ $img }}'; modalTitle = @js($p->name)"
                    class="aspect-square bg-bone-white border-b border-deep-blue/10 overflow-hidden relative cursor-pointer">

                    <img src="{{ $img }}"
                         alt="{{ $p->name }}"
                         class="product-img w-full h-full object-cover"
                         loading="lazy">

                    <div class="absolute inset-0 bg-deep-blue/25 opacity-0 hover:opacity-100 transition-opacity duration-200 flex items-center justify-center">
                        <span class="material-symbols-outlined zoom-icon text-white text-4xl drop-shadow-md">zoom_in</span>
                    </div>
                </div>

                {{-- Card Body --}}
                <div class="p-5 flex flex-col flex-grow">
                    <h3 class="font-extrabold text-deep-blue text-[15px] leading-snug line-clamp-2 min-h-[44px]">
                        {{ $p->name }}
                    </h3>

                    {{-- Badges --}}
                    <div class="mt-3 flex flex-wrap gap-2">
                        {{-- Kategori --}}
                        <span class="product-badge inline-flex items-center gap-1.5 rounded-full border border-deep-blue/10 bg-bone-white px-3 py-1 text-[10px] font-extrabold uppercase tracking-widest text-deep-blue/60 cursor-default select-none">
                            <span class="material-symbols-outlined badge-icon text-[14px] text-magenta-accent">category</span>
                            {{ $p->type ?? 'Umum' }}
                        </span>

                        {{-- Pabrikan --}}
                        @if($p->manufacturer)
                            <span class="product-badge inline-flex items-center gap-1.5 rounded-full border border-deep-blue/10 bg-bone-white px-3 py-1 text-[10px] font-extrabold uppercase tracking-widest text-deep-blue/60 cursor-default select-none">
                                <span class="material-symbols-outlined badge-icon text-[14px] text-soft-purple">precision_manufacturing</span>
                                {{ Str::limit($p->manufacturer, 12) }}
                            </span>
                        @endif
                    </div>

                    <div class="flex-grow"></div>

                    <div class="mt-5">
                        <a href="{{ route('contact') }}"
                           class="inline-flex items-center justify-center w-full gap-2 bg-deep-blue hover:bg-light-blue text-white px-4 py-3 rounded-sm text-xs font-extrabold uppercase tracking-widest shadow-md transition-all duration-200">
                            Request
                            <span class="material-symbols-outlined text-[16px]">arrow_forward</span>
                        </a>
                    </div>
                </div>
            </article>

        @empty
            <div class="col-span-full bg-white border border-deep-blue/10 rounded-xl p-12 text-center flex flex-col items-center justify-center">
                <span class="material-symbols-outlined text-5xl text-deep-blue/20 mb-3">search_off</span>
                <p class="text-deep-blue/70 font-extrabold text-lg">Produk tidak ditemukan.</p>
                <p class="text-sm text-deep-blue/50 mt-1">Coba sesuaikan kata kunci atau reset filter pencarian Anda.</p>
            </div>
        @endforelse
    </div>

    {{-- Pagination --}}
    @if(method_exists($products, 'links'))
        <div class="mt-10">
            {{ $products->appends(request()->query())->links() }}
        </div>
    @endif

    {{-- ═══════════════════════════════════════════
         3. ALPINE MODAL (Lightbox)
    ═══════════════════════════════════════════ --}}
    <div
        x-show="modalOpen"
        style="display: none;"
        class="fixed inset-0 z-50 flex items-center justify-center p-4 sm:p-6">

        {{-- Overlay --}}
        <div
            x-show="modalOpen"
            x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100"
            x-transition:leave="transition ease-in duration-150"
            x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0"
            @click="modalOpen = false"
            class="absolute inset-0 bg-deep-blue/90 backdrop-blur-sm cursor-pointer">
        </div>

        {{-- Modal Container --}}
        <div
            x-show="modalOpen"
            x-transition:enter="transition ease-out duration-250"
            x-transition:enter-start="opacity-0 scale-90"
            x-transition:enter-end="opacity-100 scale-100"
            x-transition:leave="transition ease-in duration-150"
            x-transition:leave-start="opacity-100 scale-100"
            x-transition:leave-end="opacity-0 scale-90"
            @click.stop
            class="relative z-10 w-full max-w-md md:max-w-lg bg-white rounded-xl shadow-2xl overflow-hidden">

            {{-- Close Button --}}
            <button
                @click="modalOpen = false"
                class="absolute top-3 right-3 bg-white/80 hover:bg-magenta-accent text-deep-blue hover:text-white rounded-full p-1.5 transition-colors duration-200 shadow-sm z-20"
                aria-label="Tutup">
                <span class="material-symbols-outlined text-[20px] block">close</span>
            </button>

            {{-- Image --}}
            <div class="w-full aspect-square bg-bone-white flex items-center justify-center p-4">
                <img :src="modalImage"
                     :alt="modalTitle"
                     class="max-w-full max-h-full object-contain rounded-md">
            </div>

            {{-- Title --}}
            <div class="bg-deep-blue p-4 text-center">
                <h4 x-text="modalTitle" class="text-white font-extrabold text-base leading-snug"></h4>
            </div>
        </div>
    </div>

</section>

@endsection