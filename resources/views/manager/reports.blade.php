{{-- resources/views/manager/reports.blade.php --}}
@extends('manager.layout')
@section('page_title', 'Laporan & Statistik')
@section('manager_content')

<div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
    <div class="bg-white border border-[#1565C0]/15 rounded-xl p-6 shadow-sm">
        <h2 class="font-heading font-bold text-[#1A1A2E] mb-6">Status Pengajuan</h2>
        <div class="space-y-4">
            @foreach($statusData as $data)
                <div>
                    <div class="flex justify-between text-xs font-bold mb-1.5">
                        <span class="text-[#5A6478]">{{ $data['label'] }}</span>
                        <span class="text-[#1A1A2E]">{{ $data['count'] }} ({{ $data['percentage'] }}%)</span>
                    </div>
                    <div class="w-full bg-gray-100 rounded-full h-2.5">
                        <div class="h-2.5 rounded-full {{ $data['color'] }}" style="width: {{ $data['percentage'] }}%"></div>
                    </div>
                </div>
            @endforeach
        </div>
        <p class="text-[10px] text-[#5A6478] mt-4 pt-4 border-t border-gray-100">Total: {{ $totalApplications }} pengajuan</p>
    </div>

    <div class="bg-white border border-[#1565C0]/15 rounded-xl p-6 shadow-sm">
        <h2 class="font-heading font-bold text-[#1A1A2E] mb-6">Ringkasan Kinerja</h2>
        <div class="grid grid-cols-2 gap-4">
            <div class="bg-[#F8FAFC] rounded-xl p-4 text-center">
                <p class="text-[10px] text-[#5A6478] uppercase font-bold">Menunggu Assign</p>
                <p class="text-2xl font-extrabold text-[#1565C0] mt-2">{{ $summary['submitted'] }}</p>
                <p class="text-xs text-[#5A6478]">Application</p>
            </div>
            <div class="bg-[#F8FAFC] rounded-xl p-4 text-center">
                <p class="text-[10px] text-[#5A6478] uppercase font-bold">Sedang Dinilai</p>
                <p class="text-2xl font-extrabold text-purple-600 mt-2">{{ $summary['assigned'] }}</p>
                <p class="text-xs text-[#5A6478]">Assigned/assessed</p>
            </div>
            <div class="bg-[#F8FAFC] rounded-xl p-4 text-center">
                <p class="text-[10px] text-[#5A6478] uppercase font-bold">Approved</p>
                <p class="text-2xl font-extrabold text-green-600 mt-2">{{ $summary['approved'] }}</p>
                <p class="text-xs text-[#5A6478]">Pengajuan</p>
            </div>
            <div class="bg-[#F8FAFC] rounded-xl p-4 text-center">
                <p class="text-[10px] text-[#5A6478] uppercase font-bold">Rejected</p>
                <p class="text-2xl font-extrabold text-red-600 mt-2">{{ $summary['rejected'] }}</p>
                <p class="text-xs text-[#5A6478]">Pengajuan</p>
            </div>
        </div>
    </div>
</div>

<div class="bg-white border border-[#1565C0]/15 rounded-xl shadow-sm overflow-hidden">
    <div class="p-6 border-b border-gray-100 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <h2 class="font-heading font-bold text-[#1A1A2E]">Laporan Detail Asesmen</h2>
            <p class="text-xs text-[#5A6478] mt-0.5">Rekap assignment per asesor</p>
        </div>
        <a href="{{ route('manager.asesors') }}" class="px-4 py-2 bg-green-600 text-white text-xs font-bold rounded-lg hover:bg-green-700 transition-colors">
            Data Asesor
        </a>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full text-left">
            <thead class="bg-[#F8FAFC] text-[11px] font-bold text-[#5A6478] uppercase tracking-widest border-b border-gray-100">
                <tr>
                    <th class="px-6 py-4">Asesor</th>
                    <th class="px-6 py-4">Total Dinilai</th>
                    <th class="px-6 py-4">Approved</th>
                    <th class="px-6 py-4">Rejected</th>
                    <th class="px-6 py-4">Bidang</th>
                    <th class="px-6 py-4">Status Beban</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-50">
                @forelse($reportRows as $row)
                    <tr class="hover:bg-gray-50 transition-colors">
                        <td class="px-6 py-4 text-sm font-bold text-[#1A1A2E]">{{ $row->nama }}</td>
                        <td class="px-6 py-4 text-xs font-bold text-[#1565C0]">{{ $row->total_dinilai }}</td>
                        <td class="px-6 py-4 text-xs text-green-600 font-bold">{{ $row->approved_count }}</td>
                        <td class="px-6 py-4 text-xs text-red-600 font-bold">{{ $row->rejected_count }}</td>
                        <td class="px-6 py-4 text-xs text-[#5A6478]">{{ $row->bidang_keahlian }}</td>
                        <td class="px-6 py-4 text-xs text-[#5A6478]">{{ $row->assignments_count ?? 0 }} assignment</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-6 py-10 text-center text-sm text-[#5A6478]">Belum ada laporan asesor.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@endsection
