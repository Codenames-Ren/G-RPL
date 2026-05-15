{{-- resources/views/welcome.blade.php --}}
@extends('layouts.app')

@section('title', 'Beranda')

@section('content')

<x-navbar />

{{-- ===== PRELOADER ===== --}}
<div id="page-preloader" class="fixed inset-0 z-[9999] bg-white flex items-center justify-center">
    <div class="w-full max-w-sm px-8 text-center">
        <div class="mb-7 flex justify-center">
            <div class="bg-white rounded-3xl shadow-lg border border-[#1565C0]/10 px-6 py-5">
                <img src="{{ asset('images/logo.png') }}" alt="G-RPL Logo" class="h-14 w-auto mx-auto preloader-logo">
            </div>
        </div>

        <h2 class="text-[#172033] font-heading text-lg font-bold mb-2">
            Memuat Halaman
        </h2>

        <p class="text-sm text-[#64748B] mb-6">
            Mohon tunggu sebentar...
        </p>

        <div class="w-full h-3 bg-[#EAF3FF] rounded-full overflow-hidden shadow-inner">
            <div id="preloader-bar" class="h-full rounded-full bg-gradient-to-r from-[#1565C0] via-[#1E88E5] to-[#F9A825]" style="width: 0%"></div>
        </div>

        <div class="mt-3 text-sm font-bold text-[#1565C0]">
            <span id="preloader-percent">0</span>%
        </div>
    </div>
</div>

<style>
    html {
        scroll-behavior: smooth;
    }

    .page-soft-grid {
        background-image:
            linear-gradient(rgba(21, 101, 192, 0.045) 1px, transparent 1px),
            linear-gradient(90deg, rgba(21, 101, 192, 0.045) 1px, transparent 1px);
        background-size: 56px 56px;
    }

    .soft-orb {
        animation: softFloat 8s ease-in-out infinite;
    }

    .soft-orb-delay {
        animation: softFloat 10s ease-in-out infinite;
        animation-delay: 1s;
    }

    .hero-fade-left {
        opacity: 0;
        transform: translateX(-34px);
        animation: heroLeft 0.85s ease forwards;
    }

    .hero-fade-right {
        opacity: 0;
        transform: translateX(34px);
        animation: heroRight 0.85s ease forwards;
    }

    .delay-1 {
        animation-delay: 0.10s;
    }

    .delay-2 {
        animation-delay: 0.20s;
    }

    .delay-3 {
        animation-delay: 0.30s;
    }

    .delay-4 {
        animation-delay: 0.40s;
    }

    .section-reveal {
        opacity: 0;
        transform: translateX(-36px);
        transition: opacity 0.75s ease, transform 0.75s ease;
    }

    .section-reveal.is-visible {
        opacity: 1;
        transform: translateX(0);
    }

    .section-reveal-right {
        opacity: 0;
        transform: translateX(36px);
        transition: opacity 0.75s ease, transform 0.75s ease;
    }

    .section-reveal-right.is-visible {
        opacity: 1;
        transform: translateX(0);
    }

    .clean-card {
        transition: transform 0.25s ease, box-shadow 0.25s ease, border-color 0.25s ease, background-color 0.25s ease;
    }

    .clean-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 18px 45px rgba(15, 23, 42, 0.08);
        border-color: rgba(21, 101, 192, 0.22);
    }

    .glass-card {
        background: rgba(255, 255, 255, 0.82);
        backdrop-filter: blur(14px);
        -webkit-backdrop-filter: blur(14px);
    }

    .text-balance {
        text-wrap: balance;
    }

    .preloader-logo {
        animation: logoFloat 1.8s ease-in-out infinite;
    }

    #page-preloader {
        opacity: 1;
        visibility: visible;
        transition: opacity 0.45s ease, visibility 0.45s ease;
    }

    #page-preloader.hide {
        opacity: 0;
        visibility: hidden;
    }

    #preloader-bar {
        transition: width 0.25s ease;
    }

    @keyframes heroLeft {
        to {
            opacity: 1;
            transform: translateX(0);
        }
    }

    @keyframes heroRight {
        to {
            opacity: 1;
            transform: translateX(0);
        }
    }

    @keyframes softFloat {
        0%, 100% {
            transform: translate3d(0, 0, 0);
        }

        50% {
            transform: translate3d(14px, -16px, 0);
        }
    }

    @keyframes logoFloat {
        0%, 100% {
            transform: translateY(0);
        }

        50% {
            transform: translateY(-6px);
        }
    }

    /* =========================================================
   DESKTOP / LAPTOP POLISH ONLY
   Tampilan HP tidak ikut berubah
   ========================================================= */
