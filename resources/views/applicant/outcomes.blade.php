{{-- resources/views/applicant/outcomes.blade.php --}}
@extends('applicant.layout')
@section('title', 'Input Capaian Pembelajaran')
@section('applicant_content')

<div class="mb-8">
    <h1 class="font-heading text-2xl font-bold text-[#1A1A2E]">Input Capaian Pembelajaran</h1>
    <p class="text-sm text-[#5A6478] mt-1">Tambahkan learning experiences lalu submit application.</p>
</div>

@if(session('success'))
    <div class="mb-6 p-4 bg-green-50 border border-green-200 rounded-xl text-sm font-bold text-green-700">{{ session('success') }}</div>
@endif

@if($errors->any())
    <div class="mb-6 p-4 bg-red-50 border border-red-200 rounded-xl text-sm font-bold text-red-700">{{ $errors->first() }}</div>
@endif

@if(!$application)
    <div class="bg-white border border-[#1565C0]/15 rounded-xl p-8 text-center">
        <h2 class="font-heading font-bold text-[#1A1A2E]">Belum ada application</h2>
        <p class="text-sm text-[#5A6478] mt-2">Buat application di tahap pilih program dulu.</p>
        <a href="{{ route('applicant.program') }}" class="inline-flex mt-5 px-5 py-2.5 bg-[#1565C0] text-white text-sm font-bold rounded-lg">Pilih Program</a>
    </div>
@else
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <div class="lg:col-span-2 space-y-6">
            <div class="bg-blue-50 border border-blue-100 rounded-xl p-5">
                <h3 class="text-xs font-bold text-[#1565C0] mb-2">Petunjuk Pengisian</h3>
                <p class="text-xs text-[#5A6478] leading-relaxed">API menerima `title`, `type` (`course` atau `experience`), dan `description`. Minimal satu learning experience diperlukan sebelum submit.</p>
            </div>

            @if(in_array($application->status, ['draft', 'rejected'], true))
                <form method="POST" action="{{ route('applicant.experiences.store', $application) }}" class="bg-white border border-[#1565C0]/15 rounded-xl shadow-sm overflow-hidden">
                    @csrf
                    <div class="p-6 border-b border-gray-100">
                        <h2 class="font-heading font-bold text-[#1A1A2E]">Tambah Learning Experience</h2>
                        <p class="text-xs text-[#5A6478] mt-0.5">Pengalaman kerja, pelatihan, course, atau sertifikasi.</p>
                    </div>
                    <div class="p-6 space-y-4">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-xs font-bold text-[#1A1A2E] mb-2">Judul *</label>
                                <input name="title" type="text" value="{{ old('title') }}" required placeholder="Contoh: Senior Web Developer" class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-sm outline-none focus:border-[#1565C0] transition-colors">
                            </div>
                            <div>
                                <label class="block text-xs font-bold text-[#1A1A2E] mb-2">Tipe *</label>
                                <select name="type" required class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-sm outline-none focus:border-[#1565C0] transition-colors">
                                    <option value="experience" {{ old('type') === 'experience' ? 'selected' : '' }}>Experience</option>
                                    <option value="course" {{ old('type') === 'course' ? 'selected' : '' }}>Course</option>
                                </select>
                            </div>
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-[#1A1A2E] mb-2">Deskripsi</label>
                            <textarea name="description" rows="5" placeholder="Jelaskan tanggung jawab, kompetensi, hasil kerja, atau materi yang dipelajari." class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-sm outline-none focus:border-[#1565C0] transition-colors">{{ old('description') }}</textarea>
                        </div>
                        <div class="flex justify-end">
                            <button type="submit" class="px-5 py-2.5 bg-[#1565C0] text-white text-sm font-bold rounded-lg hover:bg-[#0D47A1]">Tambah Experience</button>
                        </div>
                    </div>
                </form>
            @endif

            <div class="bg-white border border-[#1565C0]/15 rounded-xl shadow-sm overflow-hidden">
                <div class="p-6 border-b border-gray-100">
                    <h2 class="font-heading font-bold text-[#1A1A2E]">Learning Experiences Tersimpan</h2>
                </div>
                <div class="divide-y divide-gray-100">
                    @forelse($experiences as $experience)
                        <div class="p-6">
                            <div class="flex items-start justify-between gap-4">
                                <div>
                                    <h3 class="text-sm font-bold text-[#1A1A2E]">{{ $experience->title }}</h3>
                                    <span class="inline-flex mt-2 px-2 py-1 bg-blue-50 text-[#1565C0] text-[10px] font-bold rounded-full">{{ str($experience->type)->title() }}</span>
                                </div>
                                <span class="text-[10px] text-[#5A6478]">{{ optional($experience->created_at)->format('d M Y') }}</span>
                            </div>
                            <p class="mt-3 text-xs text-[#5A6478] leading-relaxed">{{ $experience->description ?: 'Tidak ada deskripsi.' }}</p>
                        </div>
                    @empty
                        <div class="p-8 text-center text-sm text-[#5A6478]">Belum ada learning experience.</div>
                    @endforelse
                </div>
            </div>

            <div class="flex justify-between pt-4">
                <a href="{{ route('applicant.documents') }}" class="px-6 py-2.5 border border-gray-300 text-[#5A6478] text-sm font-bold rounded-lg hover:bg-gray-50 transition-colors">Kembali</a>
                <div class="flex gap-3">
                    @if(in_array($application->status, ['draft', 'submitted'], true))
                        <form method="POST" action="{{ route('applicant.applications.cancel', $application) }}">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="px-6 py-2.5 border border-red-200 text-red-600 text-sm font-bold rounded-lg hover:bg-red-50">Cancel</button>
                        </form>
                    @endif
                    @if(in_array($application->status, ['draft', 'rejected'], true))
                        <form method="POST" action="{{ route('applicant.applications.submit', $application) }}">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="px-6 py-2.5 bg-[#1565C0] text-white text-sm font-bold rounded-lg hover:bg-[#0D47A1]">Submit Application</button>
                        </form>
                    @endif
                </div>
            </div>
        </div>

        <div class="space-y-4">
            <div class="bg-white border border-[#1565C0]/15 rounded-xl p-6 shadow-sm">
                <h3 class="font-heading font-bold text-[#1A1A2E] mb-4">Ringkasan Application</h3>
                <div class="space-y-3 text-xs text-[#5A6478]">
                    <div class="flex justify-between"><span>Status</span><strong class="text-[#1A1A2E]">{{ str($application->status)->title() }}</strong></div>
                    <div class="flex justify-between"><span>Dokumen</span><strong class="text-[#1A1A2E]">{{ $documentsCount }}</strong></div>
                    <div class="flex justify-between"><span>Experience</span><strong class="text-[#1A1A2E]">{{ $experiences->count() }}</strong></div>
                    <div class="flex justify-between"><span>Prodi</span><strong class="text-[#1A1A2E]">{{ $application->prodi?->nama_prodi ?? '-' }}</strong></div>
                </div>
            </div>

            <div class="bg-blue-50 border border-blue-100 rounded-xl p-5">
                <h3 class="text-xs font-bold text-[#1565C0] mb-3">Syarat Submit</h3>
                <ul class="text-xs text-[#5A6478] space-y-2 leading-relaxed">
                    <li>Minimal satu dokumen terupload.</li>
                    <li>Minimal satu learning experience terisi.</li>
                    <li>Status application harus draft atau rejected.</li>
                </ul>
            </div>
        </div>
    </div>
@endif

@endsection
