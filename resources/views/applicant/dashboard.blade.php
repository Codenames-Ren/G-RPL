{{-- resources/views/applicant/dashboard.blade.php --}}
@extends('layouts.app')
@section('title', 'Dashboard Calon Mahasiswa')
@section('content')

{{-- Navbar Khusus Dashboard Logged In --}}
<nav class="bg-white border-b border-[#1565C0]/15 px-7 h-16 flex items-center justify-between sticky top-0 z-50">
    <div class="flex items-center gap-2.5">
        <img src="{{ asset('images/logo.png') }}" alt="G-RPL" class="h-8 w-auto">
        <span class="font-heading font-bold text-[#1565C0] text-lg">G-RPL</span>
    </div>
    <div class="flex items-center gap-4">
        <div class="hidden md:block text-right">
            <p class="text-sm font-bold text-[#1A1A2E]">Budi Santoso</p>
            <p class="text-xs text-[#5A6478]">Calon Mahasiswa</p>
        </div>
        <div class="w-10 h-10 rounded-full bg-[#E3F0FF] text-[#1565C0] flex items-center justify-center font-bold border border-[#1565C0]/20">
            BS
        </div>
        {{-- Tombol Logout (Flat) --}}
        <form method="POST" action="{{ route('logout') }}" class="ml-2">
            @csrf
            <button type="submit" class="p-2 text-[#D32F2F] hover:bg-red-50 rounded-lg transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
            </button>
        </form>
    </div>
</nav>

