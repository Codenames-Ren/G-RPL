{{-- resources/views/applicant/dashboard.blade.php --}}
@extends('layouts.app')
@section('title', 'Dashboard Calon Mahasiswa')
@section('content')

@php
    $name = $applicant?->nama ?? Auth::user()?->name ?? 'Calon Mahasiswa';
    $initials = str($name)->explode(' ')->filter()->map(fn ($part) => str($part)->substr(0, 1))->take(2)->join('');
    $status = $application?->status ?? 'draft';
    $statusOrder = ['draft', 'submitted', 'assigned', 'assessed', 'approved'];
    $statusIndex = max(array_search($status, $statusOrder, true), 0);
    $lineWidth = $application ? min($statusIndex * 25, 100) : 0;
    $statusClasses = [
        'draft' => 'bg-yellow-50 text-[#F9A825]',
        'submitted' => 'bg-blue-50 text-blue-700',
        'assigned' => 'bg-purple-50 text-purple-700',
        'assessed' => 'bg-indigo-50 text-indigo-700',
        'approved' => 'bg-green-50 text-green-700',
        'rejected' => 'bg-red-50 text-red-700',
        'cancelled' => 'bg-gray-100 text-gray-600',
    ];
@endphp

<nav class="bg-white border-b border-[#1565C0]/15 px-7 h-16 flex items-center justify-between sticky top-0 z-50">
    <div class="flex items-center gap-2.5">
        <img src="{{ asset('images/logo.png') }}" alt="G-RPL" class="h-8 w-auto">
        <span class="font-heading font-bold text-[#1565C0] text-lg">G-RPL</span>
    </div>
    <div class="flex items-center gap-4">
        <div class="hidden md:block text-right">
            <p class="text-sm font-bold text-[#1A1A2E]">{{ $name }}</p>
            <p class="text-xs text-[#5A6478]">Calon Mahasiswa</p>
        </div>
        <div class="w-10 h-10 rounded-full bg-[#E3F0FF] text-[#1565C0] flex items-center justify-center font-bold border border-[#1565C0]/20">
            {{ $initials ?: 'CM' }}
        </div>
        <form method="POST" action="{{ route('logout') }}" class="ml-2">
            @csrf
            <button type="submit" class="p-2 text-[#D32F2F] hover:bg-red-50 rounded-lg transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
            </button>
        </form>
    </div>
</nav>

