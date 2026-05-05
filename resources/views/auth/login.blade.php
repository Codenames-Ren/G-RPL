{{-- resources/views/auth/login.blade.php --}}
@extends('layouts.app')
@section('title', 'Masuk')
@section('content')

<x-auth-navbar>
    <x-slot name="rightSlot">
        Belum punya akun?
        <a href="{{ route('register') }}" class="text-[#1565C0] font-bold hover:underline ml-1">Daftar Sekarang</a>
    </x-slot>
</x-auth-navbar>

<div class="min-h-[calc(100vh-56px)] bg-[#F5F6FA] flex items-center justify-center px-4 py-12">
    {{-- Card (Flat Design, 0.5px/1px border) --}}
    <div class="bg-white border border-[#1565C0]/15 rounded-xl w-full max-w-md px-8 pt-8 pb-7 shadow-sm">

        {{-- Logo --}}
        <div class="flex items-center justify-center gap-2 mb-6">
            <img src="{{ asset('images/logo.png') }}" alt="G-RPL" class="h-8 w-auto">
            <span class="font-heading font-bold text-[#1565C0] text-lg">G-RPL</span>
        </div>

        <h1 class="font-heading text-2xl font-bold text-center text-[#1A1A2E] mb-2">Selamat Datang</h1>
        <p class="text-sm text-[#5A6478] text-center mb-6">Silakan masuk menggunakan akun Anda</p>

        {{-- Role Tabs (Institutional Clean UI) --}}
        <div class="bg-[#F5F6FA] p-1 rounded-lg flex mb-6" id="role-tabs">
            <button onclick="switchRole('calon')" id="tab-calon"
                class="role-tab flex-1 py-2 text-xs font-bold text-center rounded-md transition-all
                       bg-white text-[#1565C0] shadow-sm border border-[#1565C0]/10">
                Calon Mahasiswa
            </button>
            <button onclick="switchRole('asesor')" id="tab-asesor"
                class="role-tab flex-1 py-2 text-xs font-bold text-center rounded-md transition-all
                       text-[#5A6478] hover:text-[#1A1A2E]">
                Asesor
            </button>
            <button onclick="switchRole('manager')" id="tab-manager"
                class="role-tab flex-1 py-2 text-xs font-bold text-center rounded-md transition-all
                       text-[#5A6478] hover:text-[#1A1A2E]">
                Pengelola
            </button>
        </div>

        {{-- Form --}}
        <form method="POST" action="{{ route('login') }}">
            @csrf
            <input type="hidden" name="role" id="role-input" value="calon">

            <label class="block text-xs font-bold text-[#1A1A2E] mb-1.5" id="label-identifier">
                Email / NIK
            </label>
            <input type="text" name="identifier" id="input-identifier" value="{{ old('identifier') }}"
                   placeholder="Masukkan Email atau NIK"
                   class="w-full border border-gray-300 rounded-lg px-3.5 py-2.5 text-sm text-[#1A1A2E]
                          bg-white outline-none focus:border-[#1565C0] focus:ring-1 focus:ring-[#1565C0] transition-all mb-4
                          @error('identifier') border-[#D32F2F] @enderror">
            @error('identifier')
                <p class="text-xs text-[#D32F2F] -mt-3 mb-3">{{ $message }}</p>
            @enderror

            <label class="block text-xs font-bold text-[#1A1A2E] mb-1.5">
                Kata Sandi
            </label>
            <input type="password" name="password" placeholder="Masukkan Kata Sandi"
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
                    class="w-full bg-[#1565C0] hover:bg-[#0D47A1] text-white font-bold text-sm rounded-lg py-3 mb-4 transition-colors">
                Masuk ke Sistem
            </button>
        </form>

        {{-- Dynamic Footer Info --}}
        <div id="footer-calon" class="text-center text-sm text-[#5A6478] mt-2">
            Belum punya akun?
            <a href="{{ route('register') }}" class="text-[#1565C0] font-bold hover:underline">Daftar Akun Baru</a>
        </div>
        <div id="footer-asesor" class="hidden bg-[#F5F6FA] border border-[#1565C0]/10 rounded-lg p-3 flex gap-3 mt-2">
            <svg class="w-5 h-5 text-[#1565C0] flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            <p class="text-xs text-[#5A6478] leading-relaxed">Akun Asesor diberikan oleh Pengelola RPL. Hubungi admin institusi jika terkendala.</p>
        </div>
        <div id="footer-manager" class="hidden bg-[#F5F6FA] border border-[#1565C0]/10 rounded-lg p-3 flex gap-3 mt-2">
            <svg class="w-5 h-5 text-[#1565C0] flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            <p class="text-xs text-[#5A6478] leading-relaxed">Akses Pengelola diatur oleh Super Admin sistem pusat G-RPL.</p>
        </div>
    </div>
</div>

<script>
const roleConfig = {
    calon:   { label: 'Email / NIK',     placeholder: 'Masukkan Email atau NIK',   type: 'text'  },
    asesor:  { label: 'Email Institusi', placeholder: 'Masukkan Email Institusi',  type: 'email' },
    manager: { label: 'Username Admin',  placeholder: 'Masukkan Username Admin',   type: 'text'  },
};

function switchRole(role) {
    const cfg = roleConfig[role];
    document.getElementById('role-input').value = role;
    document.getElementById('label-identifier').textContent = cfg.label;
    
    const inp = document.getElementById('input-identifier');
    inp.placeholder = cfg.placeholder;
    inp.type = cfg.type;

    ['calon','asesor','manager'].forEach(r => {
        const tab = document.getElementById('tab-' + r);
        const isActive = r === role;
        
        // Active styling
        tab.className = `role-tab flex-1 py-2 text-xs font-bold text-center rounded-md transition-all ${
            isActive ? 'bg-white text-[#1565C0] shadow-sm border border-[#1565C0]/10' : 'text-[#5A6478] hover:text-[#1A1A2E]'
        }`;

        const footer = document.getElementById('footer-' + r);
        if (footer) footer.classList.toggle('hidden', !isActive);
    });
}

// Retain state if validation fails
const oldRole = "{{ old('role', 'calon') }}";
switchRole(oldRole);
</script>
@endsection