{{-- resources/views/welcome.blade.php --}}
@extends('layouts.app')

@section('title', 'Beranda')

@section('content')

{{-- Memanggil komponen Navbar --}}
<x-navbar />

{{-- ===== HERO ===== --}}
<section class="bg-[#1565C0] px-7 py-14 grid grid-cols-1 md:grid-cols-2 gap-10 items-center">
    <div>
        <p class="text-xs font-semibold tracking-widest text-white/55 uppercase mb-3">Rekognisi Pembelajaran Lampau</p>
        <h1 class="font-heading text-3xl md:text-4xl font-extrabold text-white leading-tight mb-4">
            Wujudkan Gelar Akademikmu<br>Lewat Pengalaman Nyata
        </h1>
        <p class="text-sm text-white/75 leading-relaxed mb-7 max-w-md">
            Program Rekognisi Pembelajaran Lampau (RPL) — Kami mengakui pengalaman kerja,
            pelatihan, dan pembelajaran mandiri Anda sebagai SKS akademik resmi.
        </p>
        <div class="flex gap-3 flex-wrap">
            <a href="{{ route('register') }}"
               class="px-5 py-2.5 bg-[#F9A825] text-[#5D3B00] text-sm font-bold rounded-lg hover:bg-[#FFB300] transition-colors shadow-lg shadow-yellow-500/20">
                Daftar Sekarang
            </a>
            <a href="{{ route('about') }}"
               class="px-5 py-2.5 bg-white/10 border border-white/30 text-white text-sm font-semibold rounded-lg hover:bg-white/20 transition-colors">
                Pelajari RPL →
            </a>
        </div>
    </div>
    <div class="bg-white/10 border border-white/20 rounded-xl p-8 flex items-center justify-center min-h-44 relative overflow-hidden shadow-2xl">
        {{-- Dekorasi background --}}
        <div class="absolute -top-10 -right-10 w-32 h-32 bg-white/5 rounded-full blur-2xl"></div>
        <div class="absolute -bottom-10 -left-10 w-32 h-32 bg-white/5 rounded-full blur-2xl"></div>
        
        <div class="text-center relative z-10">
            <img src="{{ asset('images/logo.png') }}" alt="G-RPL" class="h-16 w-auto mx-auto mb-3 opacity-90 drop-shadow-md">
            <p class="text-white/70 text-xs tracking-wide font-medium">Portal Pendaftaran Digital</p>
        </div>
    </div>
</section>

{{-- ===== STATS ===== --}}
<section class="bg-white border-b border-[#1565C0]/10 grid grid-cols-2 md:grid-cols-4 shadow-sm">
    @foreach([['2.500+','Pendaftar Aktif'],['45','Prodi Tersedia'],['144','Maks SKS Diakui'],['2+','Tahun Pengalaman Min.']] as $stat)
    <div class="py-6 px-4 text-center {{ !$loop->last ? 'md:border-r md:border-[#1565C0]/10' : '' }}">
        <div class="font-heading text-3xl font-extrabold text-[#1565C0] mb-1">{{ $stat[0] }}</div>
        <div class="text-[11px] uppercase tracking-wider text-[#5A6478] font-bold">{{ $stat[1] }}</div>
    </div>
    @endforeach
</section>