<div class="min-h-[calc(100vh-64px)] bg-[#F5F6FA] py-8 px-4 md:px-8">
    <div class="max-w-6xl mx-auto">
        <div class="mb-8">
            <h1 class="font-heading text-2xl font-bold text-[#1A1A2E]">Dashboard Pendaftaran</h1>
            <p class="text-sm text-[#5A6478] mt-1">Lengkapi data dan pantau status pengajuan RPL Anda.</p>
        </div>

        @if(session('success'))
            <div class="mb-6 p-4 bg-green-50 border border-green-200 rounded-xl text-sm font-bold text-green-700">{{ session('success') }}</div>
        @endif

        @if($errors->any())
            <div class="mb-6 p-4 bg-red-50 border border-red-200 rounded-xl text-sm font-bold text-red-700">{{ $errors->first() }}</div>
        @endif

        <div class="bg-[#FFF8E1] border border-[#F9A825] rounded-lg p-4 mb-8 flex items-start gap-4 shadow-sm">
            <div class="text-[#F9A825] mt-0.5">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
            </div>
            <div>
                <h3 class="text-sm font-bold text-[#1A1A2E]">Status: {{ str($status)->title() }}</h3>
                <p class="text-xs text-[#5A6478] mt-1">
                    @if(!$application)
                        Anda belum membuat application. Mulai dari pilih tipe RPL dan program studi.
                    @elseif($status === 'submitted')
                        Application sudah dikirim dan menunggu assignment manager.
                    @elseif($status === 'assigned')
                        Application sudah ditugaskan ke asesor dan menunggu assessment.
                    @elseif($status === 'rejected')
                        Application ditolak. Silakan perbaiki dan ajukan ulang.
                    @else
                        Lengkapi dokumen dan learning experiences sebelum submit.
                    @endif
                </p>
            </div>
        </div>

        <div class="bg-white border border-[#1565C0]/15 rounded-lg p-6 mb-8 shadow-sm">
            <h2 class="text-sm font-bold text-[#1A1A2E] mb-6 uppercase tracking-wider">Status Pengajuan</h2>
            <div class="relative flex justify-between items-center w-full">
                <div class="absolute top-5 left-0 w-full h-1 bg-gray-200 rounded-full"></div>
                <div class="absolute top-5 left-0 h-1 bg-[#1565C0] rounded-full transition-all" style="width: {{ $lineWidth }}%;"></div>
                @foreach(['draft' => 'Draft', 'submitted' => 'Submitted', 'assigned' => 'Assigned', 'assessed' => 'Assessed', 'approved' => 'Keputusan'] as $key => $label)
                    @php $active = $application && array_search($key, $statusOrder, true) <= $statusIndex; @endphp
                    <div class="relative flex flex-col items-center gap-2 bg-white px-1">
                        <div class="w-10 h-10 rounded-full flex items-center justify-center border-2 {{ $active ? 'bg-[#1565C0] border-[#1565C0] text-white' : 'bg-white border-gray-300 text-gray-400' }}">
                            <span class="text-xs font-bold">{{ $loop->iteration }}</span>
                        </div>
                        <span class="text-[11px] font-bold {{ $active ? 'text-[#1565C0]' : 'text-gray-400' }}">{{ $label }}</span>
                    </div>
                @endforeach
            </div>
        </div>

        <h2 class="text-sm font-bold text-[#1A1A2E] mb-4 uppercase tracking-wider">Tahapan Pengajuan Anda</h2>
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <div class="lg:col-span-2 space-y-4">
                @foreach([
                    ['key' => 'profile', 'title' => '1. Kelola Profil Data Diri', 'desc' => 'Nama, email, NIK, nomor HP, dan alamat applicant.', 'route' => route('applicant.profile'), 'button' => 'Edit Profil'],
                    ['key' => 'program', 'title' => '2. Pilih Tipe RPL & Program Studi', 'desc' => 'Buat atau edit application draft.', 'route' => route('applicant.program'), 'button' => 'Isi Program'],
                    ['key' => 'documents', 'title' => '3. Upload Dokumen Persyaratan', 'desc' => 'Upload dokumen ke application.', 'route' => route('applicant.documents'), 'button' => 'Upload'],
                    ['key' => 'experiences', 'title' => '4. Input Learning Experiences', 'desc' => 'Tambahkan pengalaman kerja/course.', 'route' => route('applicant.outcomes'), 'button' => 'Input Data'],
                ] as $step)
                    @php $done = $progress[$step['key']] ?? false; @endphp
                    <div class="bg-white border {{ $done ? 'border-green-200' : 'border-[#1565C0]/15' }} rounded-lg p-5 flex flex-col sm:flex-row sm:items-center justify-between shadow-sm gap-4">
                        <div class="flex items-start sm:items-center gap-4">
                            <div class="w-8 h-8 rounded-full {{ $done ? 'bg-green-100 text-green-600' : 'bg-[#E3F0FF] text-[#1565C0]' }} font-bold text-sm flex items-center justify-center flex-shrink-0">
                                {{ $done ? 'OK' : $loop->iteration }}
                            </div>
                            <div>
                                <h3 class="text-sm font-bold text-[#1A1A2E]">{{ $step['title'] }}</h3>
                                <p class="text-xs text-[#5A6478]">{{ $step['desc'] }}</p>
                            </div>
                        </div>
                        <a href="{{ $step['route'] }}" class="px-4 py-2 bg-[#1565C0] text-white text-xs font-bold rounded-lg hover:bg-[#0D47A1] transition-colors whitespace-nowrap text-center">{{ $step['button'] }}</a>
                    </div>
                @endforeach
            </div>

            <div class="space-y-4">
                <div class="bg-white border border-[#1565C0]/15 rounded-lg p-6 text-center shadow-sm">
                    <div class="w-12 h-12 bg-[#E3F0FF] text-[#1565C0] rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4"></path></svg>
                    </div>
                    <h3 class="font-heading font-bold text-[#1A1A2E] text-lg mb-2">Submit Application</h3>
                    <p class="text-xs text-[#5A6478] mb-6 leading-relaxed">Submit tersedia jika application draft/rejected sudah punya dokumen dan learning experience.</p>
                    @if($application && in_array($application->status, ['draft', 'rejected'], true))
                        <form method="POST" action="{{ route('applicant.applications.submit', $application) }}">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="w-full py-3 bg-[#1565C0] text-white text-sm font-bold rounded-lg hover:bg-[#0D47A1]">Kirim Pengajuan</button>
                        </form>
                    @else
                        <a href="{{ route('applicant.program') }}" class="block w-full py-3 bg-gray-200 text-gray-500 text-sm font-bold rounded-lg">Mulai / Lihat Form</a>
                    @endif
                </div>

                <div class="bg-white border border-[#1565C0]/15 rounded-lg p-5 shadow-sm">
                    <h3 class="text-xs font-bold text-[#1A1A2E] mb-3 uppercase">Application Terbaru</h3>
                    <div class="space-y-3">
                        @forelse($applications as $item)
                            <div class="border border-gray-100 rounded-lg p-3">
                                <div class="flex items-center justify-between gap-3">
                                    <p class="text-xs font-bold text-[#1A1A2E]">{{ $item->prodi?->nama_prodi ?? 'Prodi belum dipilih' }}</p>
                                    <span class="px-2 py-1 rounded text-[10px] font-bold {{ $statusClasses[$item->status] ?? 'bg-gray-100 text-gray-600' }}">{{ str($item->status)->title() }}</span>
                                </div>
                                <p class="text-[10px] text-[#5A6478] mt-1">Tipe {{ $item->jenis_RPL ?? $item->jenis_rpl ?? '-' }} | {{ optional($item->created_at)->format('d M Y') }}</p>
                            </div>
                        @empty
                            <p class="text-xs text-[#5A6478]">Belum ada application.</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
