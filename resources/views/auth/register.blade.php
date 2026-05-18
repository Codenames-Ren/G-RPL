{{-- resources/views/auth/register.blade.php --}}
@extends('layouts.app')
@section('title', 'Daftar Akun')
@section('content')

@php
    $nikDesktopClass = [
        'w-full rounded-lg px-4 py-3 text-sm text-[#1A1A2E] bg-white outline-none transition-all placeholder:text-gray-400',
        'border border-[#D32F2F] focus:border-[#D32F2F] focus:ring-4 focus:ring-[#D32F2F]/10' => $errors->has('nik'),
        'border border-gray-300 focus:border-[#1565C0] focus:ring-4 focus:ring-[#1565C0]/10' => !$errors->has('nik'),
    ];

    $nameDesktopClass = [
        'w-full rounded-lg px-4 py-3 text-sm text-[#1A1A2E] bg-white outline-none transition-all placeholder:text-gray-400',
        'border border-[#D32F2F] focus:border-[#D32F2F] focus:ring-4 focus:ring-[#D32F2F]/10' => $errors->has('name'),
        'border border-gray-300 focus:border-[#1565C0] focus:ring-4 focus:ring-[#1565C0]/10' => !$errors->has('name'),
    ];

    $emailDesktopClass = [
        'w-full rounded-lg px-4 py-3 text-sm text-[#1A1A2E] bg-white outline-none transition-all placeholder:text-gray-400',
        'border border-[#D32F2F] focus:border-[#D32F2F] focus:ring-4 focus:ring-[#D32F2F]/10' => $errors->has('email'),
        'border border-gray-300 focus:border-[#1565C0] focus:ring-4 focus:ring-[#1565C0]/10' => !$errors->has('email'),
    ];

    $noHpDesktopClass = [
        'w-full rounded-lg px-4 py-3 text-sm text-[#1A1A2E] bg-white outline-none transition-all placeholder:text-gray-400',
        'border border-[#D32F2F] focus:border-[#D32F2F] focus:ring-4 focus:ring-[#D32F2F]/10' => $errors->has('no_hp'),
        'border border-gray-300 focus:border-[#1565C0] focus:ring-4 focus:ring-[#1565C0]/10' => !$errors->has('no_hp'),
    ];

    $alamatDesktopClass = [
        'w-full resize-none rounded-lg px-4 py-3 text-sm text-[#1A1A2E] bg-white outline-none transition-all placeholder:text-gray-400',
        'border border-[#D32F2F] focus:border-[#D32F2F] focus:ring-4 focus:ring-[#D32F2F]/10' => $errors->has('alamat'),
        'border border-gray-300 focus:border-[#1565C0] focus:ring-4 focus:ring-[#1565C0]/10' => !$errors->has('alamat'),
    ];

    $passwordDesktopClass = [
        'w-full rounded-lg px-4 py-3 text-sm text-[#1A1A2E] bg-white outline-none transition-all placeholder:text-gray-400',
        'border border-[#D32F2F] focus:border-[#D32F2F] focus:ring-4 focus:ring-[#D32F2F]/10' => $errors->has('password'),
        'border border-gray-300 focus:border-[#1565C0] focus:ring-4 focus:ring-[#1565C0]/10' => !$errors->has('password'),
    ];

    $confirmDesktopClass = [
        'w-full rounded-lg border border-gray-300 px-4 py-3 text-sm text-[#1A1A2E] bg-white outline-none transition-all placeholder:text-gray-400 focus:border-[#1565C0] focus:ring-4 focus:ring-[#1565C0]/10',
    ];

    $nikMobileClass = [
        'w-full rounded-lg px-3.5 py-2.5 text-sm text-[#1A1A2E] bg-white outline-none transition-all placeholder:text-gray-400',
        'border border-[#D32F2F] focus:border-[#D32F2F] focus:ring-4 focus:ring-[#D32F2F]/10' => $errors->has('nik'),
        'border border-gray-300 focus:border-[#1565C0] focus:ring-4 focus:ring-[#1565C0]/10' => !$errors->has('nik'),
    ];

    $nameMobileClass = [
        'w-full rounded-lg px-3.5 py-2.5 text-sm text-[#1A1A2E] bg-white outline-none transition-all placeholder:text-gray-400',
        'border border-[#D32F2F] focus:border-[#D32F2F] focus:ring-4 focus:ring-[#D32F2F]/10' => $errors->has('name'),
        'border border-gray-300 focus:border-[#1565C0] focus:ring-4 focus:ring-[#1565C0]/10' => !$errors->has('name'),
    ];

    $emailMobileClass = [
        'w-full rounded-lg px-3.5 py-2.5 text-sm text-[#1A1A2E] bg-white outline-none transition-all placeholder:text-gray-400',
        'border border-[#D32F2F] focus:border-[#D32F2F] focus:ring-4 focus:ring-[#D32F2F]/10' => $errors->has('email'),
        'border border-gray-300 focus:border-[#1565C0] focus:ring-4 focus:ring-[#1565C0]/10' => !$errors->has('email'),
    ];

    $noHpMobileClass = [
        'w-full rounded-lg px-3.5 py-2.5 text-sm text-[#1A1A2E] bg-white outline-none transition-all placeholder:text-gray-400',
        'border border-[#D32F2F] focus:border-[#D32F2F] focus:ring-4 focus:ring-[#D32F2F]/10' => $errors->has('no_hp'),
        'border border-gray-300 focus:border-[#1565C0] focus:ring-4 focus:ring-[#1565C0]/10' => !$errors->has('no_hp'),
    ];

    $alamatMobileClass = [
        'w-full resize-none rounded-lg px-3.5 py-2.5 text-sm text-[#1A1A2E] bg-white outline-none transition-all placeholder:text-gray-400',
        'border border-[#D32F2F] focus:border-[#D32F2F] focus:ring-4 focus:ring-[#D32F2F]/10' => $errors->has('alamat'),
        'border border-gray-300 focus:border-[#1565C0] focus:ring-4 focus:ring-[#1565C0]/10' => !$errors->has('alamat'),
    ];

    $passwordMobileClass = [
        'w-full rounded-lg px-3.5 py-2.5 text-sm text-[#1A1A2E] bg-white outline-none transition-all placeholder:text-gray-400',
        'border border-[#D32F2F] focus:border-[#D32F2F] focus:ring-4 focus:ring-[#D32F2F]/10' => $errors->has('password'),
        'border border-gray-300 focus:border-[#1565C0] focus:ring-4 focus:ring-[#1565C0]/10' => !$errors->has('password'),
    ];

    $confirmMobileClass = [
        'w-full rounded-lg border border-gray-300 px-3.5 py-2.5 text-sm text-[#1A1A2E] bg-white outline-none transition-all placeholder:text-gray-400 focus:border-[#1565C0] focus:ring-4 focus:ring-[#1565C0]/10',
    ];
