{{-- resources/views/components/navbar.blade.php --}}

<nav class="bg-white border-b border-[#1565C0]/10 px-7 h-14 flex items-center justify-between sticky top-0 z-50">

    {{-- ===== LOGO + BRAND ===== --}}
    <a href="{{ route('welcome') }}" class="flex items-center gap-2.5">

        {{-- 3D Animated Logo Scene --}}
        <div class="logo-scene">
            <div class="logo-stage" id="logoStage">

                {{-- Potongan BIRU --}}
                <div class="logo-piece piece-blue">
                    <img src="{{ asset('images/logo.png') }}" alt="" aria-hidden="true">
                </div>

                {{-- Potongan MERAH --}}
                <div class="logo-piece piece-red">
                    <img src="{{ asset('images/logo.png') }}" alt="" aria-hidden="true">
                </div>

                {{-- Potongan ORANGE --}}
                <div class="logo-piece piece-orange">
                    <img src="{{ asset('images/logo.png') }}" alt="" aria-hidden="true">
                </div>

                {{-- Logo penuh tampil setelah animasi selesai --}}
                <div class="logo-piece piece-full">
                    <img src="{{ asset('images/logo.png') }}" alt="Logo G-RPL">
                </div>

            </div>
        </div>

        {{-- Teks Brand --}}
        <span class="logo-brand-text font-heading font-bold text-[#1565C0] text-base">G-RPL</span>
    </a>

    {{-- ===== NAV LINKS ===== --}}
    <div class="hidden md:flex items-center gap-6">
        @php
            $navItems = [
                ['name' => 'Beranda',     'route' => 'welcome'],
                ['name' => 'Tentang RPL', 'route' => 'about'],
                ['name' => 'Persyaratan', 'route' => 'requirements'],
                ['name' => 'FAQ',         'route' => 'faq'],
                ['name' => 'Pengumuman',  'route' => 'announcements'],
            ];
        @endphp

        @foreach($navItems as $item)
            <a href="{{ route($item['route']) }}"
               class="text-sm transition-colors {{ Route::is($item['route']) ? 'text-[#1565C0] font-semibold border-b-2 border-[#1565C0] pb-0.5' : 'text-[#5A6478] hover:text-[#1565C0]' }}">
                {{ $item['name'] }}
            </a>
        @endforeach
    </div>

    {{-- ===== AUTH BUTTONS ===== --}}
    <div class="flex items-center gap-2">
        <a href="{{ route('login') }}"
           class="px-4 py-1.5 text-sm font-semibold text-[#1565C0] border border-[#1565C0] rounded-lg hover:bg-[#E3F0FF] transition-colors">
            Masuk
        </a>
        <a href="{{ route('register') }}"
           class="px-4 py-1.5 text-sm font-semibold text-white bg-[#1565C0] rounded-lg hover:bg-[#1976D2] transition-colors">
            Daftar Sekarang
        </a>
    </div>
</nav>


{{-- ===== STYLES ANIMASI LOGO ===== --}}
<style>
    /* Scene wrapper */
    .logo-scene {
        width: 32px;
        height: 32px;
        perspective: 400px;
        position: relative;
        flex-shrink: 0;
    }

    /* Stage — berputar pelan setelah animasi selesai */
    .logo-stage {
        width: 32px;
        height: 32px;
        transform-style: preserve-3d;
        position: relative;
        animation: grpl-float 5s ease-in-out 2s infinite;
    }

    @keyframes grpl-float {
        0%,100% { transform: rotateY(0deg)   rotateX(3deg) translateY(0px);   }
        30%      { transform: rotateY(10deg)  rotateX(6deg) translateY(-2px);  }
        70%      { transform: rotateY(-7deg)  rotateX(4deg) translateY(-1px);  }
    }

    /* Setiap potongan = gambar penuh + clip */
    .logo-piece {
        position: absolute;
        inset: 0;
        width: 32px;
        height: 32px;
        overflow: hidden;
    }

    .logo-piece img {
        width: 32px;
        height: 32px;
        display: block;
    }

    /* Clip sesuai zona warna logo asli */
    .piece-blue   { clip-path: polygon(0% 0%, 72% 0%, 55% 52%, 18% 72%, 0% 50%); }
    .piece-red    { clip-path: polygon(0% 50%, 18% 72%, 55% 52%, 65% 85%, 50% 100%, 10% 85%, 0% 65%); }
    .piece-orange { clip-path: polygon(55% 52%, 72% 0%, 100% 0%, 100% 100%, 50% 100%, 65% 85%); }

    /* Animasi fly-in saat page load */
    .piece-blue {
        opacity: 0;
        animation: grpl-fly-blue 0.85s cubic-bezier(.22,1,.36,1) 0.1s forwards;
    }
    .piece-red {
        opacity: 0;
        animation: grpl-fly-red 0.85s cubic-bezier(.22,1,.36,1) 0.28s forwards;
    }
    .piece-orange {
        opacity: 0;
        animation: grpl-fly-orange 0.85s cubic-bezier(.22,1,.36,1) 0.46s forwards;
    }
    .piece-full {
        opacity: 0;
        animation: grpl-fadein 0.3s ease 1.05s forwards;
    }

    /* Teks brand muncul bersamaan dengan logo penuh */
    .logo-brand-text {
        opacity: 0;
        animation: grpl-fadein 0.4s ease 1.1s forwards;
    }

    @keyframes grpl-fly-blue {
        from { opacity:0; transform: translate3d(-50px,-55px,100px) rotateZ(-50deg) scale(0.3); }
        to   { opacity:1; transform: translate3d(0,0,0) rotateZ(0deg) scale(1); }
    }
    @keyframes grpl-fly-red {
        from { opacity:0; transform: translate3d(-65px,50px,85px) rotateZ(60deg) scale(0.3); }
        to   { opacity:1; transform: translate3d(0,0,0) rotateZ(0deg) scale(1); }
    }
    @keyframes grpl-fly-orange {
        from { opacity:0; transform: translate3d(75px,25px,70px) rotateZ(-65deg) scale(0.3); }
        to   { opacity:1; transform: translate3d(0,0,0) rotateZ(0deg) scale(1); }
    }
    @keyframes grpl-fadein {
        from { opacity:0; }
        to   { opacity:1; }
    }
</style>