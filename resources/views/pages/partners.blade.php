@extends('layouts.app')

@section('title', 'Mitra & Principal - PT Sumber Sehat Sejahtera')

@section('content')

{{-- ================================================================
     1. PRINCIPAL SECTION
     ================================================================ --}}
<section id="principal" class="relative w-full py-20 bg-bone-white overflow-hidden">

    {{-- Decorative backgrounds --}}
    <div class="absolute top-0 right-0 w-1/2 h-full bg-gradient-to-l from-deep-blue/5 to-transparent pointer-events-none"></div>
    <div class="absolute -left-20 top-20 w-72 h-72 bg-magenta-accent/10 rounded-full blur-3xl pointer-events-none"></div>

    <div class="max-w-7xl mx-auto px-6 lg:px-10 relative z-10">

        <div class="text-center mb-14">
            <h1 class="text-4xl md:text-5xl lg:text-6xl font-black text-deep-blue tracking-tight" data-aos="fade-up">
                Principal
            </h1>
            <p class="mt-4 text-deep-blue/60 text-sm md:text-base max-w-4xl mx-auto" data-aos="fade-up" data-aos-delay="100">
                Perusahaan-perusahaan farmasi terkemuka yang mempercayakan distribusinya kepada kami.
            </p>
        </div>

        @php $partners = $partners ?? []; @endphp

        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-6 lg:gap-8 items-center justify-center">
            @forelse($partners as $index => $partner)
                <div class="bg-white rounded-xl border border-gray-200 aspect-[4/3] flex items-center justify-center p-6 overflow-hidden hover:shadow-md transition-shadow duration-300"
                     data-aos="fade-up"
                     data-aos-delay="{{ min($index * 50, 400) }}">
                    <img src="{{ $partner->logo_url ?? 'https://placehold.co/400x300?text=Logo' }}"
                         alt="Logo {{ $partner->name ?? 'Principal' }}"
                         class="w-full h-full object-contain"
                         loading="lazy">
                </div>
            @empty
                <div class="col-span-full py-10 text-center text-gray-400">
                    <span class="material-symbols-outlined text-4xl mb-2 opacity-50">imagesmode</span>
                    <p class="text-sm font-medium mt-2">Logo principal akan ditampilkan di sini.</p>
                </div>
            @endforelse
        </div>

    </div>
</section>


{{-- ================================================================
     2. MITRA SECTION — Infinite Marquee + Tombol Geser
     ================================================================ --}}
