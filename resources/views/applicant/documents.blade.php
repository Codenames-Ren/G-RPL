{{-- resources/views/applicant/documents.blade.php --}}
@extends('applicant.layout')
@section('title', 'Upload Dokumen Persyaratan')
@section('applicant_content')

<div class="mb-8">
    <h1 class="font-heading text-2xl font-bold text-[#1A1A2E]">Upload Dokumen Persyaratan</h1>
    <p class="text-sm text-[#5A6478] mt-1">Unggah dokumen untuk application draft/rejected sebelum submit.</p>
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
        <p class="text-sm text-[#5A6478] mt-2">Pilih tipe RPL dan prodi dulu sebelum upload dokumen.</p>
        <a href="{{ route('applicant.program') }}" class="inline-flex mt-5 px-5 py-2.5 bg-[#1565C0] text-white text-sm font-bold rounded-lg">Pilih Program</a>
    </div>
@else
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <div class="lg:col-span-2 space-y-4">
            @foreach($documentTypes as $type => $label)
                @php
                    $uploaded = $documents->where('type', $type);
                    $editable = in_array($application->status, ['draft', 'rejected'], true);
                @endphp
                <div class="bg-white border border-[#1565C0]/15 rounded-xl p-6 shadow-sm">
                    <div class="flex items-start gap-4">
                        <div class="w-10 h-10 rounded-full {{ $uploaded->isNotEmpty() ? 'bg-green-100 text-green-600' : 'bg-gray-100 text-gray-400' }} flex items-center justify-center flex-shrink-0 mt-1">
                            @if($uploaded->isNotEmpty())
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                            @else
                                <span class="font-bold text-sm">+</span>
                            @endif
                        </div>
                        <div class="flex-grow">
                            <div class="flex items-start justify-between gap-4">
                                <div>
                                    <h3 class="text-sm font-bold text-[#1A1A2E]">{{ $label }}</h3>
                                    <p class="text-xs text-[#5A6478] mt-1">Format PDF/JPG/PNG, maksimal 3MB.</p>
                                </div>
                                <span class="px-2 py-1 {{ $uploaded->isNotEmpty() ? 'bg-green-50 text-green-600' : 'bg-gray-50 text-gray-500' }} text-[10px] font-bold rounded-full flex-shrink-0">
                                    {{ $uploaded->isNotEmpty() ? 'Terupload' : 'Belum Upload' }}
                                </span>
                            </div>

                            @foreach($uploaded as $document)
                                <div class="mt-3 flex items-center gap-2 text-xs text-[#5A6478] bg-gray-50 rounded-lg p-2">
                                    <svg class="w-4 h-4 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path></svg>
                                    <a class="font-bold text-[#1565C0] hover:underline" href="{{ asset('storage/'.$document->file_path) }}" target="_blank">{{ basename($document->file_path) }}</a>
                                    <span class="ml-auto">{{ optional($document->created_at)->format('d M Y') }}</span>
                                </div>
                            @endforeach

                            @if($editable)
                                <form method="POST" action="{{ route('applicant.documents.upload', $application) }}" enctype="multipart/form-data" class="mt-4 border-2 border-dashed border-gray-300 rounded-xl p-4">
                                    @csrf
                                    <input type="hidden" name="type" value="{{ $type }}">
                                    <input type="file" name="file" required accept=".pdf,.jpg,.jpeg,.png" class="block w-full text-xs text-[#5A6478]">
                                    <button type="submit" class="mt-3 px-4 py-2 bg-[#1565C0] text-white text-xs font-bold rounded-lg hover:bg-[#0D47A1]">Upload {{ $label }}</button>
                                </form>
                            @else
                                <p class="mt-3 text-xs text-[#5A6478]">Upload terkunci karena status application: {{ $application->status }}.</p>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach

            <div class="flex justify-between pt-4">
                <a href="{{ route('applicant.program') }}" class="px-6 py-2.5 border border-gray-300 text-[#5A6478] text-sm font-bold rounded-lg hover:bg-gray-50 transition-colors">Kembali</a>
                <a href="{{ route('applicant.outcomes') }}" class="px-6 py-2.5 bg-[#1565C0] text-white text-sm font-bold rounded-lg hover:bg-[#0D47A1] transition-colors">Simpan & Lanjutkan</a>
            </div>
        </div>

        <div class="space-y-4">
            <div class="bg-white border border-[#1565C0]/15 rounded-xl p-6 shadow-sm">
                <h3 class="font-heading font-bold text-[#1A1A2E] mb-4">Status Upload</h3>
                <div class="space-y-3">
                    @foreach($documentTypes as $type => $label)
                        @php $hasDoc = $documents->where('type', $type)->isNotEmpty(); @endphp
                        <div class="flex items-center gap-2">
                            <span class="w-2 h-2 rounded-full {{ $hasDoc ? 'bg-green-500' : 'bg-gray-300' }} flex-shrink-0"></span>
                            <span class="text-xs text-[#5A6478] flex-grow">{{ $label }}</span>
                            <span class="text-[10px] font-bold {{ $hasDoc ? 'text-green-600' : 'text-gray-400' }}">{{ $hasDoc ? 'OK' : '-' }}</span>
                        </div>
                    @endforeach
                </div>
                <div class="mt-4 pt-4 border-t border-gray-100">
                    <p class="text-[10px] text-[#5A6478]">Terupload: <strong class="text-[#1A1A2E]">{{ $documents->count() }}</strong> dokumen</p>
                </div>
            </div>

            <div class="bg-blue-50 border border-blue-100 rounded-xl p-5">
                <h3 class="text-xs font-bold text-[#1565C0] mb-3">Ketentuan Upload</h3>
                <ul class="text-xs text-[#5A6478] space-y-2 leading-relaxed">
                    <li>Format yang diterima: PDF, JPG, PNG.</li>
                    <li>Ukuran maksimal per file: 3MB sesuai API.</li>
                    <li>Minimal satu dokumen diperlukan sebelum submit.</li>
                </ul>
            </div>
        </div>
    </div>
@endif

@endsection
