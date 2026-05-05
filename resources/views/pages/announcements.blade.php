{{-- resources/views/pages/announcements.blade.php --}}
@extends('layouts.app')
@section('title', 'Pengumuman')
@section('content')

<x-navbar />

<div class="bg-[#F5F6FA] min-h-screen py-16 px-7">
    <div class="max-w-6xl mx-auto">
        <div class="mb-10 border-b border-[#1565C0]/10 pb-6 flex flex-col md:flex-row md:items-end justify-between gap-4">
            <div>
                <h1 class="font-heading text-3xl font-bold text-[#1A1A2E] mb-2">Papan Pengumuman</h1>
                <p class="text-sm text-[#5A6478]">Pusat informasi terbaru terkait jadwal, seleksi, dan berita program RPL.</p>
            </div>
            
            {{-- Search Box Dummy --}}
            <div class="relative">
                <input type="text" placeholder="Cari pengumuman..." class="w-full md:w-64 border border-[#1565C0]/20 rounded-lg pl-10 pr-4 py-2 text-sm focus:outline-none focus:border-[#1565C0]">
                <svg class="w-4 h-4 text-gray-400 absolute left-3.5 top-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @php
                $news = [
                    ['tag' => 'Penting', 'color' => 'red', 'date' => '05 Mei 2026', 'title' => 'Perpanjangan Masa Unggah Portofolio Gelombang 1', 'desc' => 'Diberitahukan kepada seluruh pendaftar gelombang 1, batas waktu unggah dokumen portofolio diperpanjang hingga tanggal 10 Mei 2026 pukul 23:59 WIB.'],
                    ['tag' => 'Jadwal', 'color' => 'blue', 'date' => '02 Mei 2026', 'title' => 'Jadwal Wawancara Asesmen Fakultas Teknik', 'desc' => 'Bagi calon mahasiswa yang telah lolos seleksi administrasi, jadwal wawancara asesmen akan dilaksanakan secara daring melalui Zoom.'],
                    ['tag' => 'Informasi', 'color' => 'yellow', 'date' => '28 April 2026', 'title' => 'Panduan Pengisian Form Learning Outcomes', 'desc' => 'Silakan unduh dokumen panduan tata cara mendeskripsikan pengalaman kerja ke dalam form Learning Outcomes (Capaian Pembelajaran).'],
                    ['tag' => 'Informasi', 'color' => 'yellow', 'date' => '15 April 2026', 'title' => 'Sosialisasi Program RPL Tipe A Tahun 2026', 'desc' => 'Universitas Global mengadakan webinar sosialisasi program RPL untuk calon pendaftar. Rekaman webinar dapat diakses melalui dashboard.'],
                    ['tag' => 'Penting', 'color' => 'red', 'date' => '01 April 2026', 'title' => 'Pembukaan Pendaftaran RPL Semester Ganjil', 'desc' => 'Pendaftaran program Rekognisi Pembelajaran Lampau (RPL) resmi dibuka untuk 45 Program Studi.'],
                ];
            @endphp

            @foreach($news as $item)
            <div class="bg-white rounded-2xl border border-[#1565C0]/10 overflow-hidden hover:shadow-lg hover:-translate-y-1 transition-all duration-300 flex flex-col">
                <div class="p-6 flex-grow">
                    <div class="flex items-center justify-between mb-4">
                        @if($item['color'] == 'red')
                            <span class="px-2.5 py-1 bg-red-50 text-red-600 text-[10px] font-bold uppercase tracking-wider rounded-md">{{ $item['tag'] }}</span>
                        @elseif($item['color'] == 'blue')
                            <span class="px-2.5 py-1 bg-blue-50 text-blue-600 text-[10px] font-bold uppercase tracking-wider rounded-md">{{ $item['tag'] }}</span>
                        @else
                            <span class="px-2.5 py-1 bg-yellow-50 text-yellow-600 text-[10px] font-bold uppercase tracking-wider rounded-md">{{ $item['tag'] }}</span>
                        @endif
                        <span class="text-[11px] font-medium text-[#5A6478]">{{ $item['date'] }}</span>
                    </div>
                    
                    <h2 class="font-heading text-lg font-bold text-[#1A1A2E] mb-3 leading-tight">{{ $item['title'] }}</h2>
                    <p class="text-xs text-[#5A6478] leading-relaxed line-clamp-3">
                        {{ $item['desc'] }}
                    </p>
                </div>
                
                <div class="px-6 py-4 border-t border-gray-50 bg-gray-50/50">
                    <a href="#" class="text-xs font-bold text-[#1565C0] hover:text-[#0D47A1] flex items-center gap-1.5">
                        Baca Selengkapnya
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                    </a>
                </div>
            </div>
            @endforeach
        </div>

        {{-- Pagination Dummy --}}
        <div class="mt-12 flex justify-center gap-2">
            <button class="w-8 h-8 flex items-center justify-center rounded border border-[#1565C0]/20 text-[#5A6478] hover:bg-[#F5F6FA] disabled:opacity-50" disabled>«</button>
            <button class="w-8 h-8 flex items-center justify-center rounded bg-[#1565C0] text-white font-bold text-xs">1</button>
            <button class="w-8 h-8 flex items-center justify-center rounded border border-[#1565C0]/20 text-[#5A6478] hover:bg-gray-100 text-xs font-bold">2</button>
            <button class="w-8 h-8 flex items-center justify-center rounded border border-[#1565C0]/20 text-[#5A6478] hover:bg-gray-100 text-xs font-bold">3</button>
            <button class="w-8 h-8 flex items-center justify-center rounded border border-[#1565C0]/20 text-[#5A6478] hover:bg-gray-100">»</button>
        </div>
    </div>
</div>

<x-footer />
@endsection