@media (min-width: 1024px) {
    /* ===== GLOBAL DESKTOP FEEL ===== */
    section {
        scroll-margin-top: 5.5rem;
    }

    .clean-card {
        position: relative;
        overflow: hidden;
    }

    .clean-card::after {
        content: "";
        position: absolute;
        inset: 0;
        pointer-events: none;
        background: linear-gradient(
            135deg,
            rgba(255, 255, 255, 0.18),
            transparent 38%,
            rgba(21, 101, 192, 0.035)
        );
        opacity: 0;
        transition: opacity 0.25s ease;
    }

    .clean-card:hover::after {
        opacity: 1;
    }

    .clean-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 24px 60px rgba(15, 23, 42, 0.10);
        border-color: rgba(21, 101, 192, 0.24);
    }

    /* ===== HERO DESKTOP ===== */
    #beranda {
        min-height: calc(100vh - 71px);
        display: flex;
        align-items: center;
        padding-top: 6.5rem;
        padding-bottom: 6.5rem;
    }

    #beranda > .relative.max-w-7xl {
        width: 100%;
        gap: 5rem;
    }

    #beranda h1 {
        letter-spacing: -0.055em;
        max-width: 690px;
    }

    #beranda h1 span.relative {
        text-shadow: 0 12px 30px rgba(21, 101, 192, 0.12);
    }

    #beranda h1 span span {
        height: 0.85rem;
        bottom: -0.25rem;
        background: linear-gradient(90deg, rgba(249, 168, 37, 0.42), rgba(249, 168, 37, 0.18));
    }

    #beranda p {
        max-width: 660px;
    }

    #beranda .hero-fade-left.inline-flex {
        box-shadow: 0 14px 36px rgba(15, 23, 42, 0.06);
    }

    #beranda .hero-fade-left.delay-3 a {
        min-width: 155px;
    }

    #beranda .hero-fade-left.delay-4 {
        max-width: 620px;
    }

    #beranda .hero-fade-left.delay-4 .clean-card {
        min-height: 112px;
        display: flex;
        flex-direction: column;
        justify-content: center;
    }

    #beranda .hero-fade-right > .relative.bg-white {
        border-radius: 2.7rem;
        box-shadow:
            0 34px 90px rgba(15, 23, 42, 0.12),
            0 0 0 1px rgba(255, 255, 255, 0.75) inset;
    }

    #beranda .hero-fade-right > .relative.bg-white::before {
        content: "";
        position: absolute;
        inset: 1px;
        border-radius: 2.65rem;
        pointer-events: none;
        background:
            radial-gradient(circle at 15% 8%, rgba(249, 168, 37, 0.09), transparent 26%),
            radial-gradient(circle at 95% 95%, rgba(21, 101, 192, 0.08), transparent 28%);
    }

    #beranda .hero-fade-right .rounded-\[2rem\] {
        box-shadow: 0 22px 55px rgba(21, 101, 192, 0.22);
    }

    #beranda .hero-fade-right .space-y-4 > div {
        background: linear-gradient(135deg, #F8FAFC, #FFFFFF);
    }

    /* ===== STATS DESKTOP ===== */
    section.bg-white.px-6.md\:px-10.py-12 {
        padding-top: 4rem;
        padding-bottom: 4rem;
    }

    section.bg-white.px-6.md\:px-10.py-12 .clean-card {
        min-height: 150px;
        display: flex;
        flex-direction: column;
        justify-content: center;
        background: linear-gradient(180deg, #FFFFFF, #F8FAFC);
    }

    section.bg-white.px-6.md\:px-10.py-12 .clean-card .font-heading {
        letter-spacing: -0.04em;
    }

    /* ===== SECTION HEADINGS DESKTOP ===== */
    #tentang,
    #keunggulan,
    #alur,
    #pengumuman,
    #persyaratan,
    #faq {
        padding-top: 7rem;
        padding-bottom: 7rem;
    }

    #tentang span.inline-flex,
    #keunggulan span.inline-flex,
    #alur span.inline-flex,
    #pengumuman span.inline-flex,
    #persyaratan span.inline-flex,
    #faq span.inline-flex {
        box-shadow: 0 12px 30px rgba(15, 23, 42, 0.055);
    }

    #tentang h2,
    #keunggulan h2,
    #alur h2,
    #pengumuman h2,
    #persyaratan h2,
    #faq h2 {
        letter-spacing: -0.035em;
    }

    /* ===== TENTANG DESKTOP ===== */
    #tentang .grid.grid-cols-1.lg\:grid-cols-3 {
        grid-template-columns: 0.9fr 1.6fr;
        gap: 4rem;
        align-items: stretch;
    }

    #tentang .lg\:col-span-1 {
        grid-column: auto;
    }

    #tentang .lg\:col-span-2 {
        grid-column: auto;
    }

    #tentang .clean-card {
        min-height: 365px;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }

    #tentang .bg-gradient-to-r {
        box-shadow: 0 24px 65px rgba(15, 23, 42, 0.07);
    }

    /* ===== FEATURE BANNER DESKTOP ===== */
    section.bg-\[\#0D47A1\] {
        padding-top: 7rem;
        padding-bottom: 7rem;
        border-radius: 0;
    }

    section.bg-\[\#0D47A1\]::before {
        content: "";
        position: absolute;
        inset: 0;
        pointer-events: none;
        background:
            linear-gradient(120deg, rgba(255,255,255,0.08), transparent 35%),
            radial-gradient(circle at 75% 25%, rgba(255,255,255,0.08), transparent 22%);
    }

    section.bg-\[\#0D47A1\] .relative.max-w-7xl {
        grid-template-columns: 0.95fr 1.25fr;
    }

    section.bg-\[\#0D47A1\] .clean-card {
        min-height: 195px;
    }

    /* ===== KEUNGGULAN DESKTOP ===== */
    #keunggulan .grid.grid-cols-1.md\:grid-cols-3 {
        gap: 1.8rem;
    }

    #keunggulan .clean-card {
        min-height: 300px;
        padding: 2.1rem;
        background: linear-gradient(180deg, #FFFFFF, #FBFDFF);
    }

    #keunggulan .clean-card h3 {
        margin-bottom: 0.85rem;
    }

    /* ===== ALUR DESKTOP ===== */
    #alur .grid.grid-cols-1.md\:grid-cols-5 {
        gap: 1.4rem;
    }

    #alur .clean-card {
        min-height: 245px;
        background: linear-gradient(180deg, #F8FAFC, #FFFFFF);
    }

    #alur .clean-card .w-16 {
        box-shadow: 0 16px 32px rgba(21, 101, 192, 0.22);
    }

    #alur .hidden.md\:block {
        top: 2.05rem;
    }

    /* ===== PENGUMUMAN DESKTOP ===== */
    #pengumuman .grid.grid-cols-1.md\:grid-cols-2.lg\:grid-cols-3 {
        gap: 1.7rem;
    }

    #pengumuman .clean-card {
        min-height: 315px;
        background: linear-gradient(180deg, #FFFFFF, #FBFDFF);
    }

    #pengumuman .clean-card h3 {
        min-height: 3rem;
    }

    #pengumuman input {
        box-shadow: 0 14px 34px rgba(15, 23, 42, 0.055);
    }

    /* ===== PERSYARATAN DESKTOP ===== */
    #persyaratan .grid.grid-cols-1.lg\:grid-cols-2 {
        grid-template-columns: 0.9fr 1.15fr;
        gap: 4rem;
        align-items: center;
    }

    #persyaratan .bg-gradient-to-br {
        box-shadow: 0 26px 70px rgba(21, 101, 192, 0.18);
    }

    #persyaratan .section-reveal-right > div {
        box-shadow: 0 24px 65px rgba(15, 23, 42, 0.065);
        background:
            radial-gradient(circle at 100% 0%, rgba(21, 101, 192, 0.055), transparent 28%),
            #F8FAFC;
    }

    #persyaratan .space-y-4 {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 1rem;
    }

    #persyaratan .clean-card {
        min-height: 112px;
        background: #FFFFFF;
    }

    /* ===== FAQ DESKTOP ===== */
    #faq .max-w-4xl {
        max-width: 72rem;
    }

    #faq .space-y-4 {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 1rem;
    }

    #faq .section-reveal.bg-white {
        height: 100%;
    }

    #faq details {
        height: 100%;
    }

    #faq .mt-12.text-center {
        max-width: 48rem;
        margin-left: auto;
        margin-right: auto;
        box-shadow: 0 22px 55px rgba(15, 23, 42, 0.06);
    }

    /* ===== FINAL CTA DESKTOP ===== */
    section.relative.overflow-hidden.bg-white.px-6.md\:px-10.py-24 {
        padding-top: 7rem;
        padding-bottom: 7rem;
    }

    section.relative.overflow-hidden.bg-white.px-6.md\:px-10.py-24 .rounded-\[2\.5rem\] {
        padding-top: 4rem;
        padding-bottom: 4rem;
        box-shadow: 0 34px 90px rgba(21, 101, 192, 0.23);
    }
}

/* Desktop besar biar lebih lega */
@media (min-width: 1280px) {
    #beranda h1 {
        font-size: 4.9rem;
    }

    #beranda > .relative.max-w-7xl {
        max-width: 82rem;
    }

    #tentang .relative.max-w-7xl,
    #keunggulan .max-w-7xl,
    #alur .relative.max-w-7xl,
    #pengumuman .max-w-7xl,
    #persyaratan .relative.max-w-7xl,
    section.bg-\[\#0D47A1\] .relative.max-w-7xl {
        max-width: 82rem;
    }
}

    /* =========================================================
   MOBILE ONLY - COMPACT & RAPI
   Desktop/laptop tetap tidak berubah
   ========================================================= */
