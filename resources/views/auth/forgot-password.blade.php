{{-- resources/views/auth/forgot-password.blade.php --}}
@extends('layouts.app')
@section('title', 'Lupa Kata Sandi')
@section('content')

<div class="min-h-screen bg-[#F5F6FA] flex items-center justify-center px-4 py-12">
    <div class="bg-white border border-[#1565C0]/15 rounded-xl w-full max-w-sm px-8 py-8 shadow-sm">
        
        <div class="w-14 h-14 bg-[#F5F6FA] border border-[#1565C0]/10 rounded-xl flex items-center justify-center mx-auto mb-6">
            <svg class="h-6 w-6 text-[#1565C0]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
            </svg>
        </div>

        <h1 class="font-heading text-xl font-bold text-center text-[#1A1A2E] mb-2">Lupa Kata Sandi?</h1>
        <p class="text-sm text-[#5A6478] text-center mb-6 leading-relaxed">
            Masukkan email Anda dan kami akan mengirimkan tautan untuk mereset kata sandi.
        </p>

        @if (session('status'))
            <div class="bg-[#F8FAFC] border-l-4 border-[#1565C0] text-[#1A1A2E] p-4 rounded-r-lg text-xs mb-6 font-medium">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <label class="block text-xs font-bold text-[#1A1A2E] mb-1.5">
                Alamat Email
            </label>
            <input type="email" name="email" value="{{ old('email') }}" required autofocus
                   placeholder="Masukkan Email Anda"
                   class="w-full border border-gray-300 rounded-lg px-3.5 py-2.5 text-sm text-[#1A1A2E] focus:border-[#1565C0] focus:ring-1 focus:ring-[#1565C0] outline-none transition-all mb-5 @error('email') border-[#D32F2F] @enderror">
            @error('email') <p class="text-xs text-[#D32F2F] -mt-4 mb-4">{{ $message }}</p> @enderror

            {{-- Flat Button --}}
            <button type="submit"
                    class="w-full bg-[#1565C0] hover:bg-[#0D47A1] text-white font-bold text-sm rounded-lg py-3 mb-6 transition-colors">
                Kirim Tautan Reset
            </button>
        </form>

        <div class="text-center">
            <a href="{{ route('login') }}" class="text-sm text-[#5A6478] hover:text-[#1A1A2E] font-bold flex items-center justify-center gap-1.5 transition-colors">
                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                Kembali ke Masuk
            </a>
        </div>
    </div>
</div>
@endsection