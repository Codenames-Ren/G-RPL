{{-- resources/views/pages/faq.blade.php --}}
@extends('layouts.app')
@section('title', 'FAQ')
@section('content')

<x-navbar />

<div class="bg-[#F8FAFC] min-h-screen py-16 px-7">
    <div class="max-w-3xl mx-auto">
        <div class="text-center mb-12">
            <h1 class="font-heading text-3xl md:text-4xl font-bold text-[#1A1A2E] mb-4">Pusat Bantuan & FAQ</h1>
            <p class="text-sm text-[#5A6478]">Temukan jawaban untuk pertanyaan yang paling sering diajukan seputar program RPL.</p>
        </div>

        <div class="space-y-4">
            @php
                $faqs = [
                    ['Siapa saja yang bisa mendaftar program RPL?', 'Program ini terbuka untuk seluruh Warga Negara Indonesia (WNI) lulusan minimal SMA/Sederajat yang memiliki pengalaman kerja relevan minimal 2 tahun atau memiliki sertifikasi kompetensi/pelatihan di bidang terkait.'],
                    ['Apakah ijazah lulusan RPL berbeda dengan reguler?', 'Tidak. Ijazah yang diterbitkan untuk lulusan jalur RPL sama persis dengan ijazah jalur reguler dan tidak ada tulisan "Lulusan RPL" di ijazah tersebut.'],
                    ['Berapa biaya pendaftaran dan konversi SKS?', 'Biaya pendaftaran adalah Rp 500.000 (untuk asesmen). Biaya per-SKS yang diakui dan biaya SPP per semester akan disesuaikan dengan kebijakan program studi masing-masing.'],
                    ['Bagaimana jika dokumen asli saya hilang?', 'Anda diwajibkan melampirkan Surat Keterangan Kehilangan dari Kepolisian dan surat keterangan resmi (legalisir) dari instansi atau sekolah yang menerbitkan dokumen tersebut.'],
                    ['Berapa lama proses asesmen/penilaian portofolio?', 'Proses verifikasi dokumen memakan waktu 3-5 hari kerja. Sedangkan proses wawancara dan asesmen penilaian portofolio oleh Asesor memakan waktu sekitar 2-3 minggu.']
                ];
            @endphp

            @foreach($faqs as $faq)
            <div class="bg-white border border-[#1565C0]/15 rounded-2xl overflow-hidden shadow-sm hover:border-[#1565C0]/40 transition-colors">
                <details class="group p-6">
                    <summary class="list-none cursor-pointer flex justify-between items-center font-heading font-bold text-[#1A1A2E] text-sm pr-2">
                        {{ $faq[0] }}
                        <span class="text-[#1565C0] group-open:rotate-180 transition-transform duration-300 flex-shrink-0 ml-4">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                        </span>
                    </summary>
                    <div class="mt-4 pt-4 border-t border-gray-100 text-sm text-[#5A6478] leading-relaxed">
                        {{ $faq[1] }}
                    </div>
                </details>
            </div>
            @endforeach
        </div>

        <div class="mt-12 text-center bg-white border border-[#1565C0]/15 p-8 rounded-2xl">
            <p class="text-sm text-[#1A1A2E] font-bold mb-2">Masih punya pertanyaan?</p>
            <p class="text-xs text-[#5A6478] mb-5">Tim admin kami siap membantu Anda dari Senin-Jumat (08:00 - 16:00).</p>
            <a href="mailto:admin@g-rpl.ac.id" class="inline-block px-6 py-2.5 bg-[#1565C0] text-white text-sm font-bold rounded-lg hover:bg-[#1976D2] transition-colors">
                Hubungi Kami
            </a>
        </div>
    </div>
</div>

<x-footer />
@endsection