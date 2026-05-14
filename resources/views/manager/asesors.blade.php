{{-- resources/views/manager/asesors.blade.php --}}
@extends('manager.layout')
@section('page_title', 'Data Asesor')
@section('manager_content')

<div class="mb-6">
    <h2 class="font-heading text-2xl font-bold text-[#1A1A2E]">Data Asesor</h2>
    <p class="text-sm text-[#5A6478] mt-1">Asesor ditampilkan berdasarkan application/prodi karena endpoint BE yang tersedia bersifat scoped.</p>
</div>

<div class="bg-white border border-[#1565C0]/15 rounded-xl p-8 text-center shadow-sm">
    <div class="w-14 h-14 rounded-full bg-[#E3F0FF] text-[#1565C0] flex items-center justify-center font-bold mx-auto mb-4">AS</div>
    <h3 class="font-heading font-bold text-[#1A1A2E]">Pilih Application untuk Melihat Asesor</h3>
    <p class="text-sm text-[#5A6478] mt-2 max-w-xl mx-auto">Di API manager saat ini tidak ada endpoint list semua asesor. Asesor dimuat berdasarkan prodi application melalui endpoint berikut.</p>
    <code class="block mt-4 text-xs bg-gray-50 p-3 rounded-lg text-[#1565C0] max-w-lg mx-auto">GET /api/manager/applications/{applicationId}/asesors</code>
    <a href="{{ route('manager.assignment') }}" class="inline-flex mt-6 px-5 py-2.5 bg-[#1565C0] text-white text-sm font-bold rounded-lg hover:bg-[#0D47A1]">Pilih Application & Lihat Asesor</a>
</div>

@endsection