<section id="mitra" class="w-full py-20 bg-white border-t border-gray-100 overflow-hidden">

    <div class="max-w-7xl mx-auto px-6 lg:px-10">
        <div class="text-center mb-14">
            <h2 class="text-4xl md:text-5xl lg:text-6xl font-black text-deep-blue tracking-tight" data-aos="fade-up">
                Mitra
            </h2>
            <p class="mt-4 text-deep-blue/55 text-sm md:text-base max-w-4xl mx-auto" data-aos="fade-up" data-aos-delay="100">
                Jaringan mitra apotek, logistik, dan layanan kesehatan yang berkolaborasi bersama kami.
            </p>
        </div>
    </div>

    @php
        $namaMapping = [
            'logo_apotik_ss'         => 'APOTEK SUMBER SEHAT',
            'logo_citra_sehat_utama' => 'PT CITRA SEHAT UTAMA',
            'logo_hancap'            => 'HANCAP (HANTARAN CEPAT)',
            'logo_ghifa_express'     => 'GHIFA EXPRESS',
            'logo_hitori_logistik'   => 'HITORI LOGISTIK',
            'logo_rentokill'         => 'RENTOKILL',
        ];

        $mitraPath  = public_path('images/mitra');
        $extensions = ['jpg', 'jpeg', 'png', 'webp', 'gif', 'svg'];
        $mitraFiles = [];

        if (is_dir($mitraPath)) {
            foreach (scandir($mitraPath) as $file) {
                if ($file === '.' || $file === '..') continue;
                $ext = strtolower(pathinfo($file, PATHINFO_EXTENSION));
                if (!in_array($ext, $extensions)) continue;

                $key  = pathinfo($file, PATHINFO_FILENAME);
                $name = $namaMapping[$key]
                    ?? strtoupper(str_replace(['_', '-'], ' ', $key));

                $mitraFiles[] = ['file' => $file, 'name' => $name];
            }
        }
    @endphp

    @if(count($mitraFiles) > 0)
        <div class="relative" data-aos="fade-up" data-aos-delay="200">

            {{-- Tombol Prev --}}
            <button id="mitraPrev"
                class="absolute left-4 top-1/2 -translate-y-1/2 z-20 w-10 h-10 bg-white border border-gray-200 rounded-full shadow-md flex items-center justify-center text-deep-blue hover:bg-deep-blue hover:text-white hover:border-deep-blue transition-all duration-200"
                aria-label="Sebelumnya">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7"/>
                </svg>
            </button>

            {{-- Tombol Next --}}
            <button id="mitraNext"
                class="absolute right-4 top-1/2 -translate-y-1/2 z-20 w-10 h-10 bg-white border border-gray-200 rounded-full shadow-md flex items-center justify-center text-deep-blue hover:bg-deep-blue hover:text-white hover:border-deep-blue transition-all duration-200"
                aria-label="Berikutnya">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/>
                </svg>
            </button>

            {{-- Fade edges --}}
            <div class="absolute left-0 top-0 h-full w-24 bg-gradient-to-r from-white to-transparent z-10 pointer-events-none"></div>
            <div class="absolute right-0 top-0 h-full w-24 bg-gradient-to-l from-white to-transparent z-10 pointer-events-none"></div>

            {{-- Track --}}
            <div class="overflow-hidden" id="mitraViewport">
                <div class="flex gap-8 w-max" id="mitraTrack">

                    {{-- Set 1 --}}
                    @foreach($mitraFiles as $logo)
                        <div class="group flex-shrink-0 flex flex-col items-center gap-4 w-44">
                            <div class="w-full bg-white rounded-2xl border border-gray-100 shadow-sm h-28 flex items-center justify-center p-5 group-hover:shadow-md group-hover:border-light-blue/40 transition-all duration-300">
                                <img src="{{ asset('images/mitra/' . $logo['file']) }}"
                                     alt="{{ $logo['name'] }}"
                                     class="max-w-full max-h-full object-contain transition-all duration-300"
                                     loading="lazy">
                            </div>
                            <p class="text-center text-[10px] font-bold text-deep-blue/50 group-hover:text-deep-blue tracking-widest uppercase leading-tight transition-colors duration-300">
                                {{ $logo['name'] }}
                            </p>
                        </div>
                    @endforeach

                    {{-- Set 2 — duplikat untuk infinite loop --}}
                    @foreach($mitraFiles as $logo)
                        <div class="group flex-shrink-0 flex flex-col items-center gap-4 w-44" aria-hidden="true">
                            <div class="w-full bg-white rounded-2xl border border-gray-100 shadow-sm h-28 flex items-center justify-center p-5 group-hover:shadow-md group-hover:border-light-blue/40 transition-all duration-300">
                                <img src="{{ asset('images/mitra/' . $logo['file']) }}"
                                     alt=""
                                     class="max-w-full max-h-full object-contain transition-all duration-300"
                                     loading="lazy">
                            </div>
                            <p class="text-center text-[10px] font-bold text-deep-blue/50 group-hover:text-deep-blue tracking-widest uppercase leading-tight transition-colors duration-300">
                                {{ $logo['name'] }}
                            </p>
                        </div>
                    @endforeach

                </div>
            </div>
        </div>
    @else
        <div class="max-w-7xl mx-auto px-6 lg:px-10 py-10 text-center text-gray-400">
            <span class="material-symbols-outlined text-4xl mb-2 opacity-50">hub</span>
            <p class="text-sm font-medium mt-2">Data mitra belum tersedia.</p>
        </div>
    @endif

</section>


{{-- ================================================================
     3. VALUE PROPOSITION
     ================================================================ --}}
