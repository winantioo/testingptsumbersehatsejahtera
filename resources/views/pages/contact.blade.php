@extends('layouts.app')

@section('title', 'Contact Sales - PT Sumber Sehat Sejahtera')

@section('content')

{{-- ═══════════════════════════════════════════
     1. HERO SECTION
═══════════════════════════════════════════ --}}
<section class="relative w-full overflow-hidden bg-bone-white py-12 lg:py-16">
    <div class="absolute top-0 right-0 w-1/3 h-full bg-magenta-accent/5 skew-x-[-15deg] translate-x-1/2 pointer-events-none"></div>

    <div class="max-w-[1280px] mx-auto px-6 lg:px-10 relative z-10">
        <div class="flex flex-col lg:flex-row items-start lg:items-end justify-between gap-8">

            <div data-aos="fade-up">
                <span class="text-magenta-accent font-bold tracking-[0.3em] uppercase text-xs mb-4 block">
                    Sales Directory
                </span>
                <h1 class="text-4xl lg:text-5xl font-extrabold text-deep-blue tracking-tight leading-tight">
                    Hubungi <span class="text-light-blue">Tim Sales</span>
                </h1>
                <p class="text-deep-blue/70 text-sm mt-4 max-w-2xl leading-relaxed">
                    Tim perwakilan penjualan kami siap membantu Anda mendapatkan informasi ketersediaan stok produk, penawaran harga terbaik, serta penjadwalan distribusi ke fasilitas Anda. Silakan hubungi kontak sesuai dengan area operasional Anda.
                </p>

                <div class="mt-8 flex flex-wrap gap-3">
                    <span class="inline-flex items-center gap-2 rounded-full border border-deep-blue/10 bg-white px-4 py-2 text-[11px] font-bold tracking-widest uppercase text-deep-blue/70 shadow-sm"
                          data-aos="fade-up" data-aos-delay="100">
                        <span class="material-symbols-outlined text-base text-light-blue">support_agent</span>
                        Konsultasi Produk
                    </span>
                    <span class="inline-flex items-center gap-2 rounded-full border border-deep-blue/10 bg-white px-4 py-2 text-[11px] font-bold tracking-widest uppercase text-deep-blue/70 shadow-sm"
                          data-aos="fade-up" data-aos-delay="150">
                        <span class="material-symbols-outlined text-base text-magenta-accent">map</span>
                        Distribusi Area
                    </span>
                </div>
            </div>

            <a href="{{ route('products') }}"
               class="shrink-0 bg-deep-blue hover:bg-light-blue text-white px-7 py-3.5 rounded-sm font-bold shadow-lg hover:shadow-xl transition-all duration-200 hover:-translate-y-0.5 text-sm uppercase tracking-widest"
               data-aos="fade-up" data-aos-delay="250">
                Katalog Produk
            </a>
        </div>
    </div>
</section>

@php
    $salesPeople = $sales ?? collect([
        (object) ['name' => 'Budi Santoso',  'area' => 'Jakarta & Sekitarnya',  'wa' => '6281234567890', 'photo_url' => null],
        (object) ['name' => 'Siti Aminah',   'area' => 'Jawa Barat',            'wa' => '6281234567891', 'photo_url' => null],
        (object) ['name' => 'Andi Wijaya',   'area' => 'Jawa Tengah & DIY',     'wa' => '6281234567892', 'photo_url' => null],
        (object) ['name' => 'Rina Melati',   'area' => 'Jawa Timur',            'wa' => '',              'photo_url' => null],
    ]);
@endphp

{{-- ═══════════════════════════════════════════
     2. SALES DIRECTORY
═══════════════════════════════════════════ --}}
<section class="max-w-[1280px] mx-auto px-6 lg:px-10 py-14 lg:py-20">

    <div class="mb-8 border-b border-deep-blue/10 pb-4" data-aos="fade-up">
        <h2 class="text-xl font-extrabold text-deep-blue">Daftar Kontak Sales</h2>
        <p class="text-sm text-deep-blue/60 mt-1">Pilih representatif berdasarkan wilayah fasilitas Anda.</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($salesPeople as $s)
            @php
                $wa        = preg_replace('/\D/', '', $s->wa ?? '');
                $waMessage = urlencode("Halo Bapak/Ibu {$s->name}, saya ingin bertanya mengenai ketersediaan produk dari PT Sumber Sehat Sejahtera.");
                $waUrl     = $wa ? "https://wa.me/{$wa}?text={$waMessage}" : '#';
                $img       = $s->photo_url ?? null;
            @endphp

            <article class="bg-white rounded-xl border border-deep-blue/10 shadow-sm hover:shadow-lg transition-shadow duration-300 p-6 flex flex-col h-full relative group overflow-hidden"
                     data-aos="fade-up">

                {{-- Top accent line --}}
                <div class="absolute top-0 left-0 w-full h-1 bg-deep-blue/5 group-hover:bg-magenta-accent transition-colors duration-300"></div>

                {{-- Photo + Info --}}
                <div class="flex flex-col sm:flex-row items-start sm:items-center gap-5">

                    <div class="w-28 h-28 sm:w-32 sm:h-32 rounded-xl bg-bone-white overflow-hidden border border-deep-blue/10 flex items-center justify-center shrink-0 shadow-sm">
                        @if($img)
                            <img src="{{ $img }}" alt="{{ $s->name }}" class="w-full h-full object-cover">
                        @else
                            <span class="material-symbols-outlined text-deep-blue/20 text-5xl">person</span>
                        @endif
                    </div>

                    <div class="min-w-0 flex-1">
                        <span class="inline-flex items-center rounded bg-deep-blue/5 px-2 py-0.5 text-[10px] font-black uppercase tracking-widest text-deep-blue/60 mb-2">
                            Area {{ $s->area ?? 'General' }}
                        </span>
                        <h3 class="font-extrabold text-deep-blue text-xl leading-snug truncate">
                            {{ $s->name }}
                        </h3>
                        <p class="text-xs text-deep-blue/50 mt-1 font-semibold">Sales Representative</p>
                    </div>
                </div>

                {{-- CTA Button --}}
                <div class="mt-6 pt-5 border-t border-deep-blue/5">
                    @if($wa)
                        <a href="{{ $waUrl }}"
                           target="_blank" rel="noopener noreferrer"
                           class="w-full inline-flex items-center justify-center gap-2 bg-[#25D366] hover:bg-[#128C7E] text-white px-4 py-3 rounded-md text-sm font-bold shadow-sm hover:shadow-md transition-all duration-200">
                            <span class="material-symbols-outlined text-[18px]">chat</span>
                            Hubungi via WhatsApp
                        </a>
                    @else
                        <button disabled
                            class="w-full inline-flex items-center justify-center gap-2 bg-bone-white text-deep-blue/40 px-4 py-3 rounded-md text-sm font-bold cursor-not-allowed border border-deep-blue/10">
                            <span class="material-symbols-outlined text-[18px]">block</span>
                            Nomor Tidak Tersedia
                        </button>
                    @endif
                </div>
            </article>
        @endforeach
    </div>
