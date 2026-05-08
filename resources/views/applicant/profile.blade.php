{{-- resources/views/applicant/profile.blade.php --}}
@extends('applicant.layout')
@section('title', 'Profil Data Diri')
@section('applicant_content')

<div class="mb-8">
    <h1 class="font-heading text-2xl font-bold text-[#1A1A2E]">Kelola Profil Data Diri</h1>
    <p class="text-sm text-[#5A6478] mt-1">Lengkapi data diri Anda dengan benar. Data ini akan digunakan untuk proses asesmen.</p>
</div>

<div class="bg-white border border-[#1565C0]/15 rounded-xl shadow-sm overflow-hidden">
    <div class="p-6 border-b border-gray-100">
        <h2 class="font-heading font-bold text-[#1A1A2E]">Informasi Pribadi</h2>
        <p class="text-xs text-[#5A6478] mt-0.5">Data yang bertanda (*) wajib diisi</p>
    </div>
    
    <div class="p-6">
        <form class="space-y-6">
            {{-- Foto Profil --}}
            <div class="flex items-center gap-4 pb-6 border-b border-gray-100">
                <div class="w-16 h-16 rounded-full bg-[#E3F0FF] text-[#1565C0] flex items-center justify-center font-bold text-xl border-2 border-[#1565C0]/20">
                    BS
                </div>
                <div>
                    <button type="button" class="px-4 py-2 border border-[#1565C0]/30 text-[#1565C0] text-xs font-bold rounded-lg hover:bg-[#E3F0FF] transition-colors">Upload Foto</button>
                    <p class="text-[10px] text-[#5A6478] mt-1">Format JPG/PNG, maksimal 500KB</p>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                {{-- NIK --}}
                <div>
                    <label class="block text-xs font-bold text-[#1A1A2E] mb-2">NIK *</label>
                    <input type="text" value="3201021508900001" class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-sm outline-none focus:border-[#1565C0] transition-colors">
                </div>
                {{-- NPWP --}}
                <div>
                    <label class="block text-xs font-bold text-[#1A1A2E] mb-2">NPWP</label>
                    <input type="text" value="12.345.678.9-012.000" class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-sm outline-none focus:border-[#1565C0] transition-colors">
                </div>
                {{-- Nama Lengkap --}}
                <div>
                    <label class="block text-xs font-bold text-[#1A1A2E] mb-2">Nama Lengkap *</label>
                    <input type="text" value="Budi Santoso" class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-sm outline-none focus:border-[#1565C0] transition-colors">
                </div>
                {{-- Tempat Lahir --}}
                <div>
                    <label class="block text-xs font-bold text-[#1A1A2E] mb-2">Tempat Lahir *</label>
                    <input type="text" value="Jakarta" class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-sm outline-none focus:border-[#1565C0] transition-colors">
                </div>
                {{-- Tanggal Lahir --}}
                <div>
                    <label class="block text-xs font-bold text-[#1A1A2E] mb-2">Tanggal Lahir *</label>
                    <input type="date" value="1990-08-15" class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-sm outline-none focus:border-[#1565C0] transition-colors">
                </div>
                {{-- Jenis Kelamin --}}
                <div>
                    <label class="block text-xs font-bold text-[#1A1A2E] mb-2">Jenis Kelamin *</label>
                    <select class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-sm outline-none focus:border-[#1565C0] transition-colors">
                        <option>Laki-laki</option>
                        <option>Perempuan</option>
                    </select>
                </div>
                {{-- Agama --}}
                <div>
                    <label class="block text-xs font-bold text-[#1A1A2E] mb-2">Agama *</label>
                    <select class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-sm outline-none focus:border-[#1565C0] transition-colors">
                        <option>Islam</option>
                        <option>Kristen</option>
                        <option>Katolik</option>
                        <option>Hindu</option>
                        <option>Buddha</option>
                        <option>Konghucu</option>
                    </select>
                </div>
                {{-- Email --}}
                <div>
                    <label class="block text-xs font-bold text-[#1A1A2E] mb-2">Email *</label>
                    <input type="email" value="budi.santoso@email.com" class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-sm outline-none focus:border-[#1565C0] transition-colors">
                </div>
                {{-- No. Telepon --}}
                <div>
                    <label class="block text-xs font-bold text-[#1A1A2E] mb-2">No. Telepon *</label>
                    <input type="tel" value="081234567890" class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-sm outline-none focus:border-[#1565C0] transition-colors">
                </div>
            </div>

            {{-- Alamat --}}
            <div class="pt-6 border-t border-gray-100">
                <h3 class="text-sm font-bold text-[#1A1A2E] mb-4">Alamat Lengkap</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="md:col-span-2">
                        <label class="block text-xs font-bold text-[#1A1A2E] mb-2">Alamat *</label>
                        <textarea rows="3" class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-sm outline-none focus:border-[#1565C0] transition-colors">Jl. Merdeka No. 123, Kel. Menteng, Kec. Menteng</textarea>
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-[#1A1A2E] mb-2">Provinsi *</label>
                        <select class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-sm outline-none focus:border-[#1565C0] transition-colors">
                            <option>DKI Jakarta</option>
                            <option>Jawa Barat</option>
                            <option>Banten</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-[#1A1A2E] mb-2">Kota/Kabupaten *</label>
                        <select class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-sm outline-none focus:border-[#1565C0] transition-colors">
                            <option>Jakarta Pusat</option>
                            <option>Jakarta Selatan</option>
                            <option>Jakarta Barat</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-[#1A1A2E] mb-2">Kecamatan *</label>
                        <input type="text" value="Menteng" class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-sm outline-none focus:border-[#1565C0] transition-colors">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-[#1A1A2E] mb-2">Kode Pos *</label>
                        <input type="text" value="10310" class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-sm outline-none focus:border-[#1565C0] transition-colors">
                    </div>
                </div>
            </div>

            {{-- Pendidikan Terakhir --}}
            <div class="pt-6 border-t border-gray-100">
                <h3 class="text-sm font-bold text-[#1A1A2E] mb-4">Pendidikan Terakhir</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-xs font-bold text-[#1A1A2E] mb-2">Jenjang *</label>
                        <select class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-sm outline-none focus:border-[#1565C0] transition-colors">
                            <option>SMA/Sederajat</option>
                            <option>D1</option>
                            <option>D2</option>
                            <option>D3</option>
                            <option>S1</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-[#1A1A2E] mb-2">Nama Institusi *</label>
                        <input type="text" value="SMAN 1 Jakarta" class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-sm outline-none focus:border-[#1565C0] transition-colors">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-[#1A1A2E] mb-2">Tahun Lulus *</label>
                        <input type="text" value="2008" class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-sm outline-none focus:border-[#1565C0] transition-colors">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-[#1A1A2E] mb-2">Jurusan</label>
                        <input type="text" value="IPA" class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-sm outline-none focus:border-[#1565C0] transition-colors">
                    </div>
                </div>
            </div>

            {{-- Tombol Simpan --}}
            <div class="pt-6 border-t border-gray-100 flex justify-end gap-3">
                <button type="button" class="px-6 py-2.5 border border-gray-300 text-[#5A6478] text-sm font-bold rounded-lg hover:bg-gray-50 transition-colors">Batal</button>
                <button type="submit" class="px-6 py-2.5 bg-[#1565C0] text-white text-sm font-bold rounded-lg hover:bg-[#0D47A1] transition-colors">Simpan Profil</button>
            </div>
        </form>
    </div>
</div>

@endsection