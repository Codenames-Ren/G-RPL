@extends('layouts.app')
@section('title', 'Reset Kata Sandi')
@section('content')

<div class="min-h-screen bg-[#F5F6FA] flex items-center justify-center px-4 py-12">
    <div class="bg-white border border-[#1565C0]/15 rounded-xl w-full max-w-sm px-8 py-8 shadow-sm">
        <h1 class="font-heading text-xl font-bold text-center text-[#1A1A2E] mb-2">Reset Kata Sandi</h1>
        <p class="text-sm text-[#5A6478] text-center mb-6">Masukkan kata sandi baru untuk akun Anda.</p>

        @if ($errors->any())
            <div class="bg-red-50 border border-red-200 text-red-700 rounded-lg px-4 py-3 text-xs mb-5">
                <ul class="list-disc list-inside space-y-1">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('password.store') }}">
            @csrf
            <input type="hidden" name="token" value="{{ $token }}">

            <label class="block text-xs font-bold text-[#1A1A2E] mb-1.5">Email</label>
            <input type="email" name="email" value="{{ old('email', request('email')) }}" required autofocus
                   class="w-full border border-gray-300 rounded-lg px-3.5 py-2.5 text-sm text-[#1A1A2E] focus:border-[#1565C0] focus:ring-1 focus:ring-[#1565C0] outline-none transition-all mb-4">

            <label class="block text-xs font-bold text-[#1A1A2E] mb-1.5">Kata Sandi Baru</label>
            <input type="password" name="password" required
                   class="w-full border border-gray-300 rounded-lg px-3.5 py-2.5 text-sm text-[#1A1A2E] focus:border-[#1565C0] focus:ring-1 focus:ring-[#1565C0] outline-none transition-all mb-4">

            <label class="block text-xs font-bold text-[#1A1A2E] mb-1.5">Konfirmasi Kata Sandi</label>
            <input type="password" name="password_confirmation" required
                   class="w-full border border-gray-300 rounded-lg px-3.5 py-2.5 text-sm text-[#1A1A2E] focus:border-[#1565C0] focus:ring-1 focus:ring-[#1565C0] outline-none transition-all mb-6">

            <button type="submit" class="w-full bg-[#1565C0] hover:bg-[#0D47A1] text-white font-bold text-sm rounded-lg py-3 transition-colors">
                Simpan Kata Sandi
            </button>
        </form>
    </div>
</div>
@endsection