</section>

{{-- ═══════════════════════════════════════════
     3. CTA SUPPORT AREA — dengan particle canvas
═══════════════════════════════════════════ --}}
<section class="max-w-[1280px] mx-auto px-6 lg:px-10 pb-20">
    <div class="relative bg-deep-blue text-white rounded-xl p-10 lg:p-14 shadow-2xl overflow-hidden"
         id="contactCtaSection"
         data-aos="fade-up">

        {{-- Radial glow (static, ringan) --}}
        <div class="absolute inset-0 opacity-20 pointer-events-none"
             style="background: radial-gradient(circle at top right, rgba(0,168,232,0.4), transparent 60%);"></div>

     {{--  --}}-
        <canvas id="contactParticleCanvas"
                class="absolute inset-0 w-full h-full pointer-events-none"
                style="z-index: 1;"></canvas>

        {{-- Content --}}
        <div class="relative flex flex-col lg:flex-row items-start lg:items-center justify-between gap-10 border-l-4 border-magenta-accent pl-6 lg:pl-10"
             style="z-index: 2;">
            <div>
                <h2 class="text-2xl lg:text-3xl font-extrabold tracking-tight">
                    Belum menemukan produk yang sesuai?
                </h2>
                <p class="text-white/70 text-sm lg:text-base mt-3 max-w-2xl leading-relaxed">
                    Sampaikan kebutuhan fasilitas Anda. Tim kami akan segera merespons dan membantu merekomendasikan produk serta mengatur jadwal pengiriman terbaik.
                </p>
            </div>

            <a href="{{ route('products') }}"
               class="shrink-0 bg-white hover:bg-bone-white text-deep-blue px-8 py-4 rounded-sm font-extrabold shadow-lg transition-all duration-200 hover:-translate-y-0.5 text-sm uppercase tracking-widest flex items-center gap-2">
                Cari Produk
                <span class="material-symbols-outlined text-light-blue">search</span>
            </a>
        </div>
    </div>
</section>

@endsection

@push('head')
<script>
document.addEventListener('DOMContentLoaded', function () {

    /* ── Particle Canvas — Contact CTA ───────────────────────── */
    const canvas  = document.getElementById('contactParticleCanvas');
    if (!canvas) return;

    const ctx     = canvas.getContext('2d');
    const section = document.getElementById('contactCtaSection');

    function resizeCanvas() {
        canvas.width  = section.offsetWidth;
        canvas.height = section.offsetHeight;
    }
    resizeCanvas();
    window.addEventListener('resize', resizeCanvas);

    const PARTICLE_COUNT = 55;
    const mouse = { x: -9999, y: -9999, radius: 100 };

    section.addEventListener('mousemove', e => {
        const rect = section.getBoundingClientRect();
        mouse.x = e.clientX - rect.left;
        mouse.y = e.clientY - rect.top;
    });
    section.addEventListener('mouseleave', () => {
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

    function draw() {
        ctx.clearRect(0, 0, canvas.width, canvas.height);

        particles.forEach(p => {
            p.x += p.vx;
            p.y += p.vy;

            if (p.x < 0)             p.x = canvas.width;
            if (p.x > canvas.width)  p.x = 0;
            if (p.y < 0)             p.y = canvas.height;
            if (p.y > canvas.height) p.y = 0;

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
        });

        for (let i = 0; i < particles.length; i++) {
            for (let j = i + 1; j < particles.length; j++) {
                const a  = particles[i];
                const b  = particles[j];
                const dx = a.x - b.x;
                const dy = a.y - b.y;
                const d  = Math.sqrt(dx * dx + dy * dy);
                if (d < 90) {
                    const alpha = (1 - d / 90) * 0.12;
                    ctx.beginPath();
                    ctx.moveTo(a.x + a.ox, a.y + a.oy);
                    ctx.lineTo(b.x + b.ox, b.y + b.oy);
                    ctx.strokeStyle = `rgba(255,255,255,${alpha})`;
                    ctx.lineWidth   = 1;
                    ctx.stroke();
                }
            }
        }

        requestAnimationFrame(draw);
    }

    draw();
});
</script>
@endpush