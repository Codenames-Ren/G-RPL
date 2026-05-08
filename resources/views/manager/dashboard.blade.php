{{-- resources/views/manager/dashboard.blade.php --}}
@extends('manager.layout')
@section('page_title', 'Dashboard Manajer RPL')
@section('manager_content')

{{-- Statistik Ringkas --}}
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
    {{-- Total Pengajuan --}}
    <div class="bg-white border border-[#1565C0]/15 rounded-xl p-6 shadow-sm">
        <div class="flex items-center justify-between mb-4">
            <p class="text-xs font-bold text-[#5A6478] uppercase tracking-wider">Total Pengajuan</p>
            <div class="w-10 h-10 rounded-full bg-blue-50 flex items-center justify-center">
                <svg class="w-5 h-5 text-[#1565C0]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
            </div>
        </div>
        <h3 class="font-heading text-3xl font-extrabold text-[#1A1A2E]">156</h3>
        <p class="text-[10px] text-[#5A6478] mt-1">Semester Ganjil 2025/2026</p>
    </div>

    {{-- Menunggu Review --}}
    <div class="bg-white border border-[#1565C0]/15 rounded-xl p-6 shadow-sm">
        <div class="flex items-center justify-between mb-4">
            <p class="text-xs font-bold text-[#5A6478] uppercase tracking-wider">Menunggu Review</p>
            <div class="w-10 h-10 rounded-full bg-yellow-50 flex items-center justify-center">
                <svg class="w-5 h-5 text-[#F9A825]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            </div>
        </div>
        <h3 class="font-heading text-3xl font-extrabold text-[#F9A825]">23</h3>
        <p class="text-[10px] text-[#5A6478] mt-1">Belum ditugaskan ke asesor</p>
    </div>

    {{-- Sedang Dinilai --}}
    <div class="bg-white border border-[#1565C0]/15 rounded-xl p-6 shadow-sm">
        <div class="flex items-center justify-between mb-4">
            <p class="text-xs font-bold text-[#5A6478] uppercase tracking-wider">Sedang Dinilai</p>
            <div class="w-10 h-10 rounded-full bg-purple-50 flex items-center justify-center">
                <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path></svg>
            </div>
        </div>
        <h3 class="font-heading text-3xl font-extrabold text-purple-600">45</h3>
        <p class="text-[10px] text-[#5A6478] mt-1">Dalam proses asesmen</p>
    </div>

    {{-- Selesai --}}
    <div class="bg-white border border-[#1565C0]/15 rounded-xl p-6 shadow-sm">
        <div class="flex items-center justify-between mb-4">
            <p class="text-xs font-bold text-[#5A6478] uppercase tracking-wider">Selesai</p>
            <div class="w-10 h-10 rounded-full bg-green-50 flex items-center justify-center">
                <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            </div>
        </div>
        <h3 class="font-heading text-3xl font-extrabold text-green-600">88</h3>
        <p class="text-[10px] text-[#5A6478] mt-1">Termasuk approved & rejected</p>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    {{-- Pengajuan Terbaru (Tabel Ringkas) --}}
    <div class="lg:col-span-2 bg-white border border-[#1565C0]/15 rounded-xl shadow-sm overflow-hidden">
        <div class="p-6 border-b border-gray-100 flex items-center justify-between">
            <div>
                <h2 class="font-heading font-bold text-[#1A1A2E]">Pengajuan Terbaru</h2>
                <p class="text-xs text-[#5A6478] mt-0.5">5 pengajuan terakhir yang masuk</p>
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
                    @php
                        $submissions = [
                            ['Budi Santoso', 'S1 Teknik Informatika', 'Tipe A', 'Submitted', 'bg-blue-50 text-blue-700'],
                            ['Siti Aminah', 'S1 Sistem Informasi', 'Tipe B', 'Assigned', 'bg-purple-50 text-purple-700'],
                            ['Andi Pratama', 'S1 Teknik Elektro', 'Tipe A', 'Submitted', 'bg-blue-50 text-blue-700'],
                            ['Rina Wijaya', 'D3 Manajemen', 'Tipe A', 'Submitted', 'bg-blue-50 text-blue-700'],
                            ['Doni Kusuma', 'S1 Akuntansi', 'Tipe B', 'Submitted', 'bg-blue-50 text-blue-700'],
                        ];
                    @endphp
                    @foreach($submissions as $item)
                    <tr class="hover:bg-gray-50 transition-colors">
                        <td class="px-6 py-4 text-sm font-bold text-[#1A1A2E]">{{ $item[0] }}</td>
                        <td class="px-6 py-4 text-xs text-[#5A6478]">{{ $item[1] }}</td>
                        <td class="px-6 py-4">
                            <span class="px-2 py-1 rounded-full text-[10px] font-bold {{ $item[2] == 'Tipe A' ? 'bg-blue-50 text-[#1565C0]' : 'bg-orange-50 text-[#E65100]' }}">{{ $item[2] }}</span>
                        </td>
                        <td class="px-6 py-4">
                            <span class="px-2 py-1 rounded text-[10px] font-bold {{ $item[4] }}">{{ $item[3] }}</span>
                        </td>
                        <td class="px-6 py-4">
                            <button class="text-xs font-bold text-[#1565C0] hover:underline">Review</button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    {{-- Quick Actions & Asesor Aktif --}}
    <div class="space-y-6">
        {{-- Quick Actions --}}
        <div class="bg-white border border-[#1565C0]/15 rounded-xl p-6 shadow-sm">
            <h2 class="font-heading font-bold text-[#1A1A2E] mb-4">Aksi Cepat</h2>
            <div class="space-y-3">
                <a href="{{ route('manager.applications') }}" class="flex items-center gap-3 p-3 bg-[#F8FAFC] rounded-lg hover:bg-[#E3F0FF] transition-colors group">
                    <div class="w-8 h-8 rounded-full bg-blue-100 flex items-center justify-center group-hover:bg-[#1565C0] group-hover:text-white transition-colors">
                        <svg class="w-4 h-4 text-[#1565C0] group-hover:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                    </div>
                    <span class="text-sm font-bold text-[#5A6478] group-hover:text-[#1565C0]">Review Pengajuan Baru</span>
                </a>
                <a href="{{ route('manager.assignment') }}" class="flex items-center gap-3 p-3 bg-[#F8FAFC] rounded-lg hover:bg-[#E3F0FF] transition-colors group">
                    <div class="w-8 h-8 rounded-full bg-purple-100 flex items-center justify-center group-hover:bg-purple-600 group-hover:text-white transition-colors">
                        <svg class="w-4 h-4 text-purple-600 group-hover:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                    </div>
                    <span class="text-sm font-bold text-[#5A6478] group-hover:text-[#1565C0]">Assign Asesor</span>
                </a>
                <a href="{{ route('manager.reports') }}" class="flex items-center gap-3 p-3 bg-[#F8FAFC] rounded-lg hover:bg-[#E3F0FF] transition-colors group">
                    <div class="w-8 h-8 rounded-full bg-green-100 flex items-center justify-center group-hover:bg-green-600 group-hover:text-white transition-colors">
                        <svg class="w-4 h-4 text-green-600 group-hover:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path></svg>
                    </div>
                    <span class="text-sm font-bold text-[#5A6478] group-hover:text-[#1565C0]">Generate Laporan</span>
                </a>
            </div>
        </div>

        {{-- Asesor Tersedia --}}
        <div class="bg-white border border-[#1565C0]/15 rounded-xl p-6 shadow-sm">
            <h2 class="font-heading font-bold text-[#1A1A2E] mb-4">Asesor Aktif</h2>
            <div class="space-y-3">
                @foreach([
                    ['Dr. Darmawan', 'S1 Teknik Informatika', '2 Antrean'],
                    ['Prof. Linda', 'S1 Sistem Informasi', '1 Antrean'],
                    ['Dr. Rahman', 'S1 Akuntansi', '0 Antrean'],
                ] as $asesor)
                <div class="flex items-center gap-3 p-2 hover:bg-gray-50 rounded-lg transition-colors">
                    <div class="w-8 h-8 rounded-full bg-[#E3F0FF] text-[#1565C0] flex items-center justify-center font-bold text-xs flex-shrink-0">
                        {{ substr($asesor[0], 0, 2) }}
                    </div>
                    <div class="flex-grow min-w-0">
                        <p class="text-xs font-bold text-[#1A1A2E] truncate">{{ $asesor[0] }}</p>
                        <p class="text-[10px] text-[#5A6478] truncate">{{ $asesor[1] }}</p>
                    </div>
                    <span class="text-[10px] font-bold text-[#5A6478] bg-gray-100 px-2 py-1 rounded-full flex-shrink-0">{{ $asesor[2] }}</span>
                </div>
                @endforeach
                <a href="{{ route('manager.asesors') }}" class="block text-center text-xs font-bold text-[#1565C0] hover:underline mt-2 pt-2 border-t border-gray-100">
                    Lihat Semua Asesor
                </a>
            </div>
        </div>
    </div>
</div>

@endsection