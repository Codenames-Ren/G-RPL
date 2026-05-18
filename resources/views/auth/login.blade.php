{{-- resources/views/auth/login.blade.php --}}
@extends('layouts.app')
@section('title', 'Masuk')
@section('content')

<x-auth-navbar>
    <x-slot name="rightSlot">
        {{-- Dikosongkan, tidak menampilkan teks apapun di header --}}
    </x-slot>
</x-auth-navbar>

@php
    $identifierDesktopClass = [
        'w-full rounded-lg px-4 py-3 text-sm text-[#1A1A2E] bg-white outline-none transition-all placeholder:text-gray-400',
        'border border-[#D32F2F] focus:border-[#D32F2F] focus:ring-4 focus:ring-[#D32F2F]/10' => $errors->has('identifier'),
        'border border-gray-300 focus:border-[#1565C0] focus:ring-4 focus:ring-[#1565C0]/10' => !$errors->has('identifier'),
    ];

    $passwordDesktopClass = [
        'w-full rounded-lg px-4 py-3 text-sm text-[#1A1A2E] bg-white outline-none transition-all placeholder:text-gray-400',
        'border border-[#D32F2F] focus:border-[#D32F2F] focus:ring-4 focus:ring-[#D32F2F]/10' => $errors->has('password'),
        'border border-gray-300 focus:border-[#1565C0] focus:ring-4 focus:ring-[#1565C0]/10' => !$errors->has('password'),
    ];

    $identifierMobileClass = [
        'w-full rounded-lg px-3.5 py-2.5 text-sm text-[#1A1A2E] bg-white outline-none transition-all placeholder:text-gray-400',
        'border border-[#D32F2F] focus:border-[#D32F2F] focus:ring-4 focus:ring-[#D32F2F]/10' => $errors->has('identifier'),
        'border border-gray-300 focus:border-[#1565C0] focus:ring-4 focus:ring-[#1565C0]/10' => !$errors->has('identifier'),
    ];

    $passwordMobileClass = [
        'w-full rounded-lg px-3.5 py-2.5 text-sm text-[#1A1A2E] bg-white outline-none transition-all placeholder:text-gray-400',
        'border border-[#D32F2F] focus:border-[#D32F2F] focus:ring-4 focus:ring-[#D32F2F]/10' => $errors->has('password'),
        'border border-gray-300 focus:border-[#1565C0] focus:ring-4 focus:ring-[#1565C0]/10' => !$errors->has('password'),
    ];
@endphp


