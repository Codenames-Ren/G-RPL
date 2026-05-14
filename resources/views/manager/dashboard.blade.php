{{-- resources/views/manager/dashboard.blade.php --}}
@extends('manager.layout')
@section('page_title', 'Dashboard Manajer RPL')
@section('manager_content')

@php
    $statusClasses = [
        'submitted' => 'bg-blue-50 text-blue-700',
        'assigned' => 'bg-purple-50 text-purple-700',
        'assessed' => 'bg-yellow-50 text-yellow-700',
        'approved' => 'bg-green-50 text-green-700',
        'rejected' => 'bg-red-50 text-red-700',
    ];
@endphp

<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
    <div class="bg-white border border-[#1565C0]/15 rounded-xl p-6 shadow-sm">
        <div class="flex items-center justify-between mb-4">
            <p class="text-xs font-bold text-[#5A6478] uppercase tracking-wider">Total Pengajuan</p>
            <div class="w-10 h-10 rounded-full bg-blue-50 flex items-center justify-center">
                <svg class="w-5 h-5 text-[#1565C0]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
            </div>
        </div>
        <h3 class="font-heading text-3xl font-extrabold text-[#1A1A2E]">{{ $stats['total'] }}</h3>
        <p class="text-[10px] text-[#5A6478] mt-1">Submitted sampai rejected</p>
    </div>

    <div class="bg-white border border-[#1565C0]/15 rounded-xl p-6 shadow-sm">
        <div class="flex items-center justify-between mb-4">
            <p class="text-xs font-bold text-[#5A6478] uppercase tracking-wider">Menunggu Assign</p>
            <div class="w-10 h-10 rounded-full bg-yellow-50 flex items-center justify-center">
                <svg class="w-5 h-5 text-[#F9A825]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            </div>
        </div>
        <h3 class="font-heading text-3xl font-extrabold text-[#F9A825]">{{ $stats['submitted'] }}</h3>
        <p class="text-[10px] text-[#5A6478] mt-1">Status submitted</p>
    </div>

    <div class="bg-white border border-[#1565C0]/15 rounded-xl p-6 shadow-sm">
        <div class="flex items-center justify-between mb-4">
            <p class="text-xs font-bold text-[#5A6478] uppercase tracking-wider">Sedang Dinilai</p>
            <div class="w-10 h-10 rounded-full bg-purple-50 flex items-center justify-center">
                <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path></svg>
            </div>
        </div>
        <h3 class="font-heading text-3xl font-extrabold text-purple-600">{{ $stats['assigned'] }}</h3>
        <p class="text-[10px] text-[#5A6478] mt-1">Assigned dan assessed</p>
    </div>

    <div class="bg-white border border-[#1565C0]/15 rounded-xl p-6 shadow-sm">
        <div class="flex items-center justify-between mb-4">
            <p class="text-xs font-bold text-[#5A6478] uppercase tracking-wider">Selesai</p>
            <div class="w-10 h-10 rounded-full bg-green-50 flex items-center justify-center">
                <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            </div>
        </div>
        <h3 class="font-heading text-3xl font-extrabold text-green-600">{{ $stats['completed'] }}</h3>
        <p class="text-[10px] text-[#5A6478] mt-1">Approved dan rejected</p>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <div class="lg:col-span-2 bg-white border border-[#1565C0]/15 rounded-xl shadow-sm overflow-hidden">
        <div class="p-6 border-b border-gray-100 flex items-center justify-between">
            <div>
                <h2 class="font-heading font-bold text-[#1A1A2E]">Pengajuan Terbaru</h2>
                <p class="text-xs text-[#5A6478] mt-0.5">{{ $latestApplications->count() }} pengajuan terakhir yang masuk</p>
            </div>
            <a href="{{ route('manager.applications') }}" class="text-xs font-bold text-[#1565C0] hover:underline">Lihat Semua</a>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead class="bg-[#F8FAFC] text-[11px] font-bold text-[#5A6478] uppercase tracking-widest border-b border-gray-100">
                    <tr>
                        <th class="px-6 py-4">Applicant</th>
                        <th class="px-6 py-4">Prodi</th>
                        <th class="px-6 py-4">Tipe</th>
                        <th class="px-6 py-4">Status</th>
                        <th class="px-6 py-4">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @forelse($latestApplications as $application)
                        @php
                            $jenisRpl = $application->jenis_RPL ?? $application->jenis_rpl ?? '-';
                            $statusClass = $statusClasses[$application->status] ?? 'bg-gray-50 text-gray-700';
                        @endphp
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="px-6 py-4 text-sm font-bold text-[#1A1A2E]">{{ $application->applicant?->nama ?? '-' }}</td>
                            <td class="px-6 py-4 text-xs text-[#5A6478]">{{ $application->prodi?->nama_prodi ?? '-' }}</td>
                            <td class="px-6 py-4">
                                <span class="px-2 py-1 rounded-full text-[10px] font-bold {{ $jenisRpl === 'A' ? 'bg-blue-50 text-[#1565C0]' : 'bg-orange-50 text-[#E65100]' }}">Tipe {{ $jenisRpl }}</span>
                            </td>
                            <td class="px-6 py-4">
                                <span class="px-2 py-1 rounded text-[10px] font-bold {{ $statusClass }}">{{ str($application->status)->title() }}</span>
                            </td>
                            <td class="px-6 py-4">
                                <a href="{{ route('manager.assignment') }}" class="text-xs font-bold text-[#1565C0] hover:underline">{{ $application->status === 'submitted' ? 'Assign' : 'Review' }}</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-10 text-center text-sm text-[#5A6478]">Belum ada pengajuan untuk manager.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="space-y-6">
        <div class="bg-white border border-[#1565C0]/15 rounded-xl p-6 shadow-sm">
            <h2 class="font-heading font-bold text-[#1A1A2E] mb-4">Aksi Cepat</h2>
            <div class="space-y-3">
                <a href="{{ route('manager.applications') }}" class="flex items-center gap-3 p-3 bg-[#F8FAFC] rounded-lg hover:bg-[#E3F0FF] transition-colors group">
                    <span class="w-8 h-8 rounded-full bg-blue-100 flex items-center justify-center text-[#1565C0] font-bold text-xs">R</span>
                    <span class="text-sm font-bold text-[#5A6478] group-hover:text-[#1565C0]">Review Pengajuan Baru</span>
                </a>
                <a href="{{ route('manager.assignment') }}" class="flex items-center gap-3 p-3 bg-[#F8FAFC] rounded-lg hover:bg-[#E3F0FF] transition-colors group">
                    <span class="w-8 h-8 rounded-full bg-purple-100 flex items-center justify-center text-purple-600 font-bold text-xs">A</span>
                    <span class="text-sm font-bold text-[#5A6478] group-hover:text-[#1565C0]">Assign Asesor</span>
                </a>
                <a href="{{ route('manager.reports') }}" class="flex items-center gap-3 p-3 bg-[#F8FAFC] rounded-lg hover:bg-[#E3F0FF] transition-colors group">
                    <span class="w-8 h-8 rounded-full bg-green-100 flex items-center justify-center text-green-600 font-bold text-xs">L</span>
                    <span class="text-sm font-bold text-[#5A6478] group-hover:text-[#1565C0]">Lihat Laporan</span>
                </a>
            </div>
        </div>

        <div class="bg-white border border-[#1565C0]/15 rounded-xl p-6 shadow-sm">
            <h2 class="font-heading font-bold text-[#1A1A2E] mb-4">Asesor Aktif</h2>
            <div class="space-y-3">
                @forelse($activeAsesors as $asesor)
                    <div class="flex items-center gap-3 p-2 hover:bg-gray-50 rounded-lg transition-colors">
                        <div class="w-8 h-8 rounded-full bg-[#E3F0FF] text-[#1565C0] flex items-center justify-center font-bold text-xs flex-shrink-0">
                            {{ str($asesor->nama)->substr(0, 2)->upper() }}
                        </div>
                        <div class="flex-grow min-w-0">
                            <p class="text-xs font-bold text-[#1A1A2E] truncate">{{ $asesor->nama }}</p>
                            <p class="text-[10px] text-[#5A6478] truncate">{{ $asesor->prodis->pluck('nama_prodi')->join(', ') ?: $asesor->bidang_keahlian }}</p>
                        </div>
                        <span class="text-[10px] font-bold text-[#5A6478] bg-gray-100 px-2 py-1 rounded-full flex-shrink-0">{{ $asesor->assignments_count }} Antrean</span>
                    </div>
                @empty
                    <p class="text-sm text-[#5A6478]">Belum ada data asesor.</p>
                @endforelse
                <a href="{{ route('manager.asesors') }}" class="block text-center text-xs font-bold text-[#1565C0] hover:underline mt-2 pt-2 border-t border-gray-100">
                    Lihat Semua Asesor
                </a>
            </div>
        </div>
    </div>
</div>

@endsection
