{{-- resources/views/components/navbar.blade.php --}}

@php
    $navItems = [
        ['name' => 'Beranda', 'url' => route('welcome') . '#beranda'],
        ['name' => 'Tentang', 'url' => route('welcome') . '#tentang'],
        ['name' => 'Keunggulan', 'url' => route('welcome') . '#keunggulan'],
        ['name' => 'Alur', 'url' => route('welcome') . '#alur'],
        ['name' => 'Pengumuman', 'url' => route('welcome') . '#pengumuman'],
        ['name' => 'Persyaratan', 'url' => route('welcome') . '#persyaratan'],
        ['name' => 'FAQ', 'url' => route('welcome') . '#faq'],
    ];
@endphp

<nav id="grpl-navbar" class="fixed top-0 left-0 right-0 z-[998] bg-white/95 backdrop-blur-xl border-b border-[#1565C0]/10 transition-all duration-300">
    {{-- Accent line --}}
    <div class="h-[3px] w-full bg-gradient-to-r from-[#1565C0] via-[#F9A825] to-[#E53935]"></div>

    <div class="w-full px-4 sm:px-6 lg:px-8 xl:px-10 2xl:px-12">
        <div class="h-[68px] flex items-center justify-between gap-5">

            {{-- ===== BRAND ===== --}}
            <a href="{{ route('welcome') }}" class="grpl-brand group flex items-center gap-3 shrink-0">
                <div class="grpl-logo-wrap">
                    <div class="grpl-logo-glow"></div>

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
                </div>

                <div class="leading-tight">
                    <div class="grpl-brand-title font-heading font-extrabold text-[#1565C0] text-xl tracking-tight">
                        G-RPL
                    </div>

                    <div class="hidden sm:flex items-center gap-1.5 text-[10px] font-bold tracking-[0.18em] uppercase text-[#64748B]">
                        <span class="w-1.5 h-1.5 rounded-full bg-[#F9A825]"></span>
                        Portal Resmi
                    </div>
                </div>
            </a>

            {{-- ===== DESKTOP NAV ===== --}}
            <div class="hidden xl:flex items-center justify-center flex-1">
                <div class="flex items-center gap-7">
                    @foreach($navItems as $item)
                        <a
                            href="{{ $item['url'] }}"
                            class="grpl-nav-link relative py-2 text-[13px] font-bold text-[#64748B] hover:text-[#1565C0] transition-all duration-200"
                        >
                            {{ $item['name'] }}
                        </a>
                    @endforeach
                </div>
            </div>

            {{-- ===== ACTION DESKTOP ===== --}}
            <div class="hidden xl:flex items-center gap-3 shrink-0">
                <a
                    href="{{ route('login') }}"
                    class="px-4 py-2.5 text-sm font-bold text-[#1565C0] rounded-xl hover:bg-[#EAF3FF] transition-all"
                >
                    Masuk
                </a>

                <a
                    href="{{ route('register') }}"
                    class="inline-flex items-center gap-2 px-5 py-2.5 text-sm font-bold text-white bg-[#1565C0] rounded-xl hover:bg-[#0D47A1] transition-all shadow-lg shadow-blue-500/20"
                >
                    Daftar
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                    </svg>
                </a>
            </div>

            {{-- ===== MOBILE / TABLET BUTTON ===== --}}
            <button
                type="button"
                id="grpl-menu-button"
                class="xl:hidden w-11 h-11 rounded-xl bg-[#F8FAFC] border border-[#1565C0]/10 text-[#1565C0] flex items-center justify-center transition-all hover:bg-[#EAF3FF] shrink-0"
                aria-label="Buka menu"
                aria-expanded="false"
            >
                <svg id="grpl-menu-open" class="w-6 h-6 block" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 7h16M4 12h16M4 17h16"/>
                </svg>

                <svg id="grpl-menu-close" class="w-6 h-6 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>
    </div>

    {{-- ===== MOBILE / TABLET MENU ===== --}}
    <div id="grpl-mobile-menu" class="xl:hidden hidden border-t border-[#1565C0]/10 bg-white/98 backdrop-blur-xl shadow-[0_18px_45px_rgba(15,23,42,0.08)]">
        <div class="px-4 sm:px-6 py-5">
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-2">
                @foreach($navItems as $item)
                    <a
                        href="{{ $item['url'] }}"
                        class="grpl-mobile-link px-4 py-3 rounded-2xl text-sm font-bold text-[#64748B] hover:text-[#1565C0] hover:bg-[#EAF3FF] transition-all"
                    >
                        {{ $item['name'] }}
                    </a>
                @endforeach
            </div>

            <div class="mt-5 pt-5 border-t border-[#1565C0]/10 grid grid-cols-2 gap-3">
                <a
                    href="{{ route('login') }}"
                    class="px-4 py-3 text-center text-sm font-bold text-[#1565C0] bg-white border border-[#1565C0]/20 rounded-2xl hover:bg-[#EAF3FF] transition-all"
                >
                    Masuk
                </a>

                <a
                    href="{{ route('register') }}"
                    class="px-4 py-3 text-center text-sm font-bold text-white bg-[#1565C0] rounded-2xl hover:bg-[#0D47A1] transition-all shadow-lg shadow-blue-500/20"
                >
                    Daftar
                </a>
            </div>
        </div>
    </div>