@media (max-width: 767px) {
    body {
        overflow-x: hidden;
    }

    section {
        scroll-margin-top: 5rem;
    }

    .text-balance {
        text-wrap: auto;
    }

    .clean-card:hover {
        transform: none;
        box-shadow: none;
    }

    /* ===== HERO / BERANDA ===== */
    #beranda {
        padding-left: 1rem;
        padding-right: 1rem;
        padding-top: 2.6rem;
        padding-bottom: 3rem;
    }

    #beranda > .relative.max-w-7xl {
        grid-template-columns: 1fr;
        gap: 1.7rem;
    }

    #beranda .hero-fade-left.inline-flex {
        margin-bottom: 1.15rem;
        padding: 0.48rem 0.82rem;
        border-radius: 999px;
    }

    #beranda .hero-fade-left.inline-flex .w-2\.5 {
        width: 0.48rem;
        height: 0.48rem;
    }

    #beranda .hero-fade-left.inline-flex span:last-child {
        font-size: 0.62rem;
        letter-spacing: 0.12em;
        white-space: nowrap;
    }

    #beranda h1 {
        font-size: clamp(1.85rem, 8vw, 2.55rem);
        line-height: 1.06;
        letter-spacing: -0.04em;
        margin-bottom: 1rem;
    }

    #beranda h1 span span {
        height: 0.45rem;
        bottom: -0.16rem;
    }

    #beranda p {
        font-size: 0.86rem;
        line-height: 1.62;
        margin-bottom: 1.35rem;
    }

    #beranda .hero-fade-left.delay-3 {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 0.7rem;
        margin-bottom: 1.35rem;
    }

    #beranda .hero-fade-left.delay-3 a {
        width: 100%;
        min-height: 2.7rem;
        padding: 0.72rem 0.7rem;
        border-radius: 0.95rem;
        font-size: 0.78rem;
        white-space: nowrap;
    }

    #beranda .hero-fade-left.delay-3 svg {
        width: 0.9rem;
        height: 0.9rem;
        margin-left: 0.35rem;
    }

    #beranda .hero-fade-left.delay-4 {
        grid-template-columns: repeat(3, minmax(0, 1fr));
        gap: 0.65rem;
        max-width: 100%;
    }

    #beranda .hero-fade-left.delay-4 .clean-card {
        padding: 0.8rem 0.45rem;
        border-radius: 1rem;
        text-align: center;
    }

    #beranda .hero-fade-left.delay-4 .font-heading {
        font-size: 1.45rem;
        line-height: 1;
    }

    #beranda .hero-fade-left.delay-4 p {
        font-size: 0.58rem;
        line-height: 1.2;
        margin: 0.28rem 0 0;
    }

    /* Card kanan hero dibuat compact */
    #beranda .hero-fade-right > .relative.bg-white {
        border-radius: 1.45rem;
        padding: 0.95rem;
        box-shadow: 0 14px 34px rgba(15, 23, 42, 0.08);
    }

    #beranda .hero-fade-right .flex.items-center.justify-between.mb-8 {
        margin-bottom: 0.9rem;
    }

    #beranda .hero-fade-right img {
        height: 2.25rem;
    }

    #beranda .hero-fade-right .px-4.py-2 {
        padding: 0.42rem 0.72rem;
        border-radius: 999px;
    }

    #beranda .hero-fade-right .px-4.py-2 span {
        font-size: 0.65rem;
    }

    #beranda .hero-fade-right .rounded-\[2rem\] {
        border-radius: 1.15rem;
        padding: 0.95rem;
        margin-bottom: 0.85rem;
    }

    #beranda .hero-fade-right .rounded-\[2rem\] .mb-5 {
        margin-bottom: 0.75rem;
    }

    #beranda .hero-fade-right .rounded-\[2rem\] p.text-xs {
        font-size: 0.58rem;
        letter-spacing: 0.13em;
    }

    #beranda .hero-fade-right .rounded-\[2rem\] h3 {
        font-size: 1.05rem;
        line-height: 1.18;
        margin-bottom: 0.45rem;
    }

    #beranda .hero-fade-right .rounded-\[2rem\] p.text-sm {
        font-size: 0.72rem;
        line-height: 1.48;
        margin-bottom: 0.75rem;
    }

    #beranda .hero-fade-right .rounded-\[2rem\] .h-2 {
        height: 0.38rem;
    }

    #beranda .hero-fade-right .space-y-4 {
        display: grid;
        gap: 0.65rem;
    }

    #beranda .hero-fade-right .space-y-4 > div {
        padding: 0.75rem;
        border-radius: 1rem;
        gap: 0.7rem;
    }

    #beranda .hero-fade-right .space-y-4 .w-11 {
        width: 2rem;
        height: 2rem;
        border-radius: 0.75rem;
        font-size: 0.75rem;
    }

    #beranda .hero-fade-right .space-y-4 h4 {
        font-size: 0.78rem;
        line-height: 1.25;
        margin-bottom: 0.18rem;
    }

    #beranda .hero-fade-right .space-y-4 p {
        font-size: 0.68rem;
        line-height: 1.38;
        margin-bottom: 0;
    }

    #beranda .absolute.-top-8,
    #beranda .absolute.-bottom-8 {
        display: none;
    }

    /* ===== SECTION UMUM ===== */
    #tentang,
    #keunggulan,
    #alur,
    #pengumuman,
    #persyaratan,
    #faq {
        padding-left: 1rem;
        padding-right: 1rem;
        padding-top: 3.25rem;
        padding-bottom: 3.25rem;
    }

    #tentang h2,
    #keunggulan h2,
    #alur h2,
    #pengumuman h2,
    #persyaratan h2,
    #faq h2 {
        font-size: 1.65rem;
        line-height: 1.16;
        letter-spacing: -0.025em;
    }

    #tentang p,
    #keunggulan p,
    #alur p,
    #pengumuman p,
    #persyaratan p,
    #faq p {
        font-size: 0.82rem;
        line-height: 1.58;
    }

    #tentang span.inline-flex,
    #keunggulan span.inline-flex,
    #alur span.inline-flex,
    #pengumuman span.inline-flex,
    #persyaratan span.inline-flex,
    #faq span.inline-flex {
        font-size: 0.6rem;
        letter-spacing: 0.11em;
        padding: 0.46rem 0.75rem;
    }

    /* ===== STATS BAWAH HERO ===== */
    section.bg-white.px-6.md\:px-10.py-12 {
        padding-left: 1rem;
        padding-right: 1rem;
        padding-top: 2.2rem;
        padding-bottom: 2.2rem;
    }

    section.bg-white.px-6.md\:px-10.py-12 .max-w-7xl {
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 0.7rem;
    }

    section.bg-white.px-6.md\:px-10.py-12 .clean-card {
        padding: 0.9rem;
        border-radius: 1rem;
    }

    section.bg-white.px-6.md\:px-10.py-12 .clean-card .font-heading {
        font-size: 1.55rem;
    }

    section.bg-white.px-6.md\:px-10.py-12 .clean-card .text-sm {
        font-size: 0.75rem;
    }

    section.bg-white.px-6.md\:px-10.py-12 .clean-card p {
        font-size: 0.66rem;
        line-height: 1.4;
    }

    /* ===== TENTANG ===== */
    #tentang .grid.grid-cols-1.lg\:grid-cols-3 {
        gap: 1.35rem;
        margin-bottom: 1.35rem;
    }

    #tentang .lg\:col-span-2 {
        gap: 0.8rem;
    }

    #tentang .clean-card {
        padding: 1rem;
        border-radius: 1.2rem;
    }

    #tentang .clean-card .w-14 {
        width: 2.55rem;
        height: 2.55rem;
        border-radius: 0.9rem;
        margin-bottom: 0.85rem;
    }

    #tentang .clean-card h3 {
        font-size: 0.95rem;
    }

    #tentang .clean-card p {
        font-size: 0.76rem;
        line-height: 1.45;
    }

    #tentang .bg-gradient-to-r {
        padding: 1rem;
        border-radius: 1.2rem;
    }

    #tentang .bg-gradient-to-r h3 {
        font-size: 1.1rem;
    }

    #tentang .bg-gradient-to-r a {
        width: 100%;
        padding-top: 0.8rem;
        padding-bottom: 0.8rem;
    }

    /* ===== FEATURE BANNER ===== */
    section.bg-\[\#0D47A1\] {
        padding-left: 1rem;
        padding-right: 1rem;
        padding-top: 3.25rem;
        padding-bottom: 3.25rem;
    }

    section.bg-\[\#0D47A1\] > .relative.max-w-7xl {
        gap: 1.4rem;
    }

    section.bg-\[\#0D47A1\] h2 {
        font-size: 1.6rem;
        line-height: 1.18;
    }

    section.bg-\[\#0D47A1\] .grid.grid-cols-1.sm\:grid-cols-2 {
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 0.7rem;
    }

    section.bg-\[\#0D47A1\] .clean-card {
        padding: 0.85rem;
        border-radius: 1rem;
    }

    section.bg-\[\#0D47A1\] .clean-card .font-heading {
        font-size: 1.2rem;
        margin-bottom: 0.5rem;
    }

    section.bg-\[\#0D47A1\] .clean-card h3 {
        font-size: 0.78rem;
        line-height: 1.25;
    }

    section.bg-\[\#0D47A1\] .clean-card p {
        font-size: 0.65rem;
        line-height: 1.35;
    }

    /* ===== KEUNGGULAN ===== */
    #keunggulan .grid.grid-cols-1.md\:grid-cols-3 {
        grid-template-columns: 1fr;
        gap: 0.75rem;
    }

    #keunggulan .clean-card {
        padding: 1rem;
        border-radius: 1.2rem;
    }

    #keunggulan .clean-card .w-14 {
        width: 2.45rem;
        height: 2.45rem;
        border-radius: 0.9rem;
        margin-bottom: 0.85rem;
    }

    #keunggulan .clean-card svg {
        width: 1.25rem;
        height: 1.25rem;
    }

    #keunggulan .clean-card h3 {
        font-size: 0.95rem;
        margin-bottom: 0.4rem;
    }

    #keunggulan .clean-card p {
        font-size: 0.76rem;
    }

    /* ===== ALUR ===== */
    #alur .grid.grid-cols-1.md\:grid-cols-5 {
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 0.7rem;
    }

    #alur .section-reveal:nth-child(5) {
        grid-column: span 2;
    }

    #alur .clean-card {
        padding: 0.9rem;
        border-radius: 1.1rem;
    }

    #alur .clean-card .w-16 {
        width: 2.55rem;
        height: 2.55rem;
        border-radius: 0.85rem;
        margin-bottom: 0.65rem;
        font-size: 0.95rem;
    }

    #alur .clean-card h3 {
        font-size: 0.82rem;
        margin-bottom: 0.3rem;
    }

    #alur .clean-card p {
        font-size: 0.64rem;
        line-height: 1.35;
    }

    /* ===== PENGUMUMAN ===== */
    #pengumuman .mb-12 {
        margin-bottom: 1.5rem;
    }

    #pengumuman input {
        width: 100%;
        padding-top: 0.78rem;
        padding-bottom: 0.78rem;
        font-size: 0.78rem;
    }

    #pengumuman .grid.grid-cols-1.md\:grid-cols-2.lg\:grid-cols-3 {
        grid-template-columns: 1fr;
        gap: 0.75rem;
    }

    #pengumuman .clean-card {
        border-radius: 1.2rem;
    }

    #pengumuman .clean-card .p-7 {
        padding: 1rem;
    }

    #pengumuman .clean-card h3 {
        font-size: 0.92rem;
        line-height: 1.3;
    }

    #pengumuman .clean-card p {
        font-size: 0.76rem;
    }

    #pengumuman .clean-card span {
        font-size: 0.55rem;
    }

    #pengumuman .px-7.py-5 {
        padding: 0.8rem 1rem;
    }

    /* ===== PERSYARATAN ===== */
    #persyaratan .grid.grid-cols-1.lg\:grid-cols-2 {
        gap: 1.25rem;
    }

    #persyaratan .bg-gradient-to-br {
        padding: 1rem;
        border-radius: 1.2rem;
    }

    #persyaratan .bg-gradient-to-br h3 {
        font-size: 1rem;
    }

    #persyaratan .bg-gradient-to-br li {
        font-size: 0.76rem;
        line-height: 1.45;
    }

    #persyaratan .section-reveal-right > div {
        padding: 1rem;
        border-radius: 1.2rem;
    }

    #persyaratan .section-reveal-right h3 {
        font-size: 1.15rem;
        margin-bottom: 0.9rem;
    }

    #persyaratan .space-y-4 {
        display: grid;
        gap: 0.65rem;
    }

    #persyaratan .clean-card {
        padding: 0.8rem;
        border-radius: 1rem;
        gap: 0.65rem;
    }

    #persyaratan .clean-card .w-11 {
        width: 2rem;
        height: 2rem;
        border-radius: 0.75rem;
    }

    #persyaratan .clean-card svg {
        width: 1.05rem;
        height: 1.05rem;
    }

    #persyaratan .clean-card h4 {
        font-size: 0.82rem;
    }

    #persyaratan .clean-card p {
        font-size: 0.68rem;
        line-height: 1.38;
    }

    #persyaratan a.w-full {
        padding-top: 0.85rem;
        padding-bottom: 0.85rem;
        border-radius: 1rem;
    }

    /* ===== FAQ ===== */
    #faq .max-w-4xl {
        max-width: 100%;
    }

    #faq .space-y-4 {
        display: grid;
        gap: 0.7rem;
    }

    #faq details {
        padding: 0.95rem;
    }

    #faq summary {
        font-size: 0.82rem;
        line-height: 1.35;
        align-items: flex-start;
    }

    #faq summary span.w-10 {
        width: 2.1rem;
        height: 2.1rem;
        border-radius: 0.8rem;
    }

    #faq details div {
        font-size: 0.74rem;
        line-height: 1.45;
    }

    #faq .mt-12 {
        margin-top: 1.7rem;
    }

    #faq .mt-12.text-center {
        padding: 1.25rem;
        border-radius: 1.2rem;
    }

    /* ===== CTA ===== */
    section.relative.overflow-hidden.bg-white.px-6.md\:px-10.py-24 {
        padding-left: 1rem;
        padding-right: 1rem;
        padding-top: 3.25rem;
        padding-bottom: 3.25rem;
    }

    section.relative.overflow-hidden.bg-white.px-6.md\:px-10.py-24 .rounded-\[2\.5rem\] {
        padding: 1.35rem;
        border-radius: 1.45rem;
    }

    section.relative.overflow-hidden.bg-white.px-6.md\:px-10.py-24 h2 {
        font-size: 1.55rem;
        line-height: 1.18;
    }

    section.relative.overflow-hidden.bg-white.px-6.md\:px-10.py-24 p {
        font-size: 0.78rem;
    }

    section.relative.overflow-hidden.bg-white.px-6.md\:px-10.py-24 .flex.flex-col.sm\:flex-row {
        display: grid;
        grid-template-columns: 1fr;
        gap: 0.7rem;
    }

    section.relative.overflow-hidden.bg-white.px-6.md\:px-10.py-24 a {
        width: 100%;
        padding-top: 0.85rem;
        padding-bottom: 0.85rem;
        border-radius: 1rem;
        font-size: 0.78rem;
    }
}

