@extends('layouts.app')
@section('title', 'Persyaratan')
@section('content')
<x-navbar />
<div class="min-h-screen bg-[#F5F6FA] py-12 px-7">
    <div class="max-w-5xl mx-auto">
        <div class="mb-10">
            <h1 class="font-heading text-2xl font-bold text-[#1A1A2E]">Persyaratan & Dokumen</h1>
            <p class="text-sm text-[#5A6478]">Siapkan dokumen berikut sebelum melakukan pengisian portofolio.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="md:col-span-2 space-y-6">
                <div class="bg-white p-7 rounded-2xl border border-[#1565C0]/10 shadow-sm">
                    <h2 class="font-heading font-bold text-[#1565C0] mb-4">Dokumen Administrasi</h2>
                    <div class="space-y-3">
                        @foreach(['KTP (Scan Asli)', 'Ijazah Terakhir', 'Transkrip Nilai', 'Surat Keterangan Kerja (Minimal 2 Tahun)'] as $item)
                        <div class="flex items-center gap-3 p-3 bg-[#F8FAFC] rounded-lg border border-dashed border-[#1565C0]/20 text-sm">
                            <svg class="w-5 h-5 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            {{ $item }}
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
            
            <div class="bg-[#1565C0] p-7 rounded-2xl text-white">
                <h3 class="font-heading font-bold mb-4">Catatan Penting</h3>
                <ul class="text-xs space-y-4 opacity-80">
                    <li>1. Semua file maksimal berukuran 2MB.</li>
                    <li>2. Format dokumen wajib PDF atau JPG/PNG.</li>
                    <li>3. Dokumen harus terlihat jelas dan tidak terpotong.</li>
                </ul>
            </div>
        </div>
    </div>
</div>
<x-footer />
@endsection