</nav>

{{-- Spacer karena navbar fixed --}}
<div class="h-[71px]"></div>

<style>
    #grpl-navbar.navbar-compact {
        background: rgba(255, 255, 255, 0.98);
        box-shadow: 0 14px 38px rgba(15, 23, 42, 0.08);
    }

    #grpl-navbar.navbar-compact > div:nth-child(2) > div {
        height: 62px;
    }

    .grpl-brand {
        opacity: 0;
        transform: translateX(-22px);
        transition: opacity 0.65s ease, transform 0.65s ease;
    }

    .grpl-navbar-ready .grpl-brand {
        opacity: 1;
        transform: translateX(0);
    }

    .grpl-logo-wrap {
        width: 46px;
        height: 46px;
        border-radius: 15px;
        position: relative;
        flex-shrink: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        background:
            radial-gradient(circle at 30% 20%, rgba(249, 168, 37, 0.16), transparent 35%),
            linear-gradient(135deg, #FFFFFF, #F8FAFC);
        border: 1px solid rgba(21, 101, 192, 0.12);
        box-shadow:
            inset 0 1px 0 rgba(255, 255, 255, 0.85),
            0 10px 26px rgba(15, 23, 42, 0.08);
        overflow: hidden;
    }

    .grpl-logo-wrap::after {
        content: "";
        position: absolute;
        left: 9px;
        right: 9px;
        bottom: 7px;
        height: 2px;
        border-radius: 999px;
        background: linear-gradient(90deg, #1565C0, #F9A825, #E53935);
        opacity: 0;
        transform: scaleX(0.3);
        transform-origin: left;
        transition: opacity 0.45s ease 1.25s, transform 0.45s ease 1.25s;
    }

    .grpl-navbar-ready .grpl-logo-wrap::after {
        opacity: 0.75;
        transform: scaleX(1);
    }

    .grpl-logo-glow {
        position: absolute;
        inset: -22px;
        background: conic-gradient(
            from 120deg,
            rgba(21, 101, 192, 0.14),
            rgba(249, 168, 37, 0.12),
            rgba(229, 57, 53, 0.10),
            rgba(21, 101, 192, 0.14)
        );
        opacity: 0;
        transform: rotate(0deg);
        transition: opacity 0.4s ease;
    }

    .grpl-navbar-ready .grpl-logo-glow {
        opacity: 1;
        animation: grpl-glow-rotate 8s linear infinite;
    }

    .grpl-brand-title {
        opacity: 0;
        transform: translateX(-10px);
    }

    .grpl-navbar-ready .grpl-brand-title {
        animation: grpl-text-in 0.45s ease 1.05s forwards;
    }

    .grpl-nav-link::after {
        content: "";
        position: absolute;
        left: 0;
        right: 0;
        bottom: 0;
        height: 2px;
        border-radius: 999px;
        background: #1565C0;
        opacity: 0;
        transform: scaleX(0.25);
        transition: opacity 0.22s ease, transform 0.22s ease;
    }

    .grpl-nav-link:hover::after,
    .grpl-nav-link.active::after {
        opacity: 1;
        transform: scaleX(1);
    }

    .grpl-nav-link.active {
        color: #1565C0;
    }

    .grpl-mobile-link.active {
        color: #1565C0;
        background: #EAF3FF;
    }

    /* ===== LOGO ANIMATION — JALAN SETELAH PRELOADER SELESAI ===== */
    .logo-scene {
        width: 32px;
        height: 32px;
        perspective: 420px;
        position: relative;
        flex-shrink: 0;
        z-index: 2;
    }

    .logo-stage {
        width: 32px;
        height: 32px;
        transform-style: preserve-3d;
        position: relative;
    }

    .logo-piece {
        position: absolute;
        inset: 0;
        width: 32px;
        height: 32px;
        overflow: hidden;
        opacity: 0;
    }

    .logo-piece img {
        width: 32px;
        height: 32px;
        display: block;
    }

    .piece-blue {
        clip-path: polygon(0% 0%, 72% 0%, 55% 52%, 18% 72%, 0% 50%);
    }

    .piece-red {
        clip-path: polygon(0% 50%, 18% 72%, 55% 52%, 65% 85%, 50% 100%, 10% 85%, 0% 65%);
    }

    .piece-orange {
        clip-path: polygon(55% 52%, 72% 0%, 100% 0%, 100% 100%, 50% 100%, 65% 85%);
    }

    .piece-full {
        opacity: 0;
    }

    .grpl-navbar-ready .logo-stage {
        animation: grpl-float 5s ease-in-out 2s infinite;
    }

    .grpl-navbar-ready .piece-blue {
        animation: grpl-fly-blue 0.85s cubic-bezier(.22,1,.36,1) 0.12s forwards;
    }

    .grpl-navbar-ready .piece-red {
        animation: grpl-fly-red 0.85s cubic-bezier(.22,1,.36,1) 0.30s forwards;
    }

    .grpl-navbar-ready .piece-orange {
        animation: grpl-fly-orange 0.85s cubic-bezier(.22,1,.36,1) 0.48s forwards;
    }

    .grpl-navbar-ready .piece-full {
        animation: grpl-fadein 0.32s ease 1.08s forwards;
    }

    @keyframes grpl-glow-rotate {
        from {
            transform: rotate(0deg);
        }

        to {
            transform: rotate(360deg);
        }
    }

    @keyframes grpl-text-in {
        to {
            opacity: 1;
            transform: translateX(0);
        }
    }

    @keyframes grpl-float {
        0%, 100% {
            transform: rotateY(0deg) rotateX(3deg) translateY(0px);
        }

        30% {
            transform: rotateY(10deg) rotateX(6deg) translateY(-2px);
        }

        70% {
            transform: rotateY(-7deg) rotateX(4deg) translateY(-1px);
        }
    }

    @keyframes grpl-fly-blue {
        from {
            opacity: 0;
            transform: translate3d(-50px, -55px, 100px) rotateZ(-50deg) scale(0.3);
        }

        to {
            opacity: 1;
            transform: translate3d(0, 0, 0) rotateZ(0deg) scale(1);
        }
    }

    @keyframes grpl-fly-red {
        from {
            opacity: 0;
            transform: translate3d(-65px, 50px, 85px) rotateZ(60deg) scale(0.3);
        }

        to {
            opacity: 1;
            transform: translate3d(0, 0, 0) rotateZ(0deg) scale(1);
        }
    }

    @keyframes grpl-fly-orange {
        from {
            opacity: 0;
            transform: translate3d(75px, 25px, 70px) rotateZ(-65deg) scale(0.3);
        }

        to {
            opacity: 1;
            transform: translate3d(0, 0, 0) rotateZ(0deg) scale(1);
        }
    }

    @keyframes grpl-fadein {
        from {
            opacity: 0;
        }

        to {
            opacity: 1;
        }
    }

    @media (max-width: 767px) {
        #grpl-navbar > div:nth-child(2) {
            padding-left: 14px;
            padding-right: 14px;
        }

        #grpl-navbar > div:nth-child(2) > div {
            height: 64px;
        }

        .grpl-logo-wrap {
            width: 42px;
            height: 42px;
            border-radius: 14px;
        }

        .logo-scene,
        .logo-stage,
        .logo-piece,
        .logo-piece img {
            width: 30px;
            height: 30px;
        }

        .grpl-brand-title {
            font-size: 1.1rem;
        }
    }

    @media (max-width: 380px) {
        .grpl-brand {
            gap: 9px;
        }

        .grpl-logo-wrap {
            width: 40px;
            height: 40px;
        }

        .grpl-brand-title {
            font-size: 1rem;
        }
    }

    @media (prefers-reduced-motion: reduce) {
        .grpl-brand,
        .grpl-brand-title,
        .logo-stage,
        .logo-piece,
        .piece-blue,
        .piece-red,
        .piece-orange,
        .piece-full,
        .grpl-logo-glow {
            animation: none !important;
            opacity: 1 !important;
            transform: none !important;
            transition: none !important;
        }
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const navbar = document.getElementById('grpl-navbar');
        const menuButton = document.getElementById('grpl-menu-button');
        const mobileMenu = document.getElementById('grpl-mobile-menu');
        const menuOpen = document.getElementById('grpl-menu-open');
        const menuClose = document.getElementById('grpl-menu-close');

        const navLinks = document.querySelectorAll('.grpl-nav-link');
        const mobileLinks = document.querySelectorAll('.grpl-mobile-link');

        let logoStarted = false;

        function startLogoAnimation() {
            if (logoStarted || !navbar) return;

            logoStarted = true;
            navbar.classList.add('grpl-navbar-ready');
        }

        function waitForPreloader() {
            const preloader = document.getElementById('page-preloader');

            document.addEventListener('grpl:preloader-finished', function () {
                setTimeout(startLogoAnimation, 180);
            });

            if (!preloader) {
                window.addEventListener('load', function () {
                    setTimeout(startLogoAnimation, 180);
                });

                return;
            }

            if (preloader.classList.contains('hide')) {
                setTimeout(startLogoAnimation, 180);
                return;
            }

            const observer = new MutationObserver(function () {
                if (preloader.classList.contains('hide')) {
                    observer.disconnect();
                    setTimeout(startLogoAnimation, 180);
                }
            });

            observer.observe(preloader, {
                attributes: true,
                attributeFilter: ['class']
            });

            window.addEventListener('load', function () {
                setTimeout(function () {
                    if (!logoStarted && preloader.classList.contains('hide')) {
                        startLogoAnimation();
                    }
                }, 700);
            });
        }

        function handleNavbarScroll() {
            if (!navbar) return;

            if (window.scrollY > 12) {
                navbar.classList.add('navbar-compact');
            } else {
                navbar.classList.remove('navbar-compact');
            }
        }

        function setActiveLink() {
            const sections = [
                'beranda',
                'tentang',
                'keunggulan',
                'alur',
                'pengumuman',
                'persyaratan',
                'faq'
            ];

            let currentSection = 'beranda';

            sections.forEach(function (sectionId) {
                const section = document.getElementById(sectionId);

                if (section) {
                    const sectionTop = section.offsetTop - 130;

                    if (window.scrollY >= sectionTop) {
                        currentSection = sectionId;
                    }
                }
            });

            navLinks.forEach(function (link) {
                link.classList.remove('active');

                if (link.getAttribute('href').includes('#' + currentSection)) {
                    link.classList.add('active');
                }
            });

            mobileLinks.forEach(function (link) {
                link.classList.remove('active');

                if (link.getAttribute('href').includes('#' + currentSection)) {
                    link.classList.add('active');
                }
            });
        }

        if (menuButton && mobileMenu) {
            menuButton.addEventListener('click', function () {
                const isOpen = !mobileMenu.classList.contains('hidden');

                mobileMenu.classList.toggle('hidden');
                menuOpen.classList.toggle('hidden');
                menuClose.classList.toggle('hidden');

                menuButton.setAttribute('aria-expanded', isOpen ? 'false' : 'true');
            });
        }

        mobileLinks.forEach(function (link) {
            link.addEventListener('click', function () {
                if (!mobileMenu) return;

                mobileMenu.classList.add('hidden');
                menuOpen.classList.remove('hidden');
                menuClose.classList.add('hidden');

                if (menuButton) {
                    menuButton.setAttribute('aria-expanded', 'false');
                }
            });
        });

        window.addEventListener('scroll', function () {
            handleNavbarScroll();
            setActiveLink();
        });

        waitForPreloader();
        handleNavbarScroll();
        setActiveLink();
    });
</script>