/* HP yang sempit banget */
@media (max-width: 420px) {
    #beranda {
        padding-left: 0.9rem;
        padding-right: 0.9rem;
    }

    #beranda h1 {
        font-size: clamp(1.75rem, 8.5vw, 2.25rem);
    }

    #beranda p {
        font-size: 0.8rem;
    }

    #beranda .hero-fade-left.delay-3 {
        grid-template-columns: 1fr;
    }

    #beranda .hero-fade-left.delay-4 {
        gap: 0.5rem;
    }

    #beranda .hero-fade-left.delay-4 .font-heading {
        font-size: 1.28rem;
    }

    #beranda .hero-fade-left.delay-4 p {
        font-size: 0.52rem;
    }

    section.bg-\[\#0D47A1\] .grid.grid-cols-1.sm\:grid-cols-2,
    #alur .grid.grid-cols-1.md\:grid-cols-5 {
        grid-template-columns: 1fr;
    }

    #alur .section-reveal:nth-child(5) {
        grid-column: auto;
    }
}

    @media (prefers-reduced-motion: reduce) {
        .section-reveal,
        .section-reveal-right,
        .hero-fade-left,
        .hero-fade-right {
            opacity: 1;
            transform: none;
            animation: none;
            transition: none;
        }

        .soft-orb,
        .soft-orb-delay,
        .preloader-logo {
            animation: none;
        }
    }
</style>

{{-- ===== HERO ===== --}}
<section
    id="beranda"
    class="relative overflow-hidden bg-[#F8FAFC] page-soft-grid px-6 md:px-10 py-20 md:py-28"
>
    <div class="absolute -top-32 -right-28 w-[520px] h-[520px] bg-[#1565C0]/10 rounded-full blur-3xl soft-orb"></div>
    <div class="absolute top-24 -left-28 w-[390px] h-[390px] bg-[#F9A825]/14 rounded-full blur-3xl soft-orb-delay"></div>

    <div class="relative max-w-7xl mx-auto grid grid-cols-1 lg:grid-cols-2 gap-14 items-center">
        <div>
            <div class="hero-fade-left inline-flex items-center gap-3 px-4 py-2 rounded-full glass-card border border-[#1565C0]/10 shadow-sm mb-7">
                <span class="w-2.5 h-2.5 rounded-full bg-[#1565C0]"></span>

                <span class="text-xs font-bold tracking-[0.18em] text-[#1565C0] uppercase">
                    Portal Resmi G-RPL
                </span>
            </div>

            <h1 class="hero-fade-left delay-1 font-heading text-4xl md:text-5xl lg:text-7xl font-extrabold text-[#172033] leading-[1.05] mb-7 text-balance">
                Wujudkan Gelar Akademikmu Lewat
                <span class="relative inline-block text-[#1565C0]">
                    Pengalaman Nyata
                    <span class="absolute left-1 right-1 -bottom-2 h-3 bg-[#F9A825]/30 -z-10 rounded-full"></span>
                </span>
            </h1>

            <p class="hero-fade-left delay-2 text-base md:text-lg text-[#64748B] leading-relaxed max-w-2xl mb-9">
                Program Rekognisi Pembelajaran Lampau membantu mengakui pengalaman kerja,
                pelatihan, pendidikan nonformal, dan pembelajaran mandiri sebagai bagian dari
                capaian akademik secara resmi, terstruktur, dan mudah dipantau.
            </p>

            <div class="hero-fade-left delay-3 flex flex-col sm:flex-row gap-4 mb-10">
                <a
                    href="{{ route('register') }}"
                    class="group inline-flex items-center justify-center px-7 py-3.5 bg-[#1565C0] text-white text-sm font-bold rounded-2xl hover:bg-[#0D47A1] transition-all shadow-xl shadow-blue-500/20 hover:-translate-y-1"
                >
                    Daftar Sekarang
                    <svg class="w-4 h-4 ml-2 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                    </svg>
                </a>

                <a
                    href="#tentang"
                    class="inline-flex items-center justify-center px-7 py-3.5 bg-white border border-[#1565C0]/15 text-[#1565C0] text-sm font-bold rounded-2xl hover:bg-[#EAF3FF] transition-all shadow-sm hover:-translate-y-1"
                >
                    Pelajari RPL
                </a>
            </div>

            <div class="hero-fade-left delay-4 grid grid-cols-3 gap-4 max-w-xl">
                <div class="clean-card glass-card border border-[#1565C0]/10 rounded-3xl p-5 shadow-sm">
                    <div class="font-heading text-3xl font-extrabold text-[#1565C0]">45</div>
                    <p class="text-xs text-[#64748B] font-semibold mt-1">Prodi Tersedia</p>
                </div>

                <div class="clean-card glass-card border border-[#1565C0]/10 rounded-3xl p-5 shadow-sm">
                    <div class="font-heading text-3xl font-extrabold text-[#1565C0]">144</div>
                    <p class="text-xs text-[#64748B] font-semibold mt-1">Maks SKS</p>
                </div>

                <div class="clean-card glass-card border border-[#1565C0]/10 rounded-3xl p-5 shadow-sm">
                    <div class="font-heading text-3xl font-extrabold text-[#1565C0]">100%</div>
                    <p class="text-xs text-[#64748B] font-semibold mt-1">Digital</p>
                </div>
            </div>
        </div>

        <div class="relative hero-fade-right delay-2">
            <div class="absolute -top-8 -right-8 w-32 h-32 bg-[#F9A825]/25 rounded-full blur-2xl soft-orb"></div>
            <div class="absolute -bottom-8 -left-8 w-32 h-32 bg-[#1565C0]/16 rounded-full blur-2xl soft-orb-delay"></div>

            <div class="relative bg-white border border-[#1565C0]/10 rounded-[2.5rem] p-7 md:p-9 shadow-2xl shadow-blue-900/10 overflow-hidden">
                <div class="absolute inset-x-0 top-0 h-1 bg-gradient-to-r from-[#1565C0] via-[#F9A825] to-[#E53935]"></div>

                <div class="flex items-center justify-between mb-8">
                    <img src="{{ asset('images/logo.png') }}" alt="G-RPL" class="h-14 w-auto">

                    <div class="px-4 py-2 bg-[#EAF3FF] rounded-full">
                        <span class="text-xs font-bold text-[#1565C0]">Portal Digital</span>
                    </div>
                </div>

                <div class="rounded-[2rem] bg-gradient-to-br from-[#1565C0] to-[#0D47A1] p-7 text-white mb-6 overflow-hidden relative">
                    <div class="absolute -right-10 -top-10 w-36 h-36 bg-white/10 rounded-full"></div>
                    <div class="absolute -left-12 -bottom-12 w-40 h-40 bg-[#F9A825]/20 rounded-full"></div>

                    <div class="relative">
                        <div class="flex items-center justify-between mb-5">
                            <p class="text-xs uppercase tracking-[0.18em] text-white/65 font-bold">
                                Status Layanan
                            </p>

                            <span class="inline-flex items-center gap-2 text-xs font-bold bg-white/10 border border-white/15 px-3 py-1.5 rounded-full">
                                <span class="w-2 h-2 rounded-full bg-[#F9A825]"></span>
                                Aktif
                            </span>
                        </div>

                        <h3 class="font-heading text-2xl md:text-3xl font-extrabold mb-3">
                            Pendaftaran RPL Online
                        </h3>

                        <p class="text-sm text-white/75 leading-relaxed mb-6">
                            Lengkapi data, unggah dokumen, dan pantau proses penilaian langsung melalui sistem.
                        </p>

                        <div class="h-2 rounded-full bg-white/15 overflow-hidden">
                            <div class="h-full w-[78%] rounded-full bg-gradient-to-r from-[#F9A825] to-white"></div>
                        </div>
                    </div>
                </div>

                <div class="space-y-4">
                    <div class="clean-card flex items-start gap-4 p-4 rounded-2xl bg-[#F8FAFC] border border-[#1565C0]/10">
                        <div class="w-11 h-11 rounded-2xl bg-[#EAF3FF] text-[#1565C0] flex items-center justify-center font-extrabold shrink-0">
                            1
                        </div>
                        <div>
                            <h4 class="font-bold text-[#172033] mb-1">Daftar dan Lengkapi Profil</h4>
                            <p class="text-sm text-[#64748B] leading-relaxed">
                                Buat akun dan isi data diri sesuai kebutuhan pendaftaran.
                            </p>
                        </div>
                    </div>

                    <div class="clean-card flex items-start gap-4 p-4 rounded-2xl bg-[#F8FAFC] border border-[#1565C0]/10">
                        <div class="w-11 h-11 rounded-2xl bg-[#FFF8E1] text-[#F9A825] flex items-center justify-center font-extrabold shrink-0">
                            2
                        </div>
                        <div>
                            <h4 class="font-bold text-[#172033] mb-1">Upload Dokumen Pendukung</h4>
                            <p class="text-sm text-[#64748B] leading-relaxed">
                                Lampirkan ijazah, CV, sertifikat, dan bukti pengalaman kerja.
                            </p>
                        </div>
                    </div>

                    <div class="clean-card flex items-start gap-4 p-4 rounded-2xl bg-[#F8FAFC] border border-[#1565C0]/10">
                        <div class="w-11 h-11 rounded-2xl bg-[#FEECEC] text-[#E53935] flex items-center justify-center font-extrabold shrink-0">
                            3
                        </div>
                        <div>
                            <h4 class="font-bold text-[#172033] mb-1">Penilaian Akademik</h4>
                            <p class="text-sm text-[#64748B] leading-relaxed">
                                Dokumen diverifikasi dan dinilai oleh pihak akademik kampus.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</section>

