{{-- resources/views/applicant/documents.blade.php --}}
@extends('applicant.layout')
@section('title', 'Upload Dokumen Persyaratan')
@section('applicant_content')

<div class="mb-8">
    <h1 class="font-heading text-2xl font-bold text-[#1A1A2E]">Upload Dokumen Persyaratan</h1>
    <p class="text-sm text-[#5A6478] mt-1">Unggah dokumen yang diperlukan untuk proses verifikasi dan asesmen RPL.</p>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    {{-- Daftar Dokumen Wajib --}}
    <div class="lg:col-span-2 space-y-4">
        
        {{-- KTP --}}
        <div class="bg-white border border-[#1565C0]/15 rounded-xl p-6 shadow-sm">
            <div class="flex items-start gap-4">
                <div class="w-10 h-10 rounded-full bg-green-100 text-green-600 flex items-center justify-center flex-shrink-0 mt-1">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                </div>
                <div class="flex-grow">
                    <div class="flex items-start justify-between gap-4">
                        <div>
                            <h3 class="text-sm font-bold text-[#1A1A2E]">KTP (Scan Asli) *</h3>
                            <p class="text-xs text-[#5A6478] mt-1">Scan KTP asli berwarna, format JPG/PNG/PDF, maks 2MB</p>
                        </div>
                        <span class="px-2 py-1 bg-green-50 text-green-600 text-[10px] font-bold rounded-full flex-shrink-0">Terupload</span>
                    </div>
                    <div class="mt-3 flex items-center gap-2 text-xs text-[#5A6478] bg-gray-50 rounded-lg p-2">
                        <svg class="w-4 h-4 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path></svg>
                        ktp_budi_santoso.pdf (245KB)
                        <button class="text-red-500 hover:text-red-700 ml-auto font-bold">Hapus</button>
                    </div>
                </div>
            </div>
        </div>

        {{-- Ijazah Terakhir --}}
        <div class="bg-white border border-[#1565C0]/15 rounded-xl p-6 shadow-sm">
            <div class="flex items-start gap-4">
                <div class="w-10 h-10 rounded-full bg-green-100 text-green-600 flex items-center justify-center flex-shrink-0 mt-1">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                </div>
                <div class="flex-grow">
                    <div class="flex items-start justify-between gap-4">
                        <div>
                            <h3 class="text-sm font-bold text-[#1A1A2E]">Ijazah Terakhir *</h3>
                            <p class="text-xs text-[#5A6478] mt-1">Scan Ijazah SMA/Sederajat atau ijazah terakhir, format PDF, maks 2MB</p>
                        </div>
                        <span class="px-2 py-1 bg-green-50 text-green-600 text-[10px] font-bold rounded-full flex-shrink-0">Terupload</span>
                    </div>
                    <div class="mt-3 flex items-center gap-2 text-xs text-[#5A6478] bg-gray-50 rounded-lg p-2">
                        <svg class="w-4 h-4 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path></svg>
                        ijazah_sma.pdf (1.2MB)
                        <button class="text-red-500 hover:text-red-700 ml-auto font-bold">Hapus</button>
                    </div>
                </div>
            </div>
        </div>

        {{-- Transkrip Nilai --}}
        <div class="bg-white border-2 border-[#1565C0] rounded-xl p-6 shadow-sm">
            <div class="flex items-start gap-4">
                <div class="w-10 h-10 rounded-full bg-[#E3F0FF] text-[#1565C0] flex items-center justify-center flex-shrink-0 mt-1 font-bold text-sm">!</div>
                <div class="flex-grow">
                    <div>
                        <h3 class="text-sm font-bold text-[#1A1A2E]">Transkrip Nilai *</h3>
                        <p class="text-xs text-[#5A6478] mt-1">Scan Transkrip Nilai dari pendidikan terakhir, format PDF, maks 2MB</p>
                    </div>
                    <div class="mt-4 border-2 border-dashed border-[#1565C0]/30 rounded-xl p-6 text-center hover:bg-blue-50/30 transition-colors cursor-pointer">
                        <svg class="w-10 h-10 text-[#1565C0]/50 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path></svg>
                        <p class="text-sm font-bold text-[#1565C0]">Klik untuk Upload</p>
                        <p class="text-xs text-[#5A6478] mt-1">atau drag & drop file di sini</p>
                    </div>
                </div>
            </div>
        </div>

        {{-- CV / Curriculum Vitae --}}
        <div class="bg-white border border-[#1565C0]/15 rounded-xl p-6 shadow-sm">
            <div class="flex items-start gap-4">
                <div class="w-10 h-10 rounded-full bg-gray-100 text-gray-400 flex items-center justify-center flex-shrink-0 mt-1">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
                </div>
                <div class="flex-grow">
                    <div>
                        <h3 class="text-sm font-bold text-[#1A1A2E]">CV / Curriculum Vitae *</h3>
                        <p class="text-xs text-[#5A6478] mt-1">CV terbaru yang mencantumkan pengalaman kerja dan pelatihan, format PDF, maks 2MB</p>
                    </div>
                    <div class="mt-4 border-2 border-dashed border-gray-300 rounded-xl p-6 text-center hover:bg-gray-50 transition-colors cursor-pointer">
                        <svg class="w-10 h-10 text-gray-400 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path></svg>
                        <p class="text-sm font-bold text-[#5A6478]">Klik untuk Upload</p>
                        <p class="text-xs text-[#5A6478] mt-1">atau drag & drop file di sini</p>
                    </div>
                </div>
            </div>
        </div>

        {{-- Surat Keterangan Kerja --}}
        <div class="bg-white border border-[#1565C0]/15 rounded-xl p-6 shadow-sm">
            <div class="flex items-start gap-4">
                <div class="w-10 h-10 rounded-full bg-gray-100 text-gray-400 flex items-center justify-center flex-shrink-0 mt-1">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
                </div>
                <div class="flex-grow">
                    <div>
                        <h3 class="text-sm font-bold text-[#1A1A2E]">Surat Keterangan Kerja *</h3>
                        <p class="text-xs text-[#5A6478] mt-1">Surat keterangan dari perusahaan (minimal 2 tahun pengalaman), format PDF, maks 2MB</p>
                    </div>
                    <div class="mt-4 border-2 border-dashed border-gray-300 rounded-xl p-6 text-center hover:bg-gray-50 transition-colors cursor-pointer">
                        <svg class="w-10 h-10 text-gray-400 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path></svg>
                        <p class="text-sm font-bold text-[#5A6478]">Klik untuk Upload</p>
                        <p class="text-xs text-[#5A6478] mt-1">atau drag & drop file di sini</p>
                    </div>
                </div>
            </div>
        </div>

        {{-- Sertifikat Pendukung (Opsional) --}}
        <div class="bg-white border border-[#1565C0]/15 rounded-xl p-6 shadow-sm">
            <div class="flex items-start gap-4">
                <div class="w-10 h-10 rounded-full bg-gray-100 text-gray-400 flex items-center justify-center flex-shrink-0 mt-1">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
                </div>
                <div class="flex-grow">
                    <div>
                        <h3 class="text-sm font-bold text-[#1A1A2E]">Sertifikat Pendukung (Opsional)</h3>
                        <p class="text-xs text-[#5A6478] mt-1">Sertifikat pelatihan, kursus, seminar, atau penghargaan terkait. Format PDF, maks 2MB/file. Maks 5 file.</p>
                    </div>
                    {{-- File yang sudah terupload --}}
                    <div class="mt-3 space-y-2">
                        <div class="flex items-center gap-2 text-xs text-[#5A6478] bg-gray-50 rounded-lg p-2">
                            <svg class="w-4 h-4 text-green-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path></svg>
                            sertifikat_web_dev.pdf (560KB)
                            <button class="text-red-500 hover:text-red-700 ml-auto font-bold">Hapus</button>
                        </div>
                        <div class="flex items-center gap-2 text-xs text-[#5A6478] bg-gray-50 rounded-lg p-2">
                            <svg class="w-4 h-4 text-green-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path></svg>
                            sertifikat_toefl.pdf (320KB)
                            <button class="text-red-500 hover:text-red-700 ml-auto font-bold">Hapus</button>
                        </div>
                    </div>
                    {{-- Upload area untuk tambahan --}}
                    <div class="mt-3 border-2 border-dashed border-gray-300 rounded-xl p-4 text-center hover:bg-gray-50 transition-colors cursor-pointer">
                        <svg class="w-6 h-6 text-gray-400 mx-auto mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
                        <p class="text-xs font-bold text-[#5A6478]">Tambah Sertifikat Lain</p>
                    </div>
                </div>
            </div>
        </div>

        {{-- Tombol Navigasi --}}
        <div class="flex justify-between pt-4">
            <a href="{{ route('applicant.program') }}" class="px-6 py-2.5 border border-gray-300 text-[#5A6478] text-sm font-bold rounded-lg hover:bg-gray-50 transition-colors flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
                Kembali
            </a>
            <a href="{{ route('applicant.outcomes') }}" class="px-6 py-2.5 bg-[#1565C0] text-white text-sm font-bold rounded-lg hover:bg-[#0D47A1] transition-colors flex items-center gap-2">
                Simpan & Lanjutkan
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
            </a>
        </div>
    </div>

    {{-- Sidebar Info --}}
    <div class="space-y-4">
        {{-- Progress Upload --}}
        <div class="bg-white border border-[#1565C0]/15 rounded-xl p-6 shadow-sm">
            <h3 class="font-heading font-bold text-[#1A1A2E] mb-4">Status Upload</h3>
            <div class="space-y-3">
                @php
                    $docStatus = [
                        ['KTP', 'uploaded', 'bg-green-500'],
                        ['Ijazah Terakhir', 'uploaded', 'bg-green-500'],
                        ['Transkrip Nilai', 'pending', 'bg-yellow-500'],
                        ['CV', 'pending', 'bg-gray-300'],
                        ['Surat Keterangan Kerja', 'pending', 'bg-gray-300'],
                        ['Sertifikat Pendukung', 'partial', 'bg-blue-500'],
                    ];
                @endphp
                @foreach($docStatus as $doc)
                <div class="flex items-center gap-2">
                    <span class="w-2 h-2 rounded-full {{ $doc[2] }} flex-shrink-0"></span>
                    <span class="text-xs text-[#5A6478] flex-grow">{{ $doc[0] }}</span>
                    <span class="text-[10px] font-bold 
                        @if($doc[1] == 'uploaded') text-green-600
                        @elseif($doc[1] == 'partial') text-blue-600
                        @else text-gray-400 @endif">
                        @if($doc[1] == 'uploaded') ✓
                        @elseif($doc[1] == 'partial') 2/5
                        @else - @endif
                    </span>
                </div>
                @endforeach
            </div>
            <div class="mt-4 pt-4 border-t border-gray-100">
                <p class="text-[10px] text-[#5A6478]">Terupload: <strong class="text-[#1A1A2E]">3/6</strong> dokumen</p>
            </div>
        </div>

        {{-- Ketentuan Dokumen --}}
        <div class="bg-blue-50 border border-blue-100 rounded-xl p-5">
            <h3 class="text-xs font-bold text-[#1565C0] flex items-center gap-2 mb-3">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                Ketentuan Upload
            </h3>
            <ul class="text-xs text-[#5A6478] space-y-2 leading-relaxed">
                <li>• Format yang diterima: <strong>PDF, JPG, PNG</strong></li>
                <li>• Ukuran maksimal per file: <strong>2MB</strong></li>
                <li>• Dokumen harus terbaca jelas</li>
                <li>• Pastikan tidak ada dokumen yang terpotong</li>
                <li>• Sertifikat pendukung bersifat opsional</li>
            </ul>
        </div>
    </div>
</div>

@endsection