{{-- resources/views/applicant/program.blade.php --}}
@extends('applicant.layout')
@section('title', 'Pilih Tipe RPL & Program Studi')
@section('applicant_content')

<div class="mb-8">
    <h1 class="font-heading text-2xl font-bold text-[#1A1A2E]">Pilih Tipe RPL & Program Studi</h1>
    <p class="text-sm text-[#5A6478] mt-1">Tahap applicant flow: ajukan application dengan jenis RPL dan prodi tujuan.</p>
</div>

@if(session('success'))
    <div class="mb-6 p-4 bg-green-50 border border-green-200 rounded-xl text-sm font-bold text-green-700">{{ session('success') }}</div>
@endif

@if($errors->any())
    <div class="mb-6 p-4 bg-red-50 border border-red-200 rounded-xl text-sm font-bold text-red-700">{{ $errors->first() }}</div>
@endif

<form method="POST" action="{{ route('applicant.program.save') }}" class="space-y-6">
    @csrf
    <div class="bg-white border border-[#1565C0]/15 rounded-xl shadow-sm overflow-hidden">
        <div class="p-6 border-b border-gray-100">
            <h2 class="font-heading font-bold text-[#1A1A2E]">Tipe Pendaftaran RPL</h2>
            <p class="text-xs text-[#5A6478] mt-0.5">Sesuai API: `jenis_rpl` wajib A atau B.</p>
        </div>
        <div class="p-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                @foreach(['A' => 'Transfer Kredit / Lanjut Studi', 'B' => 'Penyetaraan Kualifikasi'] as $type => $description)
                    <label class="relative block cursor-pointer">
                        <input type="radio" name="jenis_rpl" value="{{ $type }}" class="peer sr-only" {{ old('jenis_rpl', $application?->jenis_RPL ?? $application?->jenis_rpl ?? 'A') === $type ? 'checked' : '' }}>
                        <div class="border-2 rounded-xl p-6 transition-all peer-checked:border-[#1565C0] peer-checked:bg-blue-50/30 border-gray-200 hover:border-[#1565C0]/40">
                            <div class="flex items-center gap-3 mb-3">
                                <div class="w-12 h-12 rounded-full bg-[#E3F0FF] text-[#1565C0] flex items-center justify-center font-bold text-lg flex-shrink-0">{{ $type }}</div>
                                <div>
                                    <h3 class="font-heading font-bold text-[#1A1A2E]">RPL Tipe {{ $type }}</h3>
                                    <p class="text-[10px] text-[#5A6478]">{{ $description }}</p>
                                </div>
                            </div>
                            <p class="text-xs text-[#5A6478] leading-relaxed">Pilih tipe RPL yang sesuai dengan jalur pengajuan Anda.</p>
                        </div>
                    </label>
                @endforeach
            </div>
        </div>
    </div>

    <div class="bg-white border border-[#1565C0]/15 rounded-xl shadow-sm overflow-hidden">
        <div class="p-6 border-b border-gray-100">
            <h2 class="font-heading font-bold text-[#1A1A2E]">Program Studi Tujuan</h2>
            <p class="text-xs text-[#5A6478] mt-0.5">Data prodi dan konsentrasi dibaca dari database.</p>
        </div>
        <div class="p-6">
            @if($prodis->isEmpty())
                <div class="bg-yellow-50 border border-yellow-200 rounded-xl p-4 text-sm text-[#5A6478]">
                    Belum ada data program studi di database. Tambahkan data `prodis` dulu sebelum applicant membuat application.
                </div>
            @else
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-xs font-bold text-[#1A1A2E] mb-2">Program Studi *</label>
                        <select name="prodi_id" required class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-sm outline-none focus:border-[#1565C0] transition-colors">
                            <option value="">-- Pilih Program Studi --</option>
                            @foreach($prodis as $prodi)
                                <option value="{{ $prodi->id }}" {{ old('prodi_id', $application?->prodi_id) === $prodi->id ? 'selected' : '' }}>{{ $prodi->nama_prodi }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-[#1A1A2E] mb-2">Konsentrasi (Opsional)</label>
                        <select name="konsentrasi_id" class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-sm outline-none focus:border-[#1565C0] transition-colors">
                            <option value="">-- Pilih Konsentrasi --</option>
                            @foreach($konsentrasis as $konsentrasi)
                                <option value="{{ $konsentrasi->id }}" {{ old('konsentrasi_id', $application?->konsentrasi_id) === $konsentrasi->id ? 'selected' : '' }}>{{ $konsentrasi->nama_konsentrasi }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            @endif
        </div>
    </div>

    <div class="bg-blue-50 border border-blue-100 rounded-xl p-6">
        <h3 class="text-sm font-bold text-[#1565C0] mb-3">Informasi Penting</h3>
        <ul class="text-xs text-[#5A6478] space-y-2 leading-relaxed">
            <li>Pastikan profil data diri sudah benar sebelum membuat application.</li>
            <li>Application baru akan berstatus `draft` sampai Anda upload dokumen, input learning experiences, dan submit.</li>
            <li>Jika application sudah submitted/assigned, data program tidak bisa diedit dari flow applicant.</li>
        </ul>
    </div>

    <div class="flex justify-between pt-4">
        <a href="{{ route('applicant.profile') }}" class="px-6 py-2.5 border border-gray-300 text-[#5A6478] text-sm font-bold rounded-lg hover:bg-gray-50 transition-colors">Kembali</a>
        <button type="submit" class="px-6 py-2.5 bg-[#1565C0] text-white text-sm font-bold rounded-lg hover:bg-[#0D47A1] transition-colors" {{ $prodis->isEmpty() ? 'disabled' : '' }}>
            Simpan & Lanjutkan
        </button>
    </div>
</form>

@endsection