@endphp


{{-- ========================= --}}
{{-- DESKTOP / LAPTOP VERSION --}}
{{-- ========================= --}}
<main class="hidden lg:flex min-h-screen items-center justify-center bg-[#F5F6FA] px-8 py-12">

    <div class="w-full max-w-[720px] rounded-2xl border border-[#1565C0]/10 bg-white px-9 py-8 shadow-sm">

        {{-- Logo --}}
        <div class="mb-6 flex items-center justify-center gap-2.5">
            <img src="{{ asset('images/logo.png') }}" alt="G-RPL" class="h-9 w-auto">
            <span class="font-heading text-xl font-bold tracking-tight text-[#1565C0]">
                G-RPL
            </span>
        </div>

        {{-- Header --}}
        <div class="mb-7 text-center">
            <h1 class="font-heading text-[28px] font-bold leading-tight text-[#1A1A2E]">
                Pendaftaran Mahasiswa
            </h1>
            <p class="mt-2 text-[15px] text-[#5A6478]">
                Buat akun untuk memulai proses pengajuan RPL
            </p>
        </div>

        {{-- Error Global --}}
        @if ($errors->any())
            <div class="mb-5 rounded-xl border border-[#D32F2F]/20 bg-[#D32F2F]/5 px-4 py-3 text-xs text-[#D32F2F]">
                <ul class="list-inside list-disc space-y-1">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- action mengarah ke route register.post (POST /register) --}}
        <form method="POST" action="{{ route('register.post') }}" class="space-y-4">
            @csrf

            <div class="grid grid-cols-2 gap-4">
                {{-- NIK --}}
                <div>
                    <label class="mb-1.5 block text-[13px] font-bold text-[#1A1A2E]" for="nik_desktop">
                        Nomor Induk Kependudukan (NIK)
                    </label>

                    <input
                        type="text"
                        name="nik"
                        id="nik_desktop"
                        value="{{ old('nik') }}"
                        placeholder="Contoh: 3171234567890001"
                        maxlength="16"
                        @class($nikDesktopClass)
                    >

                    @error('nik')
                        <p class="mt-1.5 text-xs text-[#D32F2F]">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Nama Lengkap --}}
                <div>
                    <label class="mb-1.5 block text-[13px] font-bold text-[#1A1A2E]" for="name_desktop">
                        Nama Lengkap
                    </label>

                    <input
                        type="text"
                        name="name"
                        id="name_desktop"
                        value="{{ old('name') }}"
                        placeholder="Contoh: Budi Santoso"
                        @class($nameDesktopClass)
                    >

                    @error('name')
                        <p class="mt-1.5 text-xs text-[#D32F2F]">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Email --}}
                <div>
                    <label class="mb-1.5 block text-[13px] font-bold text-[#1A1A2E]" for="email_desktop">
                        Alamat Email Aktif
                    </label>

                    <input
                        type="email"
                        name="email"
                        id="email_desktop"
                        value="{{ old('email') }}"
                        placeholder="nama@institusi.com"
                        @class($emailDesktopClass)
                    >

                    @error('email')
                        <p class="mt-1.5 text-xs text-[#D32F2F]">{{ $message }}</p>
                    @enderror
                </div>

                {{-- No HP --}}
                <div>
                    <label class="mb-1.5 block text-[13px] font-bold text-[#1A1A2E]" for="no_hp_desktop">
                        Nomor HP Aktif
                    </label>

                    <input
                        type="text"
                        name="no_hp"
                        id="no_hp_desktop"
                        value="{{ old('no_hp') }}"
                        placeholder="Contoh: 08123456789"
                        @class($noHpDesktopClass)
                    >

                    @error('no_hp')
                        <p class="mt-1.5 text-xs text-[#D32F2F]">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            {{-- Alamat --}}
            <div>
                <label class="mb-1.5 block text-[13px] font-bold text-[#1A1A2E]" for="alamat_desktop">
                    Alamat Lengkap
                </label>

                <textarea
                    name="alamat"
                    id="alamat_desktop"
                    rows="2"
                    placeholder="Masukkan alamat lengkap Anda"
                    @class($alamatDesktopClass)
                >{{ old('alamat') }}</textarea>

                @error('alamat')
                    <p class="mt-1.5 text-xs text-[#D32F2F]">{{ $message }}</p>
                @enderror
            </div>

            <div class="grid grid-cols-2 gap-4">
                {{-- Password --}}
                <div>
                    <label class="mb-1.5 block text-[13px] font-bold text-[#1A1A2E]" for="password_desktop">
                        Kata Sandi
                    </label>

                    <input
                        type="password"
                        name="password"
                        id="password_desktop"
                        placeholder="Minimal 6 karakter"
                        @class($passwordDesktopClass)
                    >
                </div>

                {{-- Confirm Password --}}
                <div>
                    <label class="mb-1.5 block text-[13px] font-bold text-[#1A1A2E]" for="password_confirmation_desktop">
                        Konfirmasi Sandi
                    </label>

                    <input
                        type="password"
                        name="password_confirmation"
                        id="password_confirmation_desktop"
                        placeholder="Ketik ulang sandi"
                        @class($confirmDesktopClass)
                    >
                </div>
            </div>

            @error('password')
                <p class="text-xs text-[#D32F2F]">{{ $message }}</p>
            @enderror

            <button
                type="submit"
                class="w-full rounded-lg bg-[#1565C0] py-3 text-sm font-bold text-white transition-colors hover:bg-[#0D47A1] active:bg-[#0A3A85]">
                Daftar Sekarang
            </button>
        </form>

        <div class="mt-6 space-y-3 text-center text-sm text-[#5A6478]">
            <p>
                Sudah memiliki akun?
                <a href="{{ route('login') }}" class="font-bold text-[#1565C0] hover:text-[#0D47A1] hover:underline">
                    Masuk di sini
                </a>
            </p>

            <p>
                <a href="{{ route('welcome') }}" class="font-bold text-[#1565C0] hover:text-[#0D47A1] hover:underline">
                    Balik ke Beranda
                </a>
            </p>
        </div>

    </div>
