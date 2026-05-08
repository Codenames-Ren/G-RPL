{{-- resources/views/manager/asesors.blade.php --}}
@extends('manager.layout')
@section('page_title', 'Data Asesor')
@section('manager_content')

<div class="flex justify-end mb-6">
    <button class="px-4 py-2.5 bg-[#1565C0] text-white text-sm font-bold rounded-lg hover:bg-[#0D47A1] transition-colors flex items-center gap-2">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
        Tambah Asesor
    </button>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
    @php
        $asesors = [
            ['Dr. Darmawan', 'S1 Teknik Informatika', 'darmawan@kampus.ac.id', '0812-3456-7890', 2, 15],
            ['Prof. Linda', 'S1 Sistem Informasi', 'linda@kampus.ac.id', '0812-3456-7891', 1, 12],
            ['Dr. Rahman', 'S1 Akuntansi', 'rahman@kampus.ac.id', '0812-3456-7892', 0, 8],
            ['Dr. Susanto', 'S1 Teknik Elektro', 'susanto@kampus.ac.id', '0812-3456-7893', 3, 20],
            ['Dr. Kartika', 'D3 Manajemen', 'kartika@kampus.ac.id', '0812-3456-7894', 1, 10],
            ['Prof. Budiman', 'S1 Teknik Informatika', 'budiman@kampus.ac.id', '0812-3456-7895', 0, 5],
        ];
    @endphp

    @foreach($asesors as $asesor)
    <div class="bg-white border border-[#1565C0]/15 rounded-xl p-6 shadow-sm hover:shadow-md transition-shadow">
        <div class="flex items-start gap-4 mb-4">
            <div class="w-12 h-12 rounded-full bg-[#E3F0FF] text-[#1565C0] flex items-center justify-center font-bold text-lg flex-shrink-0">
                {{ substr($asesor[0], 0, 2) }}
            </div>
            <div>
                <h3 class="font-heading font-bold text-[#1A1A2E]">{{ $asesor[0] }}</h3>
                <p class="text-xs text-[#5A6478]">{{ $asesor[1] }}</p>
            </div>
        </div>
        
        <div class="space-y-2 mb-4 text-xs text-[#5A6478]">
            <div class="flex items-center gap-2">
                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                {{ $asesor[2] }}
            </div>
            <div class="flex items-center gap-2">
                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                {{ $asesor[3] }}
            </div>
        </div>

        <div class="flex items-center gap-4 mb-4">
            <div>
                <p class="text-[10px] text-[#5A6478]">Antrean</p>
                <p class="text-lg font-bold {{ $asesor[4] > 2 ? 'text-[#D32F2F]' : 'text-[#1565C0]' }}">{{ $asesor[4] }}</p>
            </div>
            <div>
                <p class="text-[10px] text-[#5A6478]">Selesai</p>
                <p class="text-lg font-bold text-green-600">{{ $asesor[5] }}</p>
            </div>
        </div>

        <div class="flex gap-2 pt-4 border-t border-gray-100">
            <button class="flex-1 px-3 py-2 border border-gray-300 text-[#5A6478] text-xs font-bold rounded-lg hover:bg-gray-50 transition-colors">Edit</button>
            <button class="flex-1 px-3 py-2 border border-red-200 text-red-600 text-xs font-bold rounded-lg hover:bg-red-50 transition-colors">Nonaktifkan</button>
        </div>
    </div>
    @endforeach
</div>

@endsection