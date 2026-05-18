{{-- resources/views/components/footer.blade.php --}}

<footer class="grpl-footer relative overflow-hidden text-white">
    {{-- decorative layer --}}
    <div class="absolute inset-0 pointer-events-none overflow-hidden">
        <div class="absolute inset-x-0 top-0 h-[3px] bg-gradient-to-r from-[#1565C0] via-[#F9A825] to-[#E53935]"></div>

        <div class="footer-orb footer-orb-blue"></div>
        <div class="footer-orb footer-orb-yellow"></div>
        <div class="footer-grid"></div>
    </div>

    <div class="relative max-w-7xl mx-auto px-5 md:px-8 lg:px-10 pt-10 md:pt-12 pb-5 md:pb-6">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-10">

            {{-- ===== BRAND ===== --}}
            <div class="lg:col-span-4">
                <a href="{{ route('welcome') }}" class="inline-flex items-center gap-3 mb-4 group">
                    <div class="footer-logo-box">
                        <img
                            src="{{ asset('images/logo.png') }}"
                            alt="G-RPL"
                            class="h-7 w-auto transition-transform duration-300 group-hover:scale-105"
                        >
                    </div>

                    <div class="leading-tight">
                        <div class="font-heading font-extrabold text-white text-[1.45rem] tracking-tight">
                            G-RPL
                        </div>

                        <div class="flex items-center gap-1.5 text-[9px] font-bold tracking-[0.16em] uppercase text-white/75">
                            <span class="w-1.5 h-1.5 rounded-full bg-[#F9A825]"></span>
                            Portal Resmi
                        </div>
                    </div>
                </a>

                <p class="text-[13px] text-white/80 leading-relaxed max-w-sm">
                    Mewujudkan pengakuan akademik atas pengalaman nyata melalui sistem digital
                    yang terintegrasi, terarah, dan mudah digunakan.
                </p>

                <div class="mt-4 flex flex-wrap gap-2.5">
                    <span class="footer-pill">
                        <span class="w-2 h-2 rounded-full bg-[#F9A825]"></span>
                        Pendaftaran Digital
                    </span>

                    <span class="footer-pill">
                        <span class="w-2 h-2 rounded-full bg-[#E53935]"></span>
                        Rekognisi Akademik
                    </span>
                </div>
            </div>

            {{-- ===== LINKS ===== --}}
            <div class="lg:col-span-8 grid grid-cols-2 md:grid-cols-3 gap-6 md:gap-8">
                <div>
                    <h3 class="footer-title">
                        <span class="w-2 h-2 rounded-full bg-[#F9A825]"></span>
                        Navigasi
                    </h3>

                    <div class="flex flex-col gap-2.5">
                        <a href="{{ route('welcome') }}#beranda" class="footer-link">Beranda</a>
                        <a href="{{ route('welcome') }}#tentang" class="footer-link">Tentang RPL</a>
                        <a href="{{ route('welcome') }}#keunggulan" class="footer-link">Keunggulan</a>
                        <a href="{{ route('welcome') }}#alur" class="footer-link">Alur</a>
                    </div>
                </div>

                <div>
                    <h3 class="footer-title">
                        <span class="w-2 h-2 rounded-full bg-[#F9A825]"></span>
                        Informasi
                    </h3>

                    <div class="flex flex-col gap-2.5">
                        <a href="{{ route('welcome') }}#pengumuman" class="footer-link">Pengumuman</a>
                        <a href="{{ route('welcome') }}#persyaratan" class="footer-link">Persyaratan</a>
                        <a href="{{ route('welcome') }}#faq" class="footer-link">FAQ</a>
                        <a href="mailto:admin@g-rpl.ac.id" class="footer-link">Kontak Kami</a>
                    </div>
                </div>

                <div class="col-span-2 md:col-span-1">
                    <h3 class="footer-title">
                        <span class="w-2 h-2 rounded-full bg-[#F9A825]"></span>
                        Layanan
                    </h3>

                    <div class="footer-service-card">
                        <p class="text-[12px] text-white/78 mb-3.5 leading-relaxed">
                            Tim admin siap membantu proses pendaftaran dan informasi program RPL.
                        </p>

                        <div class="space-y-3">
                            <div class="flex items-start gap-3">
                                <div class="footer-icon footer-icon-blue">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8m-18 8h18a2 2 0 002-2V6a2 2 0 00-2-2H3a2 2 0 00-2 2v8a2 2 0 002 2z"/>
                                    </svg>
                                </div>

                                <div>
                                    <p class="text-[12px] font-bold text-white">
                                        Email
                                    </p>
                                    <a href="mailto:admin@g-rpl.ac.id" class="text-[12px] text-white/72 hover:text-white transition-colors">
                                        admin@g-rpl.ac.id
                                    </a>
                                </div>
                            </div>

                            <div class="flex items-start gap-3">
                                <div class="footer-icon footer-icon-yellow">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                </div>

                                <div>
                                    <p class="text-[12px] font-bold text-white">
                                        Jam Layanan
                                    </p>
                                    <p class="text-[12px] text-white/72">
                                        Senin - Jumat, 08:00 - 16:00
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- ===== BOTTOM ===== --}}
        <div class="mt-8 pt-4 border-t border-white/15 flex flex-col md:flex-row items-center justify-between gap-3">
            <p class="text-[10px] text-white/65 uppercase tracking-[0.16em] text-center md:text-left">
                © {{ date('Y') }} Bayu, Raffi, Dias. All rights reserved.
            </p>

            <div class="flex items-center gap-1.5 text-[10px] text-white/65">
                <span>Powered by</span>
                <span class="font-bold text-white">G-RPL Digital System</span>
            </div>
        </div>
    </div>
</footer>

<style>
    .grpl-footer {
        background:
            radial-gradient(circle at 10% 0%, rgba(249, 168, 37, 0.16), transparent 24%),
            radial-gradient(circle at 92% 22%, rgba(255, 255, 255, 0.08), transparent 24%),
            linear-gradient(135deg, #0D47A1 0%, #1565C0 45%, #0B3D91 100%);
    }

    .footer-grid {
        position: absolute;
        inset: 0;
        opacity: 0.06;
        background-image:
            linear-gradient(rgba(255, 255, 255, 0.35) 1px, transparent 1px),
            linear-gradient(90deg, rgba(255, 255, 255, 0.35) 1px, transparent 1px);
        background-size: 48px 48px;
    }

    .footer-orb {
        position: absolute;
        border-radius: 999px;
        filter: blur(48px);
    }

    .footer-orb-blue {
        width: 14rem;
        height: 14rem;
        top: -5rem;
        left: -4rem;
        background: rgba(255, 255, 255, 0.10);
    }

    .footer-orb-yellow {
        width: 16rem;
        height: 16rem;
        right: -5rem;
        bottom: -6rem;
        background: rgba(249, 168, 37, 0.18);
    }

    .footer-logo-box {
        width: 3rem;
        height: 3rem;
        border-radius: 1rem;
        background: #ffffff;
        border: 1px solid rgba(255, 255, 255, 0.5);
        box-shadow: 0 14px 34px rgba(6, 23, 54, 0.18);
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: hidden;
        flex-shrink: 0;
    }

    .footer-pill {
        display: inline-flex;
        align-items: center;
        gap: 0.45rem;
        padding: 0.48rem 0.85rem;
        border-radius: 999px;
        background: rgba(255, 255, 255, 0.12);
        border: 1px solid rgba(255, 255, 255, 0.20);
        color: #ffffff;
        font-size: 0.7rem;
        font-weight: 800;
        backdrop-filter: blur(10px);
    }

    .footer-title {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        color: #ffffff;
        font-size: 0.85rem;
        font-weight: 800;
        margin-bottom: 0.9rem;
    }

    .footer-link {
        color: rgba(255, 255, 255, 0.78);
        font-size: 0.8rem;
        font-weight: 650;
        transition: color 0.2s ease, transform 0.2s ease;
        width: fit-content;
        line-height: 1.35;
    }

    .footer-link:hover {
        color: #ffffff;
        transform: translateX(3px);
    }

    .footer-service-card {
        border-radius: 1.1rem;
        padding: 1rem;
        background: rgba(255, 255, 255, 0.14);
        border: 1px solid rgba(255, 255, 255, 0.20);
        box-shadow: 0 18px 42px rgba(6, 23, 54, 0.14);
        backdrop-filter: blur(10px);
    }

    .footer-icon {
        width: 1.9rem;
        height: 1.9rem;
        border-radius: 0.7rem;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }

    .footer-icon-blue {
        background: #ffffff;
        color: #1565C0;
    }

    .footer-icon-yellow {
        background: #F9A825;
        color: #5D3B00;
    }

    @media (max-width: 767px) {
        .grpl-footer .max-w-7xl {
            padding-left: 1rem;
            padding-right: 1rem;
            padding-top: 2.5rem;
            padding-bottom: 1.25rem;
        }

        .grpl-footer .grid {
            gap: 1.6rem;
        }

        .footer-logo-box {
            width: 2.65rem;
            height: 2.65rem;
            border-radius: 0.95rem;
        }

        .footer-logo-box img {
            height: 1.7rem;
        }

        .grpl-footer .font-heading.text-\[1\.45rem\] {
            font-size: 1.2rem;
        }

        .grpl-footer p.text-\[13px\] {
            font-size: 0.78rem;
            line-height: 1.55;
        }

        .footer-pill {
            font-size: 0.66rem;
            padding: 0.42rem 0.72rem;
        }

        .footer-title {
            font-size: 0.78rem;
            margin-bottom: 0.75rem;
        }

        .footer-link {
            font-size: 0.75rem;
        }

        .footer-service-card {
            padding: 0.9rem;
            border-radius: 1rem;
        }

        .footer-icon {
            width: 1.8rem;
            height: 1.8rem;
            border-radius: 0.65rem;
        }

        .grpl-footer .mt-8 {
            margin-top: 1.6rem;
        }

        .grpl-footer .pt-4 {
            padding-top: 0.85rem;
        }
    }

    @media (max-width: 420px) {
        .grpl-footer .grid.grid-cols-2.md\:grid-cols-3 {
            grid-template-columns: 1fr;
        }

        .grpl-footer .col-span-2.md\:col-span-1 {
            grid-column: auto;
        }

        .footer-pill {
            width: fit-content;
        }
    }
</style>    