</main>


{{-- ================= --}}
{{-- MOBILE / HP VERSION --}}
{{-- ================= --}}
<main class="flex lg:hidden min-h-screen items-center justify-center bg-[#F5F6FA] px-4 py-6">

    <div class="w-full max-w-[390px] rounded-2xl border border-[#1565C0]/10 bg-white px-5 py-6 shadow-sm">

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
                Pendaftaran Mahasiswa
            </h1>
            <p class="mt-2 text-sm leading-relaxed text-[#5A6478]">
                Buat akun untuk memulai proses pengajuan RPL
            </p>
        </div>

        {{-- Error Global --}}
        @if ($errors->any())
            <div class="mb-5 rounded-xl border border-[#D32F2F]/20 bg-[#D32F2F]/5 px-4 py-3 text-xs text-[#D32F2F]">
                <ul class="list-inside list-disc space-y-1">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- action mengarah ke route register.post (POST /register) --}}
        <form method="POST" action="{{ route('register.post') }}" class="space-y-4">
            @csrf

            {{-- NIK --}}
            <div>
                <label class="mb-1.5 block text-xs font-bold text-[#1A1A2E]" for="nik_mobile">
                    Nomor Induk Kependudukan (NIK)
                </label>

                <input
                    type="text"
                    name="nik"
                    id="nik_mobile"
                    value="{{ old('nik') }}"
                    placeholder="Contoh: 3171234567890001"
                    maxlength="16"
                    @class($nikMobileClass)
                >

                @error('nik')
                    <p class="mt-1.5 text-xs text-[#D32F2F]">{{ $message }}</p>
                @enderror
            </div>

            {{-- Nama Lengkap --}}
            <div>
                <label class="mb-1.5 block text-xs font-bold text-[#1A1A2E]" for="name_mobile">
                    Nama Lengkap
                </label>

                <input
                    type="text"
                    name="name"
                    id="name_mobile"
                    value="{{ old('name') }}"
                    placeholder="Contoh: Budi Santoso"
                    @class($nameMobileClass)
                >

                @error('name')
                    <p class="mt-1.5 text-xs text-[#D32F2F]">{{ $message }}</p>
                @enderror
            </div>

            {{-- Email --}}
            <div>
                <label class="mb-1.5 block text-xs font-bold text-[#1A1A2E]" for="email_mobile">
                    Alamat Email Aktif
                </label>

                <input
                    type="email"
                    name="email"
                    id="email_mobile"
                    value="{{ old('email') }}"
                    placeholder="nama@institusi.com"
                    @class($emailMobileClass)
                >

                @error('email')
                    <p class="mt-1.5 text-xs text-[#D32F2F]">{{ $message }}</p>
                @enderror
            </div>

            {{-- No HP --}}
            <div>
                <label class="mb-1.5 block text-xs font-bold text-[#1A1A2E]" for="no_hp_mobile">
                    Nomor HP Aktif
                </label>

                <input
                    type="text"
                    name="no_hp"
                    id="no_hp_mobile"
                    value="{{ old('no_hp') }}"
                    placeholder="Contoh: 08123456789"
                    @class($noHpMobileClass)
                >

                @error('no_hp')
                    <p class="mt-1.5 text-xs text-[#D32F2F]">{{ $message }}</p>
                @enderror
            </div>

            {{-- Alamat --}}
            <div>
                <label class="mb-1.5 block text-xs font-bold text-[#1A1A2E]" for="alamat_mobile">
                    Alamat Lengkap
                </label>

                <textarea
                    name="alamat"
                    id="alamat_mobile"
                    rows="2"
                    placeholder="Masukkan alamat lengkap Anda"
                    @class($alamatMobileClass)
                >{{ old('alamat') }}</textarea>

                @error('alamat')
                    <p class="mt-1.5 text-xs text-[#D32F2F]">{{ $message }}</p>
                @enderror
            </div>

            {{-- Password --}}
            <div>
                <label class="mb-1.5 block text-xs font-bold text-[#1A1A2E]" for="password_mobile">
                    Kata Sandi
                </label>

                <input
                    type="password"
                    name="password"
                    id="password_mobile"
                    placeholder="Minimal 6 karakter"
                    @class($passwordMobileClass)
                >

                @error('password')
                    <p class="mt-1.5 text-xs text-[#D32F2F]">{{ $message }}</p>
                @enderror
            </div>

            {{-- Confirm Password --}}
            <div>
                <label class="mb-1.5 block text-xs font-bold text-[#1A1A2E]" for="password_confirmation_mobile">
                    Konfirmasi Sandi
                </label>

                <input
                    type="password"
                    name="password_confirmation"
                    id="password_confirmation_mobile"
                    placeholder="Ketik ulang sandi"
                    @class($confirmMobileClass)
                >
            </div>

            <button
                type="submit"
                class="w-full rounded-lg bg-[#1565C0] py-3 text-sm font-bold text-white transition-colors hover:bg-[#0D47A1] active:bg-[#0A3A85]">
                Daftar Sekarang
            </button>
        </form>

        <div class="mt-5 space-y-3 text-center text-sm text-[#5A6478]">
            <p class="leading-relaxed">
                Sudah memiliki akun?
                <a href="{{ route('login') }}" class="font-bold text-[#1565C0] hover:text-[#0D47A1] hover:underline">
                    Masuk di sini
                </a>
            </p>

            <p>
                <a href="{{ route('welcome') }}" class="font-bold text-[#1565C0] hover:text-[#0D47A1] hover:underline">
                    Balik ke Beranda
                </a>
            </p>
        </div>

    </div>
</main>

{{-- SweetAlert2 --}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

@if (session('success'))
<script>
    Swal.fire({
        icon: 'success',
        title: 'Registrasi Berhasil',
        text: '{{ session('success') }}',
        confirmButtonColor: '#1565C0',
        confirmButtonText: 'OK'
    }).then(() => {
        window.location.href = "{{ route('login') }}";
    });
</script>
@endif

@if ($errors->any())
<script>
    Swal.fire({
        icon: 'error',
        title: 'Registrasi Gagal',
        html: `
            <ul style="text-align:left;">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        `,
        confirmButtonColor: '#D32F2F',
        confirmButtonText: 'Mengerti'
    });
</script>
@endif

@endsection