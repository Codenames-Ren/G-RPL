{{-- resources/views/auth/login.blade.php --}}
@extends('layouts.app')
@section('title', 'Masuk')
@section('content')

<x-auth-navbar>
    <x-slot name="rightSlot">
        {{-- Dikosongkan, tidak menampilkan teks apapun di header --}}
    </x-slot>
</x-auth-navbar>

<div class="min-h-[calc(100vh-56px)] bg-[#F5F6FA] flex items-center justify-center px-4 py-12">
    {{-- Card (Flat Design, 0.5px border, 8px radius standard) --}}
    <div class="bg-white border border-[#1565C0]/15 rounded-xl w-full max-w-md px-8 pt-8 pb-7 shadow-sm">

        {{-- Logo --}}
        <div class="flex items-center justify-center gap-2 mb-6">
            <img src="{{ asset('images/logo.png') }}" alt="G-RPL" class="h-8 w-auto">
            <span class="font-heading font-bold text-[#1565C0] text-lg">G-RPL</span>
        </div>

        <h1 class="font-heading text-2xl font-bold text-center text-[#1A1A2E] mb-2">Selamat Datang</h1>
        <p class="text-sm text-[#5A6478] text-center mb-8">Silakan masuk menggunakan akun Anda</p>

        {{-- Form Universal --}}
        <form method="POST" action="{{ route('login') }}">
            @csrf

            {{-- Input Identifier (Universal untuk Email/NIK/Username) --}}
            <label class="block text-xs font-bold text-[#1A1A2E] mb-1.5" for="identifier">
                Email / NIK / Username
            </label>
            <input type="text" name="identifier" id="identifier" value="{{ old('identifier') }}" required autofocus
                   placeholder="Masukkan Email, NIK, atau Username"
                   class="w-full border border-gray-300 rounded-lg px-3.5 py-2.5 text-sm text-[#1A1A2E]
                          bg-white outline-none focus:border-[#1565C0] focus:ring-1 focus:ring-[#1565C0] transition-all mb-4
                          @error('identifier') border-[#D32F2F] @enderror">
            @error('identifier')
                <p class="text-xs text-[#D32F2F] -mt-3 mb-3">{{ $message }}</p>
            @enderror

            {{-- Input Password --}}
            <label class="block text-xs font-bold text-[#1A1A2E] mb-1.5" for="password">
                Kata Sandi
            </label>
            <input type="password" name="password" id="password" required
                   placeholder="Masukkan Kata Sandi"
                   class="w-full border border-gray-300 rounded-lg px-3.5 py-2.5 text-sm text-[#1A1A2E]
                          bg-white outline-none focus:border-[#1565C0] focus:ring-1 focus:ring-[#1565C0] transition-all mb-4
                          @error('password') border-[#D32F2F] @enderror">
            @error('password')
                <p class="text-xs text-[#D32F2F] -mt-3 mb-3">{{ $message }}</p>
            @enderror

            <div class="flex items-center justify-between mb-6">
                <label class="flex items-center gap-2 text-sm text-[#5A6478] cursor-pointer select-none">
                    <input type="checkbox" name="remember" class="w-4 h-4 rounded text-[#1565C0] border-gray-300 focus:ring-[#1565C0]">
                    Ingat Saya
                </label>
                <a href="{{ route('password.request') }}" class="text-sm font-bold text-[#1565C0] hover:underline">
                    Lupa Sandi?
                </a>
            </div>

            {{-- Flat Button (No shadow, 8px radius) --}}
            <button type="submit"
                    class="w-full bg-[#1565C0] hover:bg-[#0D47A1] text-white font-bold text-sm rounded-lg py-3 mb-6 transition-colors">
                Masuk ke Sistem
            </button>
        </form>

        {{-- Footer Info --}}
        <div class="text-center text-sm text-[#5A6478] mb-4">
            Belum punya akun Calon Mahasiswa?
            <a href="{{ route('register') }}" class="text-[#1565C0] font-bold hover:underline">Daftar di sini</a>
        </div>
        
        <div class="pt-4 border-t border-gray-100 flex gap-3 mt-2">
            <svg class="w-5 h-5 text-[#1565C0] flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            <p class="text-xs text-[#5A6478] leading-relaxed text-left">
                Bagi Asesor dan Pengelola, silakan masuk menggunakan kredensial (Email/Username) yang telah diberikan oleh Admin Sistem.
            </p>
        </div>
    </div>
</div>

@endsection