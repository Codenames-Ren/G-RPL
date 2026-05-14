{{-- resources/views/applicant/status.blade.php --}}
@extends('applicant.layout')
@section('title', 'Status Pengajuan')
@section('applicant_content')

@php
    $status = $application?->status ?? 'draft';
    $steps = [
        'draft' => 'Draft',
        'submitted' => 'Menunggu Assignment',
        'assigned' => 'Menunggu Assessment',
        'assessed' => 'Assessment Selesai',
        'approved' => 'Approved',
    ];
    $statusOrder = array_keys($steps);
    $statusIndex = max(array_search($status, $statusOrder, true), 0);
    $statusClasses = [
        'draft' => 'bg-yellow-50 text-yellow-700',
        'submitted' => 'bg-blue-50 text-blue-700',
        'assigned' => 'bg-purple-50 text-purple-700',
        'assessed' => 'bg-indigo-50 text-indigo-700',
        'approved' => 'bg-green-50 text-green-700',
        'rejected' => 'bg-red-50 text-red-700',
        'cancelled' => 'bg-gray-100 text-gray-600',
    ];
@endphp

<div class="mb-8">
    <h1 class="font-heading text-2xl font-bold text-[#1A1A2E]">Status Pengajuan</h1>
    <p class="text-sm text-[#5A6478] mt-1">Pantau proses setelah application dikirim sampai keputusan akhir.</p>
</div>

@if(!$application)
    <div class="bg-white border border-[#1565C0]/15 rounded-xl p-8 text-center">
        <h2 class="font-heading font-bold text-[#1A1A2E]">Belum ada application</h2>
        <p class="text-sm text-[#5A6478] mt-2">Mulai pengajuan dulu dari tahap pilih program.</p>
        <a href="{{ route('applicant.program') }}" class="inline-flex mt-5 px-5 py-2.5 bg-[#1565C0] text-white text-sm font-bold rounded-lg">Buat Application</a>
    </div>
@else
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <div class="lg:col-span-2 bg-white border border-[#1565C0]/15 rounded-xl shadow-sm p-6">
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-8">
                <div>
                    <h2 class="font-heading font-bold text-[#1A1A2E]">{{ $application->prodi?->nama_prodi ?? 'Application RPL' }}</h2>
                    <p class="text-xs text-[#5A6478] mt-1">Tipe {{ $application->jenis_RPL ?? $application->jenis_rpl ?? '-' }} | APP-{{ str($application->id)->substr(0, 8)->upper() }}</p>
                </div>
                <span class="px-3 py-1.5 rounded-lg text-xs font-bold {{ $statusClasses[$status] ?? 'bg-gray-100 text-gray-600' }}">{{ str($status)->title() }}</span>
            </div>

            <div class="space-y-4">
                @foreach($steps as $key => $label)
                    @php
                        $done = array_search($key, $statusOrder, true) <= $statusIndex && !in_array($status, ['rejected', 'cancelled'], true);
                        $current = $key === $status;
                    @endphp
                    <div class="flex items-start gap-4 p-4 rounded-xl border {{ $current ? 'border-[#1565C0] bg-blue-50/30' : 'border-gray-100' }}">
                        <div class="w-8 h-8 rounded-full flex items-center justify-center font-bold text-xs {{ $done ? 'bg-[#1565C0] text-white' : 'bg-gray-100 text-gray-400' }}">
                            {{ $done ? 'OK' : $loop->iteration }}
                        </div>
                        <div>
                            <h3 class="text-sm font-bold text-[#1A1A2E]">{{ $label }}</h3>
                            <p class="text-xs text-[#5A6478] mt-1">
                                @if($key === 'submitted')
                                    Manager akan memilih asesor untuk application ini.
                                @elseif($key === 'assigned')
                                    Asesor sudah ditentukan dan proses assessment berjalan.
                                @elseif($key === 'approved')
                                    Hasil akhir pengajuan.
                                @else
                                    Tahap {{ strtolower($label) }}.
                                @endif
                            </p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <div class="space-y-4">
            <div class="bg-white border border-[#1565C0]/15 rounded-xl p-6 shadow-sm">
                <h3 class="font-heading font-bold text-[#1A1A2E] mb-4">Ringkasan</h3>
                <div class="space-y-3 text-xs text-[#5A6478]">
                    <div class="flex justify-between gap-3"><span>Status</span><strong class="text-[#1A1A2E]">{{ str($status)->title() }}</strong></div>
                    <div class="flex justify-between gap-3"><span>Dokumen</span><strong class="text-[#1A1A2E]">{{ $application->documents->count() }}</strong></div>
                    <div class="flex justify-between gap-3"><span>Experience</span><strong class="text-[#1A1A2E]">{{ $application->learningExperiences->count() }}</strong></div>
                    <div class="flex justify-between gap-3"><span>Asesor</span><strong class="text-[#1A1A2E]">{{ $application->latestAssignment?->asesor?->nama ?? '-' }}</strong></div>
                </div>
            </div>

            @if($status === 'rejected')
                <div class="bg-red-50 border border-red-100 rounded-xl p-5">
                    <h3 class="text-xs font-bold text-red-700 mb-2">Perlu Perbaikan</h3>
                    <p class="text-xs text-[#5A6478] leading-relaxed">Application ditolak. Silakan perbaiki data dari halaman program, dokumen, atau learning outcomes lalu submit ulang.</p>
                </div>
            @endif
        </div>
    </div>
@endif

@endsection