{{-- ========================= --}}
{{-- DESKTOP / LAPTOP VERSION --}}
{{-- ========================= --}}
<main class="hidden lg:flex min-h-[calc(100vh-56px)] items-center justify-center bg-[#F5F6FA] px-8 py-12">

    <div class="w-full max-w-[430px] rounded-2xl border border-[#1565C0]/10 bg-white px-8 py-8 shadow-sm">

        {{-- Logo --}}
        <div class="mb-6 flex items-center justify-center gap-2.5">
            <img src="{{ asset('images/logo.png') }}" alt="G-RPL" class="h-9 w-auto">
            <span class="font-heading text-xl font-bold tracking-tight text-[#1565C0]">
                G-RPL
            </span>
        </div>

        {{-- Header --}}
        <div class="mb-8 text-center">
            <h1 class="font-heading text-[28px] font-bold leading-tight text-[#1A1A2E]">
                Selamat Datang
            </h1>
            <p class="mt-2 text-[15px] text-[#5A6478]">
                Silakan masuk menggunakan akun Anda
            </p>
        </div>

        {{-- Form Universal --}}
        <form method="POST" action="{{ route('login') }}" class="space-y-4">
            @csrf

            {{-- Input Identifier --}}
            <div>
                <label class="mb-1.5 block text-[13px] font-bold text-[#1A1A2E]" for="identifier_desktop">
                    Email / NIK / Username
                </label>

                <input
                    type="text"
                    name="identifier"
                    id="identifier_desktop"
                    value="{{ old('identifier') }}"
                    required
                    autofocus
                    placeholder="Masukkan Email, NIK, atau Username"
                    @class($identifierDesktopClass)
                >

                @error('identifier')
                    <p class="mt-1.5 text-xs text-[#D32F2F]">{{ $message }}</p>
                @enderror
            </div>

            {{-- Input Password --}}
            <div>
                <label class="mb-1.5 block text-[13px] font-bold text-[#1A1A2E]" for="password_desktop">
                    Kata Sandi
                </label>

                <input
                    type="password"
                    name="password"
                    id="password_desktop"
                    required
                    placeholder="Masukkan Kata Sandi"
                    @class($passwordDesktopClass)
                >

                @error('password')
                    <p class="mt-1.5 text-xs text-[#D32F2F]">{{ $message }}</p>
                @enderror
            </div>

            {{-- Remember + Forgot --}}
            <div class="flex items-center justify-between gap-3 pt-1">
                <label class="flex cursor-pointer select-none items-center gap-2 text-sm text-[#5A6478]">
                    <input
                        type="checkbox"
                        name="remember"
                        class="h-4 w-4 rounded border-gray-300 text-[#1565C0] focus:ring-[#1565C0]"
                    >
                    <span>Ingat Saya</span>
                </label>

                <a href="{{ route('password.request') }}"
                   class="whitespace-nowrap text-sm font-bold text-[#1565C0] hover:text-[#0D47A1] hover:underline">
                    Lupa Sandi?
                </a>
            </div>

            {{-- Button --}}
            <button
                type="submit"
                class="w-full rounded-lg bg-[#1565C0] py-3 text-sm font-bold text-white transition-colors hover:bg-[#0D47A1] active:bg-[#0A3A85]">
                Masuk ke Sistem
            </button>
        </form>

        {{-- Footer Links --}}
        <div class="mt-6 space-y-3 text-center text-sm text-[#5A6478]">
            <p class="leading-relaxed">
                Belum punya akun Calon Mahasiswa?
                <a href="{{ route('register') }}"
                   class="font-bold text-[#1565C0] hover:text-[#0D47A1] hover:underline">
                    Daftar di sini
                </a>
            </p>

            <p>
                <a href="{{ route('welcome') }}"
                   class="font-bold text-[#1565C0] hover:text-[#0D47A1] hover:underline">
                    Balik ke beranda
                </a>
            </p>
        </div>

        {{-- Info Box --}}
        <div class="mt-6 border-t border-gray-100 pt-5">
            <div class="flex gap-3 rounded-xl border border-[#1565C0]/10 bg-[#1565C0]/5 px-4 py-3">
                <svg class="mt-0.5 h-5 w-5 flex-shrink-0 text-[#1565C0]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                    </path>
                </svg>

                <p class="text-left text-xs leading-relaxed text-[#5A6478]">
                    Bagi Asesor dan Pengelola, silakan masuk menggunakan kredensial
                    <span class="font-semibold text-[#1A1A2E]">Email/Username</span>
                    yang telah diberikan oleh Admin Sistem.
                </p>
            </div>
        </div>

    </div>
</main>


{{-- ================= --}}
{{-- MOBILE / HP VERSION --}}
{{-- ================= --}}
<main class="flex lg:hidden min-h-[calc(100vh-56px)] items-center justify-center bg-[#F5F6FA] px-4 py-6">

    <div class="w-full max-w-[380px] rounded-2xl border border-[#1565C0]/10 bg-white px-5 py-6 shadow-sm">

        {{-- Logo --}}
        <div class="mb-5 flex items-center justify-center gap-2">
            <img src="{{ asset('images/logo.png') }}" alt="G-RPL" class="h-8 w-auto">
            <span class="font-heading text-lg font-bold tracking-tight text-[#1565C0]">
                G-RPL
            </span>
        </div>

        {{-- Header --}}
        <div class="mb-6 text-center">
            <h1 class="font-heading text-[24px] font-bold leading-tight text-[#1A1A2E]">
                Selamat Datang
            </h1>
            <p class="mt-2 text-sm leading-relaxed text-[#5A6478]">
                Silakan masuk menggunakan akun Anda
            </p>
        </div>

        {{-- Form Universal --}}
        <form method="POST" action="{{ route('login') }}" class="space-y-4">
            @csrf

            {{-- Input Identifier --}}
            <div>
                <label class="mb-1.5 block text-xs font-bold text-[#1A1A2E]" for="identifier_mobile">
                    Email / NIK / Username
                </label>

                <input
                    type="text"
                    name="identifier"
                    id="identifier_mobile"
                    value="{{ old('identifier') }}"
                    required
                    placeholder="Masukkan Email, NIK, atau Username"
                    @class($identifierMobileClass)
                >

                @error('identifier')
                    <p class="mt-1.5 text-xs text-[#D32F2F]">{{ $message }}</p>
                @enderror
            </div>

            {{-- Input Password --}}
            <div>
                <label class="mb-1.5 block text-xs font-bold text-[#1A1A2E]" for="password_mobile">
                    Kata Sandi
                </label>

                <input
                    type="password"
                    name="password"
                    id="password_mobile"
                    required
                    placeholder="Masukkan Kata Sandi"
                    @class($passwordMobileClass)
                >

                @error('password')
                    <p class="mt-1.5 text-xs text-[#D32F2F]">{{ $message }}</p>
                @enderror
            </div>

            {{-- Remember + Forgot --}}
            <div class="flex items-center justify-between gap-3 pt-1">
                <label class="flex cursor-pointer select-none items-center gap-2 text-sm text-[#5A6478]">
                    <input
                        type="checkbox"
                        name="remember"
                        class="h-4 w-4 rounded border-gray-300 text-[#1565C0] focus:ring-[#1565C0]"
                    >
                    <span>Ingat Saya</span>
                </label>

                <a href="{{ route('password.request') }}"
                   class="whitespace-nowrap text-sm font-bold text-[#1565C0] hover:text-[#0D47A1] hover:underline">
                    Lupa Sandi?
                </a>
            </div>

            {{-- Button --}}
            <button
                type="submit"
                class="w-full rounded-lg bg-[#1565C0] py-3 text-sm font-bold text-white transition-colors hover:bg-[#0D47A1] active:bg-[#0A3A85]">
                Masuk ke Sistem
            </button>
        </form>

        {{-- Footer Links --}}
        <div class="mt-5 space-y-3 text-center text-sm text-[#5A6478]">
            <p class="leading-relaxed">
                Belum punya akun Calon Mahasiswa?
                <a href="{{ route('register') }}"
                   class="font-bold text-[#1565C0] hover:text-[#0D47A1] hover:underline">
                    Daftar di sini
                </a>
            </p>

            <p>
                <a href="{{ route('welcome') }}"
                   class="font-bold text-[#1565C0] hover:text-[#0D47A1] hover:underline">
                    Balik ke beranda
                </a>
            </p>
        </div>

        {{-- Info Box --}}
        <div class="mt-5 border-t border-gray-100 pt-4">
            <div class="flex gap-3 rounded-xl border border-[#1565C0]/10 bg-[#1565C0]/5 px-3.5 py-3">
                <svg class="mt-0.5 h-5 w-5 flex-shrink-0 text-[#1565C0]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                    </path>
                </svg>

                <p class="text-left text-xs leading-relaxed text-[#5A6478]">
                    Bagi Asesor dan Pengelola, silakan masuk menggunakan kredensial
                    <span class="font-semibold text-[#1A1A2E]">Email/Username</span>
                    yang telah diberikan oleh Admin Sistem.
                </p>
            </div>
        </div>

    </div>
</main>

{{-- SweetAlert2 --}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

{{-- Login Success --}}
@if (session('success'))
<script>
    Swal.fire({
        icon: 'success',
        title: 'Berhasil',
        text: '{{ session('success') }}',
        confirmButtonColor: '#1565C0',
        confirmButtonText: 'OK'
    });
</script>
@endif

{{-- Warning --}}
@if (session('warning'))
<script>
    Swal.fire({
        icon: 'warning',
        title: 'Perhatian',
        text: '{{ session('warning') }}',
        confirmButtonColor: '#F59E0B',
        confirmButtonText: 'Mengerti'
    });
</script>
@endif

{{-- Validation / Login Error --}}
@if ($errors->any())
<script>
    Swal.fire({
        icon: 'error',
        title: 'Login Gagal',
        html: `
            <ul style="text-align:left;">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        `,
        confirmButtonColor: '#D32F2F',
        confirmButtonText: 'Coba Lagi'
    });
</script>
@endif

@endsection