{{-- ===== STATS ===== --}}
<section class="bg-white px-6 md:px-10 py-12 border-y border-[#1565C0]/10">
    <div class="max-w-7xl mx-auto grid grid-cols-2 md:grid-cols-4 gap-4">
        @foreach([
            ['2.500+', 'Pendaftar Aktif', 'Calon mahasiswa telah menggunakan sistem G-RPL'],
            ['45', 'Program Studi', 'Pilihan prodi tersedia untuk jalur RPL'],
            ['144', 'Maksimal SKS', 'Potensi pengakuan pembelajaran lampau'],
            ['2+', 'Tahun Pengalaman', 'Minimal pengalaman kerja yang relevan'],
        ] as $stat)
            <div class="section-reveal clean-card bg-[#F8FAFC] border border-[#1565C0]/10 rounded-3xl p-6 text-center">
                <div class="font-heading text-3xl md:text-4xl font-extrabold text-[#1565C0] mb-2">
                    {{ $stat[0] }}
                </div>

                <div class="text-sm font-bold text-[#172033] mb-2">
                    {{ $stat[1] }}
                </div>

                <p class="text-xs text-[#64748B] leading-relaxed">
                    {{ $stat[2] }}
                </p>
            </div>
        @endforeach
    </div>
</section>

{{-- ===== TENTANG RPL ===== --}}
<section id="tentang" class="relative bg-white px-6 md:px-10 py-24 overflow-hidden">
    <div class="absolute top-24 right-0 w-80 h-80 bg-[#1565C0]/5 rounded-full blur-3xl"></div>
    <div class="absolute bottom-10 left-0 w-80 h-80 bg-[#F9A825]/10 rounded-full blur-3xl"></div>

    <div class="relative max-w-7xl mx-auto">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-10 mb-12">
            <div class="lg:col-span-1 section-reveal">
                <span class="inline-flex px-4 py-2 rounded-full bg-[#EAF3FF] text-[#1565C0] text-xs font-bold uppercase tracking-[0.16em] mb-5">
                    Tentang Program
                </span>

                <h2 class="font-heading text-3xl md:text-4xl font-extrabold text-[#172033] leading-tight mb-5 text-balance">
                    Mengenal Program Rekognisi Pembelajaran Lampau
                </h2>

                <p class="text-sm md:text-base text-[#64748B] leading-relaxed mb-5">
                    RPL adalah pengakuan atas capaian pembelajaran seseorang yang diperoleh dari
                    pendidikan formal, nonformal, informal, atau pengalaman kerja sebagai dasar
                    untuk melanjutkan pendidikan formal.
                </p>

                <p class="text-sm md:text-base text-[#64748B] leading-relaxed">
                    Dengan RPL, pengalaman kerja, pelatihan, sertifikasi, dan portofolio yang relevan
                    dapat dinilai sebagai capaian akademik sehingga proses studi dapat menjadi lebih efisien.
                </p>
            </div>

            <div class="lg:col-span-2 grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="section-reveal-right clean-card group bg-white border border-[#1565C0]/10 rounded-[2rem] p-7 shadow-sm">
                    <div class="w-14 h-14 rounded-2xl bg-[#EAF3FF] text-[#1565C0] flex items-center justify-center mb-6">
                        <span class="font-heading text-2xl font-extrabold">A</span>
                    </div>

                    <span class="inline-flex items-center text-xs font-bold px-3 py-1 rounded-full bg-[#EAF3FF] text-[#0D47A1] mb-4">
                        RPL Tipe A
                    </span>

                    <h3 class="font-heading font-extrabold text-[#172033] text-xl mb-3">
                        Transfer Kredit
                    </h3>

                    <p class="text-sm text-[#64748B] leading-relaxed mb-6">
                        Digunakan untuk melanjutkan pendidikan formal di perguruan tinggi. Pengalaman
                        kerja atau pendidikan sebelumnya dapat dinilai untuk mengurangi beban SKS.
                    </p>

                    <div class="flex items-center gap-3 text-sm font-bold text-[#1565C0]">
                        <span>Fokus: lanjut studi</span>
                        <span class="w-8 h-[2px] bg-[#1565C0]/30"></span>
                    </div>
                </div>

                <div class="section-reveal-right clean-card group bg-white border border-[#F9A825]/25 rounded-[2rem] p-7 shadow-sm">
                    <div class="w-14 h-14 rounded-2xl bg-[#FFF8E1] text-[#F9A825] flex items-center justify-center mb-6">
                        <span class="font-heading text-2xl font-extrabold">B</span>
                    </div>

                    <span class="inline-flex items-center text-xs font-bold px-3 py-1 rounded-full bg-[#FFF8E1] text-[#B7791F] mb-4">
                        RPL Tipe B
                    </span>

                    <h3 class="font-heading font-extrabold text-[#172033] text-xl mb-3">
                        Penyetaraan
                    </h3>

                    <p class="text-sm text-[#64748B] leading-relaxed mb-6">
                        Digunakan untuk penyetaraan kualifikasi atau pengakuan kompetensi sesuai
                        standar akademik dan kebutuhan program studi.
                    </p>

                    <div class="flex items-center gap-3 text-sm font-bold text-[#B7791F]">
                        <span>Fokus: kompetensi</span>
                        <span class="w-8 h-[2px] bg-[#F9A825]/40"></span>
                    </div>
                </div>
            </div>
        </div>

        <div class="section-reveal bg-gradient-to-r from-[#EAF3FF] to-[#FFF8E1] border border-[#1565C0]/10 rounded-[2rem] p-7 md:p-9 flex flex-col md:flex-row md:items-center md:justify-between gap-6">
            <div>
                <h3 class="font-heading text-2xl font-extrabold text-[#172033] mb-2">
                    Pengalamanmu Bisa Bernilai Akademik
                </h3>

                <p class="text-sm text-[#64748B] leading-relaxed max-w-2xl">
                    Sistem G-RPL dirancang untuk membantu proses pendaftaran, pengumpulan dokumen,
                    dan penilaian agar lebih mudah dipantau secara digital.
                </p>
            </div>

            <a
                href="#persyaratan"
                class="inline-flex items-center justify-center px-6 py-3 bg-white text-[#1565C0] border border-[#1565C0]/15 text-sm font-bold rounded-2xl hover:bg-[#1565C0] hover:text-white transition-all shadow-sm"
            >
                Lihat Persyaratan
            </a>
        </div>
    </div>
</section>

{{-- ===== FEATURE BANNER ===== --}}
<section class="relative overflow-hidden bg-[#0D47A1] px-6 md:px-10 py-24">
    <div class="absolute -top-24 -left-24 w-96 h-96 bg-[#1565C0] rounded-full blur-3xl opacity-40"></div>
    <div class="absolute -bottom-32 -right-24 w-96 h-96 bg-[#F9A825]/25 rounded-full blur-3xl"></div>

    <div class="relative max-w-7xl mx-auto grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
        <div class="section-reveal">
            <span class="inline-flex px-4 py-2 rounded-full bg-white/10 border border-white/15 text-white text-xs font-bold uppercase tracking-[0.16em] mb-5">
                Sistem Terintegrasi
            </span>

            <h2 class="font-heading text-3xl md:text-5xl font-extrabold text-white leading-tight mb-6 text-balance">
                Satu Portal untuk Pendaftaran, Dokumen, dan Pemantauan Proses
            </h2>

            <p class="text-sm md:text-base text-white/75 leading-relaxed max-w-2xl">
                Tampilan G-RPL dibuat agar calon mahasiswa dapat memahami alur pendaftaran
                dengan cepat, tanpa tampilan yang berat atau membingungkan.
            </p>
        </div>

        <div class="section-reveal-right grid grid-cols-1 sm:grid-cols-2 gap-5">
            @foreach([
                ['01', 'Data Peserta', 'Profil peserta tersimpan rapi dalam sistem.'],
                ['02', 'Dokumen Digital', 'Upload berkas pendukung dengan alur sederhana.'],
                ['03', 'Verifikasi Admin', 'Dokumen dapat dicek dan diverifikasi.'],
                ['04', 'Penilaian Asesor', 'Proses asesmen berjalan lebih terarah.'],
            ] as $system)
                <div class="clean-card bg-white/10 border border-white/15 rounded-3xl p-6 backdrop-blur hover:bg-white/15 transition-all">
                    <div class="text-[#F9A825] font-heading text-2xl font-extrabold mb-4">
                        {{ $system[0] }}
                    </div>

                    <h3 class="font-heading text-lg font-extrabold text-white mb-2">
                        {{ $system[1] }}
                    </h3>

                    <p class="text-sm text-white/65 leading-relaxed">
                        {{ $system[2] }}
                    </p>
                </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ===== KEUNGGULAN ===== --}}
<section id="keunggulan" class="bg-[#F8FAFC] px-6 md:px-10 py-24 border-y border-[#1565C0]/10">
    <div class="max-w-7xl mx-auto">
        <div class="section-reveal text-center max-w-3xl mx-auto mb-14">
            <span class="inline-flex px-4 py-2 rounded-full bg-white border border-[#1565C0]/10 text-[#1565C0] text-xs font-bold uppercase tracking-[0.16em] mb-5">
                Keunggulan G-RPL
            </span>

            <h2 class="font-heading text-3xl md:text-4xl font-extrabold text-[#172033] mb-4">
                Sistem yang Mudah, Resmi, dan Terarah
            </h2>

            <p class="text-sm md:text-base text-[#64748B] leading-relaxed">
                G-RPL membantu calon mahasiswa mengikuti proses pendaftaran RPL dengan tampilan
                yang sederhana, nyaman, dan informatif.
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @foreach([
                [
                    'bg' => 'bg-[#EAF3FF]',
                    'text' => 'text-[#1565C0]',
                    'title' => 'Efisiensi Waktu',
                    'desc' => 'Masa studi dapat menjadi lebih singkat karena SKS disesuaikan dengan portofolio dan pengalaman yang relevan.',
                    'icon' => 'M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z'
                ],
                [
                    'bg' => 'bg-[#FFF8E1]',
                    'text' => 'text-[#F9A825]',
                    'title' => 'Proses Digital',
                    'desc' => 'Dari pendaftaran, unggah dokumen, hingga pemantauan status dapat dilakukan secara online.',
                    'icon' => 'M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z'
                ],
                [
                    'bg' => 'bg-[#FEECEC]',
                    'text' => 'text-[#E53935]',
                    'title' => 'Transparan',
                    'desc' => 'Status pengajuan lebih mudah dipantau sehingga peserta mengetahui perkembangan prosesnya.',
                    'icon' => 'M15 12a3 3 0 11-6 0 3 3 0 016 0z M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z'
                ],
            ] as $item)
                <div class="section-reveal clean-card bg-white border border-[#1565C0]/10 rounded-[2rem] p-7 shadow-sm">
                    <div class="w-14 h-14 rounded-2xl {{ $item['bg'] }} {{ $item['text'] }} flex items-center justify-center mb-6">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $item['icon'] }}"/>
                        </svg>
                    </div>

                    <h3 class="font-heading text-xl font-extrabold text-[#172033] mb-3">
                        {{ $item['title'] }}
                    </h3>

                    <p class="text-sm text-[#64748B] leading-relaxed">
                        {{ $item['desc'] }}
                    </p>
                </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ===== ALUR PENDAFTARAN ===== --}}
<section id="alur" class="relative bg-white px-6 md:px-10 py-24 overflow-hidden">
    <div class="absolute top-0 right-0 w-80 h-80 bg-[#1565C0]/5 rounded-full blur-3xl"></div>

    <div class="relative max-w-7xl mx-auto">
        <div class="section-reveal text-center max-w-3xl mx-auto mb-14">
            <span class="inline-flex px-4 py-2 rounded-full bg-[#EAF3FF] text-[#1565C0] text-xs font-bold uppercase tracking-[0.16em] mb-5">
                Tahapan Pendaftaran
            </span>

            <h2 class="font-heading text-3xl md:text-4xl font-extrabold text-[#172033] mb-4">
                Alur Pendaftaran Digital
            </h2>

            <p class="text-sm md:text-base text-[#64748B] leading-relaxed">
                Ikuti proses pendaftaran secara bertahap mulai dari pembuatan akun hingga menunggu hasil penilaian.
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-5 gap-6">
            @foreach([
                ['1', 'Daftar Akun', 'Buat akun dan lengkapi data awal peserta.'],
                ['2', 'Pilih Program', 'Pilih tipe RPL dan program studi tujuan.'],
                ['3', 'Upload Dokumen', 'Unggah dokumen akademik dan pengalaman kerja.'],
                ['4', 'Isi Pengalaman', 'Masukkan riwayat kerja, pelatihan, dan portofolio.'],
                ['5', 'Submit Penilaian', 'Kirim pengajuan dan tunggu proses verifikasi.'],
            ] as $step)
                <div class="section-reveal relative">
                    @if(!$loop->last)
                        <div class="hidden md:block absolute top-8 left-[58%] w-full h-[2px] bg-gradient-to-r from-[#1565C0]/25 to-transparent"></div>
                    @endif

                    <div class="clean-card relative bg-[#F8FAFC] border border-[#1565C0]/10 rounded-[2rem] p-6 text-center h-full hover:bg-white">
                        <div class="w-16 h-16 rounded-2xl bg-[#1565C0] text-white font-heading font-extrabold text-xl flex items-center justify-center mx-auto mb-5 shadow-lg shadow-blue-500/20 ring-4 ring-white">
                            {{ $step[0] }}
                        </div>

                        <h3 class="font-heading text-lg font-extrabold text-[#172033] mb-2">
                            {{ $step[1] }}
                        </h3>

                        <p class="text-xs text-[#64748B] leading-relaxed">
                            {{ $step[2] }}
                        </p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ===== PENGUMUMAN ===== --}}