<div class="min-h-[calc(100vh-64px)] bg-[#F5F6FA] py-8 px-4 md:px-8">
    <div class="max-w-6xl mx-auto">
        
        {{-- Header Greeting --}}
        <div class="mb-8">
            <h1 class="font-heading text-2xl font-bold text-[#1A1A2E]">Dashboard Pendaftaran</h1>
            <p class="text-sm text-[#5A6478] mt-1">Lengkapi data dan pantau status pengajuan Rekognisi Pembelajaran Lampau Anda.</p>
        </div>

        {{-- Alert Notification (Accent Yellow for Action Required / Draft Status) --}}
        <div class="bg-[#FFF8E1] border border-[#F9A825] rounded-lg p-4 mb-8 flex items-start gap-4 shadow-sm">
            <div class="text-[#F9A825] mt-0.5">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
            </div>
            <div>
                <h3 class="text-sm font-bold text-[#1A1A2E]">Status: Draft (Menunggu Dilengkapi)</h3>
                <p class="text-xs text-[#5A6478] mt-1">Anda belum mengirimkan pengajuan. Silakan lengkapi 5 tahapan di bawah ini sebelum melakukan submit.</p>
            </div>
        </div>

        {{-- Real-time Application Tracking Bar --}}
        <div class="bg-white border border-[#1565C0]/15 rounded-lg p-6 mb-8 shadow-sm">
            <h2 class="text-sm font-bold text-[#1A1A2E] mb-6 uppercase tracking-wider">Status Pengajuan</h2>
            
            <div class="relative flex justify-between items-center w-full">
                {{-- Connecting Lines (Background) --}}
                <div class="absolute top-1/2 left-0 w-full h-1 bg-gray-200 -z-10 -translate-y-1/2 rounded-full"></div>
                {{-- Active Line --}}
                <div class="absolute top-1/2 left-0 w-0 h-1 bg-[#1565C0] -z-10 -translate-y-1/2 rounded-full transition-all" style="width: 15%;"></div>

                {{-- Status Points --}}
                @php
                    $statuses = [
                        ['label' => 'Draft', 'status' => 'active', 'icon' => 'M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z'],
                        ['label' => 'Submitted', 'status' => 'pending', 'icon' => 'M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z'],
                        ['label' => 'Assigned', 'status' => 'pending', 'icon' => 'M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z'],
                        ['label' => 'Assessed', 'status' => 'pending', 'icon' => 'M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2'],
                        ['label' => 'Keputusan', 'status' => 'pending', 'icon' => 'M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4']
                    ];
                @endphp

                @foreach($statuses as $index => $step)
                    <div class="flex flex-col items-center gap-2">
                        <div class="w-10 h-10 rounded-full flex items-center justify-center border-2 {{ $step['status'] == 'active' ? 'bg-[#1565C0] border-[#1565C0] text-white' : 'bg-white border-gray-300 text-gray-400' }}">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $step['icon'] }}"></path></svg>
                        </div>
                        <span class="text-[11px] font-bold {{ $step['status'] == 'active' ? 'text-[#1565C0]' : 'text-gray-400' }}">{{ $step['label'] }}</span>
                    </div>
                @endforeach
            </div>
        </div>

        {{-- 5-Step Guided Process (Submission Wizard per PRD) --}}
        <h2 class="text-sm font-bold text-[#1A1A2E] mb-4 uppercase tracking-wider">Tahapan Pengajuan Anda</h2>
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            
            {{-- Col 1 & 2: Main Steps --}}
            <div class="lg:col-span-2 space-y-4">
                
                {{-- Step 1: Profil (Completed State) --}}
                <div class="bg-white border border-[#1565C0]/15 rounded-lg p-5 flex items-center justify-between shadow-sm">
                    <div class="flex items-center gap-4">
                        <div class="w-8 h-8 rounded-full bg-green-100 text-green-600 flex items-center justify-center flex-shrink-0">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                        </div>
                        <div>
                            <h3 class="text-sm font-bold text-[#1A1A2E]">1. Kelola Profil Data Diri</h3>
                            <p class="text-xs text-[#5A6478]">Data profil dan alamat lengkap telah disimpan.</p>
                        </div>
                    </div>
                    <a href="#" class="px-4 py-2 border border-gray-300 text-[#5A6478] text-xs font-bold rounded-lg hover:bg-gray-50 transition-colors">Edit Profil</a>
                </div>

                {{-- Step 2: Pilih Program (Active/To Do State) --}}
                <div class="bg-white border-2 border-[#1565C0] rounded-lg p-5 flex flex-col sm:flex-row sm:items-center justify-between shadow-sm gap-4">
                    <div class="flex items-start sm:items-center gap-4">
                        <div class="w-8 h-8 rounded-full bg-[#E3F0FF] text-[#1565C0] font-bold text-sm flex items-center justify-center flex-shrink-0">2</div>
                        <div>
                            <h3 class="text-sm font-bold text-[#1A1A2E]">2. Pilih Tipe RPL & Program Studi</h3>
                            <p class="text-xs text-[#5A6478]">Pilih tipe pendaftaran (A/B) dan tujuan prodi Anda.</p>
                        </div>
                    </div>
                    <a href="#" class="px-4 py-2 bg-[#1565C0] text-white text-xs font-bold rounded-lg hover:bg-[#0D47A1] transition-colors whitespace-nowrap text-center">Isi Formulir</a>
                </div>

                {{-- Step 3: Upload Dokumen (Locked State) --}}
                <div class="bg-white border border-gray-200 rounded-lg p-5 flex flex-col sm:flex-row sm:items-center justify-between opacity-75 shadow-sm gap-4">
                    <div class="flex items-start sm:items-center gap-4">
                        <div class="w-8 h-8 rounded-full bg-gray-100 text-gray-400 font-bold text-sm flex items-center justify-center flex-shrink-0">3</div>
                        <div>
                            <h3 class="text-sm font-bold text-gray-500">3. Upload Dokumen Persyaratan</h3>
                            <p class="text-xs text-gray-400">Upload KTP, Ijazah, CV, dan Sertifikat. <span class="italic">(Selesaikan tahap 2)</span></p>
                        </div>
                    </div>
                    <button disabled class="px-4 py-2 bg-gray-100 text-gray-400 text-xs font-bold rounded-lg cursor-not-allowed">Mulai Upload</button>
                </div>

                {{-- Step 4: Learning Outcomes (Locked State) --}}
                <div class="bg-white border border-gray-200 rounded-lg p-5 flex flex-col sm:flex-row sm:items-center justify-between opacity-75 shadow-sm gap-4">
                    <div class="flex items-start sm:items-center gap-4">
                        <div class="w-8 h-8 rounded-full bg-gray-100 text-gray-400 font-bold text-sm flex items-center justify-center flex-shrink-0">4</div>
                        <div>
                            <h3 class="text-sm font-bold text-gray-500">4. Input Capaian Pembelajaran (Learning Outcomes)</h3>
                            <p class="text-xs text-gray-400">Deskripsikan pengalaman kerja Anda. <span class="italic">(Selesaikan tahap 3)</span></p>
                        </div>
                    </div>
                    <button disabled class="px-4 py-2 bg-gray-100 text-gray-400 text-xs font-bold rounded-lg cursor-not-allowed">Input Data</button>
                </div>

            </div>

            {{-- Col 3: Submit Action & Summary Sidebar --}}
            <div class="space-y-4">
                {{-- Final Submit Card --}}
                <div class="bg-white border border-[#1565C0]/15 rounded-lg p-6 text-center shadow-sm">
                    <div class="w-12 h-12 bg-gray-100 text-gray-400 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
                    </div>
                    <h3 class="font-heading font-bold text-[#1A1A2E] text-lg mb-2">Submit Application</h3>
                    <p class="text-xs text-[#5A6478] mb-6 leading-relaxed">
                        Anda dapat mengirimkan pengajuan RPL jika tahapan 1 sampai 4 sudah ditandai selesai (ceklis hijau).
                    </p>
                    <button disabled class="w-full py-3 bg-gray-200 text-gray-400 text-sm font-bold rounded-lg cursor-not-allowed transition-colors">
                        Kirim Pengajuan
                    </button>
                </div>

                {{-- Informasi Bantuan --}}
                <div class="bg-blue-50 border border-blue-100 rounded-lg p-5">
                    <h3 class="text-xs font-bold text-[#1565C0] flex items-center gap-2 mb-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        Pusat Bantuan
                    </h3>
                    <p class="text-xs text-[#5A6478] leading-relaxed">
                        Jika Anda mengalami kendala saat upload dokumen atau input pengalaman, silakan baca <a href="#" class="text-[#1565C0] font-bold hover:underline">Panduan Pengisian</a> atau hubungi Admin.
                    </p>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection