{{-- resources/views/manager/applications.blade.php --}}
@extends('manager.layout')
@section('page_title', 'Kelola Pengajuan RPL')
@section('manager_content')

<div class="bg-white border border-[#1565C0]/15 rounded-xl shadow-sm">
    <div class="p-6 border-b border-gray-100 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <h2 class="font-heading font-bold text-[#1A1A2E]">Daftar Pengajuan</h2>
            <p class="text-xs text-[#5A6478] mt-0.5">Kelola dan review semua pengajuan RPL dari calon mahasiswa</p>
        </div>
        <div class="flex gap-2 flex-wrap">
            <select class="text-xs border border-gray-300 rounded-lg px-3 py-2 outline-none focus:border-[#1565C0]">
                <option>Semua Status</option>
                <option>Submitted</option>
                <option>Assigned</option>
                <option>Approved</option>
                <option>Rejected</option>
            </select>
            <select class="text-xs border border-gray-300 rounded-lg px-3 py-2 outline-none focus:border-[#1565C0]">
                <option>Semua Prodi</option>
                <option>S1 Teknik Informatika</option>
                <option>S1 Sistem Informasi</option>
                <option>S1 Teknik Elektro</option>
            </select>
            <input type="text" placeholder="Cari nama..." class="text-xs border border-gray-300 rounded-lg px-3 py-2 outline-none focus:border-[#1565C0] w-40">
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
                @php
                    $applications = [
                        ['APP-2024-001', 'Budi Santoso', 'S1 Teknik Informatika', 'Tipe A', '01 Mei 2026', 'Submitted', '-'],
                        ['APP-2024-002', 'Siti Aminah', 'S1 Sistem Informasi', 'Tipe B', '02 Mei 2026', 'Assigned', 'Dr. Darmawan'],
                        ['APP-2024-003', 'Andi Pratama', 'S1 Teknik Elektro', 'Tipe A', '03 Mei 2026', 'Approved', 'Prof. Linda'],
                        ['APP-2024-004', 'Rina Wijaya', 'D3 Manajemen', 'Tipe A', '03 Mei 2026', 'Submitted', '-'],
                        ['APP-2024-005', 'Doni Kusuma', 'S1 Akuntansi', 'Tipe B', '04 Mei 2026', 'Rejected', 'Dr. Rahman'],
                        ['APP-2024-006', 'Maya Sari', 'S1 Teknik Informatika', 'Tipe A', '05 Mei 2026', 'Submitted', '-'],
                    ];
                @endphp
                @foreach($applications as $app)
                <tr class="hover:bg-gray-50 transition-colors">
                    <td class="px-6 py-4 text-[10px] font-mono text-[#5A6478]">{{ $app[0] }}</td>
                    <td class="px-6 py-4 text-sm font-bold text-[#1A1A2E]">{{ $app[1] }}</td>
                    <td class="px-6 py-4 text-xs text-[#5A6478]">{{ $app[2] }}</td>
                    <td class="px-6 py-4">
                        <span class="px-2 py-1 rounded-full text-[10px] font-bold {{ $app[3] == 'Tipe A' ? 'bg-blue-50 text-[#1565C0]' : 'bg-orange-50 text-[#E65100]' }}">{{ $app[3] }}</span>
                    </td>
                    <td class="px-6 py-4 text-xs text-[#5A6478]">{{ $app[4] }}</td>
                    <td class="px-6 py-4">
                        @php
                            $statusColor = match($app[5]) {
                                'Submitted' => 'bg-blue-50 text-blue-700',
                                'Assigned' => 'bg-purple-50 text-purple-700',
                                'Approved' => 'bg-green-50 text-green-700',
                                'Rejected' => 'bg-red-50 text-red-700',
                                default => 'bg-gray-50 text-gray-700'
                            };
                        @endphp
                        <span class="px-2 py-1 rounded text-[10px] font-bold {{ $statusColor }}">{{ $app[5] }}</span>
                    </td>
                    <td class="px-6 py-4 text-xs text-[#5A6478]">{{ $app[6] }}</td>
                    <td class="px-6 py-4 text-center">
                        <div class="flex items-center justify-center gap-2">
                            <button class="px-3 py-1.5 bg-[#1565C0] text-white text-[10px] font-bold rounded-lg hover:bg-[#0D47A1] transition-colors">Detail</button>
                            @if($app[5] == 'Submitted')
                            <button class="px-3 py-1.5 bg-purple-600 text-white text-[10px] font-bold rounded-lg hover:bg-purple-700 transition-colors">Assign</button>
                            @endif
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    {{-- Pagination --}}
    <div class="p-6 border-t border-gray-50 flex items-center justify-between">
        <p class="text-xs text-[#5A6478]">Menampilkan 1-6 dari 156 pengajuan</p>
        <div class="flex gap-2">
            <button class="px-3 py-1 border border-gray-200 text-gray-400 rounded-lg text-xs hover:bg-gray-50 disabled:opacity-50" disabled>Prev</button>
            <button class="px-3 py-1 bg-[#1565C0] text-white rounded-lg text-xs">1</button>
            <button class="px-3 py-1 border border-gray-200 text-[#5A6478] rounded-lg text-xs hover:bg-gray-50">2</button>
            <button class="px-3 py-1 border border-gray-200 text-[#5A6478] rounded-lg text-xs hover:bg-gray-50">3</button>
            <button class="px-3 py-1 border border-gray-200 text-[#5A6478] rounded-lg text-xs hover:bg-gray-50">...</button>
            <button class="px-3 py-1 border border-gray-200 text-[#5A6478] rounded-lg text-xs hover:bg-gray-50">26</button>
            <button class="px-3 py-1 border border-gray-200 text-[#5A6478] rounded-lg text-xs hover:bg-gray-50">Next</button>
        </div>
    </div>
</div>

@endsection