<section id="pengumuman" class="bg-[#F8FAFC] px-6 md:px-10 py-24 border-y border-[#1565C0]/10">
    <div class="max-w-7xl mx-auto">
        <div class="section-reveal mb-12 flex flex-col lg:flex-row lg:items-end justify-between gap-6">
            <div>
                <span class="inline-flex px-4 py-2 rounded-full bg-white border border-[#1565C0]/10 text-[#1565C0] text-xs font-bold uppercase tracking-[0.16em] mb-5">
                    Informasi Terbaru
                </span>

                <h2 class="font-heading text-3xl md:text-4xl font-extrabold text-[#172033] mb-3">
                    Papan Pengumuman
                </h2>

                <p class="text-sm md:text-base text-[#64748B] leading-relaxed max-w-2xl">
                    Pusat informasi terbaru terkait jadwal, seleksi, dan berita program RPL.
                </p>
            </div>

            <div class="relative">
                <input
                    type="text"
                    placeholder="Cari pengumuman..."
                    class="w-full lg:w-72 bg-white border border-[#1565C0]/15 rounded-2xl pl-11 pr-4 py-3 text-sm focus:outline-none focus:border-[#1565C0] focus:ring-4 focus:ring-[#1565C0]/10 transition"
                >

                <svg class="w-4 h-4 text-[#64748B] absolute left-4 top-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                </svg>
            </div>
        </div>

        @php
            $news = [
                [
                    'tag' => 'Penting',
                    'color' => 'red',
                    'date' => '05 Mei 2026',
                    'title' => 'Perpanjangan Masa Unggah Portofolio Gelombang 1',
                    'desc' => 'Diberitahukan kepada seluruh pendaftar gelombang 1, batas waktu unggah dokumen portofolio diperpanjang hingga tanggal 10 Mei 2026 pukul 23:59 WIB.'
                ],
                [
                    'tag' => 'Jadwal',
                    'color' => 'blue',
                    'date' => '02 Mei 2026',
                    'title' => 'Jadwal Wawancara Asesmen Fakultas Teknik',
                    'desc' => 'Bagi calon mahasiswa yang telah lolos seleksi administrasi, jadwal wawancara asesmen akan dilaksanakan secara daring melalui Zoom.'
                ],
                [
                    'tag' => 'Informasi',
                    'color' => 'yellow',
                    'date' => '28 April 2026',
                    'title' => 'Panduan Pengisian Form Learning Outcomes',
                    'desc' => 'Silakan unduh dokumen panduan tata cara mendeskripsikan pengalaman kerja ke dalam form Learning Outcomes atau Capaian Pembelajaran.'
                ],
                [
                    'tag' => 'Informasi',
                    'color' => 'yellow',
                    'date' => '15 April 2026',
                    'title' => 'Sosialisasi Program RPL Tipe A Tahun 2026',
                    'desc' => 'Universitas mengadakan webinar sosialisasi program RPL untuk calon pendaftar. Rekaman webinar dapat diakses melalui dashboard.'
                ],
                [
                    'tag' => 'Penting',
                    'color' => 'red',
                    'date' => '01 April 2026',
                    'title' => 'Pembukaan Pendaftaran RPL Semester Ganjil',
                    'desc' => 'Pendaftaran program Rekognisi Pembelajaran Lampau resmi dibuka untuk berbagai program studi.'
                ],
                [
                    'tag' => 'Jadwal',
                    'color' => 'blue',
                    'date' => '25 Maret 2026',
                    'title' => 'Simulasi Pengisian Portofolio Online',
                    'desc' => 'Calon peserta dapat mengikuti simulasi pengisian data portofolio untuk memahami proses pendaftaran.'
                ],
            ];
        @endphp

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($news as $item)
                <div class="section-reveal clean-card bg-white rounded-[2rem] border border-[#1565C0]/10 overflow-hidden flex flex-col">
                    <div class="p-7 flex-grow">
                        <div class="flex items-center justify-between mb-5">
                            @if($item['color'] == 'red')
                                <span class="px-3 py-1.5 bg-[#FEECEC] text-[#E53935] text-[10px] font-bold uppercase tracking-wider rounded-full">
                                    {{ $item['tag'] }}
                                </span>
                            @elseif($item['color'] == 'blue')
                                <span class="px-3 py-1.5 bg-[#EAF3FF] text-[#1565C0] text-[10px] font-bold uppercase tracking-wider rounded-full">
                                    {{ $item['tag'] }}
                                </span>
                            @else
                                <span class="px-3 py-1.5 bg-[#FFF8E1] text-[#B7791F] text-[10px] font-bold uppercase tracking-wider rounded-full">
                                    {{ $item['tag'] }}
                                </span>
                            @endif

                            <span class="text-[11px] font-semibold text-[#64748B]">
                                {{ $item['date'] }}
                            </span>
                        </div>

                        <h3 class="font-heading text-lg font-extrabold text-[#172033] mb-3 leading-tight">
                            {{ $item['title'] }}
                        </h3>

                        <p class="text-sm text-[#64748B] leading-relaxed">
                            {{ $item['desc'] }}
                        </p>
                    </div>

                    <div class="px-7 py-5 border-t border-[#1565C0]/10 bg-[#F8FAFC]">
                        <a href="#pengumuman" class="text-sm font-bold text-[#1565C0] hover:text-[#0D47A1] inline-flex items-center gap-1.5">
                            Baca Selengkapnya

                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                            </svg>
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ===== PERSYARATAN ===== --}}
<section id="persyaratan" class="relative bg-white px-6 md:px-10 py-24 overflow-hidden">
    <div class="absolute -top-20 -right-20 w-96 h-96 bg-[#1565C0]/5 rounded-full blur-3xl"></div>

    <div class="relative max-w-7xl mx-auto">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-start">
            <div class="section-reveal">
                <span class="inline-flex px-4 py-2 rounded-full bg-[#EAF3FF] text-[#1565C0] text-xs font-bold uppercase tracking-[0.16em] mb-5">
                    Persyaratan & Dokumen
                </span>

                <h2 class="font-heading text-3xl md:text-4xl font-extrabold text-[#172033] leading-tight mb-5">
                    Siapkan Dokumen Sebelum Mendaftar
                </h2>

                <p class="text-sm md:text-base text-[#64748B] leading-relaxed mb-8">
                    Pastikan dokumen pendukung telah disiapkan agar proses pengajuan RPL berjalan
                    lebih lancar. Dokumen akan digunakan sebagai bukti capaian pembelajaran,
                    pengalaman kerja, dan kompetensi yang dimiliki.
                </p>

                <div class="bg-gradient-to-br from-[#1565C0] to-[#0D47A1] rounded-[2rem] p-7 text-white shadow-xl shadow-blue-900/10 relative overflow-hidden">
                    <div class="absolute -right-12 -top-12 w-36 h-36 rounded-full bg-white/10"></div>
                    <div class="absolute -left-12 -bottom-12 w-36 h-36 rounded-full bg-[#F9A825]/20"></div>

                    <div class="relative">
                        <h3 class="font-heading text-xl font-extrabold mb-5">
                            Catatan Penting
                        </h3>

                        <ul class="space-y-4 text-sm text-white/80 leading-relaxed">
                            <li class="flex gap-3">
                                <span class="font-bold text-[#F9A825]">1.</span>
                                <span>Semua file maksimal berukuran 2MB.</span>
                            </li>

                            <li class="flex gap-3">
                                <span class="font-bold text-[#F9A825]">2.</span>
                                <span>Format dokumen wajib PDF atau JPG/PNG.</span>
                            </li>

                            <li class="flex gap-3">
                                <span class="font-bold text-[#F9A825]">3.</span>
                                <span>Dokumen harus terlihat jelas, lengkap, dan tidak terpotong.</span>
                            </li>

                            <li class="flex gap-3">
                                <span class="font-bold text-[#F9A825]">4.</span>
                                <span>Data yang diunggah harus sesuai dengan dokumen asli.</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="section-reveal-right">
                <div class="bg-[#F8FAFC] border border-[#1565C0]/10 rounded-[2rem] p-6 md:p-8">
                    <h3 class="font-heading text-2xl font-extrabold text-[#172033] mb-6">
                        Dokumen Administrasi
                    </h3>

                    <div class="space-y-4">
                        @foreach([
                            ['KTP Scan Asli', 'Identitas resmi peserta yang masih berlaku.'],
                            ['Ijazah Terakhir', 'Dokumen pendidikan formal terakhir yang telah ditempuh.'],
                            ['Transkrip Nilai', 'Riwayat nilai akademik dari pendidikan sebelumnya.'],
                            ['Surat Keterangan Kerja', 'Minimal 2 tahun pengalaman kerja yang relevan.'],
                            ['CV / Riwayat Hidup', 'Profil pengalaman kerja, pelatihan, dan kompetensi.'],
                            ['Sertifikat Pendukung', 'Sertifikat pelatihan, profesi, atau portofolio relevan.'],
                        ] as $doc)
                            <div class="clean-card flex items-start gap-4 p-4 bg-white rounded-2xl border border-[#1565C0]/10 shadow-sm">
                                <div class="w-11 h-11 rounded-2xl bg-[#EAF3FF] text-[#1565C0] flex items-center justify-center shrink-0">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                </div>

                                <div>
                                    <h4 class="font-heading text-base font-extrabold text-[#172033] mb-1">
                                        {{ $doc[0] }}
                                    </h4>

                                    <p class="text-sm text-[#64748B] leading-relaxed">
                                        {{ $doc[1] }}
                                    </p>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="mt-7">
                        <a
                            href="{{ route('register') }}"
                            class="w-full inline-flex items-center justify-center px-7 py-3.5 bg-[#1565C0] text-white text-sm font-bold rounded-2xl hover:bg-[#0D47A1] transition-all shadow-lg shadow-blue-500/20"
                        >
                            Mulai Pendaftaran
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ===== FAQ ===== --}}
<section id="faq" class="bg-[#F8FAFC] px-6 md:px-10 py-24 border-y border-[#1565C0]/10">
    <div class="max-w-4xl mx-auto">
        <div class="section-reveal text-center mb-12">
            <span class="inline-flex px-4 py-2 rounded-full bg-white border border-[#1565C0]/10 text-[#1565C0] text-xs font-bold uppercase tracking-[0.16em] mb-5">
                Pusat Bantuan
            </span>

            <h2 class="font-heading text-3xl md:text-4xl font-extrabold text-[#172033] mb-4">
                Pertanyaan yang Sering Diajukan
            </h2>

            <p class="text-sm md:text-base text-[#64748B] leading-relaxed">
                Temukan jawaban untuk pertanyaan yang paling sering diajukan seputar program RPL.
            </p>
        </div>

        @php
            $faqs = [
                [
                    'Siapa saja yang bisa mendaftar program RPL?',
                    'Program ini terbuka untuk seluruh Warga Negara Indonesia (WNI) lulusan minimal SMA/Sederajat yang memiliki pengalaman kerja relevan minimal 2 tahun atau memiliki sertifikasi kompetensi/pelatihan di bidang terkait.'
                ],
                [
                    'Apakah ijazah lulusan RPL berbeda dengan reguler?',
                    'Tidak. Ijazah yang diterbitkan untuk lulusan jalur RPL sama dengan ijazah jalur reguler dan tidak ada tulisan "Lulusan RPL" di ijazah tersebut.'
                ],
                [
                    'Berapa biaya pendaftaran dan konversi SKS?',
                    'Biaya pendaftaran adalah Rp 500.000 untuk asesmen. Biaya per-SKS yang diakui dan biaya SPP per semester akan disesuaikan dengan kebijakan program studi masing-masing.'
                ],
                [
                    'Bagaimana jika dokumen asli saya hilang?',
                    'Anda diwajibkan melampirkan Surat Keterangan Kehilangan dari Kepolisian dan surat keterangan resmi atau legalisir dari instansi atau sekolah yang menerbitkan dokumen tersebut.'
                ],
                [
                    'Berapa lama proses asesmen atau penilaian portofolio?',
                    'Proses verifikasi dokumen memakan waktu 3-5 hari kerja. Sedangkan proses wawancara dan asesmen penilaian portofolio oleh asesor memakan waktu sekitar 2-3 minggu.'
                ],
            ];
        @endphp

        <div class="space-y-4">
            @foreach($faqs as $faq)
                <div class="section-reveal bg-white border border-[#1565C0]/10 rounded-[2rem] overflow-hidden shadow-sm hover:border-[#1565C0]/30 transition-all">
                    <details class="group p-6">
                        <summary class="list-none cursor-pointer flex justify-between items-center gap-5 font-heading font-extrabold text-[#172033] text-sm md:text-base">
                            <span>{{ $faq[0] }}</span>

                            <span class="w-10 h-10 rounded-2xl bg-[#EAF3FF] text-[#1565C0] group-open:rotate-180 transition-transform duration-300 flex items-center justify-center flex-shrink-0">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                </svg>
                            </span>
                        </summary>

                        <div class="mt-5 pt-5 border-t border-[#1565C0]/10 text-sm text-[#64748B] leading-relaxed">
                            {{ $faq[1] }}
                        </div>
                    </details>
                </div>
            @endforeach
        </div>

        <div class="section-reveal mt-12 text-center bg-white border border-[#1565C0]/10 p-8 rounded-[2rem] shadow-sm">
            <p class="text-base text-[#172033] font-extrabold mb-2">
                Masih punya pertanyaan?
            </p>

            <p class="text-sm text-[#64748B] mb-6">
                Tim admin siap membantu Anda dari Senin-Jumat pukul 08:00 - 16:00.
            </p>

            <a
                href="mailto:admin@g-rpl.ac.id"
                class="inline-flex items-center justify-center px-7 py-3 bg-[#1565C0] text-white text-sm font-bold rounded-2xl hover:bg-[#0D47A1] transition-all shadow-lg shadow-blue-500/20"
            >
                Hubungi Kami
            </a>
        </div>
    </div>
