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

        {{-- Error Global --}}
        @if ($errors->any())
            <div class="bg-red-50 border border-red-200 text-red-700 rounded-lg px-4 py-3 text-xs mb-5">
                <ul class="list-disc list-inside space-y-1">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- action mengarah ke route register.post (POST /register) --}}
        <form method="POST" action="{{ route('register.post') }}">
            @csrf

            {{-- NIK --}}
            <label class="block text-xs font-bold text-[#1A1A2E] mb-1.5">
                Nomor Induk Kependudukan (NIK)
            </label>
            <input type="text" name="nik" value="{{ old('nik') }}" placeholder="Contoh: 3171234567890001" maxlength="16"
                   class="w-full border border-gray-300 rounded-lg px-3.5 py-2.5 text-sm text-[#1A1A2E] focus:border-[#1565C0] focus:ring-1 focus:ring-[#1565C0] outline-none transition-all mb-1 @error('nik') border-[#D32F2F] @enderror">
            @error('nik') <p class="text-xs text-[#D32F2F] mb-3">{{ $message }}</p> @else <div class="mb-3"></div> @enderror

            {{-- Nama Lengkap --}}
            <label class="block text-xs font-bold text-[#1A1A2E] mb-1.5">
                Nama Lengkap (Sesuai KTP/Ijazah)
            </label>
            <input type="text" name="name" value="{{ old('name') }}" placeholder="Contoh: Budi Santoso"
                   class="w-full border border-gray-300 rounded-lg px-3.5 py-2.5 text-sm text-[#1A1A2E] focus:border-[#1565C0] focus:ring-1 focus:ring-[#1565C0] outline-none transition-all mb-1 @error('name') border-[#D32F2F] @enderror">
            @error('name') <p class="text-xs text-[#D32F2F] mb-3">{{ $message }}</p> @else <div class="mb-3"></div> @enderror

            {{-- Email --}}
            <label class="block text-xs font-bold text-[#1A1A2E] mb-1.5">
                Alamat Email Aktif
            </label>
            <input type="email" name="email" value="{{ old('email') }}" placeholder="nama@institusi.com"
                   class="w-full border border-gray-300 rounded-lg px-3.5 py-2.5 text-sm text-[#1A1A2E] focus:border-[#1565C0] focus:ring-1 focus:ring-[#1565C0] outline-none transition-all mb-1 @error('email') border-[#D32F2F] @enderror">
            @error('email') <p class="text-xs text-[#D32F2F] mb-3">{{ $message }}</p> @else <div class="mb-3"></div> @enderror

            {{-- No HP --}}
            <label class="block text-xs font-bold text-[#1A1A2E] mb-1.5">
                Nomor HP Aktif
            </label>
            <input type="text" name="no_hp" value="{{ old('no_hp') }}" placeholder="Contoh: 08123456789"
                   class="w-full border border-gray-300 rounded-lg px-3.5 py-2.5 text-sm text-[#1A1A2E] focus:border-[#1565C0] focus:ring-1 focus:ring-[#1565C0] outline-none transition-all mb-1 @error('no_hp') border-[#D32F2F] @enderror">
            @error('no_hp') <p class="text-xs text-[#D32F2F] mb-3">{{ $message }}</p> @else <div class="mb-3"></div> @enderror

            {{-- Alamat --}}
            <label class="block text-xs font-bold text-[#1A1A2E] mb-1.5">
                Alamat Lengkap
            </label>
            <textarea name="alamat" rows="2" placeholder="Masukkan alamat lengkap Anda"
                      class="w-full border border-gray-300 rounded-lg px-3.5 py-2.5 text-sm text-[#1A1A2E] focus:border-[#1565C0] focus:ring-1 focus:ring-[#1565C0] outline-none transition-all mb-1 resize-none @error('alamat') border-[#D32F2F] @enderror">{{ old('alamat') }}</textarea>
            @error('alamat') <p class="text-xs text-[#D32F2F] mb-3">{{ $message }}</p> @else <div class="mb-3"></div> @enderror

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                {{-- Password --}}
                <div>
                    <label class="block text-xs font-bold text-[#1A1A2E] mb-1.5">Kata Sandi</label>
                    <input type="password" name="password" placeholder="Minimal 6 karakter"
                           class="w-full border border-gray-300 rounded-lg px-3.5 py-2.5 text-sm text-[#1A1A2E] focus:border-[#1565C0] focus:ring-1 focus:ring-[#1565C0] outline-none transition-all @error('password') border-[#D32F2F] @enderror">
                </div>
                {{-- Confirm Password --}}
                <div>
                    <label class="block text-xs font-bold text-[#1A1A2E] mb-1.5">Konfirmasi Sandi</label>
                    <input type="password" name="password_confirmation" placeholder="Ketik ulang sandi"
                           class="w-full border border-gray-300 rounded-lg px-3.5 py-2.5 text-sm text-[#1A1A2E] focus:border-[#1565C0] focus:ring-1 focus:ring-[#1565C0] outline-none transition-all">
                </div>
            </div>
            @error('password') <p class="text-xs text-[#D32F2F] mt-1 mb-2">{{ $message }}</p> @enderror

            <button type="submit"
                    class="w-full bg-[#1565C0] hover:bg-[#0D47A1] text-white font-bold text-sm rounded-lg py-3 mt-4 mb-6 transition-colors">
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