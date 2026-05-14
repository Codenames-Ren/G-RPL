@extends('layouts.app')
@section('title', 'Verifikasi Email')
@section('content')

<div class="min-h-screen bg-[#F5F6FA] flex items-center justify-center px-4 py-12">
    <div class="bg-white border border-[#1565C0]/15 rounded-xl w-full max-w-md px-8 py-8 shadow-sm text-center">
        <h1 class="font-heading text-xl font-bold text-[#1A1A2E] mb-2">Verifikasi Email</h1>
        <p class="text-sm text-[#5A6478] mb-6">Cek inbox email Anda untuk tautan verifikasi akun.</p>

        @if (session('status') === 'verification-link-sent')
            <div class="bg-[#F8FAFC] border-l-4 border-[#1565C0] text-[#1A1A2E] p-4 rounded-r-lg text-xs mb-6 font-medium text-left">
                Tautan verifikasi baru sudah dikirim.
            </div>
        @endif

        <form method="POST" action="{{ route('verification.send') }}" class="mb-4">
            @csrf
            <button type="submit" class="w-full bg-[#1565C0] hover:bg-[#0D47A1] text-white font-bold text-sm rounded-lg py-3 transition-colors">
                Kirim Ulang Verifikasi
            </button>
        </form>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="text-sm text-[#5A6478] hover:text-[#1A1A2E] font-bold">
                Keluar
            </button>
        </form>
    </div>
</div>
@endsection