</section>

{{-- ===== FINAL CTA ===== --}}
<section class="relative overflow-hidden bg-white px-6 md:px-10 py-24">
    <div class="absolute inset-0 bg-gradient-to-br from-[#1565C0]/5 via-transparent to-[#F9A825]/10"></div>

    <div class="relative max-w-5xl mx-auto">
        <div class="section-reveal bg-gradient-to-br from-[#1565C0] to-[#0D47A1] rounded-[2.5rem] p-8 md:p-12 text-center shadow-2xl shadow-blue-900/20 overflow-hidden relative">
            <div class="absolute -top-20 -right-20 w-56 h-56 rounded-full bg-white/10 soft-orb"></div>
            <div class="absolute -bottom-24 -left-24 w-64 h-64 rounded-full bg-[#F9A825]/20 soft-orb-delay"></div>

            <div class="relative">
                <div class="inline-flex items-center justify-center bg-white rounded-3xl p-4 shadow-xl mb-7">
                    <img src="{{ asset('images/logo.png') }}" alt="G-RPL" class="h-12 w-auto">
                </div>

                <h2 class="font-heading text-3xl md:text-4xl font-extrabold text-white mb-5">
                    Mulai Perjalanan Akademik Anda Hari Ini
                </h2>

                <p class="text-sm md:text-base text-white/75 max-w-2xl mx-auto mb-8 leading-relaxed">
                    Jadikan pengalaman kerja dan pembelajaran yang sudah Anda miliki sebagai langkah
                    nyata untuk melanjutkan pendidikan formal melalui G-RPL.
                </p>

                <div class="flex flex-col sm:flex-row justify-center gap-4">
                    <a
                        href="#persyaratan"
                        class="px-8 py-3.5 bg-white text-[#1565C0] text-sm font-bold rounded-2xl hover:bg-[#EAF3FF] transition-all shadow-lg hover:-translate-y-1"
                    >
                        Cek Persyaratan
                    </a>

                    <a
                        href="{{ route('register') }}"
                        class="px-8 py-3.5 bg-[#F9A825] text-[#5D3B00] text-sm font-bold rounded-2xl hover:bg-[#FFB300] transition-all shadow-lg shadow-yellow-500/20 hover:-translate-y-1"
                    >
                        Daftar Sekarang
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const preloader = document.getElementById('page-preloader');
        const preloaderBar = document.getElementById('preloader-bar');
        const preloaderPercent = document.getElementById('preloader-percent');

        let progress = 0;

        const loadingInterval = setInterval(function () {
            progress += Math.floor(Math.random() * 12) + 6;

            if (progress >= 90) {
                progress = 90;
                clearInterval(loadingInterval);
            }

            preloaderBar.style.width = progress + '%';
            preloaderPercent.textContent = progress;
        }, 120);

        window.addEventListener('load', function () {
            clearInterval(loadingInterval);

            let finalProgress = progress;

            const finishInterval = setInterval(function () {
                finalProgress += 2;

                if (finalProgress >= 100) {
                    finalProgress = 100;
                }

                preloaderBar.style.width = finalProgress + '%';
                preloaderPercent.textContent = finalProgress;

                if (finalProgress >= 100) {
                    clearInterval(finishInterval);

                    setTimeout(function () {
                        preloader.classList.add('hide');
                    }, 250);
                }
            }, 18);
        });

        const revealItems = document.querySelectorAll('.section-reveal, .section-reveal-right');

        const revealObserver = new IntersectionObserver(function (entries) {
            entries.forEach(function (entry) {
                if (entry.isIntersecting) {
                    entry.target.classList.add('is-visible');
                    revealObserver.unobserve(entry.target);
                }
            });
        }, {
            threshold: 0.14,
            rootMargin: '0px 0px -40px 0px'
        });

        revealItems.forEach(function (item) {
            revealObserver.observe(item);
        });
    });
</script>

<x-footer />

@endsection