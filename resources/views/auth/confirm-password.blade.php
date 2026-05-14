@extends('layouts.app')
@section('title', 'Konfirmasi Kata Sandi')
@section('content')

<div class="min-h-screen bg-[#F5F6FA] flex items-center justify-center px-4 py-12">
    <div class="bg-white border border-[#1565C0]/15 rounded-xl w-full max-w-sm px-8 py-8 shadow-sm">
        <h1 class="font-heading text-xl font-bold text-center text-[#1A1A2E] mb-2">Konfirmasi Kata Sandi</h1>
        <p class="text-sm text-[#5A6478] text-center mb-6">Masukkan kata sandi untuk melanjutkan.</p>

        <form method="POST" action="{{ route('password.confirm.store') }}">
            @csrf

            <label class="block text-xs font-bold text-[#1A1A2E] mb-1.5">Kata Sandi</label>
            <input type="password" name="password" required autofocus
                   class="w-full border border-gray-300 rounded-lg px-3.5 py-2.5 text-sm text-[#1A1A2E] focus:border-[#1565C0] focus:ring-1 focus:ring-[#1565C0] outline-none transition-all mb-2 @error('password') border-[#D32F2F] @enderror">
            @error('password') <p class="text-xs text-[#D32F2F] mb-4">{{ $message }}</p> @enderror

            <button type="submit" class="w-full bg-[#1565C0] hover:bg-[#0D47A1] text-white font-bold text-sm rounded-lg py-3 mt-4 transition-colors">
                Konfirmasi
            </button>
        </form>
    </div>
</div>
@endsection
