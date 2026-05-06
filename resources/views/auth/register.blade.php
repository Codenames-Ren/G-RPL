{{-- resources/views/auth/register.blade.php --}}
@extends('layouts.app')
@section('title', 'Daftar Akun')
@section('content')

<div class="min-h-screen bg-[#F5F6FA] flex items-center justify-center px-4 py-12">
    <div class="bg-white border border-[#1565C0]/15 rounded-xl w-full max-w-md px-8 pt-8 pb-7 shadow-sm">
        
        <div class="flex items-center justify-center gap-2 mb-6">
            <img src="{{ asset('images/logo.png') }}" alt="G-RPL" class="h-8 w-auto">
            <span class="font-heading font-bold text-[#1565C0] text-lg">G-RPL</span>
        </div>

        <h1 class="font-heading text-2xl font-bold text-center text-[#1A1A2E] mb-2">Pendaftaran Mahasiswa</h1>
        <p class="text-sm text-[#5A6478] text-center mb-8">Buat akun untuk memulai proses pengajuan RPL</p>

        <form method="POST" action="{{ route('register') }}">
            @csrf

            {{-- NIK (Kebutuhan Calon Mahasiswa Indonesia) --}}
            <label class="block text-xs font-bold text-[#1A1A2E] mb-1.5">
                Nomor Induk Kependudukan (NIK)
            </label>
            <input type="text" name="nik" value="{{ old('nik') }}" placeholder="Contoh: 3171234567890001" maxlength="16"
                   class="w-full border border-gray-300 rounded-lg px-3.5 py-2.5 text-sm text-[#1A1A2E] focus:border-[#1565C0] focus:ring-1 focus:ring-[#1565C0] outline-none transition-all mb-4 @error('nik') border-[#D32F2F] @enderror">
            @error('nik') <p class="text-xs text-[#D32F2F] -mt-3 mb-3">{{ $message }}</p> @enderror

            {{-- Nama Lengkap --}}
            <label class="block text-xs font-bold text-[#1A1A2E] mb-1.5">
                Nama Lengkap (Sesuai KTP/Ijazah)
            </label>
            <input type="text" name="name" value="{{ old('name') }}" placeholder="Contoh: Budi Santoso"
                   class="w-full border border-gray-300 rounded-lg px-3.5 py-2.5 text-sm text-[#1A1A2E] focus:border-[#1565C0] focus:ring-1 focus:ring-[#1565C0] outline-none transition-all mb-4 @error('name') border-[#D32F2F] @enderror">
            @error('name') <p class="text-xs text-[#D32F2F] -mt-3 mb-3">{{ $message }}</p> @enderror

            {{-- Email --}}
            <label class="block text-xs font-bold text-[#1A1A2E] mb-1.5">
                Alamat Email Aktif
            </label>
            <input type="email" name="email" value="{{ old('email') }}" placeholder="nama@institusi.com"
                   class="w-full border border-gray-300 rounded-lg px-3.5 py-2.5 text-sm text-[#1A1A2E] focus:border-[#1565C0] focus:ring-1 focus:ring-[#1565C0] outline-none transition-all mb-4 @error('email') border-[#D32F2F] @enderror">
            @error('email') <p class="text-xs text-[#D32F2F] -mt-3 mb-3">{{ $message }}</p> @enderror

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                {{-- Password --}}
                <div>
                    <label class="block text-xs font-bold text-[#1A1A2E] mb-1.5">Kata Sandi</label>
                    <input type="password" name="password" placeholder="Minimal 8 karakter"
                           class="w-full border border-gray-300 rounded-lg px-3.5 py-2.5 text-sm text-[#1A1A2E] focus:border-[#1565C0] focus:ring-1 focus:ring-[#1565C0] outline-none transition-all mb-4 @error('password') border-[#D32F2F] @enderror">
                </div>
                {{-- Confirm Password --}}
                <div>
                    <label class="block text-xs font-bold text-[#1A1A2E] mb-1.5">Konfirmasi Sandi</label>
                    <input type="password" name="password_confirmation" placeholder="Ketik ulang sandi"
                           class="w-full border border-gray-300 rounded-lg px-3.5 py-2.5 text-sm text-[#1A1A2E] focus:border-[#1565C0] focus:ring-1 focus:ring-[#1565C0] outline-none transition-all mb-4">
                </div>
            </div>
            @error('password') <p class="text-xs text-[#D32F2F] -mt-3 mb-3">{{ $message }}</p> @enderror

            {{-- Flat Button --}}
            <button type="submit"
                    class="w-full bg-[#1565C0] hover:bg-[#0D47A1] text-white font-bold text-sm rounded-lg py-3 mt-2 mb-6 transition-colors">
                Daftar Sekarang
            </button>
        </form>

        <div class="text-center text-sm text-[#5A6478]">
            Sudah memiliki akun? 
            <a href="{{ route('login') }}" class="text-[#1565C0] font-bold hover:underline">Masuk di sini</a>
        </div>
    </div>
</div>
@endsection