<section class="py-20 bg-bone-white border-t border-gray-100">
    <div class="max-w-7xl mx-auto px-6 lg:px-10">

        <div class="text-center mb-12" data-aos="fade-up">
            <h2 class="text-3xl md:text-4xl font-black text-deep-blue">Grow With Us</h2>
            <p class="text-deep-blue/55 text-sm md:text-base mt-3 max-w-xl mx-auto">Keunggulan bergabung dalam jaringan distribusi kami.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">

            <div class="text-center p-8 rounded-2xl bg-white border border-gray-100 hover:shadow-md transition-shadow duration-300"
                 data-aos="fade-up" data-aos-delay="100">
                <div class="w-16 h-16 mx-auto bg-deep-blue/5 text-deep-blue rounded-full flex items-center justify-center mb-5">
                    <span class="material-symbols-outlined text-3xl">hub</span>
                </div>
                <h3 class="font-bold text-lg text-deep-blue mb-2 tracking-tight">Nationwide Network</h3>
                <p class="text-sm text-deep-blue/55 leading-relaxed">Akses pasar yang luas ke ribuan apotek, RS, dan faskes di seluruh wilayah.</p>
            </div>

            <div class="text-center p-8 rounded-2xl bg-white border border-gray-100 hover:shadow-md transition-shadow duration-300"
                 data-aos="fade-up" data-aos-delay="200">
                <div class="w-16 h-16 mx-auto bg-magenta-accent/5 text-magenta-accent rounded-full flex items-center justify-center mb-5">
                    <span class="material-symbols-outlined text-3xl">verified_user</span>
                </div>
                <h3 class="font-bold text-lg text-deep-blue mb-2 tracking-tight">Brand Protection</h3>
                <p class="text-sm text-deep-blue/55 leading-relaxed">Kami menjaga reputasi produk Anda dengan standar penanganan CDOB yang ketat.</p>
            </div>

            <div class="text-center p-8 rounded-2xl bg-white border border-gray-100 hover:shadow-md transition-shadow duration-300"
                 data-aos="fade-up" data-aos-delay="300">
                <div class="w-16 h-16 mx-auto bg-light-blue/5 text-light-blue rounded-full flex items-center justify-center mb-5">
                    <span class="material-symbols-outlined text-3xl">trending_up</span>
                </div>
                <h3 class="font-bold text-lg text-deep-blue mb-2 tracking-tight">Market Growth</h3>
                <p class="text-sm text-deep-blue/55 leading-relaxed">Strategi pemasaran dan distribusi yang fokus pada pertumbuhan sales principal.</p>
            </div>

        </div>
    </div>
</section>


{{-- ================================================================
     4. CTA — dengan interactive particle canvas
     ================================================================ --}}
<section class="relative py-16 bg-deep-blue overflow-hidden" id="ctaSection">

    <canvas id="particleCanvas" class="absolute inset-0 w-full h-full pointer-events-none" style="z-index:1;"></canvas>

    <div class="max-w-5xl mx-auto px-6 relative text-center" style="z-index:2;">
        <h2 class="text-3xl md:text-4xl font-black text-white mb-4 tracking-tight" data-aos="zoom-in">
            Jadilah Principal Mitra Kami
        </h2>
        <p class="text-white/70 text-base md:text-lg mb-8 max-w-2xl mx-auto font-light leading-relaxed">
            Perluas jangkauan produk farmasi Anda bersama PT Sumber Sehat Sejahtera. Kami siap mendiskusikan skema kerjasama yang menguntungkan.
        </p>

        <div class="flex flex-col sm:flex-row justify-center gap-4" data-aos="fade-up" data-aos-delay="100">
            <a href="{{ route('contact') }}"
               class="inline-flex items-center justify-center gap-2 px-8 py-4 bg-magenta-accent hover:bg-white hover:text-magenta-accent text-white font-semibold rounded-lg transition-all duration-200 group">
                <span>Daftarkan Principal</span>
                <span class="material-symbols-outlined text-base group-hover:translate-x-1 transition-transform duration-200">arrow_forward</span>
            </a>
            <a href="https://wa.me/6285156767900"
               target="_blank"
               rel="noopener noreferrer"
               class="inline-flex items-center justify-center gap-2 px-8 py-4 border border-white/30 hover:border-white hover:bg-white/10 text-white font-semibold rounded-lg transition-all duration-200">
                <span>Chat Tim Business</span>
            </a>
        </div>
    </div>
</section>

@endsection


@push('head')
<style>
    #mitraTrack { will-change: transform; }
</style>

