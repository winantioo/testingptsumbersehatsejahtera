@extends('layouts.app')

@section('title', 'About Us - PT Sumber Sehat Sejahtera')
@section('meta_description', 'Profil PT Sumber Sehat Sejahtera, Pedagang Besar Farmasi (PBF) yang berfokus pada mutu, kepatuhan CDOB, dan layanan distribusi farmasi profesional untuk Kalimantan Selatan dan Kalimantan Tengah.')
@section('meta_keywords', 'PT Sumber Sehat Sejahtera, PBF, pedagang besar farmasi, distributor farmasi, CDOB, distribusi obat, gudang farmasi, cold chain, Kalimantan Selatan, Kalimantan Tengah, apotek, rumah sakit, toko obat berizin')
@section('canonical', route('about'))

@section('content')

<style>
    @keyframes pulseRing {
        0%   { transform: scale(1);   opacity: 0.6; }
        70%  { transform: scale(1.8); opacity: 0; }
        100% { transform: scale(1.8); opacity: 0; }
    }
    @keyframes floatY {
        0%, 100% { transform: translateY(0px); }
        50%       { transform: translateY(-10px); }
    }
    @keyframes shimmer {
        0%   { background-position: -200% center; }
        100% { background-position:  200% center; }
    }
    @keyframes countUp {
        from { opacity: 0; transform: translateY(12px); }
        to   { opacity: 1; transform: translateY(0); }
    }

    .pulse-ring::before,
    .compliance-pulse::before {
        content: '';
        position: absolute;
        inset: -5px;
        border-radius: 9999px;
        border: 2px solid currentColor;
        opacity: 0;
        animation: pulseRing 2.5s ease-out infinite;
    }

    .float-anim      { animation: floatY 4s ease-in-out infinite; }
    .float-anim-slow { animation: floatY 5s ease-in-out infinite; }

    .shimmer-text {
        background: linear-gradient(90deg, var(--tw-gradient-from) 0%, #fff 40%, var(--tw-gradient-from) 80%);
        background-size: 200% auto;
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        animation: shimmer 3s linear infinite;
    }

    .stat-item { animation: countUp 0.6s ease both; }
</style>

{{-- ══════════════════════════════════════════════
     SECTION 1 · HERO — id="perusahaankami"
══════════════════════════════════════════════ --}}
<section id="perusahaankami" class="relative w-full overflow-hidden bg-bone-white py-16 lg:py-24">

    {{-- Decorative background --}}
    <div class="absolute top-0 right-0 w-1/3 h-full bg-bone-white pointer-events-none"></div>

    <div class="max-w-7xl mx-auto px-6 lg:px-10 relative z-10">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">

            {{-- LEFT: Text --}}
            <div data-aos="fade-up" data-aos-duration="900">
                <h1 class="text-deep-blue text-4xl lg:text-5xl font-extrabold leading-tight mb-4">
                    Perusahaan Kami
                </h1>

                {{-- FIX: was bg-white (invisible on white bg) → bg-magenta-accent --}}
                <div class="w-14 h-1 bg-magenta-accent rounded-full mb-8"></div>

                <div class="space-y-5 text-deep-blue/70 text-base lg:text-[17px] leading-relaxed max-w-xl">
                    <p>
                        <strong class="text-deep-blue font-bold">PT Sumber Sehat Sejahtera</strong> hadir sebagai Pedagang Besar Farmasi (PBF) resmi yang berdedikasi penuh dalam menjaga integritas rantai pasok kesehatan. Kami mengelola seluruh proses pengadaan, penyimpanan, hingga penyaluran sediaan farmasi secara terpadu, tertib, dan transparan.
                    </p>
                    <p>
                        Dengan berlandaskan pada kepatuhan mutlak terhadap standar <strong class="text-deep-blue font-bold">Cara Distribusi Obat yang Baik (CDOB)</strong>, kami menjamin ketertelusuran dan mutu setiap produk yang kami salurkan—mulai dari fasilitas gudang yang terkontrol hingga armada transportasi yang aman, untuk seluruh mitra fasilitas kesehatan di wilayah <strong class="text-deep-blue font-bold">Kalimantan Selatan</strong> dan <strong class="text-deep-blue font-bold">Kalimantan Tengah</strong>.
                    </p>
                </div>

                {{-- CTA Buttons --}}
                <div class="flex flex-wrap gap-4 mt-10">
                    <a href="#sejarah"
                       class="bg-deep-blue text-white px-8 py-3.5 rounded-sm font-bold tracking-wider uppercase text-sm
                              hover:bg-light-blue transition-all shadow-lg hover:shadow-xl hover:-translate-y-0.5">
                        Sejarah Kami
                    </a>
                    <a href="#visimisi"
                       class="border-2 border-deep-blue text-deep-blue px-8 py-3.5 rounded-sm font-bold tracking-wider uppercase text-sm
                              hover:bg-deep-blue hover:text-white transition-all hover:-translate-y-0.5">
                        Visi & Misi
                    </a>
                    <a href="#struktur"
                       class="border-2 border-magenta-accent text-magenta-accent px-8 py-3.5 rounded-sm font-bold tracking-wider uppercase text-sm
                              hover:bg-magenta-accent hover:text-white transition-all hover:-translate-y-0.5">
                        Struktur Organisasi
                    </a>
                </div>

                {{-- Trust indicators --}}
                <div class="mt-12 flex flex-wrap items-center gap-x-8 gap-y-4 text-sm text-deep-blue/60 font-semibold"
                     data-aos="fade-up" data-aos-delay="200">
                    <span class="flex items-center gap-2">
                        <svg class="w-4 h-4 text-light-blue flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414L8.414 15l-4.121-4.121a1 1 0 111.414-1.414L8.414 12.172l7.879-7.879a1 1 0 011.414 0z" clip-rule="evenodd"/>
                        </svg>
                        Bersertifikat CDOB
                    </span>
                    <span class="hidden sm:block w-px h-4 bg-deep-blue/20"></span>
                    <span class="flex items-center gap-2">
                        <svg class="w-4 h-4 text-light-blue flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414L8.414 15l-4.121-4.121a1 1 0 111.414-1.414L8.414 12.172l7.879-7.879a1 1 0 011.414 0z" clip-rule="evenodd"/>
                        </svg>
                        Terdaftar BPOM
                    </span>
                    <span class="hidden sm:block w-px h-4 bg-deep-blue/20"></span>
                    <span class="flex items-center gap-2">
                        <svg class="w-4 h-4 text-light-blue flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414L8.414 15l-4.121-4.121a1 1 0 111.414-1.414L8.414 12.172l7.879-7.879a1 1 0 011.414 0z" clip-rule="evenodd"/>
                        </svg>
                        Distribusi Kalsel &amp; Kalteng
                    </span>
                </div>
            </div>

            {{-- RIGHT: Lottie Animation --}}
            <div class="relative flex items-center justify-center" data-aos="fade-left" data-aos-duration="1000">

                <div class="absolute -bottom-10 -left-10 w-56 h-56 bg-soft-purple/10 rounded-full blur-3xl -z-10"></div>
                <div class="absolute -top-10 -right-10 w-56 h-56 bg-magenta-accent/10 rounded-full blur-3xl -z-10"></div>

                <div class="rounded-2xl overflow-hidden border-[10px] border-white shadow-2xl relative z-20 w-full aspect-[4/3] group">
                    <dotlottie-wc
                        alt="Distribusi farmasi profesional"
                        class="w-full h-full object-cover group-hover:scale-[1.03] transition-transform duration-700"
                        src="/lottie/logistics.json"
                        background="transparent"
                        speed="1"
                        loop
                        autoplay
                        style="width: 100%; height: 100%;">
                    </dotlottie-wc>
                    <div class="absolute inset-0 bg-gradient-to-tr from-deep-blue/10 via-transparent to-magenta-accent/10 opacity-0 group-hover:opacity-100 transition-opacity"></div>
                </div>

                {{-- Floating badge --}}
                <div class="absolute -bottom-5 left-6 bg-white shadow-xl rounded-xl px-5 py-3 flex items-center gap-3 z-30"
                     data-aos="fade-up" data-aos-delay="400">
                    <div class="w-9 h-9 rounded-full bg-light-blue/10 flex items-center justify-center flex-shrink-0">
                        <svg class="w-4 h-4 text-light-blue" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                        </svg>
                    </div>
                    <div>
                        <p class="text-[10px] uppercase tracking-widest text-deep-blue/40 font-bold leading-none mb-0.5">Terjamin</p>
                        <p class="text-sm font-bold text-deep-blue leading-none">Standar CDOB &amp; BPOM</p>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

{{-- ══════════════════════════════════════════════
     SECTION 2 · SEJARAH — id="sejarah"
══════════════════════════════════════════════ --}}
<section id="sejarah" class="relative py-28 overflow-hidden bg-bone-white">

    {{-- Decorative background --}}
    <div class="absolute top-0 right-0 w-1/3 h-full bg-bone-white pointer-events-none"></div>

    {{-- FIX: Container was self-closed (></div>) making all content sit outside it --}}
    <div class="max-w-7xl mx-auto px-6 lg:px-10 relative z-10">

        {{-- Section header --}}
        {{-- FIX: Removed empty <span> that served no purpose --}}
        <div class="text-center mb-20" data-aos="fade-up">
            <h2 class="text-4xl lg:text-5xl font-extrabold text-deep-blue leading-tight mb-5">
                Sejarah
                <span class="block text-2xl lg:text-3xl font-normal text-deep-blue/40 mt-4 tracking-wide">PT Sumber Sehat Sejahtera</span>
            </h2>
            <div class="flex items-center justify-center gap-3 mb-6">
                <div class="h-px w-16 bg-gradient-to-r from-transparent to-magenta-accent"></div>
                <div class="w-2 h-2 rounded-full bg-magenta-accent"></div>
                <div class="h-px w-16 bg-gradient-to-l from-transparent to-magenta-accent"></div>
            </div>
            <p class="text-deep-blue/55 text-base lg:text-[17px] leading-relaxed max-w-2xl mx-auto">
                Sebagai Pedagang Besar Farmasi (PBF) yang terus berinovasi, PT Sumber Sehat Sejahtera membangun ekosistem
                rantai pasok logistik secara bertahap—dari fondasi kepatuhan regulasi BPOM, penguatan sistem jaminan mutu,
                hingga perluasan jaringan layanan distribusi demi seluruh mitra fasilitas kesehatan.
            </p>
        </div>

        {{-- Main content grid --}}
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 xl:gap-24 items-start">

            {{-- LEFT: Animation + Stats --}}
            <div class="sticky top-28" data-aos="fade-right" data-aos-duration="1000">

                <div class="relative float-anim">
                    <div class="absolute -top-3 -left-3 w-8 h-8 border-t-2 border-l-2 border-magenta-accent rounded-tl-lg z-20"></div>
                    <div class="absolute -bottom-3 -right-3 w-8 h-8 border-b-2 border-r-2 border-light-blue rounded-br-lg z-20"></div>
                    <div class="absolute inset-0 rounded-3xl blur-2xl opacity-30"
                         style="background: linear-gradient(135deg, rgba(31,62,135,0.3), rgba(102,160,215,0.3));"></div>
                    <div class="relative rounded-3xl overflow-hidden border border-white/80 shadow-2xl bg-white">
                        <dotlottie-wc
                            alt="Logistic checker animation"
                            src="/lottie/CheckLogistic.json"
                            background="transparent"
                            speed="1"
                            loop
                            autoplay
                            style="width: 100%; height: 380px; display: block;">
                        </dotlottie-wc>
                        <div class="absolute bottom-0 left-0 right-0 h-24 pointer-events-none"
                             style="background: linear-gradient(to top, rgba(255,255,255,0.95), transparent);">
                        </div>
                    </div>
                </div>

                {{-- Stats strip --}}
                <div class="mt-8 grid grid-cols-3 gap-0 rounded-2xl overflow-hidden shadow-md border border-deep-blue/10 bg-white">
                    <div class="stat-item text-center py-5 px-3" style="animation-delay: 0.2s">
                        <p class="text-2xl lg:text-3xl font-black text-deep-blue">15<span class="text-magenta-accent">+</span></p>
                        <p class="text-[11px] uppercase tracking-widest text-deep-blue/40 font-bold mt-1">Tahun</p>
                    </div>
                    <div class="stat-item text-center py-5 px-3 border-x border-deep-blue/10" style="animation-delay: 0.35s">
                        <p class="text-2xl lg:text-3xl font-black text-deep-blue">2<span class="text-light-blue"> Prov</span></p>
                        <p class="text-[11px] uppercase tracking-widest text-deep-blue/40 font-bold mt-1">Cakupan</p>
                    </div>
                    <div class="stat-item text-center py-5 px-3" style="animation-delay: 0.5s">
                        <p class="text-2xl lg:text-3xl font-black" style="color: #cc397d;">CDOB</p>
                        <p class="text-[11px] uppercase tracking-widest text-deep-blue/40 font-bold mt-1">Certified</p>
                    </div>
                </div>
            </div>

            {{-- RIGHT: Timeline --}}
            <div class="relative" data-aos="fade-up" data-aos-duration="900">

                {{-- Vertical guide line --}}
                <div class="absolute left-[23px] top-12 bottom-12 w-px bg-gradient-to-b from-soft-purple via-magenta-accent to-light-blue opacity-20 pointer-events-none"></div>

                <div class="space-y-0">

                    {{-- Milestone 2010 --}}
                    <div class="relative flex gap-7 pb-14" data-aos="fade-up" data-aos-delay="100">
                        <div class="relative flex-shrink-0 z-10">
                            <div class="pulse-ring relative w-12 h-12 rounded-full flex items-center justify-center shadow-lg"
                                 style="background: linear-gradient(135deg, #6b4fa0, #9b6fe0); color: #6b4fa0;">
                                <dotlottie-wc src="/lottie/founding.json" background="transparent" speed="0.8" loop autoplay style="width: 32px; height: 32px;"></dotlottie-wc>
                            </div>
                        </div>
                        <div class="flex-1">
                            <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100 hover:shadow-xl hover:-translate-y-1 transition-all duration-300 relative overflow-hidden">
                                <div class="absolute left-0 top-0 bottom-0 w-1 rounded-l-2xl" style="background: linear-gradient(to bottom, #6b4fa0, #9b6fe0);"></div>
                                <div class="flex items-start justify-between mb-3 pl-2">
                                    <span class="font-black text-3xl leading-none" style="color: #6b4fa0;">2010</span>
                                </div>
                                <h3 class="text-base font-extrabold text-deep-blue mb-2 pl-2">Pendirian &amp; Nilai Inti Perusahaan</h3>
                                <p class="text-deep-blue/55 text-sm leading-relaxed pl-2">
                                    PT Sumber Sehat Sejahtera resmi berdiri dengan visi memperkuat sistem distribusi farmasi. Sejak awal, operasional kami berlandaskan pada praktik kerja yang aman, mematuhi regulasi hukum, dan menjunjung tinggi transparansi guna membangun kepercayaan jangka panjang bersama para prinsipal dan mitra.
                                </p>
                            </div>
                        </div>
                    </div>

                    {{-- Milestone 2020 --}}
                    <div class="relative flex gap-7 pb-14" data-aos="fade-up" data-aos-delay="200">
                        <div class="relative flex-shrink-0 z-10">
                            <div class="pulse-ring relative w-12 h-12 rounded-full flex items-center justify-center shadow-lg"
                                 style="background: linear-gradient(135deg, #cc397d, #e8679f); color: #cc397d;">
                                <dotlottie-wc src="/lottie/cdob-badge.json" background="transparent" speed="0.8" loop autoplay style="width: 32px; height: 32px;"></dotlottie-wc>
                            </div>
                        </div>
                        <div class="flex-1">
                            <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100 hover:shadow-xl hover:-translate-y-1 transition-all duration-300 relative overflow-hidden">
                                <div class="absolute left-0 top-0 bottom-0 w-1 rounded-l-2xl" style="background: linear-gradient(to bottom, #cc397d, #e8679f);"></div>
                                <div class="flex items-start justify-between mb-3 pl-2">
                                    <span class="font-black text-3xl leading-none" style="color: #cc397d;">2020</span>
                                </div>
                                <h3 class="text-base font-extrabold text-deep-blue mb-2 pl-2">Standarisasi CDOB &amp; Peningkatan Mutu</h3>
                                <p class="text-deep-blue/55 text-sm leading-relaxed pl-2">
                                    Kami melakukan penguatan sistem jaminan mutu secara komprehensif untuk memenuhi standar Cara Distribusi Obat yang Baik (CDOB). Fase ini mencakup optimalisasi dokumentasi, manajemen risiko, pelatihan sumber daya manusia, serta kesiapan fasilitas rantai dingin (cold-chain) untuk mendistribusikan produk farmasi yang sensitif terhadap suhu.
                                </p>
                            </div>
                        </div>
                    </div>

                    {{-- Milestone 2026 --}}
                    <div class="relative flex gap-7" data-aos="fade-up" data-aos-delay="300">
                        <div class="relative flex-shrink-0 z-10">
                            <div class="pulse-ring relative w-12 h-12 rounded-full flex items-center justify-center shadow-lg"
                                 style="background: linear-gradient(135deg, #3b82f6, #66a0d7); color: #3b82f6;">
                                <dotlottie-wc src="/lottie/network.json" background="transparent" speed="0.8" loop autoplay style="width: 32px; height: 32px;"></dotlottie-wc>
                            </div>
                        </div>
                        <div class="flex-1">
                            <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100 hover:shadow-xl hover:-translate-y-1 transition-all duration-300 relative overflow-hidden">

                                {{-- Live badge --}}
                                <div class="absolute top-4 right-4 flex items-center gap-1.5">
                                    <span class="relative flex h-2 w-2">
                                        <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-blue-400 opacity-75"></span>
                                        <span class="relative inline-flex rounded-full h-2 w-2 bg-blue-500"></span>
                                    </span>
                                </div>

                                <div class="absolute left-0 top-0 bottom-0 w-1 rounded-l-2xl" style="background: linear-gradient(to bottom, #3b82f6, #66a0d7);"></div>
                                <div class="flex items-start justify-between mb-3 pl-2">
                                    <span class="font-black text-3xl leading-none" style="color: #3b82f6;">2026</span>
                                </div>
                                <h3 class="text-base font-extrabold text-deep-blue mb-2 pl-2">Perluasan Jaringan Distribusi Regional</h3>
                                <p class="text-deep-blue/55 text-sm leading-relaxed pl-2">
                                    Memantapkan posisi sebagai mitra penyalur farmasi terpercaya, kami kini melayani kebutuhan logistik untuk Toko Obat Berizin, Apotek, Klinik, dan Rumah Sakit (pemerintah maupun swasta) di seluruh wilayah Kalimantan Selatan dan Kalimantan Tengah. Fokus utama kami adalah jaminan ketepatan waktu pengiriman dan layanan purnajual (after-sales) yang cepat dan responsif.
                                </p>

                                {{-- Coverage tags --}}
                                <div class="flex flex-wrap gap-2 mt-4 pl-2">
                                    <span class="inline-flex items-center gap-1 text-xs font-semibold text-blue-600 bg-blue-50 px-3 py-1 rounded-full">
                                        <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/>
                                        </svg>
                                        Kalimantan Selatan
                                    </span>
                                    <span class="inline-flex items-center gap-1 text-xs font-semibold text-blue-600 bg-blue-50 px-3 py-1 rounded-full">
                                        <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/>
                                        </svg>
                                        Kalimantan Tengah
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            {{-- end timeline --}}

        </div>
    </div>
    {{-- FIX: Closing tag for the corrected max-w-7xl container --}}
</section>

{{-- ══════════════════════════════════════════════
     SECTION 3 · VISI & MISI — id="visimisi"
══════════════════════════════════════════════ --}}
<section id="visimisi" class="relative py-28 overflow-hidden bg-bone-white">

    {{-- Decorative background --}}
    <div class="absolute top-0 right-0 w-1/3 h-full bg-bone-white pointer-events-none"></div>

    {{-- Top gradient line --}}
    <div class="absolute top-0 left-0 w-full h-[3px]"
         style="background: linear-gradient(90deg, #6b4fa0, #cc397d, #66a0d7);"></div>

    <div class="absolute inset-0 pointer-events-none"
         style="background: radial-gradient(ellipse 80% 60% at 50% 50%, transparent 30%, #FAF9F7 100%);">
    </div>

    <div class="max-w-[1280px] mx-auto px-6 lg:px-10 relative z-10">

        {{-- Section header --}}
        {{-- FIX: Removed empty <span> --}}
        <div class="text-center mb-16" data-aos="fade-up">
            <h2 class="text-4xl lg:text-5xl font-extrabold text-deep-blue leading-tight mb-5">
                Visi & Misi
                <span class="block text-2xl lg:text-3xl font-normal text-deep-blue/40 mt-1 tracking-wide">PT Sumber Sehat Sejahtera</span>
            </h2>
            <div class="flex items-center justify-center gap-3 mb-6">
                <div class="h-px w-16 bg-gradient-to-r from-transparent to-magenta-accent"></div>
                <div class="w-2 h-2 rounded-full bg-magenta-accent"></div>
                <div class="h-px w-16 bg-gradient-to-l from-transparent to-magenta-accent"></div>
            </div>
            <p class="text-deep-blue/55 text-base lg:text-[17px] leading-relaxed max-w-2xl mx-auto">
                Dalam distribusi farmasi, kepatuhan prosedur membantu menjaga mutu, keamanan, dan efektivitas produk
                hingga diterima oleh fasilitas kesehatan—melalui disiplin operasional, kontrol dokumentasi, serta
                pengawasan proses penyimpanan dan pengiriman.
            </p>
        </div>

        {{-- Visi & Misi cards --}}
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-12">

            {{-- CARD: VISI --}}
            <div class="group relative bg-white rounded-3xl overflow-hidden shadow-sm border border-gray-100
                        hover:shadow-2xl hover:-translate-y-1 transition-all duration-500"
                 data-aos="fade-right" data-aos-duration="900">

                <div class="absolute left-0 top-0 bottom-0 w-1.5 rounded-l-3xl"
                     style="background: linear-gradient(to bottom, #6b4fa0, #9b6fe0);"></div>
                <div class="absolute -top-12 -right-12 w-36 h-36 rounded-full opacity-[0.06]" style="background: #6b4fa0;"></div>

                <div class="p-8 pl-10">
                    <div class="flex items-center gap-5 mb-6">
                        <div class="relative compliance-pulse float-anim-slow flex-shrink-0" style="color: #6b4fa0;">
                            <div class="w-16 h-16 rounded-2xl flex items-center justify-center overflow-hidden shadow-md"
                                 style="background: linear-gradient(135deg, rgba(107,79,160,0.12), rgba(155,111,224,0.08)); border: 1px solid rgba(107,79,160,0.15);">
                                <dotlottie-wc src="/lottie/vision.json" background="transparent" speed="1" loop autoplay style="width: 48px; height: 48px;"></dotlottie-wc>
                            </div>
                        </div>
                        <div>
                            <span class="text-[10px] font-bold tracking-[0.25em] uppercase px-2.5 py-1 rounded-full"
                                  style="background: rgba(107,79,160,0.08); color: #6b4fa0;">Vision</span>
                            <h3 class="text-2xl font-extrabold text-deep-blue mt-1">Visi</h3>
                        </div>
                    </div>

                    <div class="w-12 h-0.5 rounded-full mb-5" style="background: #6b4fa0; opacity: 0.3;"></div>

                    <p class="text-deep-blue/70 leading-relaxed text-[15px]">
                        Menjadi Pedagang Besar Farmasi (PBF) terkemuka di Kalimantan yang menjadi pilihan utama dalam distribusi sediaan farmasi, didukung oleh integritas SDM profesional dan sistem manajemen mutu yang terintegrasi.
                    </p>

                    <div class="mt-6 pt-5 border-t border-gray-100 flex items-center gap-3">
                        <svg class="w-5 h-5 flex-shrink-0 opacity-30" style="color: #6b4fa0;" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M14.017 21v-7.391c0-5.704 3.731-9.57 8.983-10.609l.995 2.151c-2.432.917-3.995 3.638-3.995 5.849h4v10h-9.983zm-14.017 0v-7.391c0-5.704 3.748-9.57 9-10.609l.996 2.151c-2.433.917-3.996 3.638-3.996 5.849h3.983v10h-9.983z"/>
                        </svg>
                        <p class="text-xs text-deep-blue/40 font-medium italic">Pilihan utama distribusi farmasi di Kalimantan</p>
                    </div>
                </div>
            </div>

            {{-- CARD: MISI --}}
            <div class="group relative bg-white rounded-3xl overflow-hidden shadow-sm border border-gray-100
                        hover:shadow-2xl hover:-translate-y-1 transition-all duration-500"
                 data-aos="fade-left" data-aos-duration="900">

                <div class="absolute left-0 top-0 bottom-0 w-1.5 rounded-l-3xl"
                     style="background: linear-gradient(to bottom, #cc397d, #e8679f);"></div>
                <div class="absolute -top-12 -right-12 w-36 h-36 rounded-full opacity-[0.06]" style="background: #cc397d;"></div>

                <div class="p-8 pl-10">
                    <div class="flex items-center gap-5 mb-6">
                        <div class="relative compliance-pulse flex-shrink-0" style="color: #cc397d;">
                            <div class="w-16 h-16 rounded-2xl flex items-center justify-center shadow-md"
                                 style="background: linear-gradient(135deg, rgba(204,57,125,0.12), rgba(232,103,159,0.08)); border: 1px solid rgba(204,57,125,0.15);">
                                <span class="material-symbols-outlined text-3xl" style="color: #cc397d;">track_changes</span>
                            </div>
                        </div>
                        <div>
                            <span class="text-[10px] font-bold tracking-[0.25em] uppercase px-2.5 py-1 rounded-full"
                                  style="background: rgba(204,57,125,0.08); color: #cc397d;">Mission</span>
                            <h3 class="text-2xl font-extrabold text-deep-blue mt-1">Misi</h3>
                        </div>
                    </div>

                    <div class="w-12 h-0.5 rounded-full mb-5" style="background: #cc397d; opacity: 0.3;"></div>

                    <div class="space-y-4">
                        @foreach([
                            ['delay' => '100', 'text' => 'Mendistribusikan ketersediaan farmasi di fasilitas kesehatan secara merata di perkotaan maupun pedesaan di Provinsi Kalimantan Selatan dan Tengah.'],
                            ['delay' => '180', 'text' => 'Menjadi distributor berbagai pabrikan farmasi dengan penyediaan barang yang relatif lengkap dan berkesinambungan.'],
                            ['delay' => '260', 'text' => 'Memperkuat layanan melalui kontrol mutu, ketertelusuran, serta ketepatan proses pengiriman agar mitra menerima produk dalam kondisi terbaik.'],
                        ] as $item)
                        <div class="flex gap-3 items-start" data-aos="fade-up" data-aos-delay="{{ $item['delay'] }}">
                            <div class="flex-shrink-0 w-6 h-6 rounded-full flex items-center justify-center mt-0.5"
                                 style="background: rgba(204,57,125,0.1);">
                                <svg class="w-3 h-3" style="color: #cc397d;" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414L8.414 15l-4.121-4.121a1 1 0 111.414-1.414L8.414 12.172l7.879-7.879a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                </svg>
                            </div>
                            <p class="text-deep-blue/70 text-[14px] leading-relaxed">{{ $item['text'] }}</p>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>

        </div>

        {{-- Compliance highlights strip --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-5" data-aos="fade-up" data-aos-delay="150">

            @foreach([
                ['color' => '#6b4fa0', 'bg' => 'rgba(107,79,160,0.08)', 'from' => '#6b4fa0', 'to' => '#9b6fe0',
                 'icon' => 'manage_search', 'label' => 'Traceability', 'title' => 'Ketertelusuran',
                 'desc' => 'Dokumentasi dan kontrol proses untuk mendukung visibilitas distribusi dan penanganan produk yang tertib.'],
                ['color' => '#cc397d', 'bg' => 'rgba(204,57,125,0.08)', 'from' => '#cc397d', 'to' => '#e8679f',
                 'icon' => 'inventory_2', 'label' => 'Product Handling', 'title' => 'Penanganan Produk',
                 'desc' => 'Penyimpanan dan pengiriman mengikuti kebutuhan produk untuk menjaga stabilitas dan kualitasnya.'],
                ['color' => '#3b82f6', 'bg' => 'rgba(59,130,246,0.08)', 'from' => '#3b82f6', 'to' => '#66a0d7',
                 'icon' => 'verified_user', 'label' => 'Service Level', 'title' => 'Konsistensi Layanan',
                 'desc' => 'Fokus pada akurasi pesanan, ketepatan waktu, dan komunikasi yang jelas kepada mitra.'],
            ] as $card)
            <div class="group relative bg-white rounded-2xl p-6 shadow-sm border border-gray-100
                        hover:shadow-lg hover:-translate-y-0.5 transition-all duration-300 overflow-hidden">
                <div class="absolute top-0 left-0 right-0 h-0.5 rounded-t-2xl scale-x-0 group-hover:scale-x-100 transition-transform duration-500 origin-left"
                     style="background: linear-gradient(90deg, {{ $card['from'] }}, {{ $card['to'] }});"></div>
                <div class="w-9 h-9 rounded-xl flex items-center justify-center mb-4"
                     style="background: {{ $card['bg'] }};">
                    <span class="material-symbols-outlined text-[18px]" style="color: {{ $card['color'] }};">{{ $card['icon'] }}</span>
                </div>
                <p class="text-[10px] uppercase tracking-[0.25em] font-bold mb-1" style="color: {{ $card['color'] }};">{{ $card['label'] }}</p>
                <h4 class="font-extrabold text-deep-blue text-[15px] mb-2">{{ $card['title'] }}</h4>
                <p class="text-sm text-deep-blue/55 leading-relaxed">{{ $card['desc'] }}</p>
            </div>
            @endforeach

        </div>
    </div>
</section>

{{-- ══════════════════════════════════════════════
     SECTION 4 · STRUKTUR ORGANISASI — id="struktur"
══════════════════════════════════════════════ --}}
<section id="struktur" class="relative py-24 overflow-hidden bg-bone-white">

    {{-- Decorative background --}}
    <div class="absolute top-0 right-0 w-1/3 h-full bg-bone-white pointer-events-none"></div>

    <div class="max-w-7xl mx-auto px-6 lg:px-10 relative z-10">

        {{-- Section header --}}
        {{-- FIX: Removed empty <span> --}}
        <div class="text-center mb-12" data-aos="fade-up">
            <h2 class="text-4xl lg:text-5xl font-extrabold text-deep-blue leading-tight mb-4">
                Struktur Organisasi
            </h2>
            <span class="block text-xl lg:text-2xl font-normal text-deep-blue/40 tracking-wide mb-5">
                PT Sumber Sehat Sejahtera
            </span>
            <div class="flex items-center justify-center gap-3">
                <div class="h-px w-16 bg-gradient-to-r from-transparent to-magenta-accent"></div>
                <div class="w-2 h-2 rounded-full bg-magenta-accent"></div>
                <div class="h-px w-16 bg-gradient-to-l from-transparent to-magenta-accent"></div>
            </div>
        </div>

        {{-- Image container --}}
        <div class="relative rounded-3xl overflow-hidden shadow-2xl border border-gray-100" data-aos="fade-up" data-aos-delay="100">
            <div class="absolute -top-3 -left-3 w-8 h-8 border-t-2 border-l-2 border-magenta-accent rounded-tl-lg z-20 pointer-events-none"></div>
            <div class="absolute -bottom-3 -right-3 w-8 h-8 border-b-2 border-r-2 border-light-blue rounded-br-lg z-20 pointer-events-none"></div>

            <div class="w-full bg-white">
                {{-- FIX: Vite::asset('public/images/...') → asset('images/...') untuk public assets --}}
                <img
                    src="{{ asset('images/Struktur_pt3s.jpg') }}"
                    alt="Struktur Organisasi PT Sumber Sehat Sejahtera"
                    class="w-full h-auto object-contain block"
                    loading="lazy">
            </div>

            <div class="absolute inset-0 rounded-3xl ring-1 ring-inset ring-deep-blue/5 pointer-events-none"></div>
        </div>

    </div>
</section>

@endsection