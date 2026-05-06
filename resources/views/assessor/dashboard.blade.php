{{-- resources/views/assessor/dashboard.blade.php --}}
@extends('assessor.layout')
@section('page_title', 'Panel Penilaian Asesor')
@section('assessor_content')

{{-- Statistik Ringkas (Stats Cards) --}}
<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
    <div class="bg-white border border-[#1565C0]/15 rounded-xl p-6 shadow-sm">
        <p class="text-xs font-bold text-[#5A6478] uppercase tracking-wider mb-2">Total Penugasan</p>
        <div class="flex items-end justify-between">
            <h3 class="font-heading text-3xl font-extrabold text-[#1A1A2E]">24</h3>
            <span class="text-[10px] px-2 py-1 bg-blue-50 text-[#1565C0] font-bold rounded">Bulan Ini</span>
        </div>
    </div>
    <div class="bg-white border border-[#1565C0]/15 rounded-xl p-6 shadow-sm">
        <p class="text-xs font-bold text-[#5A6478] uppercase tracking-wider mb-2">Belum Dinilai</p>
        <div class="flex items-end justify-between">
            <h3 class="font-heading text-3xl font-extrabold text-[#F9A825]">08</h3>
            <span class="text-[10px] px-2 py-1 bg-yellow-50 text-[#F9A825] font-bold rounded italic">Perlu Tindakan</span>
        </div>
    </div>
    <div class="bg-white border border-[#1565C0]/15 rounded-xl p-6 shadow-sm">
        <p class="text-xs font-bold text-[#5A6478] uppercase tracking-wider mb-2">Selesai Dinilai</p>
        <div class="flex items-end justify-between">
            <h3 class="font-heading text-3xl font-extrabold text-green-600">16</h3>
            <span class="text-[10px] px-2 py-1 bg-green-50 text-green-600 font-bold rounded">Tervalidasi</span>
        </div>
    </div>
</div>

{{-- Antrean Penilaian (Queue Table) --}}
<div class="bg-white border border-[#1565C0]/15 rounded-xl shadow-sm overflow-hidden">
    <div class="p-6 border-b border-gray-100 flex items-center justify-between">
        <h2 class="font-heading font-bold text-[#1A1A2E]">Antrean Penilaian Mahasiswa</h2>
        <div class="flex gap-2">
            <input type="text" placeholder="Cari nama..." class="text-xs border border-gray-300 rounded-lg px-3 py-2 outline-none focus:border-[#1565C0] w-48">
        </div>
    </div>
    
    <div class="overflow-x-auto">
        <table class="w-full text-left">
            <thead class="bg-[#F8FAFC] text-[11px] font-bold text-[#5A6478] uppercase tracking-widest border-b border-gray-100">
                <tr>
                    <th class="px-6 py-4">Mahasiswa</th>
                    <th class="px-6 py-4">Tipe RPL</th>
                    <th class="px-6 py-4">Program Studi</th>
                    <th class="px-6 py-4">Tgl Ditugaskan</th>
                    <th class="px-6 py-4">Urgensi</th>
                    <th class="px-6 py-4 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-50">
                {{-- Baris 1 (Urgent Overdue Alert based on PRD) --}}
                <tr class="hover:bg-gray-50 transition-colors">
                    <td class="px-6 py-4">
                        <p class="text-sm font-bold text-[#1A1A2E]">Andi Pratama</p>
                        <p class="text-[10px] text-gray-400 font-mono">APP-2024-001</p>
                    </td>
                    <td class="px-6 py-4">
                        <span class="px-2 py-1 bg-blue-50 text-[#1565C0] text-[10px] font-bold rounded-full">Tipe A (Formal)</span>
                    </td>
                    <td class="px-6 py-4 text-xs font-medium text-[#5A6478]">S1 Teknik Informatika</td>
                    <td class="px-6 py-4 text-xs text-[#5A6478]">01 Mei 2024</td>
                    <td class="px-6 py-4">
                        <span class="inline-flex items-center gap-1 text-[10px] font-bold text-[#D32F2F] bg-red-50 px-2 py-1 rounded">
                            <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path></svg>
                            Overdue (3 Hari)
                        </span>
                    </td>
                    <td class="px-6 py-4 text-center">
                        <a href="#" class="inline-block px-4 py-2 bg-[#1565C0] text-white text-[11px] font-bold rounded-lg hover:bg-[#0D47A1] transition-colors">Buka Asesmen</a>
                    </td>
                </tr>

                {{-- Baris 2 --}}
                <tr class="hover:bg-gray-50 transition-colors">
                    <td class="px-6 py-4">
                        <p class="text-sm font-bold text-[#1A1A2E]">Siti Aminah</p>
                        <p class="text-[10px] text-gray-400 font-mono">APP-2024-005</p>
                    </td>
                    <td class="px-6 py-4">
                        <span class="px-2 py-1 bg-orange-50 text-[#E65100] text-[10px] font-bold rounded-full">Tipe B (Non-Formal)</span>
                    </td>
                    <td class="px-6 py-4 text-xs font-medium text-[#5A6478]">S1 Sistem Informasi</td>
                    <td class="px-6 py-4 text-xs text-[#5A6478]">04 Mei 2024</td>
                    <td class="px-6 py-4">
                        <span class="text-[10px] font-bold text-[#F9A825] bg-yellow-50 px-2 py-1 rounded">Menunggu</span>
                    </td>
                    <td class="px-6 py-4 text-center">
                        <a href="#" class="inline-block px-4 py-2 bg-[#1565C0] text-white text-[11px] font-bold rounded-lg hover:bg-[#0D47A1] transition-colors">Buka Asesmen</a>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    <div class="p-6 border-t border-gray-50 flex items-center justify-between">
        <p class="text-xs text-[#5A6478]">Menampilkan 2 dari 8 penugasan</p>
        <div class="flex gap-2">
            <button class="px-3 py-1 border border-gray-200 text-gray-400 rounded-lg text-xs hover:bg-gray-50 disabled:opacity-50">Prev</button>
            <button class="px-3 py-1 bg-[#1565C0] text-white rounded-lg text-xs">1</button>
            <button class="px-3 py-1 border border-gray-200 text-[#5A6478] rounded-lg text-xs hover:bg-gray-50">Next</button>
        </div>
    </div>
</div>

@endsection