<script>
document.addEventListener('DOMContentLoaded', function () {

    /* ── Mitra Slider ─────────────────────────────────────────── */
    const track   = document.getElementById('mitraTrack');
    const btnPrev = document.getElementById('mitraPrev');
    const btnNext = document.getElementById('mitraNext');

    if (track && btnPrev && btnNext) {
        const CARD_W     = 176;  // w-44 = 11rem = 176px
        const GAP        = 32;   // gap-8 = 2rem = 32px
        const STEP       = CARD_W + GAP;
        const SPEED      = 0.5;  // px / frame
        const totalCards = Math.floor(track.children.length / 2);
        const setWidth   = totalCards * STEP;

        let offset = 0;
        let paused = false;
        let rafId  = null;

        function animate() {
            if (!paused) {
                offset += SPEED;
                if (offset >= setWidth) offset -= setWidth;
            }
            track.style.transform = `translateX(-${offset}px)`;
            rafId = requestAnimationFrame(animate);
        }

        btnPrev.addEventListener('click', () => {
            offset = (offset - STEP + setWidth) % setWidth;
        });

        btnNext.addEventListener('click', () => {
            offset = (offset + STEP) % setWidth;
        });

        const section = document.getElementById('mitra');
        section.addEventListener('mouseenter', () => { paused = true; });
        section.addEventListener('mouseleave', () => { paused = false; });

        // Touch swipe
        let touchStartX = 0;
        track.addEventListener('touchstart', e => {
            touchStartX = e.touches[0].clientX;
        }, { passive: true });

        track.addEventListener('touchend', e => {
            const diff = touchStartX - e.changedTouches[0].clientX;
            if (Math.abs(diff) > 40) {
                offset += diff > 0 ? STEP : -STEP;
                offset = (offset + setWidth) % setWidth;
            }
        }, { passive: true });

        rafId = requestAnimationFrame(animate);
    }

    /* ── Particle Canvas (CTA Section) ───────────────────────── */
    const canvas  = document.getElementById('particleCanvas');
    const ctaSect = document.getElementById('ctaSection');

    if (!canvas || !ctaSect) return;

    const ctx = canvas.getContext('2d');

    function resizeCanvas() {
        canvas.width  = ctaSect.offsetWidth;
        canvas.height = ctaSect.offsetHeight;
    }
    resizeCanvas();

    const resizeObserver = new ResizeObserver(resizeCanvas);
    resizeObserver.observe(ctaSect);

    const PARTICLE_COUNT = 55;
    const mouse = { x: -9999, y: -9999, radius: 100 };

    ctaSect.addEventListener('mousemove', e => {
        const rect = ctaSect.getBoundingClientRect();
        mouse.x = e.clientX - rect.left;
        mouse.y = e.clientY - rect.top;
    });
    ctaSect.addEventListener('mouseleave', () => {
        mouse.x = -9999;
        mouse.y = -9999;
    });

    const particles = Array.from({ length: PARTICLE_COUNT }, () => ({
        x:       Math.random() * canvas.width,
        y:       Math.random() * canvas.height,
        r:       Math.random() * 2 + 1,
        vx:      (Math.random() - 0.5) * 0.5,
        vy:      (Math.random() - 0.5) * 0.5,
        ox:      0,
        oy:      0,
        opacity: Math.random() * 0.4 + 0.15,
    }));

    function drawParticles() {
        ctx.clearRect(0, 0, canvas.width, canvas.height);

        for (const p of particles) {
            p.x += p.vx;
            p.y += p.vy;

            // Wrap around edges
            if (p.x < 0)             p.x = canvas.width;
            if (p.x > canvas.width)  p.x = 0;
            if (p.y < 0)             p.y = canvas.height;
            if (p.y > canvas.height) p.y = 0;

            // Mouse repulsion
            const dx   = p.x - mouse.x;
            const dy   = p.y - mouse.y;
            const dist = Math.sqrt(dx * dx + dy * dy);

            if (dist < mouse.radius) {
                const force = (mouse.radius - dist) / mouse.radius;
                const angle = Math.atan2(dy, dx);
                p.ox = Math.cos(angle) * force * 3;
                p.oy = Math.sin(angle) * force * 3;
            } else {
                p.ox *= 0.9;
                p.oy *= 0.9;
            }

            ctx.beginPath();
            ctx.arc(p.x + p.ox, p.y + p.oy, p.r, 0, Math.PI * 2);
            ctx.fillStyle = `rgba(255,255,255,${p.opacity})`;
            ctx.fill();
        }

        // Connection lines
        for (let i = 0; i < particles.length; i++) {
            for (let j = i + 1; j < particles.length; j++) {
                const a  = particles[i];
                const b  = particles[j];
                const dx = a.x - b.x;
                const dy = a.y - b.y;
                const d  = Math.sqrt(dx * dx + dy * dy);

                if (d < 90) {
                    ctx.beginPath();
                    ctx.moveTo(a.x + a.ox, a.y + a.oy);
                    ctx.lineTo(b.x + b.ox, b.y + b.oy);
                    ctx.strokeStyle = `rgba(255,255,255,${(1 - d / 90) * 0.12})`;
                    ctx.lineWidth   = 1;
                    ctx.stroke();
                }
            }
        }

        requestAnimationFrame(drawParticles);
    }

    drawParticles();
});
</script>
@endpush