{{-- ===== APA ITU RPL (Ringkasan) ===== --}}
<section class="bg-white px-7 py-16">
    <div class="max-w-6xl mx-auto">
        <div class="mb-10">
            <h2 class="font-heading text-3xl font-bold text-[#1A1A2E] mb-3">Apa itu RPL?</h2>
            <p class="text-sm text-[#5A6478] leading-relaxed max-w-2xl">
                Rekognisi Pembelajaran Lampau (RPL) adalah pengakuan atas Capaian Pembelajaran seseorang
                yang diperoleh dari pendidikan formal, nonformal, informal, dan/atau pengalaman kerja
                sebagai dasar untuk melanjutkan pendidikan formal.
            </p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="bg-white border border-[#1565C0]/15 rounded-2xl p-7 hover:border-[#1565C0]/40 transition-colors shadow-sm">
                <span class="inline-flex items-center text-xs font-bold px-3 py-1 rounded-full bg-[#E3F0FF] text-[#0D47A1] mb-4">RPL Tipe A</span>
                <h3 class="font-heading font-bold text-[#1A1A2E] text-lg mb-2">Transfer Kredit</h3>
                <p class="text-sm text-[#5A6478] leading-relaxed mb-4">
                    Melanjutkan pendidikan dengan mentransfer SKS dari perguruan tinggi sebelumnya
                    atau mengakui pengalaman kerja relevan agar masa studi menjadi jauh lebih singkat.
                </p>
            </div>
            <div class="bg-white border border-[#1565C0]/15 rounded-2xl p-7 hover:border-[#1565C0]/40 transition-colors shadow-sm">
                <span class="inline-flex items-center text-xs font-bold px-3 py-1 rounded-full bg-[#FFF8E1] text-[#E65100] mb-4">RPL Tipe B</span>
                <h3 class="font-heading font-bold text-[#1A1A2E] text-lg mb-2">Penyetaraan</h3>
                <p class="text-sm text-[#5A6478] leading-relaxed mb-4">
                    Pengakuan langsung atas kompetensi yang dimiliki untuk mendapatkan
                    ijazah atau sertifikat kompetensi tertentu sesuai dengan Kerangka Kualifikasi Nasional Indonesia.
                </p>
            </div>
        </div>
        
        <div class="mt-8">
            <a href="{{ route('about') }}" class="inline-flex items-center gap-1.5 text-sm font-bold text-[#1565C0] hover:text-[#0D47A1] hover:underline">
                Baca selengkapnya tentang RPL 
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
            </a>
        </div>
    </div>
</section>

{{-- ===== ALUR PENDAFTARAN ===== --}}
<section class="bg-[#F8FAFC] px-7 py-16 border-t border-[#1565C0]/5">
    <div class="max-w-6xl mx-auto">
        <h2 class="font-heading text-2xl font-bold text-[#0D47A1] mb-10 text-center">Alur Pendaftaran Digital</h2>
        <div class="grid grid-cols-2 md:grid-cols-5 gap-6">
            @foreach([
                ['1','Daftar Akun & Isi Profil'],
                ['2','Pilih Tipe RPL & Prodi'],
                ['3','Upload Dokumen & CV'],
                ['4','Input Pengalaman Kerja'],
                ['5','Submit & Tunggu Penilaian'],
            ] as $step)
            <div class="text-center group relative">
                {{-- Garis penghubung untuk desktop --}}
                @if(!$loop->last)
                <div class="hidden md:block absolute top-6 left-[60%] w-full h-[2px] bg-[#1565C0]/20"></div>
                @endif
                
                <div class="relative z-10 w-14 h-14 rounded-full bg-[#1565C0] text-white font-heading font-bold text-xl flex items-center justify-center mx-auto mb-4 group-hover:-translate-y-1 transition-transform shadow-md shadow-blue-200 ring-4 ring-[#F8FAFC]">
                    {{ $step[0] }}
                </div>
                <p class="text-sm text-[#1A1A2E] font-medium leading-relaxed px-2">{{ $step[1] }}</p>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ===== CALL TO ACTION (Penjelasan Singkat) ===== --}}
<section class="bg-white px-7 py-20 text-center">
    <h2 class="font-heading text-2xl md:text-3xl font-bold text-[#1A1A2E] mb-4">Mulai Karir Akademik Anda Hari Ini</h2>
    <p class="text-sm text-[#5A6478] max-w-2xl mx-auto mb-8 leading-relaxed">
        Sistem G-RPL dirancang untuk memudahkan tenaga profesional mendapatkan pengakuan akademik tanpa harus mengulang mata kuliah yang sudah Anda kuasai di dunia kerja nyata.
    </p>
    <div class="flex flex-col sm:flex-row justify-center gap-4">
        <a href="{{ route('requirements') }}" class="px-8 py-3 border-2 border-[#1565C0] text-[#1565C0] text-sm font-bold rounded-xl hover:bg-[#E3F0FF] transition-colors">
            Cek Persyaratan
        </a>
        <a href="{{ route('register') }}" class="px-8 py-3 bg-[#1565C0] text-white text-sm font-bold rounded-xl hover:bg-[#1976D2] transition-colors shadow-lg shadow-blue-500/30">
            Daftar Sekarang
        </a>
    </div>
</section>

{{-- Memanggil komponen Footer --}}
<x-footer />

@endsection