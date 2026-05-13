{{-- resources/views/applicant/program.blade.php --}}
@extends('applicant.layout')
@section('title', 'Pilih Tipe RPL & Program Studi')
@section('applicant_content')

<div class="mb-8">
    <h1 class="font-heading text-2xl font-bold text-[#1A1A2E]">Pilih Tipe RPL & Program Studi</h1>
    <p class="text-sm text-[#5A6478] mt-1">Tentukan jenis pengajuan RPL dan program studi tujuan Anda.</p>
</div>

<form class="space-y-6">
    {{-- Pilih Tipe RPL --}}
    <div class="bg-white border border-[#1565C0]/15 rounded-xl shadow-sm overflow-hidden">
        <div class="p-6 border-b border-gray-100">
            <h2 class="font-heading font-bold text-[#1A1A2E]">Tipe Pendaftaran RPL</h2>
            <p class="text-xs text-[#5A6478] mt-0.5">Pilih salah satu tipe RPL sesuai dengan kebutuhan Anda</p>
        </div>
        <div class="p-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                {{-- Tipe A --}}
                <label class="relative block cursor-pointer">
                    <input type="radio" name="tipe_rpl" value="A" class="peer sr-only" checked>
                    <div class="border-2 rounded-xl p-6 transition-all peer-checked:border-[#1565C0] peer-checked:bg-blue-50/30 border-gray-200 hover:border-[#1565C0]/40">
                        <div class="flex items-center gap-3 mb-3">
                            <div class="w-12 h-12 rounded-full bg-[#E3F0FF] text-[#1565C0] flex items-center justify-center font-bold text-lg flex-shrink-0">A</div>
                            <div>
                                <h3 class="font-heading font-bold text-[#1A1A2E]">RPL Tipe A</h3>
                                <p class="text-[10px] text-[#5A6478]">Transfer Kredit / Lanjut Studi</p>
                            </div>
                        </div>
                        <p class="text-xs text-[#5A6478] leading-relaxed">Melanjutkan pendidikan formal dengan mengakui SKS dari pendidikan sebelumnya atau pengalaman kerja. Cocok untuk lulusan D3 yang ingin lanjut S1.</p>
                        <div class="mt-4 flex items-center gap-2 text-xs text-[#1565C0] font-bold">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            Maksimal 144 SKS diakui
                        </div>
                    </div>
                </label>

                {{-- Tipe B --}}
                <label class="relative block cursor-pointer">
                    <input type="radio" name="tipe_rpl" value="B" class="peer sr-only">
                    <div class="border-2 rounded-xl p-6 transition-all peer-checked:border-[#E65100] peer-checked:bg-orange-50/30 border-gray-200 hover:border-[#E65100]/40">
                        <div class="flex items-center gap-3 mb-3">
                            <div class="w-12 h-12 rounded-full bg-[#FFF8E1] text-[#E65100] flex items-center justify-center font-bold text-lg flex-shrink-0">B</div>
                            <div>
                                <h3 class="font-heading font-bold text-[#1A1A2E]">RPL Tipe B</h3>
                                <p class="text-[10px] text-[#5A6478]">Penyetaraan Kualifikasi</p>
                            </div>
                        </div>
                        <p class="text-xs text-[#5A6478] leading-relaxed">Pengakuan kompetensi untuk mendapatkan ijazah/sertifikat kompetensi. Diselenggarakan oleh Kemendikbud bersama LSP terkait.</p>
                        <div class="mt-4 flex items-center gap-2 text-xs text-[#E65100] font-bold">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            Sertifikat Kompetensi
                        </div>
                    </div>
                </label>
            </div>
        </div>
    </div>

    {{-- Pilih Program Studi --}}
    <div class="bg-white border border-[#1565C0]/15 rounded-xl shadow-sm overflow-hidden">
        <div class="p-6 border-b border-gray-100">
            <h2 class="font-heading font-bold text-[#1A1A2E]">Program Studi Tujuan</h2>
            <p class="text-xs text-[#5A6478] mt-0.5">Pilih program studi dan konsentrasi yang Anda tuju</p>
        </div>
        <div class="p-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-xs font-bold text-[#1A1A2E] mb-2">Program Studi *</label>
                    <select class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-sm outline-none focus:border-[#1565C0] transition-colors">
                        <option value="">-- Pilih Program Studi --</option>
                        <option value="1">S1 Teknik Informatika</option>
                        <option value="2">S1 Sistem Informasi</option>
                        <option value="3">S1 Teknik Elektro</option>
                        <option value="4">S1 Akuntansi</option>
                        <option value="5">S1 Manajemen</option>
                        <option value="6">D3 Manajemen Informatika</option>
                    </select>
                </div>
                <div>
                    <label class="block text-xs font-bold text-[#1A1A2E] mb-2">Konsentrasi (Opsional)</label>
                    <select class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-sm outline-none focus:border-[#1565C0] transition-colors">
                        <option value="">-- Pilih Konsentrasi --</option>
                        <option>Software Engineering</option>
                        <option>Data Science</option>
                        <option>Network & Security</option>
                        <option>Artificial Intelligence</option>
                    </select>
                </div>
            </div>
        </div>
    </div>

    {{-- Estimasi SKS & Informasi --}}
    <div class="bg-blue-50 border border-blue-100 rounded-xl p-6">
        <h3 class="text-sm font-bold text-[#1565C0] flex items-center gap-2 mb-3">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            Informasi Penting
        </h3>
        <ul class="text-xs text-[#5A6478] space-y-2 leading-relaxed">
            <li>• Pastikan Anda telah melengkapi profil data diri sebelum memilih program studi.</li>
            <li>• Setiap program studi memiliki kuota dan persyaratan yang berbeda.</li>
            <li>• Anda hanya dapat memilih <strong>satu program studi</strong> per pengajuan.</li>
            <li>• Untuk pertanyaan lebih lanjut, hubungi admin di <strong>admin@g-rpl.ac.id</strong>.</li>
        </ul>
    </div>

    {{-- Tombol Navigasi --}}
    <div class="flex justify-between pt-4">
        <a href="{{ route('applicant.profile') }}" class="px-6 py-2.5 border border-gray-300 text-[#5A6478] text-sm font-bold rounded-lg hover:bg-gray-50 transition-colors flex items-center gap-2">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
            Kembali
        </a>
        <button type="submit" class="px-6 py-2.5 bg-[#1565C0] text-white text-sm font-bold rounded-lg hover:bg-[#0D47A1] transition-colors flex items-center gap-2">
            Simpan & Lanjutkan
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
        </button>
    </div>
</form>

@endsection