{{-- resources/views/pages/about.blade.php --}}
@extends('layouts.app')
@section('title', 'Tentang RPL')
@section('content')

<x-navbar />

{{-- Hero Section --}}
<section class="bg-[#1565C0] px-7 py-20 text-center relative overflow-hidden">
    {{-- Dekorasi --}}
    <div class="absolute top-0 left-0 w-64 h-64 bg-white/5 rounded-full blur-3xl -translate-x-1/2 -translate-y-1/2"></div>
    <div class="absolute bottom-0 right-0 w-64 h-64 bg-white/5 rounded-full blur-3xl translate-x-1/2 translate-y-1/2"></div>
    
    <div class="relative z-10 max-w-3xl mx-auto">
        <h1 class="font-heading text-4xl md:text-5xl font-extrabold text-white mb-6">Mengenal Program RPL</h1>
        <p class="text-white/80 text-base leading-relaxed">
            Rekognisi Pembelajaran Lampau (RPL) adalah solusi inovatif bagi Anda yang ingin mengakselerasi karir akademik dengan mengonversi pengalaman kerja menjadi SKS resmi.
        </p>
    </div>
</section>

{{-- Definisi Detail --}}
<section class="bg-white px-7 py-16">
    <div class="max-w-5xl mx-auto">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-12 items-center">
            <div>
                <h2 class="font-heading text-3xl font-bold text-[#1A1A2E] mb-6">Apa itu RPL?</h2>
                <div class="prose prose-sm text-[#5A6478] leading-relaxed">
                    <p class="mb-4">
                        Berdasarkan Permendikbudristek No. 41 Tahun 2021, <strong>Rekognisi Pembelajaran Lampau (RPL)</strong> adalah pengakuan atas Capaian Pembelajaran seseorang yang diperoleh dari pendidikan formal, nonformal, informal, dan/atau pengalaman kerja sebagai dasar untuk melanjutkan pendidikan formal.
                    </p>
                    <p>
                        Dengan kata lain, segala bentuk pelatihan, sertifikasi, atau pengalaman kerja bertahun-tahun yang Anda miliki dapat "dihargai" dan diubah menjadi nilai SKS, sehingga Anda tidak perlu mengulang mata kuliah yang relevan dari awal.
                    </p>
                </div>
            </div>
            <div class="grid grid-cols-1 gap-4">
                <div class="bg-[#F8FAFC] border border-[#1565C0]/15 rounded-2xl p-6">
                    <div class="flex items-center gap-3 mb-3">
                        <div class="w-10 h-10 rounded-full bg-[#E3F0FF] text-[#1565C0] flex items-center justify-center font-bold text-lg">A</div>
                        <h3 class="font-heading font-bold text-[#1A1A2E]">RPL Tipe A</h3>
                    </div>
                    <p class="text-xs text-[#5A6478] leading-relaxed">Digunakan untuk <strong>melanjutkan pendidikan formal</strong> di Perguruan Tinggi. Contoh: Lulusan D3 yang ingin lanjut S1, SKS dari pengalaman kerjanya bisa diakui untuk mengurangi beban SKS S1.</p>
                </div>
                <div class="bg-[#F8FAFC] border border-[#1565C0]/15 rounded-2xl p-6">
                    <div class="flex items-center gap-3 mb-3">
                        <div class="w-10 h-10 rounded-full bg-[#FFF8E1] text-[#E65100] flex items-center justify-center font-bold text-lg">B</div>
                        <h3 class="font-heading font-bold text-[#1A1A2E]">RPL Tipe B</h3>
                    </div>
                    <p class="text-xs text-[#5A6478] leading-relaxed">Digunakan untuk <strong>penyetaraan kualifikasi</strong> (mendapatkan Ijazah/Sertifikat Kompetensi). Biasanya diselenggarakan oleh Kemendikbud langsung bersama LSP.</p>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- Tujuan & Keunggulan --}}
<section class="bg-[#F5F6FA] px-7 py-16">
    <div class="max-w-5xl mx-auto text-center mb-12">
        <h2 class="font-heading text-3xl font-bold text-[#1A1A2E] mb-4">Mengapa Memilih Sistem G-RPL?</h2>
        <p class="text-sm text-[#5A6478] max-w-2xl mx-auto">Sistem kami dirancang untuk mempermudah, mempercepat, dan memberikan transparansi penuh dalam proses pengajuan RPL Anda.</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 max-w-5xl mx-auto">
        @foreach([
            ['Efisiensi Waktu', 'Masa studi menjadi jauh lebih singkat karena SKS disesuaikan dengan portofolio Anda.'],
            ['Proses 100% Digital', 'Dari pendaftaran, unggah dokumen, hingga hasil asesmen, semua dilakukan secara online tanpa perlu datang ke kampus.'],
            ['Transparan & Akurat', 'Sistem penilaian portofolio terintegrasi langsung dengan para asesor profesional dan bersertifikat.']
        ] as $keunggulan)
        <div class="bg-white p-8 rounded-2xl shadow-sm border border-[#1565C0]/5 text-center group hover:-translate-y-1 transition-transform">
            <div class="w-12 h-12 bg-[#E3F0FF] text-[#1565C0] rounded-xl flex items-center justify-center mx-auto mb-6 group-hover:bg-[#1565C0] group-hover:text-white transition-colors">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
            </div>
            <h3 class="font-heading font-bold text-[#1A1A2E] mb-3">{{ $keunggulan[0] }}</h3>
            <p class="text-xs text-[#5A6478] leading-relaxed">{{ $keunggulan[1] }}</p>
        </div>
        @endforeach
    </div>
</section>

<x-footer />
@endsection