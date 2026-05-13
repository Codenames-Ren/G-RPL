{{-- resources/views/applicant/outcomes.blade.php --}}
@extends('applicant.layout')
@section('title', 'Input Capaian Pembelajaran')
@section('applicant_content')

<div class="mb-8">
    <h1 class="font-heading text-2xl font-bold text-[#1A1A2E]">Input Capaian Pembelajaran (Learning Outcomes)</h1>
    <p class="text-sm text-[#5A6478] mt-1">Deskripsikan pengalaman kerja, pelatihan, dan kompetensi yang Anda miliki untuk dinilai oleh asesor.</p>
</div>

<form class="space-y-6">
    {{-- Petunjuk Pengisian --}}
    <div class="bg-blue-50 border border-blue-100 rounded-xl p-5">
        <h3 class="text-xs font-bold text-[#1565C0] flex items-center gap-2 mb-2">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            Petunjuk Pengisian
        </h3>
        <ul class="text-xs text-[#5A6478] space-y-1.5 leading-relaxed">
            <li>• Jelaskan pengalaman kerja Anda secara detail dan relevan dengan program studi tujuan.</li>
            <li>• Sertakan informasi mengenai tanggung jawab, pencapaian, dan keterampilan yang diperoleh.</li>
            <li>• Anda dapat menambahkan maksimal <strong>5 pengalaman</strong> (pekerjaan, pelatihan, atau proyek).</li>
            <li>• Setiap pengalaman akan dinilai oleh asesor untuk dikonversi menjadi SKS.</li>
        </ul>
    </div>

    {{-- Pengalaman 1 --}}
    <div class="bg-white border border-[#1565C0]/15 rounded-xl shadow-sm overflow-hidden">
        <div class="p-6 border-b border-gray-100 flex items-center justify-between">
            <div>
                <h2 class="font-heading font-bold text-[#1A1A2E]">Pengalaman #1</h2>
                <p class="text-xs text-[#5A6478] mt-0.5">Pengalaman kerja utama Anda</p>
            </div>
            <span class="px-2 py-1 bg-green-50 text-green-600 text-[10px] font-bold rounded-full">Wajib</span>
        </div>
        <div class="p-6 space-y-4">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-bold text-[#1A1A2E] mb-2">Nama Perusahaan/Organisasi *</label>
                    <input type="text" value="PT. Teknologi Nusantara" class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-sm outline-none focus:border-[#1565C0] transition-colors">
                </div>
                <div>
                    <label class="block text-xs font-bold text-[#1A1A2E] mb-2">Posisi/Jabatan *</label>
                    <input type="text" value="Senior Web Developer" class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-sm outline-none focus:border-[#1565C0] transition-colors">
                </div>
                <div>
                    <label class="block text-xs font-bold text-[#1A1A2E] mb-2">Periode Mulai *</label>
                    <input type="month" value="2015-01" class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-sm outline-none focus:border-[#1565C0] transition-colors">
                </div>
                <div>
                    <label class="block text-xs font-bold text-[#1A1A2E] mb-2">Periode Selesai *</label>
                    <div class="flex items-center gap-3">
                        <input type="month" value="2024-06" class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-sm outline-none focus:border-[#1565C0] transition-colors">
                        <label class="flex items-center gap-1.5 text-xs text-[#5A6478] cursor-pointer flex-shrink-0">
                            <input type="checkbox" class="w-4 h-4 rounded text-[#1565C0] border-gray-300 focus:ring-[#1565C0]">
                            Sekarang
                        </label>
                    </div>
                </div>
            </div>
            <div>
                <label class="block text-xs font-bold text-[#1A1A2E] mb-2">Deskripsi Pekerjaan & Tanggung Jawab *</label>
                <textarea rows="4" placeholder="Jelaskan secara detail tanggung jawab dan tugas utama Anda..." class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-sm outline-none focus:border-[#1565C0] transition-colors">Mengembangkan dan memelihara aplikasi web perusahaan menggunakan Laravel, Vue.js, dan MySQL. Memimpin tim developer junior, merancang arsitektur sistem, dan melakukan code review. Berhasil meningkatkan performa aplikasi sebesar 40% melalui optimasi query database.</textarea>
            </div>
            <div>
                <label class="block text-xs font-bold text-[#1A1A2E] mb-2">Keterampilan & Kompetensi yang Diperoleh *</label>
                <textarea rows="3" placeholder="Sebutkan keterampilan teknis dan non-teknis yang Anda peroleh..." class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-sm outline-none focus:border-[#1565C0] transition-colors">Web Development (Laravel, Vue.js, React), Database Management (MySQL, PostgreSQL), Team Leadership, Agile/Scrum Methodology, Problem Solving, Project Management</textarea>
            </div>
            <div>
                <label class="block text-xs font-bold text-[#1A1A2E] mb-2">Pencapaian Utama</label>
                <textarea rows="2" placeholder="Prestasi, penghargaan, atau hasil nyata selama bekerja..." class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-sm outline-none focus:border-[#1565C0] transition-colors">Menerima penghargaan Employee of The Year 2022. Berhasil mengimplementasikan microservices yang mengurangi downtime sebesar 60%.</textarea>
            </div>
            {{-- Upload Bukti Pendukung --}}
            <div>
                <label class="block text-xs font-bold text-[#1A1A2E] mb-2">Upload Bukti Pendukung</label>
                <div class="border-2 border-dashed border-gray-300 rounded-xl p-4 text-center hover:bg-gray-50 transition-colors cursor-pointer">
                    <svg class="w-6 h-6 text-gray-400 mx-auto mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path></svg>
                    <p class="text-xs text-[#5A6478]">Upload SK, Sertifikat, atau dokumen pendukung (Opsional, PDF, maks 2MB)</p>
                </div>
            </div>
        </div>
    </div>

    {{-- Pengalaman 2 --}}
    <div class="bg-white border border-[#1565C0]/15 rounded-xl shadow-sm overflow-hidden">
        <div class="p-6 border-b border-gray-100 flex items-center justify-between">
            <div>
                <h2 class="font-heading font-bold text-[#1A1A2E]">Pengalaman #2</h2>
                <p class="text-xs text-[#5A6478] mt-0.5">Pengalaman tambahan (opsional)</p>
            </div>
            <span class="px-2 py-1 bg-gray-50 text-gray-500 text-[10px] font-bold rounded-full">Opsional</span>
        </div>
        <div class="p-6 space-y-4">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-bold text-[#1A1A2E] mb-2">Nama Perusahaan/Organisasi</label>
                    <input type="text" value="Digital Creative Agency" class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-sm outline-none focus:border-[#1565C0] transition-colors">
                </div>
                <div>
                    <label class="block text-xs font-bold text-[#1A1A2E] mb-2">Posisi/Jabatan</label>
                    <input type="text" value="Web Developer" class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-sm outline-none focus:border-[#1565C0] transition-colors">
                </div>
                <div>
                    <label class="block text-xs font-bold text-[#1A1A2E] mb-2">Periode Mulai</label>
                    <input type="month" value="2013-03" class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-sm outline-none focus:border-[#1565C0] transition-colors">
                </div>
                <div>
                    <label class="block text-xs font-bold text-[#1A1A2E] mb-2">Periode Selesai</label>
                    <input type="month" value="2014-12" class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-sm outline-none focus:border-[#1565C0] transition-colors">
                </div>
            </div>
            <div>
                <label class="block text-xs font-bold text-[#1A1A2E] mb-2">Deskripsi Pekerjaan & Tanggung Jawab</label>
                <textarea rows="3" placeholder="Jelaskan secara detail tanggung jawab dan tugas utama Anda..." class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-sm outline-none focus:border-[#1565C0] transition-colors">Mengembangkan website client menggunakan WordPress dan PHP. Berkolaborasi dengan tim desain untuk implementasi UI/UX. Melakukan maintenance dan update website secara berkala.</textarea>
            </div>
            <div>
                <label class="block text-xs font-bold text-[#1A1A2E] mb-2">Keterampilan & Kompetensi yang Diperoleh</label>
                <textarea rows="2" placeholder="Sebutkan keterampilan teknis dan non-teknis yang Anda peroleh..." class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-sm outline-none focus:border-[#1565C0] transition-colors">WordPress Development, PHP, HTML/CSS, JavaScript, Client Communication, Time Management</textarea>
            </div>
        </div>
    </div>

    {{-- Pengalaman 3 --}}
    <div class="bg-white border border-[#1565C0]/15 rounded-xl shadow-sm overflow-hidden">
        <div class="p-6 border-b border-gray-100 flex items-center justify-between">
            <div>
                <h2 class="font-heading font-bold text-[#1A1A2E]">Pengalaman #3</h2>
                <p class="text-xs text-[#5A6478] mt-0.5">Pelatihan atau sertifikasi (opsional)</p>
            </div>
            <span class="px-2 py-1 bg-gray-50 text-gray-500 text-[10px] font-bold rounded-full">Opsional</span>
        </div>
        <div class="p-6 space-y-4">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-bold text-[#1A1A2E] mb-2">Nama Pelatihan/Sertifikasi</label>
                    <input type="text" value="AWS Certified Solutions Architect" class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-sm outline-none focus:border-[#1565C0] transition-colors">
                </div>
                <div>
                    <label class="block text-xs font-bold text-[#1A1A2E] mb-2">Penyelenggara</label>
                    <input type="text" value="Amazon Web Services" class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-sm outline-none focus:border-[#1565C0] transition-colors">
                </div>
                <div>
                    <label class="block text-xs font-bold text-[#1A1A2E] mb-2">Tahun</label>
                    <input type="text" value="2023" class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-sm outline-none focus:border-[#1565C0] transition-colors">
                </div>
                <div>
                    <label class="block text-xs font-bold text-[#1A1A2E] mb-2">Durasi (Jam)</label>
                    <input type="text" value="120" class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-sm outline-none focus:border-[#1565C0] transition-colors">
                </div>
            </div>
            <div>
                <label class="block text-xs font-bold text-[#1A1A2E] mb-2">Kompetensi yang Diperoleh</label>
                <textarea rows="2" placeholder="Sebutkan keterampilan yang diperoleh dari pelatihan ini..." class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-sm outline-none focus:border-[#1565C0] transition-colors">Cloud Architecture Design, AWS Core Services (EC2, S3, RDS, Lambda), Security Best Practices, Cost Optimization, High Availability Architecture</textarea>
            </div>
        </div>
    </div>

    {{-- Tombol Tambah Pengalaman --}}
    <div class="text-center">
        <button type="button" class="px-6 py-2.5 border-2 border-dashed border-[#1565C0]/30 text-[#1565C0] text-sm font-bold rounded-xl hover:bg-blue-50 transition-colors flex items-center gap-2 mx-auto">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
            Tambah Pengalaman Lain
        </button>
        <p class="text-[10px] text-[#5A6478] mt-2">Maksimal 5 pengalaman</p>
    </div>

    {{-- Estimasi SKS --}}
    <div class="bg-[#F8FAFC] border border-[#1565C0]/10 rounded-xl p-5">
        <h3 class="text-sm font-bold text-[#1A1A2E] mb-3">Ringkasan Pengalaman</h3>
        <div class="space-y-2 text-xs text-[#5A6478]">
            <div class="flex justify-between">
                <span>Total Pengalaman Kerja:</span>
                <span class="font-bold text-[#1A1A2E]">10 Tahun 3 Bulan</span>
            </div>
            <div class="flex justify-between">
                <span>Jumlah Pengalaman Diinput:</span>
                <span class="font-bold text-[#1A1A2E]">3 dari 5</span>
            </div>
            <div class="flex justify-between">
                <span>Estimasi SKS Potensial:</span>
                <span class="font-bold text-[#1565C0]">24 - 36 SKS</span>
            </div>
        </div>
        <p class="text-[10px] text-[#5A6478] mt-3 italic">* Estimasi SKS akan divalidasi oleh asesor berdasarkan bukti dan relevansi dengan program studi tujuan.</p>
    </div>

    {{-- Tombol Navigasi --}}
    <div class="flex justify-between pt-4">
        <a href="{{ route('applicant.documents') }}" class="px-6 py-2.5 border border-gray-300 text-[#5A6478] text-sm font-bold rounded-lg hover:bg-gray-50 transition-colors flex items-center gap-2">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
            Kembali
        </a>
        <div class="flex gap-3">
            <button type="button" class="px-6 py-2.5 border border-gray-300 text-[#5A6478] text-sm font-bold rounded-lg hover:bg-gray-50 transition-colors">
                Simpan Draft
            </button>
            <button type="submit" class="px-6 py-2.5 bg-[#1565C0] text-white text-sm font-bold rounded-lg hover:bg-[#0D47A1] transition-colors flex items-center gap-2">
                Review & Submit
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
            </button>
        </div>
    </div>
</form>

@endsection