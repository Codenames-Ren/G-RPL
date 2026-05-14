{{-- resources/views/manager/applications.blade.php --}}
@extends('manager.layout')
@section('page_title', 'Kelola Pengajuan RPL')
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

<div class="bg-white border border-[#1565C0]/15 rounded-xl shadow-sm" x-data="{ status: 'all', prodi: 'all', search: '' }">
    <div class="p-6 border-b border-gray-100 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <h2 class="font-heading font-bold text-[#1A1A2E]">Daftar Pengajuan</h2>
            <p class="text-xs text-[#5A6478] mt-0.5">Kelola dan review semua pengajuan RPL dari calon mahasiswa</p>
        </div>
        <div class="flex gap-2 flex-wrap">
            <select x-model="status" class="text-xs border border-gray-300 rounded-lg px-3 py-2 outline-none focus:border-[#1565C0]">
                <option value="all">Semua Status</option>
                @foreach($statusOptions as $option)
                    <option value="{{ $option }}">{{ str($option)->title() }}</option>
                @endforeach
            </select>
            <select x-model="prodi" class="text-xs border border-gray-300 rounded-lg px-3 py-2 outline-none focus:border-[#1565C0]">
                <option value="all">Semua Prodi</option>
                @foreach($prodiOptions as $option)
                    <option value="{{ $option }}">{{ $option }}</option>
                @endforeach
            </select>
            <input x-model.debounce.150ms="search" type="text" placeholder="Cari nama..." class="text-xs border border-gray-300 rounded-lg px-3 py-2 outline-none focus:border-[#1565C0] w-40">
        </div>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full text-left">
            <thead class="bg-[#F8FAFC] text-[11px] font-bold text-[#5A6478] uppercase tracking-widest border-b border-gray-100">
                <tr>
                    <th class="px-6 py-4">ID</th>
                    <th class="px-6 py-4">Applicant</th>
                    <th class="px-6 py-4">Prodi Tujuan</th>
                    <th class="px-6 py-4">Tipe RPL</th>
                    <th class="px-6 py-4">Tgl Submit</th>
                    <th class="px-6 py-4">Status</th>
                    <th class="px-6 py-4">Asesor</th>
                    <th class="px-6 py-4 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-50">
                @forelse($applications as $application)
                    @php
                        $applicantName = $application->applicant?->nama ?? '-';
                        $prodiName = $application->prodi?->nama_prodi ?? '-';
                        $jenisRpl = $application->jenis_RPL ?? $application->jenis_rpl ?? '-';
                        $statusClass = $statusClasses[$application->status] ?? 'bg-gray-50 text-gray-700';
                        $asesorName = $application->latestAssignment?->asesor?->nama ?? '-';
                    @endphp
                    <tr
                        class="hover:bg-gray-50 transition-colors"
                        data-status="{{ $application->status }}"
                        data-prodi="{{ $prodiName }}"
                        data-search="{{ str($applicantName.' '.$application->id)->lower() }}"
                        x-show="(status === 'all' || status === $el.dataset.status) && (prodi === 'all' || prodi === $el.dataset.prodi) && (!search || $el.dataset.search.includes(search.toLowerCase()))"
                    >
                        <td class="px-6 py-4 text-[10px] font-mono text-[#5A6478]">APP-{{ str($application->id)->substr(0, 8)->upper() }}</td>
                        <td class="px-6 py-4 text-sm font-bold text-[#1A1A2E]">{{ $applicantName }}</td>
                        <td class="px-6 py-4 text-xs text-[#5A6478]">{{ $prodiName }}</td>
                        <td class="px-6 py-4">
                            <span class="px-2 py-1 rounded-full text-[10px] font-bold {{ $jenisRpl === 'A' ? 'bg-blue-50 text-[#1565C0]' : 'bg-orange-50 text-[#E65100]' }}">Tipe {{ $jenisRpl }}</span>
                        </td>
                        <td class="px-6 py-4 text-xs text-[#5A6478]">{{ optional($application->updated_at)->format('d M Y') }}</td>
                        <td class="px-6 py-4">
                            <span class="px-2 py-1 rounded text-[10px] font-bold {{ $statusClass }}">{{ str($application->status)->title() }}</span>
                        </td>
                        <td class="px-6 py-4 text-xs text-[#5A6478]">{{ $asesorName }}</td>
                        <td class="px-6 py-4 text-center">
                            <div class="flex items-center justify-center gap-2">
                                <a href="{{ route('manager.assignment') }}" class="px-3 py-1.5 bg-[#1565C0] text-white text-[10px] font-bold rounded-lg hover:bg-[#0D47A1] transition-colors">Detail</a>
                                @if($application->status === 'submitted')
                                    <a href="{{ route('manager.assignment') }}" class="px-3 py-1.5 bg-purple-600 text-white text-[10px] font-bold rounded-lg hover:bg-purple-700 transition-colors">Assign</a>
                                @endif
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="px-6 py-10 text-center text-sm text-[#5A6478]">Belum ada pengajuan yang siap dikelola manager.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="p-6 border-t border-gray-50 flex items-center justify-between">
        <p class="text-xs text-[#5A6478]">Menampilkan {{ $applications->count() }} pengajuan</p>
        <a href="{{ route('manager.assignment') }}" class="px-4 py-2 bg-[#1565C0] text-white rounded-lg text-xs font-bold hover:bg-[#0D47A1]">Assign Asesor</a>
    </div>
</div>

@endsection
