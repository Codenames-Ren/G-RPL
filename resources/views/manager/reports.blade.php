{{-- resources/views/manager/reports.blade.php --}}
@extends('manager.layout')
@section('page_title', 'Laporan & Statistik')
@section('manager_content')

<div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
    {{-- Grafik Status Pengajuan --}}
    <div class="bg-white border border-[#1565C0]/15 rounded-xl p-6 shadow-sm">
        <h2 class="font-heading font-bold text-[#1A1A2E] mb-6">Status Pengajuan</h2>
        <div class="space-y-4">
            @php
                $statusData = [
                    ['Submitted', 23, 'bg-blue-500', '23%'],
                    ['Assigned', 45, 'bg-purple-500', '29%'],
                    ['Approved', 72, 'bg-green-500', '46%'],
                    ['Rejected', 16, 'bg-red-500', '10%'],
                ];
            @endphp
            @foreach($statusData as $data)
            <div>
                <div class="flex justify-between text-xs font-bold mb-1.5">
                    <span class="text-[#5A6478]">{{ $data[0] }}</span>
                    <span class="text-[#1A1A2E]">{{ $data[1] }} ({{ $data[3] }})</span>
                </div>
                <div class="w-full bg-gray-100 rounded-full h-2.5">
                    <div class="h-2.5 rounded-full {{ $data[2] }}" style="width: {{ $data[3] }}"></div>
                </div>
            </div>
            @endforeach
        </div>
        <p class="text-[10px] text-[#5A6478] mt-4 pt-4 border-t border-gray-100">Total: 156 pengajuan</p>
    </div>

    {{-- Ringkasan Cepat --}}
    <div class="bg-white border border-[#1565C0]/15 rounded-xl p-6 shadow-sm">
        <h2 class="font-heading font-bold text-[#1A1A2E] mb-6">Ringkasan Kinerja</h2>
        <div class="grid grid-cols-2 gap-4">
            <div class="bg-[#F8FAFC] rounded-xl p-4 text-center">
                <p class="text-[10px] text-[#5A6478] uppercase font-bold">Rata-rata Waktu Asesmen</p>
                <p class="text-2xl font-extrabold text-[#1565C0] mt-2">5.2</p>
                <p class="text-xs text-[#5A6478]">Hari</p>
            </div>
            <div class="bg-[#F8FAFC] rounded-xl p-4 text-center">
                <p class="text-[10px] text-[#5A6478] uppercase font-bold">SKS Diakui (Rata-rata)</p>
                <p class="text-2xl font-extrabold text-green-600 mt-2">21</p>
                <p class="text-xs text-[#5A6478]">SKS</p>
            </div>
            <div class="bg-[#F8FAFC] rounded-xl p-4 text-center">
                <p class="text-[10px] text-[#5A6478] uppercase font-bold">Tingkat Approval</p>
                <p class="text-2xl font-extrabold text-green-600 mt-2">82%</p>
                <p class="text-xs text-[#5A6478]">Approved</p>
            </div>
            <div class="bg-[#F8FAFC] rounded-xl p-4 text-center">
                <p class="text-[10px] text-[#5A6478] uppercase font-bold">Asesor Aktif</p>
                <p class="text-2xl font-extrabold text-purple-600 mt-2">6</p>
                <p class="text-xs text-[#5A6478]">Orang</p>
            </div>
        </div>
    </div>
</div>

{{-- Tabel Laporan Detail --}}
<div class="bg-white border border-[#1565C0]/15 rounded-xl shadow-sm overflow-hidden">
    <div class="p-6 border-b border-gray-100 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <h2 class="font-heading font-bold text-[#1A1A2E]">Laporan Detail Asesmen</h2>
            <p class="text-xs text-[#5A6478] mt-0.5">Rekap hasil asesmen per asesor</p>
        </div>
        <div class="flex gap-2">
            <select class="text-xs border border-gray-300 rounded-lg px-3 py-2 outline-none focus:border-[#1565C0]">
                <option>Semua Asesor</option>
                <option>Dr. Darmawan</option>
                <option>Prof. Linda</option>
                <option>Dr. Rahman</option>
            </select>
            <button class="px-4 py-2 bg-green-600 text-white text-xs font-bold rounded-lg hover:bg-green-700 transition-colors flex items-center gap-1.5">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                Export Excel
            </button>
        </div>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full text-left">
            <thead class="bg-[#F8FAFC] text-[11px] font-bold text-[#5A6478] uppercase tracking-widest border-b border-gray-100">
                <tr>
                    <th class="px-6 py-4">Asesor</th>
                    <th class="px-6 py-4">Total Dinilai</th>
                    <th class="px-6 py-4">Approved</th>
                    <th class="px-6 py-4">Rejected</th>
                    <th class="px-6 py-4">SKS Diakui (Rata-rata)</th>
                    <th class="px-6 py-4">Rata-rata Waktu</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-50">
                @foreach([
                    ['Dr. Darmawan', 28, 22, 6, '24 SKS', '4.5 hari'],
                    ['Prof. Linda', 20, 17, 3, '20 SKS', '5.2 hari'],
                    ['Dr. Rahman', 15, 13, 2, '18 SKS', '6.1 hari'],
                    ['Dr. Susanto', 18, 14, 4, '22 SKS', '4.8 hari'],
                    ['Dr. Kartika', 7, 6, 1, '19 SKS', '5.5 hari'],
                ] as $row)
                <tr class="hover:bg-gray-50 transition-colors">
                    <td class="px-6 py-4 text-sm font-bold text-[#1A1A2E]">{{ $row[0] }}</td>
                    <td class="px-6 py-4 text-xs font-bold text-[#1565C0]">{{ $row[1] }}</td>
                    <td class="px-6 py-4 text-xs text-green-600 font-bold">{{ $row[2] }}</td>
                    <td class="px-6 py-4 text-xs text-red-600 font-bold">{{ $row[3] }}</td>
                    <td class="px-6 py-4 text-xs text-[#5A6478]">{{ $row[4] }}</td>
                    <td class="px-6 py-4 text-xs text-[#5A6478]">{{ $row[5] }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection