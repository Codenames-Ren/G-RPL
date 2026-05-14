{{-- resources/views/applicant/profile.blade.php --}}
@extends('applicant.layout')
@section('title', 'Profil Data Diri')
@section('applicant_content')

<div class="mb-8">
    <h1 class="font-heading text-2xl font-bold text-[#1A1A2E]">Kelola Profil Data Diri</h1>
    <p class="text-sm text-[#5A6478] mt-1">Lengkapi data diri. Data ini dipakai sebagai applicant profile pada proses RPL.</p>
</div>

@if(session('success'))
    <div class="mb-6 p-4 bg-green-50 border border-green-200 rounded-xl text-sm font-bold text-green-700">{{ session('success') }}</div>
@endif

@if($errors->any())
    <div class="mb-6 p-4 bg-red-50 border border-red-200 rounded-xl text-sm font-bold text-red-700">{{ $errors->first() }}</div>
@endif

<div class="bg-white border border-[#1565C0]/15 rounded-xl shadow-sm overflow-hidden">
    <div class="p-6 border-b border-gray-100">
        <h2 class="font-heading font-bold text-[#1A1A2E]">Informasi Pribadi</h2>
        <p class="text-xs text-[#5A6478] mt-0.5">Field mengikuti data yang tersedia di backend: user dan applicant.</p>
    </div>

    <div class="p-6">
        <form method="POST" action="{{ route('applicant.profile.update') }}" class="space-y-6">
            @csrf
            <div class="flex items-center gap-4 pb-6 border-b border-gray-100">
                <div class="w-16 h-16 rounded-full bg-[#E3F0FF] text-[#1565C0] flex items-center justify-center font-bold text-xl border-2 border-[#1565C0]/20">
                    {{ str($applicant?->nama ?? $user?->name ?? 'CM')->substr(0, 2)->upper() }}
                </div>
                <div>
                    <p class="text-sm font-bold text-[#1A1A2E]">{{ $user?->email }}</p>
                    <p class="text-[10px] text-[#5A6478] mt-1">Role: {{ $user?->role }}</p>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-xs font-bold text-[#1A1A2E] mb-2">Nama Lengkap *</label>
                    <input name="name" type="text" value="{{ old('name', $applicant?->nama ?? $user?->name) }}" required class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-sm outline-none focus:border-[#1565C0] transition-colors">
                </div>
                <div>
                    <label class="block text-xs font-bold text-[#1A1A2E] mb-2">Email *</label>
                    <input name="email" type="email" value="{{ old('email', $user?->email) }}" required class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-sm outline-none focus:border-[#1565C0] transition-colors">
                </div>
                <div>
                    <label class="block text-xs font-bold text-[#1A1A2E] mb-2">NIK</label>
                    <input name="nik" type="text" value="{{ old('nik', $applicant?->nik) }}" maxlength="16" class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-sm outline-none focus:border-[#1565C0] transition-colors">
                </div>
                <div>
                    <label class="block text-xs font-bold text-[#1A1A2E] mb-2">No. Telepon</label>
                    <input name="no_hp" type="tel" value="{{ old('no_hp', $applicant?->no_hp) }}" class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-sm outline-none focus:border-[#1565C0] transition-colors">
                </div>
                <div class="md:col-span-2">
                    <label class="block text-xs font-bold text-[#1A1A2E] mb-2">Alamat</label>
                    <textarea name="alamat" rows="4" class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-sm outline-none focus:border-[#1565C0] transition-colors">{{ old('alamat', $applicant?->alamat) }}</textarea>
                </div>
            </div>

            <div class="pt-6 border-t border-gray-100 flex justify-end gap-3">
                <a href="{{ route('dashboard') }}" class="px-6 py-2.5 border border-gray-300 text-[#5A6478] text-sm font-bold rounded-lg hover:bg-gray-50 transition-colors">Batal</a>
                <button type="submit" class="px-6 py-2.5 bg-[#1565C0] text-white text-sm font-bold rounded-lg hover:bg-[#0D47A1] transition-colors">Simpan & Lanjutkan</button>
            </div>
        </form>
    </div>
</div>

@endsection
